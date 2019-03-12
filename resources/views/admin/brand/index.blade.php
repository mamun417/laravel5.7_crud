@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>Brands</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-4">
            <div class="ibox-tools">
                <a href="{{ route('admin.brands.create')  }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            @include('flash_message.message')

            @if( count($brands) == 0 )
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> Brand not found.
                </div>
            @endif

            <div class="ibox-title">
                <h5>Brand list</h5>
            </div>
            <div class="ibox-content">

                <div class="row search_sec">
                    <div class="col-sm-3">
                        <form method="get" action="{{ route('admin.brands.index') }}">

                            <div class="input-group">
                                <input name="search" value="{{ $search }}" type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('admin.brands.reset') }}" class="btn btn-sm btn-info">Reset</a> </span>

                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php( $i = 1 )
                    @foreach ($brands as $brand)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>{{ date_format($brand->created_at, 'd-m-Y') }}</td>

                            @if($brand->status)
                                <td> <i class="fa fa-check"></i> </td>
                            @else
                                <td><i class="fa fa-times"></i></td>
                            @endif

                            <td>
                                @if($brand->status)
                                    <a href="{{ route('admin.brands.change-status', [$brand->id, $brand->status]) }}" class="btn btn-success action_btn" title="Change status"> <i class="fa fa-thumbs-up"></i></a>
                                @else
                                    <a href="{{ route('admin.brands.change-status', [$brand->id, $brand->status]) }}" class="btn btn-warning action_btn" title="Change status"> <i class="fa fa-thumbs-down"></i></a>
                                @endif

                                <a href="{{ route('admin.brands.edit', [$brand->id]) }}" class="btn btn-info action_btn" title="Edit"> <i class="fa fa-pencil"></i></a>
                                <a data-toggle="modal" data-target="#myModal{{$brand->id}}" type="button" class="btn btn-danger action_btn" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>

                            <!-- The Modal -->
                            <div class="modal" id="myModal{{$brand->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete brand</h4>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">

                                            <h3>You are going to delete ' {{ $brand->name }} ' ?</h3>

                                            <a data-dismiss="modal" class="btn btn-sm btn-warning"><strong>No</strong></a>
                                            <button class="btn btn-sm btn-primary" type="submit" onclick="event.preventDefault();
                                                    document.getElementById('brand-delete-form{{ $brand->id }}').submit();">
                                                <strong>Yes</strong>
                                            </button>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <form id="brand-delete-form{{ $brand->id }}" method="POST" action="{{ route('admin.brands.destroy', [$brand->id]) }}" style="display: none" >

                                {{method_field('DELETE')}}
                                @csrf()

                            </form>

                        </tr>

                        @php($i++)

                    @endforeach


                    </tbody>
                </table>
                {{ $brands->links() }}

            </div>
        </div>
    </div>
@endsection()