<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $books = Book::with('category')
            ->when($q, fn($query) => $query->where('title', 'like', "%{$q}%"))
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.books.index', compact('books', 'q'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:3072',
            'overview' => 'nullable|string',
            'views' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|between:0,5',
            'review' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['author'] = "admin"; // fixed author

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:3072',
            'overview' => 'nullable|string',
            'views' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|between:0,5',
            'review' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['author'] = "admin"; // NEW

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    public function toggleStatus(Book $book)
    {
        $book->is_active = !$book->is_active;
        $book->save();

        return redirect()
            ->back()
            ->with('success', 'Book status updated successfully.');
    }
}
