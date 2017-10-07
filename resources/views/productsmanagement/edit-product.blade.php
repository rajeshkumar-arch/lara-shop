@extends('layouts.app')

@section('template_title')
  Editing Product {{ $product->name }}
@endsection

@section('template_linked_css')
  <style type="text/css">
    .btn-save,
    .pw-change-container {
      display: none;
    }
  </style>
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Editing User:</strong> {{ $product->name }}

            <a href="/products/{{$product->id}}" class="btn btn-primary btn-xs pull-right" style="margin-left: 1em;">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
             Back  <span class="hidden-xs">to Product</span>
            </a>

            <a href="/products" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to </span>Products
            </a>

          </div>

          {!! Form::model($product, array('action' => array('ProductsManagementController@update', $product->id), 'method' => 'PUT')) !!}

            {!! csrf_field() !!}

            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Product Name' , array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'name')) !!}
                    <label class="input-group-addon" for=""><i class="fa" aria-hidden="false"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('slug') ? ' has-error ' : '' }}">
                {!! Form::label('slug', 'Slug' , array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('slug', old('slug'), array('id' => 'slug', 'class' => 'form-control', 'placeholder' => 'slug')) !!}
                    <label class="input-group-addon" for=""><i class="fa" aria-hidden="false"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Description', array('class' => 'col-md-3 control-label')) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description')) !!}
                    <label class="input-group-addon" for=""><i class="fa" aria-hidden="false"></i></label>
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
                    <label class="input-group-addon" for=""><i class="fa" aria-hidden="false"></i></label>
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
                    <label class="input-group-addon" for=""><i class="fa" aria-hidden="false"></i></label>
                  </div>
                  @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="col-xs-6">
                {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="false"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
              </div>
            </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-save')
  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')

@endsection