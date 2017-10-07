@extends('layouts.app')

@section('template_title')
    Shop Now
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
                <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product['name'] }}</p>
                <h1>{{ $product['name'] }}</h1>

                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $product['image'] }}" alt="product" class="img-responsive">
                    </div>

                    <div class="col-md-8">
                        <h3>${{ $product['price'] }}</h3>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                        </form>

                        <br><br>

                        {{ $product['description'] }}
                    </div> <!-- end col-md-8 -->
                </div> <!-- end row -->

                <div class="spacer"></div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
