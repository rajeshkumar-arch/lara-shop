@extends('layouts.app')

@section('template_title')
    Showing User {{ $product->name }}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel-heading">
                    <a href="/products/" class="btn btn-primary btn-xs pull-right">
                        <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                        <span class="hidden-xs">{{ trans('productsmanagement.productsBackBtn') }}</span>
                    </a>
                    {{ trans('productsmanagement.productsPanelTitle') }}
                </div>
                <div class="panel-body">

                    <div class="well">
                        <div class="row">

                            <div class="col-sm-6">
                                <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                                    {{ $product->name }}
                                </h4>

                                @if ($product->name)
                                    <div class="text-center text-left-tablet margin-bottom-1">

                                        <a href="/products/{{$product->id}}/edit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span
                                                    class="hidden-xs hidden-sm hidden-md"> {{ trans('productsmanagement.editProduct') }} </span>
                                        </a>

                                        {!! Form::open(array('url' => 'products/' . $product->id, 'class' => 'form-inline')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . trans('productsmanagement.deleteProduct') . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Product', 'data-message' => 'Are you sure you want to delete this Product?')) !!}
                                        {!! Form::close() !!}

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>

                    @if ($product->name)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelProductName') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->name }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                    @if ($product->slug)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelProductSlug') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->slug }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                    @if ($product->description)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelProductDesc') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->description }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif


                    @if ($product->price)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelProductPrice') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->price }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                    @if ($product->image)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelProductImage') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->image }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                    @if ($product->created_at)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelCreatedAt') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->created_at }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                    @if ($product->updated_at)

                        <div class="col-sm-5 col-xs-6 text-larger">
                            <strong>
                                {{ trans('productsmanagement.labelUpdatedAt') }}
                            </strong>
                        </div>

                        <div class="col-sm-7">
                            {{ $product->updated_at }}
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                    @endif

                </div>

            </div>
        </div>
    </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')

@endsection
