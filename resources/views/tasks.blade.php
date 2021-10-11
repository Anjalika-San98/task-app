<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Test</title>

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

                        <form method="post" action="/saveTask">
                            {{csrf_field()}}

                            <input type="text" class="form-control" name="task" placeholder="Enter Your Task Here">
                            </br>
                            <input type="submit" class="btn btn-primary" value="SAVE">
                            <input type="button" class="btn btn-warning" value="CLEAR">

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
                                    <a href="/updatetask/{{$task->id}}" class="btn btn-primary">Update</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>
