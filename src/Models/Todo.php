<?php

namespace Ekanoffiong\TodoLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'todo', 'completed',
    ];

    protected $table = 'todos_laravel';

    public function category()
    {
        return $this->belongsTo('\Ekanoffiong\TodoLaravel\Models\TodoCategory', 'category_id', 'id');
    }
}
