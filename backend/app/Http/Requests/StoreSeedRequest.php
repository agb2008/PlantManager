<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeedRequest extends FormRequest
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
            'number_of_seeds' => 'required',
            'amount' => 'required|max:255',
            'type_id' => 'required',
            'manufacturer_id' => 'required',
            'production_date' => 'required',
            'expiration_date' => 'required',
            'harvest_date' => 'required',
            'notes' => 'max:4096',
            'price' => 'max:255',
            'img_id' => 'required',
            'user_id' => 'required',
        ];
    }
}
