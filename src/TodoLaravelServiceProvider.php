<?php

namespace Ekanoffiong\TodoLaravel;

use Illuminate\Support\ServiceProvider;

class TodoLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
        
        // To publish views & migrations
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/todo-laravel'),
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Controllers
        $this->app->make('Ekanoffiong\TodoLaravel\Controllers\TodoLaravelController');

        //Requests
        $this->app->make('Ekanoffiong\TodoLaravel\Requests\TodoRequest');
        $this->app->make('Ekanoffiong\TodoLaravel\Requests\TodoCategoryRequest');
        
        // Models
        $this->app->make('Ekanoffiong\TodoLaravel\Models\Todo');
        $this->app->make('Ekanoffiong\TodoLaravel\Models\TodoCategory');
        
        // Services
        $this->app->make('Ekanoffiong\TodoLaravel\Services\TodoService');

        // Views
        $this->loadViewsFrom(__DIR__.'/views', 'todo');
    }
}
