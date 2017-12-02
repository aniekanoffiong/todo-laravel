<?php

namespace Ekanoffiong\TodoLaravel\Services;

use Ekanoffiong\TodoLaravel\Models\Todo;

class TodoService
{

    public function get_todo($todo_id)
    {
        return Todo::where('id', $todo_id)->with('category')->first();
    }

    public function all_todos()
    {
        return Todo::with('category', function ($query) {
            $query->orderBy('id', 'desc');
        })->get();
    }

    public function create_todo($request, $category_id)
    {
        $todo = new Todo;
        $todo->category_id = $category_id;
        $todo->todo = $request->todo;
        $todo->completed = false;
        if ($todo->save()) {
            return $todo;
        }
    }

    public function update_todo($request, $category_id, $todo_id)
    {
        $todo = Todo::find($todo_id);
        if ($todo) {
            $todo->category_id = $category_id;
            $todo->todo = $request->todo;
            $todo->completed = ($request->has('completed')) ? $request->completed : false;
            if ($todo->save()) {
                return $todo;
            }
        }
    }

    public function delete_todo($category_id, $todo_id)
    {
        return Todo::where('id', $todo_id)
            ->where('category_id', $category_id)
            ->delete();
    }

    public function delete_by_category($category_id)
    {
        return Todo::where('category_id', $category_id)
            ->delete();
    }

}