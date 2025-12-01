<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // List with search & pagination
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status');

        $categories = Category::query()
            ->when($q, fn($query) => $query->where('name', 'like', "%{$q}%"))
            ->when($status !== null, fn($query) => $query->where('is_active', $status))
            ->orderBy('position', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.categories.index', compact('categories', 'q', 'status'));
    }

    // Create form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:190',
            'slug' => 'nullable|string|max:190|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'is_active' => 'sometimes|boolean',
            'position' => 'nullable|integer|min:0',
        ]);

        // handle image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        // slug fallback
        if (empty($data['slug'])) {
            $data['slug'] = Category::createUniqueSlug($data['name']);
        }

        $data['is_active'] = isset($data['is_active']) ? (bool)$data['is_active'] : true;
        $data['position'] = $data['position'] ?? 0;

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Edit form
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:190'],
            'slug' => ['nullable','string','max:190', Rule::unique('categories','slug')->ignore($category->id)],
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'is_active' => 'sometimes|boolean',
            'position' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // delete old image
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        // if slug empty, regenerate from name
        if (empty($data['slug'])) {
            $data['slug'] = Category::createUniqueSlug($data['name'], $category->id);
        }

        $data['is_active'] = isset($data['is_active']) ? (bool)$data['is_active'] : false;
        $data['position'] = $data['position'] ?? $category->position;

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Destroy
    public function destroy(Category $category)
    {
        // delete image
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
