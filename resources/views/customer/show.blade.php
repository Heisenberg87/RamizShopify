@extends('layout.app')

@section('content')
    <div class="container">
        <a href="/customers" class="btn btn-dark" />Back</a>
        <div class="card card-body alert-primary">
            <h3>The Average order value for {{$customer->first_name . ' ' . $customer->last_name}} is &#163;{{$average}} </h3>
        </div>
    </div>
@endsection
