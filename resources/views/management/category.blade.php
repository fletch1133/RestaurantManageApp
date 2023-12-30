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
                 <i class="fa-solid fa-table-columns"></i> Category  
                 <button href="/management/category/create" class="btn btn-success btn-sm float-right"> <i class="fa-solid fa-plus"></i> Create Category</button> 
                 <hr>
            </div>  
        </div> 
    </div>

<h1>This is the category page</h1> 