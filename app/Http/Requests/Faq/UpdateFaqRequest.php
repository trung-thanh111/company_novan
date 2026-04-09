<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:faq_language,canonical,'.$this->id.',faq_id',
            'faq_catalogue_id' => 'required|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập câu hỏi.',
            'canonical.required' => 'Bạn chưa nhập đường dẫn.',
            'canonical.unique' => 'Đường dẫn đã tồn tại, hãy nhập đường dẫn khác.',
            'faq_catalogue_id.gt' => 'Bạn chưa chọn nhóm câu hỏi.',
        ];
    }
}
