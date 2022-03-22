<?php

namespace App\Http\Requests;

use App\News;
use App\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title'    => [
                'required',
            ],
            'description'    => [
                'required',
            ],
        ];
        if(!isset(News::find($this->id)->photo) || isset($this->photo)){
            $rules['photo'] = [
                'array'
            ];
            $rules['photo.*'] = [
                'image',
                'mimes:jpeg,bmp,png,jpg,svg,gif,webp'
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'შეავსე სათაურის ველი',
            'description.required' => 'შეავსე აღწერის ველი',
            'photo.required' => 'ატვირთე ფოტო',
            'photo.*.image' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif ან svg',
            'photo.*.mimes' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif ან svg',
            'photo.array' => 'ფაილის გაფართოება უნდა იყოს : jpeg , png , jpg , gif ან svg'
        ];
    }
}
