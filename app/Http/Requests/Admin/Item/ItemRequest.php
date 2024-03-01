<?php

namespace App\Http\Requests\Admin\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_name' => ['required', 'string', 'min:3'],
            'category_id' => ['required', 'numeric'],
            'qty_available' => ['required', 'numeric'],
            'price_item' => ['required', 'numeric'],
            'is_in_stock' => ['required', 'boolean'],
            'item_description' => ['required', 'string'],
            'item_image' => ['required','array'],
            'item_image.*' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
        ];
    }
}
