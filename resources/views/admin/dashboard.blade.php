@extends('admin.layout.master')
@section('content')
<h1>dashboard admin</h1>
@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
    </div>
@endif
@endsection
