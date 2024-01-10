@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar') 
            <div class="col-md-8">
            <i class="fa-solid fa-bars"></i> Menu  
                 <a href="/management/menu/create" class="btn btn-success btn-sm float-right btn-create-category"> <i class="fa-solid fa-plus"></i> Create Menu</a> 
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
                       
                    </tbody>
                 </table>
        </div> 
    </div>

<h1>This is the menu page</h1> 