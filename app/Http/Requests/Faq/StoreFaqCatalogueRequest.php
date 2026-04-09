<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqCatalogueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:faq_catalogue_language,canonical',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên nhóm câu hỏi.',
            'canonical.required' => 'Bạn chưa nhập đường dẫn.',
            'canonical.unique' => 'Đường dẫn đã tồn tại, hãy nhập đường dẫn khác.',
        ];
    }
}
