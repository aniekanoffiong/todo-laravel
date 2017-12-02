<?php

namespace Ekanoffiong\TodoLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class TodoCategory extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $table = 'todos_laravel_categories';

    public function todo()
    {
        return $this->hasMany('\Ekanoffiong\TodoLaravel\Models\Todo', 'category_id', 'id')
            ->orderBy('id', 'desc');
    }

}
