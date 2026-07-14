<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\FileHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon_image' => $this->uploadFile($request, 'icon_image', null, 'categories'),
            'bg_image' => $this->uploadFile($request, 'bg_image', null, 'categories'),
            'status' => $request->status,
            'description' => $request->description,
            'show_at_home' => $request->show_at_home,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $oldIcon = $category->icon_image;
        $old_bg = $category->bg_image;

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon_image' => $this->uploadFile($request, 'icon_image', $oldIcon, 'categories'),
            'bg_image' => $this->uploadFile($request, 'bg_image', $old_bg, 'categories'),
            'status' => $request->status,
            'description' => $request->description,
            'show_at_home' => $request->show_at_home,
        ]);
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

        // called in observerClass Delete images dynamically
//        $this->deleteFile($category->icon_image, 'categories');
//        $this->deleteFile($category->bg_image, 'categories');

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'deleted successfully.');
    }
}
