@extends('layouts.app')

@section('template_title')
    Create New Product
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        Create New Product

                        <a href="/products" class="btn btn-info btn-xs pull-right">
                            <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                            Back <span class="hidden-xs">to</span><span class="hidden-xs"> Products</span>
                        </a>

                    </div>
                    <div class="panel-body">

                        {!! Form::open(array('action' => 'ProductsManagementController@store')) !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', 'Product Name' , array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'name')) !!}
                                    <label class="input-group-addon" for=""><i class="fa"
                                                                               aria-hidden="false"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('slug') ? ' has-error ' : '' }}">
                            {!! Form::label('slug', 'Slug' , array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('slug', NULL, array('id' => 'slug', 'class' => 'form-control', 'placeholder' => 'slug')) !!}
                                    <label class="input-group-addon" for=""><i class="fa"
                                                                               aria-hidden="false"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', 'Description', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description')) !!}
                                    <label class="input-group-addon" for=""><i class="fa"
                                                                               aria-hidden="false"></i></label>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('image') ? ' has-error ' : '' }}">
                            {!! Form::label('image', 'Image URL', array('class' => 'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('image', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'http://')) !!}
                                    <label class="input-group-addon" for=""><i class="fa"
                                                                               aria-hidden="false"></i></label>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('price') ? ' has-error ' : '' }}">
                            {!! Form::label('price', 'Price', array('class' => 'col-md-3 control-label ')) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('price', NULL, array('id' => 'price', 'class' => 'form-control', 'placeholder' => '0.0')) !!}
                                    <label class="input-group-addon" for=""><i class="fa"
                                                                               aria-hidden="false"></i></label>
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button('<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;' . 'Create New Product', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
