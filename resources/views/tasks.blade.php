<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Test</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <style>
        h1{
            font-size: 300%;
            font-family: serif;
        }
        table,th,td
        {
            border: 1px solid black;
            border-collapse: collapse;
        }
        h5
        {
            text-align: left;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="hidden fixed top-0 right-16 px-6 py-4 sm:block">
            <a href="{{ route('logout') }}" class="float-right btn btn-primary">Log out</a>
        </div>
        <div class="text-center">
            <br>
            <h1><b>Daily Tasks</b></h1>
            <br>
            <br>
                <div class="row">
                    <div class="col-md-12">

                        <h5>Create Your Task...</h5>

                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach

                        <form method="post" action="/tasks">
                           @csrf

                            <input type="text" class="form-control" name="task" placeholder="Enter Your Task Here">
                            </br>
                            <input type="button" class="btn btn-warning" value="CLEAR">
                            <input type="submit" class="btn btn-primary" value="SAVE">

                        </form>
                            <br>
                            <br>

                        <table class="table table-dark">
                            <th>ID</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit Status</th>
                            <th>Action</th>

                            @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->task}}</td>

                                <td>
                                    @if($task->iscompleted)
                                        <button class="btn btn-success">Completed</button>
                                    @else
                                    <button class="btn btn-warning">Not Completed</button>
                                    @endif
                                </td>

                                <td>{{$task->created_at}}</td>
                                <td>{{$task->updated_at}}</td>

                                <td>
                                    @if($task->iscompleted)
                                        <a href="/markasnotcompleted/{{$task->id}}" class="btn btn-warning">Mark As Not Completed</a>
                                    @else
                                        <a href="/markascompleted/{{$task->id}}" class="btn btn-primary">Mark As Completed</a>
                                    @endif
                                </td>

                                <td>
                                    <a href="/deleteTask/{{$task->id}}" class="btn btn-danger">Delete</a>
{{--                                    <a href="/updatetask/{{$task->id}}" class="btn btn-primary">Update</a>--}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="task_id({{$task->id}})">
                                        Update
                                    </button>
                                </td>
                            </tr>

                            @endforeach

                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $tasks->links() !!}
                        </div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Update Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/tasks" method="post">
                                            @csrf
                                            <input type="text" class="form-control" name="task">
                                            <input type="hidden" name="task_id" id="task_id">
                                            </br>
                                            <button type="button" class="btn btn-danger" value="Cancel" data-dismiss="modal">Cancel</button>
                                            <input type="submit" class="btn btn-success" value="update">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>
<script>
    function task_id(id){
        document.getElementById("task_id").value = id;
    }
</script>
</html>
