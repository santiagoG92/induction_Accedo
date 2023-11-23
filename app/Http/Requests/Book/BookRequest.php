<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{

    protected $rules= [
        'title'=>['required','string'],
        'description'=>['required','string'],
        'stock'=>['required','numeric'],
        'author_id'=>['required','exists:authors,id'],
        'category_id'=>['required','exists:categories,id'],
        'file'=>['required','image'],
    ];


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return $this->rules;

    }

    public function messages(){

        return[

            'title.required'=>'Este titulo es requerido',
            'title.string'=>'El nombre debe ser valido',
            'description.required'=>'Esta descripcion es requerida',
            'title.string'=>'La descripcion debe de ser valida',
            'stock.required'=>'La cantidad es requerida',
            'stock.numeric'=>'La cantidad debe de ser numerica y valida',
            'author_id.required'=>'El autor es requerido',
            'author_id.exists'=>'El autor no existe',
            'category_id.required'=>'La categoria es requerida',
            'category_id.exists'=>'La categoria no existe',


            'file.required'=>'La imagen es requerida',
            'file.image'=>'el archivo debe de ser una imagen valida',
        ];
    }

}
