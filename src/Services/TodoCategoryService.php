<?php

namespace Ekanoffiong\TodoLaravel\Services;

use Ekanoffiong\TodoLaravel\Models\TodoCategory as Category;
use Ekanoffiong\TodoLaravel\Services\TodoService;

class TodoCategoryService
{

    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function get_category($category_id)
    {
        return Category::where('id', $category_id)->with('todo')->first();
    }

    public function all_categories()
    {
        return Category::with('todo')->get();
    }

    public function create_category($request)
    {
        $category = new Category;
        $category->name = $request->name;
        if ($category->save()) {
            return $category;
        }
    }

    public function update_category($request, $category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $category->name = $request->name;
            if ($category->save()) {
                return $category;
            }
        }
    }

    public function delete_category($category_id)
    {
        if ($this->todoService->delete_by_category($category_id)) {
            return Category::where('id', $category_id)->delete();
        } else {
            return Category::where('id', $category_id)->delete();
        }
    }
}