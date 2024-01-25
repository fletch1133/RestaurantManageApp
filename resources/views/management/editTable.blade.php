@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar')
            <div class="col-md-8">
                <i class="fa-solid fa-caret-up"></i> Edit a Table 
                 <hr>
                 @if($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li> 
                        @endforeach
                    </ul>
                </div>
                @endif
                <!--Check if there are any validation errors, if so creates alert box with danger style, lists VE in unordered list and displays each error message in seperate list-->

                 <form action="/management/table/{{$table->id}}" method="POST"> 
                    @csrf 
                    @method('PUT')
                    <div class="form-group">
                        <label form="tableName">Table Name</label> 
                        <input type="text" name="name" value="{{$table->name}}" class="form-control" placeholder="Table...">
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button> 
                 </form>
                 <!--Creates new category, includes text input for category name, CSRF token for security, submit button, when submitted
                 sends POST request to route--> 
            </div>  
        </div> 
    </div>

<h1>This is the edit a table page</h1> 