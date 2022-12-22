<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MediaLibraryRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'nullable|string|max:255'
        ];
    }
}
