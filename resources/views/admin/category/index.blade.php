@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>Categories</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-4">
            <div class="ibox-tools">
                <a href="{{ route('admin.categories.create')  }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>


    {{--List--}}
    @if (count($main_categories) > 0)
        <ul>
            @foreach ($main_categories as $category)
                @include('admin.category.ulli', $category)
            @endforeach
        </ul>
    @else
        @include('partials')
    @endif


    {{--nav bar--}}
    <div class="bs-example">
        <nav class="navbar navbar-inverse" role="navigation">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">

                @if (count($main_categories) > 0)
                    <ul class="nav navbar-nav">
                        @foreach ($main_categories as $category)
                            @include('admin.category.dropdown', $category)
                        @endforeach
                    </ul>
                @endif

            </div><!-- /.navbar-collapse -->
        </nav>
    </div>


    {{--Tree function--}}
    <?php

        function tree($category){

            if(count($category['childrens']) > 0 ){

                echo "<li>".$category['name'].
                    "<ul>";
                        foreach($category['childrens'] as $category){
                            tree($category);
                        }
                    echo "</ul>
                </li>";

            }else{
                echo "<li data-jstree=\"'type':'html'}\">" .$category['name']."</li>";
            }
        }
    ?>

    {{--Tree--}}
    <div id="jstree1">

        @if (count($main_categories) > 0)
            <ul>
                @foreach ($main_categories as $category)
                   @php(tree($category))
                @endforeach
            </ul>
        @endif

    </div>



    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            @include('flash_message.message')

            @if( count($categories) == 0 )
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> Category not found.
                </div>
            @endif

            <div class="ibox-title">
                <h5>Category list</h5>
            </div>
            <div class="ibox-content">

                <div class="row search_sec">
                    <div class="col-sm-3">
                        <form method="get" action="{{ route('admin.categories.index') }}">

                            <div class="input-group">
                                <input name="search" value="{{ $search }}" type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('admin.categories.reset') }}" class="btn btn-sm btn-info">Reset</a> </span>

                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php( $i = 1 )
                    @foreach ($categories as $category)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->name }}</td>

                            <td>{{ ($category->parent_id != null)?$category->parent->name:'--' }} </td>

                            <td> {{ $category->description }}</td>

                            <?php
                                if (isset($category->image)){
                                    $image_url = URL::to('admin/uploads/images/categories/'.$category->image);
                                }else{
                                    $image_url = URL::to('admin/img/no-image.png');
                                }
                            ?>

                            <td><img src="{{ $image_url }}" alt="Image" class="cus_thumbnail"></td>
                            <td> {{ date_format($category->created_at, 'd-m-Y') }}</td>

                            @if($category->status)
                                <td> <i class="fa fa-check"></i> </td>
                            @else
                                <td><i class="fa fa-times"></i></td>
                            @endif

                            <td>

                                @if($category->status)
                                    <a href="{{ route('admin.categories.change-status', [$category->id, $category->status]) }}" class="btn btn-success action_btn" title="Change status"> <i class="fa fa-thumbs-up"></i></a>
                                @else
                                    <a href="{{ route('admin.categories.change-status', [$category->id, $category->status]) }}" class="btn btn-warning action_btn" title="Change status"> <i class="fa fa-thumbs-down"></i></a>
                                @endif

                                <a title="Edit" href="{{ route('admin.categories.edit', [$category->id]) }}" class="btn btn-info action_btn"> <i class="fa fa-pencil"></i></a>
                                <a title="Delete" data-toggle="modal" data-target="#myModal{{$category->id}}" type="button" class="btn btn-danger action_btn"><i class="fa fa-trash"></i></a>
                            </td>

                            <!-- The Modal -->
                            <div class="modal" id="myModal{{$category->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete brand</h4>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">

                                            <h3>You are going to delete ' {{ $category->name }} ' ?</h3>

                                            <a data-dismiss="modal" class="btn btn-sm btn-warning"><strong>No</strong></a>
                                            <button class="btn btn-sm btn-primary" type="submit" onclick="event.preventDefault();
                                                    document.getElementById('brand-delete-form{{ $category->id }}').submit();">
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

                            <form id="brand-delete-form{{ $category->id }}" method="POST" action="{{ route('admin.categories.destroy', [$category->id]) }}" style="display: none" >

                                {{method_field('DELETE')}}
                                @csrf()

                            </form>

                        </tr>

                        @php($i++)
                    @endforeach


                    </tbody>
                </table>
                {{ $categories->links() }}

            </div>
        </div>
    </div>
@endsection()