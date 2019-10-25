@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <editproduct my-product-id={{$id}}></editproduct>
            </div>
        </div>
    </div>
@endsection
