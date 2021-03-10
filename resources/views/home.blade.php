@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <create-job></create-job>
    </div>
    <div class="row justify-content-center">
        <index-job></index-job>
    </div>

    <div class="row justify-content-center">
        <articles></articles>
    </div>
</div>
@endsection
