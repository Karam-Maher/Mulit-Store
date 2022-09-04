<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules($id = 0)
    {
        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            new Filter(['karam','php']),
            'image' => ['image'],
            'status' => ['in:active,archived'],
        ];
    }
}
