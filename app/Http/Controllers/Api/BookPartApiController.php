<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\BookPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookPartApiController extends Controller
{
    // Fetch all parts under a book
    public function index(Book $book)
    {
        $book->load([
            'category',
            'authorUser',
            'parts' => function ($q) {
                $q->orderBy('position');
            }
        ]);

        return response()->json([
            'status' => 'success',
            'book' => $book,
            'parts' => $book->parts,
        ]);
    }


    // Fetch single part
    public function show(Book $book, BookPart $part)
    {
        return response()->json([
            'status' => 'success',
            'book' => $book->load('category', 'authorUser'),
            'part' => $part,
        ]);
    }


    // Create a part (Admin/User both)
    public function store(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('book_parts', 'public');
            $data['thumbnail'] = $path;
        }

        $data['is_active'] = $data['is_active'] ?? false;
        $data['views'] = $data['views'] ?? 0;
        $data['rating'] = $data['rating'] ?? 0;
        $data['review_count'] = $data['review_count'] ?? 0;

        $data['book_id'] = $book->id;

        $part = BookPart::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Book Part added successfully',
            'data' => $part
        ], 201);
    }

    public function update(Request $request, Book $book, BookPart $part)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'details'       => 'nullable|string',
            'rating'        => 'nullable|numeric|min:0|max:5',
            'review_count'  => 'nullable|integer|min:0',
            'views'         => 'nullable|integer|min:0',
            'is_active'     => 'nullable|boolean',
            'position'      => 'nullable|integer|min:0',
            'notes'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // 🔥 Default: inactive (যদি পাঠানো না হয়)
        $data['is_active'] = $data['is_active'] ?? false;

        // Update Book Part
        $part->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Book part updated successfully',
            'data'    => $part
        ], 200);
    }


    public function destroy(BookPart $part)
    {
        try {
            // যদি এই পার্টের সাথে কোন PDF, audio, বা file থাকে তবে সেগুলো delete করবেন
            if ($part->file_path && Storage::disk('public')->exists($part->file_path)) {
                Storage::disk('public')->delete($part->file_path);
            }

            // Database থেকে delete
            $part->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Book part deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
