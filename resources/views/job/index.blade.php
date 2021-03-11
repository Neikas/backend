@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <index-job :article="{{ json_encode(route('article.index')) }}"></index-job>
        </div>
    </div>
@endsection
