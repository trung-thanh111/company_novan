<?php

namespace App\Http\Requests\RealEstate\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'album' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'album.required' => 'Bạn chưa chọn ảnh nào cho bộ sưu tập.',
            'album.array' => 'Dữ liệu ảnh không hợp lệ.',
        ];
    }
}
