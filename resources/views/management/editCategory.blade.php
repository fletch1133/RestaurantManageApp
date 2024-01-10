@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="list-group">
                    <a href="/management/category" class="list-group-item list-group-item-action"> <i class="fa-solid fa-table-columns"></i> Category</a>
                    <a href="/management/menu" class="list-group-item list-group-item-action"> <i class="fa-solid fa-bars"></i> Menu</a>
                    <a href="/management/table" class="list-group-item list-group-item-action"> <i class="fa-solid fa-caret-up"></i> Table</a> 
                    <a href="/management/user" class="list-group-item list-group-item-action"> <i class="fa-regular fa-user"></i> User</a>
                </div>
            </div>
            <div class="col-md-8">
                 <i class="fa-solid fa-table-columns"></i> Edit a Category
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

                 <form action="/management/category/{{$category->id}}" method="POST"> 
                    @csrf 
                    @method('PUT') 
                    <div class="form-group">
                        <label form="categoryName">Categroy Name</label> 
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Category...">
                    </div> 
                    <button type="submit" class="btn btn-primary">Update</button> 
                 </form>
            </div>  
        </div> 
    </div>

<h1>This is the edit a category page</h1> 