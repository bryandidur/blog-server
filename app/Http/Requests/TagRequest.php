<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name'        => 'required|max:255|unique:tags,name',
            'description' => 'max:255',
        ];

        // Checks the action
        if ( $this->route('id') ) {
            $rules['name'] = $rules['name'] . ',' . $this->route('id');
        }

        return $rules;
    }

    /**
     * Get the proper failed validation response for the request.
     * [Always returns JSON objects with validation errors]
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
