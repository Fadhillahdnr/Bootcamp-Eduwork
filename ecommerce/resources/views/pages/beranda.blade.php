@extends('layouts.master')

@section('content')
<div class="container">
    <div class="col-12 text-center my-4">
        <h1>Welcome to Our Store</h1>
        <p class="lead">Discover our exclusive products below</p>
    </div>

    {{-- card --}}
    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card 1</h5>
                    <p class="card-text">Deskripsi produk.</p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card 2</h5>
                    <p class="card-text">Deskripsi produk.</p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card 3</h5>
                    <p class="card-text">Deskripsi produk.</p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
