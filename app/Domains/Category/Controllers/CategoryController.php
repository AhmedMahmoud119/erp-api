<?php

namespace App\Domains\Category\Controllers;

use App\Domains\Category\Models\EnumPermissionCategory;
use App\Domains\Category\Request\StoreCategoryRequest;
use App\Domains\Category\Request\UpdateCategoryRequest;
use App\Domains\Category\Resources\CategoryResource;
use App\Domains\Category\Services\CategoryService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCategory::view_categories->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CategoryResource($this->categoryService->findById($id));
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCategory::view_categories->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  CategoryResource::collection($this->categoryService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCategory::delete_category->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->categoryService->delete($id);
        return response()->json([
            'message' => __('Category deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StoreCategoryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCategory::create_category->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->categoryService->create($request);
        return response()->json([
            'message' => __('Category created successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateCategoryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCategory::edit_category->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->categoryService->update($id, $request);
        return response()->json([
            'message' => __('Category information updated successfully!'),
            'status' => true,
        ], 200);
    }

}
