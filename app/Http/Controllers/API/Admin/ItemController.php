<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImages;
use App\Http\Requests\Admin\Item\ItemRequest;
use App\Http\Requests\Admin\Item\ItemImageRequest;
use App\Http\Requests\Admin\Item\ItemUpdateRequest;
use App\Http\Resources;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Admin\ItemResource;

class ItemController extends Controller
{
    /**
     * index of items
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(ItemResource::collection(Item::get()), HttpResponse::HTTP_OK);
    }

    /**
     * show of items
     * 
     * @param Item $item
     *
     * @return JsonResponse
     */
    public function show(Item $item)
    {
        return response()->json(new ItemResource($item), HttpResponse::HTTP_OK);
    }

    /**
     * store data of items
     * 
     * @param ItemRequest $request
     * 
     * @return JsonResponse
     */
    public function store(ItemRequest $request): JsonResponse
    {
        try {
            $items = Item::create($request->validated());
            
            if ($images = $request->item_image) {
                foreach ($images as $image) {
                    $items->addMedia($image)->toMediaCollection('images');
                }
            }
            return response()->json(new ItemResource($items), HttpResponse::HTTP_CREATED);

        } catch(\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating items: ' . $e->getMessage()], 404);
        }
    }

    /**
     * update data items
     * 
     * @param ItemUpdateRequest $request
     * @param Item $item
     * 
     * @return JsonResponse
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        try {
            $items = $item->update($request->validated());

            if($images = $request->item_image)
            {
                $items->clearMediaCollection('images');
                foreach($images as $image) 
                {
                    $items->addMedia($image)->toMediaCollection('images');
                }
            }

            return response()->json(new ItemResource($items), HttpResponse::HTTP_CREATED);
        } catch(\Exception $e) {
            return response()->json(['error' => 'An error occurred while updateing items: ' . $e->getMessage()], HttpResponse::BAD_REQUEST);
        }   
    }

     /**
     * delete category data
     * 
     * @param Item $item
     * @param ItemImages $itemImages
     * 
     * @return JsonResponse
     */
    public function destroy(Item $item, ItemImages $itemImages)
    {
        $item->delete();
        
        return response()->json([], HttpResponse::HTTP_NO_CONTENT);
    }
}
