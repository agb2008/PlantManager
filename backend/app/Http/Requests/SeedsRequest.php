<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeedsRequest extends FormRequest
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
            'name' => ['required', 'max:50'],
            'number_of_seeds' => ['required', 'integer'],
            'amount' => ['required', 'integer'],
            'type_id' => ['required'],
            'manufacturer_id' => ['required'],
            'production_date' => ['required'],
            'expiration_date' => ['required'],
            'harvest_year' => ['required'],
            'notes' => ['required', 'max:1000'],
            'price' => ['required', 'numeric'],
            'img_id' => ['required'],
        ];
    }
}
