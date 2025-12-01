@extends('layouts.app')

@section('title','Parts of '.$book->title)
@section('page-title','Book Parts')
@section('page-subtitle','Manage all parts for '.$book->title)

@section('content')
<div class="mb-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <!-- Add New Part Button -->
    <a href="{{ route('admin.books.parts.create', $book) }}"
        class="px-4 py-2 bg-green-600 text-white rounded w-full sm:w-auto text-center">
        Add New Part
    </a>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <!-- Horizontal scroll for mobile -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm text-gray-600">#</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-600">Thumbnail / Title</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-600">Views / Rating</th>
                    <th class="px-4 py-3 text-left text-sm text-gray-600 hidden md:table-cell">Status</th>
                    <th class="px-4 py-3 text-right text-sm text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($parts as $part)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $part->id }}</td>

                    <td class="px-4 py-3 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        @if($part->thumbnail)
                        <img src="{{ asset('storage/'.$part->thumbnail) }}" class="w-16 h-16 object-cover rounded" alt="thumb">
                        @else
                        <div class="w-16 h-16 bg-gray-100 flex items-center justify-center text-gray-400">N/A</div>
                        @endif
                        <div>
                            <div class="font-medium text-gray-800">{{ $part->title }}</div>
                            <div class="text-xs text-gray-500 break-words">{{ Str::limit($part->notes, 50) }}</div>
                        </div>
                    </td>

                    <td class="px-4 py-3 text-sm">
                        <div>Views: {{ $part->views }}</div>
                        <div>Rating: {{ $part->rating }} ({{ $part->review_count }} reviews)</div>
                    </td>

                    <td class="px-4 py-3 text-sm hidden md:table-cell">
    @if($part->is_active)
        <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Active</span>
    @else
        <span class="px-2 py-1 bg-gray-200 text-gray-600 rounded">Pending</span>
    @endif
</td>

                    <td class="px-4 py-3 text-sm text-right flex flex-col sm:flex-row items-start sm:items-center gap-2">

                        {{-- Edit Button --}}
                        <a href="{{ route('admin.books.parts.edit', [$book, $part]) }}"
                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-center">Edit</a>

                        {{-- Accept Button -> only when inactive --}}
                        @if(!$part->is_active)
                        <form action="{{ route('admin.books.parts.accept', [$book, $part]) }}"
                            method="POST"
                            onsubmit="return confirm('Accept this part?');">
                            @csrf
                            <button class="px-3 py-1 bg-blue-100 text-blue-800 rounded w-full sm:w-auto">
                                Accept
                            </button>
                        </form>
                        @endif

                        {{-- Delete --}}
                        <form action="{{ route('admin.books.parts.destroy', [$book, $part]) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Are you sure to delete this part?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-100 text-red-700 rounded w-full sm:w-auto">Delete</button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">No parts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $parts->links() }}
</div>
@endsection