@extends('layouts.app')

@section('title','Categories')
@section('page-title','Categories')
@section('page-subtitle','Create, edit or delete categories')

@section('content')
<div class="mb-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">

  {{-- Filter Form --}}
  <form method="GET" class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full md:w-auto">
    <input name="q" value="{{ $q ?? '' }}" 
      type="search" 
      placeholder="Search category name" 
      class="px-3 py-2 border rounded w-full md:w-72" />

    <select name="status" class="px-3 py-2 border rounded w-full md:w-auto">
      <option value="">All</option>
      <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
      <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
    </select>

    <button class="px-4 py-2 bg-blue-600 text-white rounded w-full md:w-auto">
      Filter
    </button>

    <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500">Reset</a>
  </form>

  {{-- Add Button --}}
  <a href="{{ route('admin.categories.create') }}" 
     class="px-4 py-2 bg-green-600 text-white rounded w-full md:w-auto text-center">
     Add Category
  </a>
</div>

<div class="bg-white shadow rounded overflow-hidden">

  {{-- Responsive Table Wrapper --}}
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-sm text-gray-600">#</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Image</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Name</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600 hidden sm:table-cell">Slug</th>
          <th class="px-4 py-3 text-left text-sm text-gray-600">Status</th>
          <th class="px-4 py-3 text-right text-sm text-gray-600">Actions</th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y">
        @forelse($categories as $category)
        <tr>
          <td class="px-4 py-3 text-sm">{{ $category->id }}</td>

          <td class="px-4 py-3">
            @if($category->image)
              <img src="{{ asset('storage/'.$category->image) }}" class="w-14 h-14 object-cover rounded">
            @else
              <div class="w-14 h-14 bg-gray-100 rounded flex items-center justify-center text-gray-400">N/A</div>
            @endif
          </td>

          <td class="px-4 py-3">
            <div class="font-medium text-gray-800">{{ $category->name }}</div>
            <div class="text-xs text-gray-500">{{ Str::limit($category->description, 80) }}</div>
          </td>

          <td class="px-4 py-3 text-sm hidden sm:table-cell">{{ $category->slug }}</td>

          <td class="px-4 py-3 text-sm">
            <span class="{{ $category->is_active ? 'text-green-600' : 'text-red-600' }}">
              {{ $category->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>

          <td class="px-4 py-3 text-sm text-right">
            <a href="{{ route('admin.categories.edit', $category) }}" 
               class="inline-block px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded">
               Edit
            </a>

            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                  class="inline-block"
                  onsubmit="return confirm('Are you sure to delete this category?');">
              @csrf
              @method('DELETE')
              <button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded">Delete</button>
            </form>
          </td>
        </tr>

        @empty
        <tr>
          <td colspan="6" class="px-4 py-6 text-center text-gray-500">No categories found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-4">
  {{ $categories->links() }}
</div>
@endsection
