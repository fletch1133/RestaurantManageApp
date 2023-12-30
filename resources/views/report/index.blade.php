@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action">Category</a>
                    <a class="list-group-item list-group-item-action">Menu</a>
                    <a class="list-group-item list-group-item-action">Table</a> 
                    <a class="list-group-item list-group-item-action">User</a>
                </div>
            </div>
            <div class="col-md-8"></div>  
        </div>
    </div>

<h1>This is the report page</h1> 

{{ dd('Reached here!') }} 