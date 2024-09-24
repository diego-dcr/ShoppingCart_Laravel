<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
            'description' => 'required|string',
        ];

        // Si la solicitud es POST, se requiere una imagen
        if ($this->isMethod('POST')) {
            $rules['img'] = 'required|image|mimes:jpeg,png,jpg,webp|max:5120';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre del producto no puede tener más de :max caracteres.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser un número.',
            'price.min' => 'El precio del producto no puede ser menor que :min.',
            'category.required' => 'La categoría del producto es obligatoria.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'img.required' => 'La imagen del producto es obligatoria.',
            'img.image' => 'El archivo debe ser una imagen.',
            'img.mimes' => 'El archivo debe tener uno de los siguientes formatos: jpeg, png, jpg, webp.',
            'img.max' => 'El tamaño máximo de la imagen es :max kilobytes.',
        ];
    }
}
