@extends('layouts.app')

@section('title', 'Edit Banner')
@section('page-title', 'Edit Banner')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
  <h3 class="text-lg font-semibold mb-4">Edit Banner</h3>

  <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Title -->
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Title (optional)</label>
        <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full px-3 py-2 border rounded">
        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Position -->
      <div>
        <label class="block text-sm font-medium mb-1">Position</label>
        <select name="position" class="w-full px-3 py-2 border rounded">
          <option value="homepage" {{ $banner->position == 'homepage' ? 'selected' : '' }}>Homepage</option>
          <option value="category" {{ $banner->position == 'category' ? 'selected' : '' }}>Category</option>
          <option value="topbar" {{ $banner->position == 'topbar' ? 'selected' : '' }}>Topbar</option>
          <option value="bottom" {{ $banner->position == 'bottom' ? 'selected' : '' }}>Bottom</option>
          <option value="custom" {{ $banner->position == 'custom' ? 'selected' : '' }}>Custom</option>
        </select>
        @error('position') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Sort Order -->
      <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="w-full px-3 py-2 border rounded">
        @error('sort_order') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Image -->
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Banner Image</label>

        <div class="flex items-center gap-4 flex-wrap">
          <input type="file" name="image" id="banner-image-input" accept="image/*">

          <!-- Preview box -->
          <div id="banner-preview" class="w-40 h-20 bg-gray-50 border rounded overflow-hidden flex items-center justify-center text-gray-400">
            @if($banner->image)
              <img src="{{ asset('storage/' . $banner->image) }}" class="w-full h-full object-cover" id="old-preview">
            @else
              <span class="text-xs">Preview</span>
            @endif
          </div>
        </div>

        <p class="text-xs text-gray-500 mt-2">
          Recommended sizes: 1080×450px (mobile), 1920×650px (web).
        </p>

        @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Link -->
      <div>
        <label class="block text-sm font-medium mb-1">Book Id (optional)</label>
        <input type="text" name="book_id" value="{{ old('book_id', $banner->book_id) }}" class="w-full px-3 py-2 border rounded">
        @error('book_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Active -->
      <div>
        <label class="inline-flex items-center mt-1">
          <input type="checkbox" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }} class="mr-2">
          <span class="text-sm">Active</span>
        </label>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex items-center justify-end gap-2 mt-4">
      <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 border rounded text-gray-700">Cancel</a>
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
    </div>
  </form>
</div>

<script>
  (function () {
    const input = document.getElementById('banner-image-input');
    const preview = document.getElementById('banner-preview');
    const oldPreview = document.getElementById('old-preview');

    input?.addEventListener('change', function (e) {
      const file = e.target.files ? e.target.files[0] : null;
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (ev) {
        preview.innerHTML = '';
        const img = document.createElement('img');
        img.src = ev.target.result;
        img.className = 'w-full h-full object-cover';
        preview.appendChild(img);

        if (oldPreview) oldPreview.remove();
      };
      reader.readAsDataURL(file);
    });
  })();
</script>
@endsection
