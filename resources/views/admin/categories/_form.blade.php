@php
  $isEdit = isset($category) && $category;
@endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
      enctype="multipart/form-data"
      class="space-y-4">

  @csrf
  @if($isEdit)
    @method('PUT')
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    {{-- Name --}}
    <div>
      <label class="text-sm font-medium">Name</label>
      <input name="name"
             value="{{ old('name', $category->name ?? '') }}"
             class="w-full px-3 py-2 border rounded"
             required />
      @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    {{-- Slug --}}
    <div>
      <label class="text-sm font-medium">Slug (optional)</label>
      <input name="slug"
             value="{{ old('slug', $category->slug ?? '') }}"
             class="w-full px-3 py-2 border rounded" />
      @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    {{-- Description --}}
    <div class="md:col-span-2">
      <label class="text-sm font-medium">Description</label>
      <textarea name="description"
                class="w-full px-3 py-2 border rounded"
                rows="4">{{ old('description', $category->description ?? '') }}</textarea>
      @error('description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    {{-- Image --}}
    <div>
      <label class="text-sm font-medium">Image</label>
      <input type="file" name="image" class="w-full" />

      @if(isset($category->image))
        <div class="mt-2">
          <img src="{{ asset('storage/'.$category->image) }}" class="w-28 h-28 object-cover rounded">
        </div>
      @endif

      @error('image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    {{-- Position --}}
    <div>
      <label class="text-sm font-medium">Position</label>
      <input type="number" name="position"
             value="{{ old('position', $category->position ?? 0) }}"
             class="w-full px-3 py-2 border rounded" />
      @error('position')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    {{-- Active --}}
    <div class="md:col-span-2">
      <label class="inline-flex items-center">
        <input type="checkbox" name="is_active" value="1"
               {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
               class="mr-2" />
        <span class="text-sm">Active</span>
      </label>
    </div>

  </div>

  {{-- Buttons --}}
  <div class="flex justify-end gap-2">
    <a href="{{ route('admin.categories.index') }}"
       class="px-4 py-2 border rounded text-gray-600">
      Cancel
    </a>

    <button type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded">
      {{ $isEdit ? 'Update' : 'Create' }}
    </button>
  </div>

</form>
