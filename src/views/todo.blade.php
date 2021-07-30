<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo Laravel</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style type="text/css">
        .bordered {
            border: 1px solid #000;
        }
        .margin-md {
            margin: 10px 0;
        }
        .padding-lg {
            padding: 20px;
        }
        .tab-content .todo-list {
            box-shadow: 0.4px 0.4px 3px 3px rgba(0, 0, 0, .05);
            margin: 10px 0;
        }
        .divider {
            border-color: #b1b1b1;
        }
        .checkboxes label, .checkboxes .todo-manage {
            padding: 7px 20px;
            display: block;
            white-space: nowrap;
            margin-bottom: 0;
            cursor: pointer;
        }
        .checkboxes .todo-delete {
            margin-top: 4px;
        }
        .checkboxes input {
            margin-left: 10px;
        }
        .checkboxes input, .checkboxes label span {
            vertical-align: middle;
        }
        .checkboxes label span {
            padding-left: 0;
            margin-left: 10px;
        }
        .todo-list-completed label span.todo-content {
            text-decoration: line-through;
        }
        a.active .category-edit {
            color: #fff!important;
        }
    </style>
</head>
<body>
    <div class="container padding-lg">
        <div class="row">
            <div class="col-md-4 todo-category-section">
                <div class="category-header d-flex justify-content-between margin-md">
                    <div>Categories List</div>
                    <div><button class="btn btn-info btn-sm todo-category-create">Create Category</button></div>
                </div>
                <form action="{{ url('/category-create') }}" method="post" class="category-form margin-md d-none">
                    <input type="text" maxlength="20" title="Max Length: 20 characters" class="form-control" id="new-category" name="category" placeholder="New Category" data-url="" data-category="">
                </form>
                <hr class="divider">
                <div class="nav flex-column nav-pills categories-list" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <?php $category_count++;
                                $total_completed = 0;
                                foreach ($category->todo as $todo) {
                                    if (! $todo->completed) {
                                        $total_completed++;
                                    }
                                }
                            ?>
                            <a class="nav-item nav-link d-flex justify-content-between align-items-center @if ($category_count < 2) active @endif" data-id="category-{{ $category->id }}" id="pill-{{ Str::kebab($category->name) }}-pill" data-toggle="pill" href="#pills-{{ Str::kebab($category->name) }}" role="tab" aria-controls="{{ Str::kebab($category->name) }}"  aria-selected="true">
                                <span class="category-content">{{ ucwords($category->name) }}</span> 
                                <div><span class="badge badge-primary badge-pill">{{ $total = ($total_completed > 0) ? $total_completed : '' }}</span>
                                <span class='fa fa-pencil text-info col-1 category-edit'></span>
                                <span class="fa fa-trash text-danger col-1 category-delete"></span></div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-8 todo-items-section">
                <div class="tab-content" id="pill-tabContent">
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <?php $category_count1++; ?>
                            <div class="tab-pane fade @if ($category_count1 < 2) show active @endif" data-category="category-{{ $category->id }}" id="pills-{{ Str::kebab($category->name) }}" role="tabpanel" aria-labelledby="pill-{{ Str::kebab($category->name) }}-pill"> 
                                <form action="{{ url('/todo-create') }}" method="post" class="create-todo margin-md" data-submit="">
                                    <input type="text" class="form-control new-todo" name="todo" placeholder="New Todo">
                                </form>
                                <div class="todo-list-active todo-listed">
                                    @if ($category->todo->count() > 0)
                                        @foreach ($category->todo as $todo)
                                            @if (! $todo->completed)
                                                <div class="todo-list">
                                                    <form action="{{ url('/todo-update') }}" method="post">
                                                        <div class="checkboxes d-flex justify-content-between" data-url="/category/{{ $category->id }}/todos/{{ $todo->id }}">
                                                            <label class="todo-active-item col-10">
                                                                <div><span class="fa fa-sort"></span>
                                                                <input id="todo-3" type="checkbox" name="completed">
                                                                <span class="todo-content">{{ $todo->todo }}</span></div>
                                                            </label>
                                                            <div class="todo-manage col-2">
                                                                <span class='fa fa-pencil text-info col-1 todo-edit'></span>
                                                                <span class="fa fa-trash text-danger col-1 todo-delete"></span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif         
                                        @endforeach
                                    @endif
                                </div>
                                <hr class="divider">
                                <div class="todo-list-completed todo-listed">
                                    @if ($category->todo->count() > 0)
                                        @foreach ($category->todo as $todo)
                                            @if ($todo->completed)
                                                <div class="todo-list">
                                                    <form action="{{ url('/todo-update') }}" class="todo-list" method="post" data-id="{{ $todo->id }}">
                                                        <div class="checkboxes d-flex justify-content-between" data-url="/category/{{ $category->id }}/todos/{{ $todo->id }}">
                                                            <label class="todo-completed-item col-10">
                                                                <div><span class="fa fa-sort"></span>
                                                                <input id="todo-{{ $todo->id }}" type="checkbox" name="completed">
                                                                <span class="todo-content">{{ $todo->todo }}</span></div>
                                                            </label>
                                                            <div class="todo-manage col-2">
                                                                <span class="fa text-info col-1 todo-edit"></span>
                                                                <span class="fa fa-trash text-danger col-1 todo-delete"></span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif         
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h6 class="empty-content text-center padding-lg">Create a Category, Then You can Start Adding Your To-Do Items</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   
            $('div.todo-listed').sortable();

            var num = 7;
            // Set all items in active to unchecked
            $('div.todo-list-active input[type="checkbox"]').prop('checked', false);
            // Set all items in completed to checked
            $('div.todo-list-completed input[type="checkbox"]').prop('checked', true);
            
            // Move Todo Between Active and Completed
            $('.todo-items-section').on('click', 'label', function (evt) {
                // Prevent Bubbling and firing twice for both active and completed
                evt.preventDefault();                
                evt.stopPropagation();
                var parent = $(this).parents('div.tab-pane');
                var todo_content = $(this).find('span.todo-content').text();
                if ($(this).hasClass('todo-active-item')) {
                    var response = sendRequest('put', $(this).parent().data('url'), 'todo=' + todo_content + '&completed=1');
                    $(this).removeClass('todo-active-item')
                    .addClass('todo-completed-item')
                    .find('input[type="checkbox"]').prop('checked', true);
                    $(this).parents('div.checkboxes').find('span.todo-edit').removeClass('fa-pencil');
                    parent.find('div.todo-list-completed')
                    .prepend($(this).parents('div.todo-list'));
                    decrementTodo(parent.attr('aria-labelledby'));
                } else if ($(this).hasClass('todo-completed-item')) {
                    var todo_category = parent.data('category').split('-');
                    var response = sendRequest('put', $(this).parent().data('url'), 'todo=' + todo_content + '&completed=0');
                    $(this).removeClass('todo-completed-item')
                    .addClass('todo-active-item')
                    .find('input[type="checkbox"]').prop('checked', false);
                    $(this).parents('div.checkboxes').find('span.todo-edit').addClass('fa-pencil');
                    parent.find('div.todo-list-active')
                    .prepend($(this).parents('div.todo-list'));
                    incrementTodo(parent.attr('aria-labelledby'));
                }
            });
            // Add Todo To List
            $('div.todo-items-section').on('keydown', 'input.new-todo', function (evt) {
                evt.stopPropagation();
                if (evt.which === 13) {
                    evt.preventDefault();
                    var parent = $(this).parents('div.tab-pane'); 
                    var todo_category = parent.data('category').split('-');
                    if ($(this).parent().data('submit') !== '') {
                        // Update Todo
                        var response = sendRequest('put', $(this).parent().data('submit'), 'todo=' + $(this).val());
                    } else {
                        // New Todo
                        var response = sendRequest('post', '/category/' + todo_category[1] + '/todos', 'todo=' + $(this).val());
                        incrementTodo(parent.attr('aria-labelledby'));
                    }
                    console.log('here: ', response.id);
                    if ($(this).val() !== '') {
                        var todo = "<div class='todo-list'>" +
                            "<form action=\"{{ url('/todo-update') }}\" method='post'>" +
                            "<div class='checkboxes d-flex justify-content-between' data-url='/category/"+ todo_category[1] +"/todos/" + response.id + "'>" +
                            "<label class='todo-active-item col-10'>" +
                            "<div><span class='fa fa-sort'></span> <input id='todo-" + response.id + "' type='checkbox' name='completed'> " +
                            "<span class='todo-content'>" + $(this).val() + "</span></div>" +
                            "</label><div class='todo-manage'><span class='fa fa-pencil text-info col-1 todo-edit'></span>" +
                            "<span class='fa fa-trash text-danger col-1 todo-delete'></span></div>" +
                            "</div></form></div>";
                        parent.find('div.todo-list-active').prepend(todo);
                        parent.find('div.todo-listed').sortable();
                        $(this).val('');
                        $(this).parent().data('submit', '');
                    }
                }
            });
            // Edit Todo
            $('.todo-items-section').on('click', 'span.todo-edit', function () {
                var text = $(this).parents('div.checkboxes').find('span.todo-content').text();
                var form = $(this).parents('div.tab-pane').find('form.create-todo');
                form.data('submit', $(this).parents('div.checkboxes').data('url'));
                form.find('input').val(text).focus();
                $(this).parents('div.todo-list').remove();
            });
            // Delete Todo
            $('.todo-items-section').on('click', 'span.todo-delete', function () {
                var response = sendRequest('delete', $(this).parents('div.checkboxes').data('url'), null);
                decrementTodo($(this).parents('div.tab-pane').attr('aria-labelledby'));
                $(this).parents('div.todo-list').remove();
            });

            // Create A New Category
            $('button.todo-category-create').click(function () {
                $(this).parents('div.category-header').next()
                .removeClass('d-none').addClass('d-block');
                $('input#new-category').data('url', '')
                .data('category', '').val('').focus();
            });
            // Add Category To List
            $('input#new-category').keydown(function (evt) {
                evt.stopPropagation();
                if (evt.which === 13) {
                    evt.preventDefault();
                    var content = $(this).val();
                    var kebabCase = content.replace(/([a-z])([A-Z])/g, '$1-$2').replace(/\s+/g, '-').toLowerCase();
                    if ($(this).val() !== '') {
                        if ($(this).data('url') !== '' && $(this).data('category') !== '') {
                            // Edit Category
                            response = sendRequest('put', $(this).data('url'), 'name=' + $(this).val());
                            var element = $('a#' + $(this).data('category'));
                            var current = element.prop('href').split('#');
                            $('div.tab-pane#' + current[1]).prop('id', 'pills-' + kebabCase);
                            element.find('span.category-content').text(content);
                            element.prop('id', 'pill-' + kebabCase + '-pill').prop('href', '#pills-' + kebabCase);
                        } else {
                            // Create New Category
                            // Remove currently active tab
                            $('div.tab-pane').removeClass('show active');
                            $('a.nav-item.nav-link').removeClass('active');
                            response = sendRequest('post', '/category-create', 'name=' + $(this).val());
                            var category = "<a class='nav-item nav-link d-flex justify-content-between align-items-center active' data-id='category-"+ response.id +"' id='pill-" + kebabCase + "-pill' data-toggle='pill' href='#pills-" + kebabCase + "' role='tab' aria-controls='profile' aria-selected='false'>" +
                            "<span class='category-content'>" + $(this).val() + "</span><div><span class='badge badge-primary badge-pill'></span>" +
                            "<span class='fa fa-pencil text-info col-1 category-edit'></span>" +
                            "<span class='fa fa-trash text-danger col-1 category-delete'></span></div></a>";
                            var category_tab = "<div class='tab-pane fade show active' data-category='category-"+ response.id +"' id='pills-" + kebabCase + "' role='tabpanel' aria-labelledby='pill-" + kebabCase + "-pill'>" +
                                "<form action=\"{{ url('/todo-create') }}\" method='post' class='margin-md'>" +
                                "<input type='text' class='form-control new-todo' name='todo' placeholder='New Todo'>" +
                                "</form><div class='todo-list-active todo-listed'></div><hr class='divider'>" +
                                "<div class='todo-list-completed todo-listed'></div></div>";
                            $('div.categories-list').append(category);
                            $('div.tab-content#pill-tabContent').append(category_tab);
                        }
                        $(this).data('url', '').data('category', '');
                        $(this).parent().removeClass('d-block').addClass('d-none');
                        $(this).val('');
                        contentArea();
                   }
                }
            });
            // Edit Category
            $('div.nav').on('click', 'span.category-edit', function () {
                var form = $(this).parents('div.todo-category-section').find('form.category-form');
                var parent = $(this).parents('a.nav-item.nav-link');
                var text = parent.find('span.category-content').text();
                var get_id = parent.data('id').split('-');
                form.find('input#new-category').data('url', '/category-update/' + get_id[1])
                .data('category', parent.prop('id')).val(text).focus();
                form.removeClass('d-none').addClass('d-block');
            });
            // Delete Category
            $('div.nav').on('click', 'span.category-delete', function () {
                var parent = $(this).parents('a.nav-item.nav-link');
                var get_id = parent.data('id').split('-');
                response = sendRequest('delete', '/category-delete/' + get_id[1], null);
                var element = parent.prop('href').split("#");
                $('div.tab-pane#' + element[1]).remove().fadeOut(2000);
                if (parent.hasClass('active')) {
                    if (parent.prev().hasClass('nav-item nav-link')) {
                        var sibling = parent.prev();
                        sibling.addClass('active');
                        var prev = sibling.prop('href').split("#");
                        $('div.tab-pane#' + prev[1]).addClass('show active');
                    } else if (parent.next().hasClass('nav-item nav-link')) {
                        var sibling = parent.next();
                        sibling.addClass('active');
                        var prev = sibling.prop('href').split("#");
                        $('div.tab-pane#' + prev[1]).addClass('show active');
                    }
                }
                parent.remove().fadeOut(2000);
                contentArea();
            });

            function incrementTodo(a_id) {
                var item = $('a.nav-item#' + a_id).find('span.badge.badge-pill');
                if (item.text() !== '') {
                    item.text(parseInt(item.text()) + 1);
                } else {
                    item.text(1);
                }
            }
            function decrementTodo(a_id) {
                var item = $('a.nav-item#' + a_id).find('span.badge.badge-pill');
                if (item.text() !== '') {
                    item.text(parseInt(item.text()) - 1);
                    if (item.text() < 1) {
                        item.text('');
                    }
                } else {
                    item.text(1);
                }
            }

            function contentArea() {
                console.log($('div.tab-pane').length);
                if ($('div.tab-pane').length == 0) {
                    $('div.tab-content#pill-tabContent')
                    .html('<h6 class="empty-content text-center padding-lg">Create a Category, Then You can Start Adding Your To-Do Items</h6>');
                } else {
                    $('h6.empty-content').remove();
                }
            }

            function sendRequest(type, url, data) {
                var message;
                $.ajax({
                    type: type,
                    url: url,
                    dataType: "json",
                    async: false,
                    data: data,
                }).done(function(data, textStatus, jqXHR) {
                    var res = $.parseJSON(jqXHR.responseText);
                    message = res;
                });
                return message;
            }
        });
    </script>
</body>
</html>
