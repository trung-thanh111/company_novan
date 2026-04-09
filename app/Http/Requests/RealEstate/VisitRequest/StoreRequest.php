<?php

namespace App\Http\Requests\RealEstate\VisitRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'full_name' => 'required|max:150',
            'email' => 'required|email',
            'phone' => 'required',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Bạn chưa chọn dịch vụ khách quan tâm.',
            'service_id.exists' => 'Dịch vụ không hợp lệ.',
            'full_name.required' => 'Bạn chưa nhập họ tên khách hàng.',
            'email.required' => 'Bạn chưa nhập email khách hàng.',
            'email.email' => 'Email không đúng định dạng.',
            'phone.required' => 'Bạn chưa nhập số điện thoại khách hàng.',
            'preferred_time.required' => 'Bạn chưa nhập giờ hẹn dự kiến.',
        ];
    }
}
