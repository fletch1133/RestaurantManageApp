@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar') 
            <div class="col-md-8">
                 <i class="fa-solid fa-table-columns"></i> Category  
                 <a href="/management/category/create" class="btn btn-success btn-sm float-right btn-create-category"> <i class="fa-solid fa-plus"></i> Create Category</a> 
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
                            <th scope="col">Category</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th> 
                        </tr>
                    </thead>
                    <!--The above line is creating a column for each individual category -->
                    <tbody>
                        @foreach($categories as $category) 
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="/management/category/{{$category->id}}/edit" class="btn btn-warning">Edit</a> 
                            </td>
                            <td>
                                <form action="/management/category/{{$category->id}}" method="POST">
                                @csrf 
                                @method('DELETE') 
                                <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td> 
                        </tr>
                        @endforeach 
                        <!--This is creating a row for each category in $categories arr, contains ID, name, Edit and Delete button--> 
                    </tbody>
                 </table> 
                 {{$categories->links()}} 
                 <!--Generating pagination links based on # of categories in collection--> 
            </div>  
        </div> 
    </div>

<h1>This is the category page</h1> 