@extends('super.master')

@section('page_title', 'Add New Category - Intimate Blog')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add Category</li>
            </ol>
        </div><!--/.row-->

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        @if (isset($catogory) && !empty($category))
                            Edit Category
                        @else
                            Add Category
                        @endif
                    </div>
                    <div class="panel-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form role="form" method="post" action="{{ route('super.save_category') }}">
                            @csrf
                            <?php
                                if (isset($category) && !empty($category)){
                                    $id = $category->id;
                                    $category_name = $category->category;
                                }else{
                                    $id = 0;
                                    $category_name ='';
                                }
                            ?>
                            <input type="hidden" name="id" value="{{ $id }}" >
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control" placeholder="Placeholder" name="category" value="{{ old('category') == '' ? $category_name : old('category')}}">
                                @if($errors->has('category'))
                                    <label class="text-danger">{{ $errors->first('category') }}</label>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div>
@endsection