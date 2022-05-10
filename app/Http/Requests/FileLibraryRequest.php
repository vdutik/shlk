<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class FileLibraryRequest extends FormRequest
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
            'file' => 'required|max:10000|mimes:doc,docx,pdf,xsl,xlsx',
            'name' => 'nullable|string|max:255'
        ];
    }
}
