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
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Picture</th> 
                            <th scope="col">Description</th> 
                            <th scope="col">Category</th> 
                            <th scope="col">Edit</th> 
                            <th scope="col">Delete</th> 
                        </tr>
                    </thead>
                    <!--The above line is creating a column for each individual category -->
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{$menu->id}}</td>
                            <td>{{$menu->name}}</td>
                            <td>{{$menu->price}}</td>
                            <td>
                                <img src="{{ asset('menu_images/' . $menu->image) }}" alt="{{$menu->name}}" 
                                width="120px" height="120px" class="img-thumbnail"> <!--Might need to update based on Img???-->
                            </td>
                            <td>{{$menu->description}}</td>
                            <td>{{ optional($menu->category)->name }}</td>
                            <td><a href="/management/menu/{{$menu->id}}/edit" class="btn btn-warning">Edit</a></td> <!--Sends to edit func in menu controller-->
                            <td>
                                <form action="/management/menu/{{$menu->id}}" method="post">
                                    @csrf
                                    @method('DELETE') 
                                    <input type="submit" value="Delete" class="btn btn-danger">
                            </td> 
                        </tr>   
                    @endforeach

                    </tbody>
                 </table>
        </div> 
    </div>
