<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|max:24',
            'subtitle' => 'string|max:20',
            'description' => 'string|max:300',
            'image' => 'image',
            'location' => 'string|max:100',
            'date' => 'date_format:d/m/Y H:i',
        ];
    }
}
