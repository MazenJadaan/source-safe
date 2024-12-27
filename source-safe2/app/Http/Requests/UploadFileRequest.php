<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Optionally, check user permissions here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:docx,txt|max:10240', // Adjust MIME types and size limit
            'name' => 'required|string|max:255',
            'group_id' => 'required|exists:groups,id', // Ensure the group exists
            'status' => 'required|in:free,reserved',   // Validate status is either 'free' or 'reserved'
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'file.required' => 'The file field is required.',
            'file.mimes' => 'The file must be a valid type (e.g., docx, txt).',
            'name.required' => 'Please provide a name for the file.',
            'group_id.required' => 'Please select a valid group.',
            'group_id.exists' => 'The selected group is invalid.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either Free or Reserved.',
        ];
    }
}
