<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookPart;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookPartController extends Controller
{
    public function index(Book $book)
    {
        $parts = $book->parts()->orderBy('position')->paginate(15);
        return view('admin.book_parts.index', compact('book', 'parts'));
    }

    public function create(Book $book)
    {
        return view('admin.book_parts.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:3072',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'views' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'position' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('book_parts', 'public');
        }

        $book->parts()->create($data);

        return redirect()->route('admin.books.parts.index', $book)
            ->with('success', 'Part added successfully.');
    }

    public function edit(Book $book, BookPart $part)
    {
        return view('admin.book_parts.edit', compact('book', 'part'));
    }

    public function update(Request $request, Book $book, BookPart $part)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:3072',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'views' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'position' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($part->thumbnail && Storage::disk('public')->exists($part->thumbnail)) {
                Storage::disk('public')->delete($part->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('book_parts', 'public');
        }

        $part->update($data);

        return redirect()->route('admin.books.parts.index', $book)
            ->with('success', 'Part updated successfully.');
    }

    public function destroy(Book $book, BookPart $part)
    {
        if ($part->thumbnail && Storage::disk('public')->exists($part->thumbnail)) {
            Storage::disk('public')->delete($part->thumbnail);
        }

        $part->delete();

        return redirect()->route('admin.books.parts.index', $book)
            ->with('success', 'Part deleted successfully.');
    }

    public function accept(Book $book, BookPart $part)
    {
        $part->update([
            'is_active' => true,
        ]);

        return redirect()->route('admin.books.parts.index', $book)
            ->with('success', 'Part has been accepted successfully.');
    }
}
