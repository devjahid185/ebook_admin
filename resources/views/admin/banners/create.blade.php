@extends('layouts.app')

@section('title', 'Create Banner')
@section('page-title', 'Create Banner')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
  <h3 class="text-lg font-semibold mb-4">Add New Banner</h3>

  <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Title -->
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Title (optional)</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border rounded" placeholder="Short title for banner">
        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Position -->
      <div>
        <label class="block text-sm font-medium mb-1">Position</label>
        <select name="position" class="w-full px-3 py-2 border rounded" required>
          <option value="homepage" {{ old('position') == 'homepage' ? 'selected' : '' }}>Homepage</option>
          <option value="category" {{ old('position') == 'category' ? 'selected' : '' }}>Category</option>
          <option value="topbar" {{ old('position') == 'topbar' ? 'selected' : '' }}>Topbar</option>
          <option value="bottom" {{ old('position') == 'bottom' ? 'selected' : '' }}>Bottom</option>
          <option value="custom" {{ old('position') == 'custom' ? 'selected' : '' }}>Custom</option>
        </select>
        @error('position') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Sort order -->
      <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3 py-2 border rounded" min="0">
        @error('sort_order') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Image -->
      <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Banner Image <span class="text-xs text-gray-500">(required)</span></label>

        <div class="flex items-center gap-4">
          <input type="file" name="image" id="banner-image-input" accept="image/*" class="block" required>
          <div id="banner-preview" class="w-40 h-20 bg-gray-50 border rounded overflow-hidden flex items-center justify-center text-gray-400">
            <span class="text-xs">Preview</span>
          </div>
        </div>

        <p class="text-xs text-gray-500 mt-2">
          Recommended sizes:
          <strong class="ml-1">Mobile:</strong> 1080×450 px (ratio ~2.4:1) —
          <strong class="ml-2">Web hero:</strong> 1920×650 px.
        </p>

        @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Active -->
      <div>
        <label class="inline-flex items-center mt-1">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
          <span class="text-sm">Active</span>
        </label>
      </div>

      <!-- Optional: external link -->
      <div>
        <label class="block text-sm font-medium mb-1">Book Id (optional)</label>
        <input type="text" name="book_id" value="{{ old('book_id') }}" class="w-full px-3 py-2 border rounded" placeholder="123">
        @error('book_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="flex items-center justify-end gap-2 mt-4">
      <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 border rounded text-gray-700">Cancel</a>
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Create Banner</button>
    </div>
  </form>
</div>

<!-- JS: image preview -->
<script>
  (function () {
    const input = document.getElementById('banner-image-input');
    const preview = document.getElementById('banner-preview');

    function showPreview(file) {
      if (!file) {
        preview.innerHTML = '<span class="text-xs">Preview</span>';
        return;
      }
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.innerHTML = '';
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-full object-cover';
        preview.appendChild(img);
      };
      reader.readAsDataURL(file);
    }

    input?.addEventListener('change', function (e) {
      const f = e.target.files && e.target.files[0];
      showPreview(f);
    });

    // If old uploaded file exists (editing scenario) - you can render server-side img instead.
  })();
</script>
@endsection
