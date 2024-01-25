@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar') 
            <div class="col-md-8">
                <i class="fa-solid fa-caret-up"></i> Table  
                 <a href="/management/table/create" class="btn btn-success btn-sm float-right btn-create-category"> <i class="fa-solid fa-plus"></i> Create Table</a> 
                 <hr>
                 @if(Session()->has('status')) 
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                        {{Session()->get('status')}}
                    </div>
                 @endif
                 <!--This above is seeigng if status exists, if so creates alert box with success styling, with close "X" button and sisplays content of status session-->
                 <table class="table table-bordered mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Table</th> 
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th> 
                        </tr>
                    </thead>
                    <!--The above line is creating a column for each individual table -->
                    <tbody>
                        @foreach($tables as $table)
                            <tr>
                                <td>{{$table->id}}</td>
                                <td>{{$table->name}}</td>
                                <td>{{$table->status}}</td> 
                                <td>
                                    <a href="/management/table/{{$table->id}}/edit" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action="/management/table/{{$table->id}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                        @endforeach
                    </tbody>
                 </table> 
            </div>  
        </div> 
    </div>

<h1>This is the table page</h1> 