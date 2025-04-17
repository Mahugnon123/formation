<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'int',
            'titre'         => 'required|max:255',
            'commentaire'   => 'required',
            'formation_id'         => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png,gif,bmp,svg|max:1024'
        ];
    }
}
