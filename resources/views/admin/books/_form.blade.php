@php
    $isEdit = isset($book) && $book;
@endphp

<form method="POST" action="{{ $isEdit ? route('admin.books.update', $book) : route('admin.books.store') }}" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label class="text-sm font-medium">Title</label>
            <input name="title" value="{{ old('title', $book->title ?? '') }}" class="w-full px-3 py-2 border rounded" required />
            @error('title') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Category</label>
            <select name="category_id" class="w-full px-3 py-2 border rounded" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="text-sm font-medium">Overview</label>
            <textarea name="overview" class="w-full px-3 py-2 border rounded" rows="3">{{ old('overview', $book->overview ?? '') }}</textarea>
            @error('overview') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Book Image</label>
            <input type="file" name="image" class="w-full" />
            @if(!empty($book->image))
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$book->image) }}" class="w-28 h-28 object-cover rounded" alt="book">
                </div>
            @endif
            @error('image') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Views</label>
            <input type="number" name="views" value="{{ old('views', $book->views ?? 0) }}" class="w-full px-3 py-2 border rounded" min="0" />
            @error('views') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Rating (0-5)</label>
            <input type="number" step="0.01" max="5" min="0" name="rating" value="{{ old('rating', $book->rating ?? 0) }}" class="w-full px-3 py-2 border rounded" />
            @error('rating') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium">Review Count</label>
            <input type="number" min="0" name="review" value="{{ old('review', $book->review ?? 0) }}" class="w-full px-3 py-2 border rounded" />
            @error('review') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="inline-flex items-center mt-6">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $book->is_active ?? true) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm">Active</span>
            </label>
        </div>

        <div class="md:col-span-2">
            <label class="text-sm font-medium">Notes</label>
            <textarea name="notes" class="w-full px-3 py-2 border rounded" rows="2">{{ old('notes', $book->notes ?? '') }}</textarea>
            @error('notes') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div class="md:col-span-2 flex items-center justify-end gap-2 mt-2">
            <a href="{{ route('admin.books.index') }}" class="px-4 py-2 border rounded text-gray-700">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $isEdit ? 'Update' : 'Create' }}</button>
        </div>

    </div>
</form>
