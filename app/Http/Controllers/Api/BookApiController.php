<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\User;
use App\Models\BookReview;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{
    // List all books
    public function index()
    {
        $books = Book::with('category')->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    // View single book
    public function show(Book $book)
    {
        return response()->json([
            'status' => 'success',
            'data' => $book->load('category', 'parts')
        ]);
    }

    // Create new book
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'overview' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'views' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $data['image'] = $path;
        }

        $user = User::find($data['user_id']);
        $data['author'] = $user->name;
        $data['author_id'] = $data['user_id']; // NEW → author = user_id
        unset($data['user_id']); // table এ user_id নেই

        $data['is_active'] = false;
        $data['views'] = $data['views'] ?? 0;
        $data['rating'] = $data['rating'] ?? 0;
        $data['review'] = $data['review'] ?? 0;

        $book = Book::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 201);
    }

    public function reviewstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create or update review
        $review = BookReview::updateOrCreate(
            ['book_id' => $request->book_id, 'user_id' => $request->user_id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        // Update book stats
        $review->book->updateRatingStats();

        return response()->json([
            'status' => 'success',
            'message' => 'Review submitted successfully.',
            'review' => $review->load('user')
        ]);
    }

    public function list($book_id)
    {
        $reviews = BookReview::with(['book', 'user'])
            ->where('book_id', $book_id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $reviews
        ]);
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'overview' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'views' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
            'user_id' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // If new image upload → delete old image
        if ($request->hasFile('image')) {

            // delete old image
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }

            // upload new image
            $path = $request->file('image')->store('books', 'public');
            $data['image'] = $path;
        }

        // If user_id provided → update author name
        if ($request->filled('user_id')) {
            $user = User::find($request->user_id);
            $data['author'] = $user->name;
            $data['author_id'] = $request->user_id;
            unset($data['user_id']);
        }

        // Force is_active always false
        $data['is_active'] = false;

        // Update book
        $book->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $book->fresh()
        ]);
    }


    // Delete book
    public function destroy(Book $book)
    {
        // Delete image if exists
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        // Delete book record
        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully.'
        ]);
    }
}
