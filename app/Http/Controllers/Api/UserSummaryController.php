<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserSummaryController extends Controller
{
    public function summary($userId)
    {
        $user = User::with(['books.category'])
            ->with(['books.parts'])
            ->with(['books.userReviews.user'])
            ->findOrFail($userId);

        // All books authored by this user
        $books = $user->books;

        $totalBooks = $books->count();
        $totalViews = $books->sum('views');
        $totalReviews = $books->sum('review'); // number of reviews
        $averageRating = $books->avg('rating') ?? 0;

        return response()->json([
            'status' => 'success',
            'author' => [
                'id' => $user->id,
                'name' => $user->name,
                'profile_image' => $user->profile_image,
            ],
            'summary' => [
                'total_books' => $totalBooks,
                'total_views' => $totalViews,
                'total_reviews' => $totalReviews,
                'average_rating' => round($averageRating, 2),
            ],
            'books' => $books
        ]);
    }
}
