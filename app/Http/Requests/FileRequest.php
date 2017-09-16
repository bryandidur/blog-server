<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
        $rules = [];

        if ( $this->routeIs('files.store') ) {
            // Rules for store
            $rules = [
                'disk'    => 'required|in:local,s3',
                'files'   => 'required|array',
                'files.*' => 'required|mimes:jpeg,png,gif,bmp,svg,mp3,mp4,txt,pdf,docx|max:4000',
            ];
        }

        if ( $this->routeIs('files.update') ) {
            // Rules for update
            $rules = [
                'name'        => 'required|max:255',
                'description' => 'max:255',
            ];
        }

        if ( $this->routeIs('files.bulkDestroy') ) {
            // Rules for bulk destroy
            $rules = [
                'ids'   => 'required',
                'ids.*' => 'required|integer',
            ];
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
