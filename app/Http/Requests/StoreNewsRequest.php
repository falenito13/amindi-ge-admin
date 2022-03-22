<?php

namespace App\Http\Requests;

use App\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'    => [
                'required',
            ],
            'description'    => [
                'required',
            ],
            'photo' => [
                'array',
                'required'
            ],
            'photo.*'    => [
                'image',
                'mimes:jpeg,png,jpg,gif,svg,webp',
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'შეავსე სათაურის ველი',
            'description.required' => 'შეავსე აღწერის ველი',
            'photo.required' => 'ატვირთე ფოტო',
            'photo.*.image' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif , webp ან svg',
            'photo.*.mimes' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif , webp ან svg',
            'photo.array' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif , webp ან svg'
        ];
    }

}
