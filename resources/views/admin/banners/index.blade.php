@extends('layouts.app')

@section('title','Banners')

@section('content')
<div class="flex justify-between mb-4">
    <a href="{{ route('admin.banners.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded">Add Banner</a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Image</th>
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2 text-left">Position</th>
                <th class="px-4 py-2 text-left">Sort</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banners as $banner)
            <tr class="border-b">
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/'.$banner->image) }}" class="w-24 h-14 object-cover rounded">
                </td>
                <td class="px-4 py-2">{{ $banner->title }}</td>
                <td class="px-4 py-2">{{ $banner->position }}</td>
                <td class="px-4 py-2">{{ $banner->sort_order }}</td>
                <td class="px-4 py-2">
                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                </td>
                <td class="px-4 py-2 text-right">
                    <a href="{{ route('admin.banners.edit', $banner) }}"
                       class="text-blue-600 mr-2">Edit</a>

                    <form action="{{ route('admin.banners.destroy', $banner) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Delete Banner?');">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
