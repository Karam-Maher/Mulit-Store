<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false ,function($builder , $value){
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false ,function($builder , $value){
            $builder->where('categories.status', '=', $value);
        });

        // if ($filters['name'] ?? false) {
        //     $builder->where('name', 'LIKE', "%{$filters['name']}%");
        // }
        // if ($filters['status'] ?? false) {
        //     $builder->where('status', '=', $filters['status']);
        // }
    }

    public static function rules($id = 0)
    {
        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            new Filter(['karam', 'php']),
            'image' => ['image'],
            'status' => ['in:active,archived'],
        ];
    }
}
