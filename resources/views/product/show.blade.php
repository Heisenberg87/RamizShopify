@extends('layout.app')

@section('content')
    <div class="container">
        <a href="/products" class="btn btn-dark">Back</a>
        <div class="card card-body alert-primary">
            <h3>Average variant for the {{$product->title}} is: &#163;{{ number_format($average, 2) }}</h3>
        </div>
    </div>
@endsection