<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'item_id'   => 'required|integer',
            'quantity'  => 'required|integer',
            'total_price'  => 'required|integer',
            'customer_name'  => 'required',
            'customer_addess'  => 'required',
            'delivery_time'  => 'required',
        ];
    }
}
