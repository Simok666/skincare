<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * category index
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse 
    {
        return response()->json(CategoryResource::collection(Category::get()), HttpResponse::HTTP_OK);
    }

    /**
     * category show data
     * 
     * @param Category $category
     * 
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category), HttpResponse::HTTP_OK);
    }

    /**
     * store category data
     * 
     * @param CategoryRequest $request
     * 
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json(new CategoryResource($category), HttpResponse::HTTP_CREATED);
    }

    /**
     * update category data
     * 
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * 
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category) 
    {
        $category->update($request->validated());

        return response()->json(new CategoryResource($category), HttpResponse::HTTP_OK);
    }

    /**
     * delete category data
     * 
     * @param Category $category
     * 
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json([], HttpResponse::HTTP_NO_CONTENT);
    }

}
