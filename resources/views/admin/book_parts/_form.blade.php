@php
    $part = $part ?? null;
    $isEdit = $part && $part->id;
@endphp

<form method="POST" action="{{ $isEdit ? route('admin.books.parts.update', [$book, $part]) : route('admin.books.parts.store', $book) }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div>
            <label class="text-sm font-medium">Title</label>
            <input name="title" value="{{ old('title', $part->title ?? '') }}" class="w-full px-3 py-2 border rounded" required>
            @error('title')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Thumbnail -->
        <div>
            <label class="text-sm font-medium">Thumbnail</label>
            <input type="file" name="thumbnail" class="w-full">
            @if(!empty($part->thumbnail))
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$part->thumbnail) }}" class="w-28 h-28 object-cover rounded" alt="thumbnail">
                </div>
            @endif
            @error('thumbnail')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Details -->
        <div class="md:col-span-2">
            <label class="text-sm font-medium">Details</label>
            <textarea id="details-editor" name="details" class="w-full px-3 py-2 border rounded" rows="6">{{ old('details', $part->details ?? '') }}</textarea>
            @error('details')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Rating -->
        <div>
            <label class="text-sm font-medium">Rating</label>
            <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', $part->rating ?? 0) }}" class="w-full px-3 py-2 border rounded">
            @error('rating')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Review Count -->
        <div>
            <label class="text-sm font-medium">Review Count</label>
            <input type="number" min="0" name="review_count" value="{{ old('review_count', $part->review_count ?? 0) }}" class="w-full px-3 py-2 border rounded">
            @error('review_count')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Views -->
        <div>
            <label class="text-sm font-medium">Views</label>
            <input type="number" min="0" name="views" value="{{ old('views', $part->views ?? 0) }}" class="w-full px-3 py-2 border rounded">
            @error('views')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Position -->
        <div>
            <label class="text-sm font-medium">Position</label>
            <input type="number" min="0" name="position" value="{{ old('position', $part->position ?? 0) }}" class="w-full px-3 py-2 border rounded">
            @error('position')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>

        <!-- Status -->
        <div class="md:col-span-2">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $part->is_active ?? true) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm">Active</span>
            </label>
        </div>

        <!-- Notes -->
        <div class="md:col-span-2">
            <label class="text-sm font-medium">Notes</label>
            <textarea name="notes" class="w-full px-3 py-2 border rounded" rows="3">{{ old('notes', $part->notes ?? '') }}</textarea>
            @error('notes')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row gap-2 justify-end mt-2">
        <a href="{{ route('admin.books.parts.index', $book) }}" class="px-4 py-2 border rounded text-gray-700 text-center">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $isEdit ? 'Update Part' : 'Create Part' }}</button>
    </div>
</form>

<!-- TinyMCE Full Cloud Version -->
<script src="https://cdn.tiny.cloud/1/0gac9oqpszmertij59e2j5wfaoiism15amoohpbml7bcswu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#details-editor',
    menubar: false,
    plugins: 'link image media lists table code wordcount',
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | code',
    height: 300,
    branding: false,
    content_style: 'body { font-family:Inter,system-ui; font-size:16px }'
});
</script>
<style>
.tox-tinymce {
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
}
</style>
