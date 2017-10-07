@extends('layouts.app')

@section('template_title')
  Showing Products
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            Showing All Products

                            <div class="btn-group pull-right btn-group-xs">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        Show Products Management Menu
                                    </span>
                                </button>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/products/create">
                                            <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                            Create New Product
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th class="hidden-xs">Slug</th>
                                        <th class="hidden-xs col-md-2">Description</th>
                                        <th class="hidden-xs">Price</th>
                                        <th class="hidden-xs col-md-2" style="max-width:120px">Image Url</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Created</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                                        <th>Actions</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td class="hidden-xs">{{ $product->slug }}</td>
                                            <td class="hidden-xs">{{ $product->description }}</td>
                                            <td class="hidden-xs">{{$product->price}}</td>
                                            <td class="hidden-xs col-md-2" style="max-width:120px;overflow-wrap:break-word">{{$product->image}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$product->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$product->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'products/' . $product->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> Product</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Product', 'data-message' => 'Are you sure you want to delete this product ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('products/' . $product->id) }}" data-toggle="tooltip" title="Show">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Product</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('products/' . $product->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> Product</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($products) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}
@endsection