<?php

namespace Ekanoffiong\TodoLaravel\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ekanoffiong\TodoLaravel\Requests\TodoRequest;
use Ekanoffiong\TodoLaravel\Services\TodoService;
use Ekanoffiong\TodoLaravel\Requests\TodoCategoryRequest;
use Ekanoffiong\TodoLaravel\Services\TodoCategoryService;

class TodoLaravelController extends Controller
{

    protected $todoService;
    protected $todoCategoryService;

    public function __construct(TodoService $todoService, TodoCategoryService $todoCategoryService)
    {
        $this->todoService = $todoService;
        $this->todoCategoryService = $todoCategoryService;
    }

    public function get_todo($todo_id)
    {
        $todo = $this->todoService->get_todo($todo_id);
    }

    public function all_todos()
    {
        $data['todos'] = $this->todoService->all_todos();
        return view('todo::todo', $data);
    }

    public function add_todo(TodoRequest $request, $category_id)
    {
        if ($created = $this->todoService->create_todo($request, $category_id)) {
            echo json_encode($created);
            exit();
            return response()->json($created);
        }
        echo json_encode(['error' => 'Error Creating Todo']);
        exit();
        // return redirect()->back()->with('error', 'Error Creating Todo');
    }

    public function update_todo(TodoRequest $request, $category_id, $todo_id)
    {
        if ($updated = $this->todoService->update_todo($request, $category_id, $todo_id)) {
            echo json_encode($updated);
            exit();
            // return redirect()->back()->with('message', 'Todo Updated Successfully');
        }
        echo json_encode(['error' => 'Error Updating Todo']);
        exit();
        // return redirect()->back()->with('error', 'Error Updating Todo');
    }
    
    public function delete_todo($category_id, $todo_id)
    {
        if ($deleted = $this->todoService->delete_todo($category_id, $todo_id)) {
            echo json_encode(['message' => 'Todo Deleted']);
            exit();
            // return redirect()->back()->with('message', 'Todo Deleted Successfully');
        }
        echo json_encode(['error' => 'Error Deleting Todo']);
        exit();
        // return redirect()->back()->with('error', 'Error Deleting Todo');
    }


    // Methods for Categories
    public function create_category(TodoCategoryRequest $request)
    {
        if ($created = $this->todoCategoryService->create_category($request)) {
            echo json_encode($created);
            exit();
            // return redirect()->back()->with('message', 'Category Created');
        }
        echo json_encode(['error' => 'Error Creating Category']);
        exit();
        // return redirect()->back()->with('error', 'Error Creating Category');
    }
    
    public function get_category($category_id)
    {
        $todo = $this->todoCategoryService->get_category($category_id);
    }

    public function all_categories()
    {
        $data['categories'] = $this->todoCategoryService->all_categories();
        $data['category_count'] = 0;
        $data['category_count1'] = 0;
        return view('todo::todo', $data);
    }

    public function update_category(Request $request, $category_id)
    {
        if ($created = $this->todoCategoryService->update_category($request, $category_id)) {
            echo json_encode(['message' => 'Category Updated']);
            exit();
            // return redirect()->back()->with('message', 'Category Updated Successfully');
        }
        echo json_encode(['message' => 'Error Updating Category']);
        exit();
        // return redirect()->back()->with('error', 'Error Updating Category');
    }
    
    public function delete_category($category_id)
    {
        if ($created = $this->todoCategoryService->delete_category($category_id)) {
            echo json_encode(['message' => 'Category Deleted']);
            exit();
            // return redirect()->back()->with('message', 'Category Deleted Successfully');
        }
        echo json_encode(['message' => 'Error Deleting Category']);
        exit();
        // return redirect()->back()->with('error', 'Error Deleting Category');
    }

}
