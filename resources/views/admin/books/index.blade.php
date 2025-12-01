@extends('layouts.app')

@section('title','Books')
@section('page-title','Books')
@section('page-subtitle','Manage all books')

@section('content')

<div class="mb-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">

  <!-- Search Form -->
  <form method="GET" class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full md:w-auto">
    <input name="q"
           value="{{ request('q') }}"
           type="search"
           placeholder="Search book title"
           class="px-3 py-2 border rounded w-full md:w-80" />

    <button class="px-4 py-2 bg-blue-600 text-white rounded w-full md:w-auto">
      Search
    </button>

    <a href="{{ route('admin.books.index') }}"
       class="text-sm text-gray-500">
       Reset
    </a>
  </form>

  <!-- Add Button -->
  <a href="{{ route('admin.books.create') }}"
     class="px-4 py-2 bg-green-600 text-white rounded w-full md:w-auto text-center">
     Add New Book
  </a>

</div>

<div class="bg-white shadow rounded overflow-hidden">

  <!-- Responsive Scroll -->
  <div class="overflow-x-auto">

    <table class="min-w-full divide-y">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-sm text-gray-600">#</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Book</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Author</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Category</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600 hidden sm:table-cell">Views</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600 hidden sm:table-cell">Rating / Review</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600 hidden md:table-cell">Status</th>
          <th class="px-4 py-3 text-right text-sm text-gray-600">Actions</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y">
        @forelse($books as $book)
        <tr>
          <td class="px-4 py-3 text-sm">{{ $book->id }}</td>

          <td class="px-4 py-3">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                @if($book->image)
                  <img src="{{ asset('storage/'.$book->image) }}" class="w-full h-full object-cover" />
                @else
                  <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">N/A</div>
                @endif
              </div>
              <div class="break-words">
                <div class="font-medium text-gray-800">{{ $book->title }}</div>
                <div class="text-xs text-gray-500">{{ Str::limit($book->overview, 80) }}</div>
              </div>
            </div>
          </td>

          <td class="px-4 py-3 text-sm">{{ $book->author }}</td>
          <td class="px-4 py-3 text-sm">{{ $book->category->name ?? '-' }}</td>
          <td class="px-4 py-3 text-sm hidden sm:table-cell">{{ $book->views }}</td>
          <td class="px-4 py-3 text-sm hidden sm:table-cell">{{ $book->rating }} / {{ $book->review }}</td>
          <td class="px-4 py-3 text-sm hidden md:table-cell">
    <form action="{{ route('admin.books.toggle-status', $book) }}" 
          method="POST" 
          onsubmit="return confirm('Change approval status?');">
        @csrf
        @method('PATCH')

        @if($book->is_active)
            <button class="px-2 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200">
                Approved ✓
            </button>
        @else
            <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                Pending...
            </button>
        @endif
    </form>
</td>


          <td class="px-4 py-3 text-sm text-right whitespace-nowrap">
            <a href="{{ route('admin.books.edit', $book) }}"
               class="inline-block px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded">
               Edit
            </a>

            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete this book?');">
              @csrf
              @method('DELETE')
              <button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded">Delete</button>
            </form>

            <a href="{{ route('admin.books.parts.index', $book) }}"
               class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded">
               Parts
            </a>
          </td>

        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-4 py-6 text-center text-gray-500">
            No books found.
          </td>
        </tr>
        @endforelse
      </tbody>

    </table>
  </div>

</div>

<div class="mt-4">
  {{ $books->links() }}
</div>

@endsection
