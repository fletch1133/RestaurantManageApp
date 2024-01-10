@extends('layouts.app')  

@section('content')
@include('components.nav-link')

    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar') 
                
            <div class="col-md-8"></div>  
        </div>
    </div>

<h1>This is the management page</h1> 