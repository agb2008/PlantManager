<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'type_id' => 'required',
            'manufacturer_id' => 'required',
            'amount' => 'required|max:255',
            'img_id' => 'required',
            'notes' => 'max:4096',
            'price' => 'max:255',
            'purchase_date' => 'required',
            'plant_date' => 'required',
            'seeds_id' => 'required',     // <- не обязательно ?
            'user_id' => 'required',
        ];
    }
}
