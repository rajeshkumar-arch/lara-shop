@extends('layouts.app')

@section('template_title')
    Shop Now
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <h3>Products List</h3>
            <div class="col-md-10 col-md-offset-1">
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif

                @if (session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                @endif

                @foreach (array_chunk($products, 4) as $items)
                    <div class="row">
                        @foreach ($items as $product)
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <div class="caption text-center">
                                        <a href="{{ url('shop', [$product['slug']]) }}"><img
                                                    src="{{ $product['image'] }}" alt="product"
                                                    class="img-responsive"></a>
                                        <a href="{{ url('shop', [$product['slug']]) }}"><h3>{{ $product['name'] }}</h3>
                                            <p>${{ $product['price'] }}</p>
                                            <button type="button" class="btn btn-primary">View</button>
                                        </a>

                                    </div> <!-- end caption -->
                                </div> <!-- end thumbnail -->
                            </div> <!-- end col-md-3 -->
                        @endforeach
                    </div> <!-- end row -->
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
