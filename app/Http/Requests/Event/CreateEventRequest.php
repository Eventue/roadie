<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:24',
            'subtitle' => 'required|string|max:20',
            'description' => 'required|string|max:300',
            'image' => 'required|image',
            'location' => 'required|string|max:100',
            'date' => 'required|date_format:d/m/Y H:i',
        ];
    }
}
