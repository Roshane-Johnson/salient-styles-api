<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialMediaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "user_id" => "unique:users,id",
            "twitter" => "sometimes",
            "instagram" => "sometimes",
            "tiktok" => "sometimes",
            "snapchat" => "sometimes",
            "youtube" => "sometimes",
            "facebook" => "sometimes",
            "whatsapp" => "sometimes",
            "reddit" => "sometimes",
        ];
    }
}
