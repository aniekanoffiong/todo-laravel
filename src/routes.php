<?php

// Categories Routes
Route::get('todo', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@all_categories');
Route::post('category-create', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@create_category');
Route::put('category-update/{category_id}', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@update_category');
Route::delete('category-delete/{category_id}', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@delete_category');

// Category Todo Routes
Route::get('category/{category_id}/todos', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@all_categories');
Route::post('category/{category_id}/todos', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@add_todo');
Route::put('category/{category_id}/todos/{todo_id}', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@update_todo');
Route::delete('category/{category_id}/todos/{todo_id}', 'Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController@delete_todo');
