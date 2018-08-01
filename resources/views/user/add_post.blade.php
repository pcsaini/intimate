@extends('super.master')

@section('page_title', 'Add New Post | Intimate Blog')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">New Post</li>
            </ol>
        </div><!--/.row-->
        <?php
        if (isset($post) && !empty($post)){
            $heading = 'Post Edit';
            $id = $post->id;
            $post_title = $post->post_title;
            $post_category = $post->category_id;
            $post_tags = $post->tags;
            $post_media = $post->post_media;
            $post_content = $post->post;
        }else{
            $heading = 'Add New Post';
            $id = 0;
            $post_title = '';
            $post_category = '';
            $post_tags = '';
            $post_media = '';
            $post_content = '';
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $heading }}
                    </div>
                    <div class="panel panel-body">
                        <form role="form" method="post" action="{{ route('user.save_post') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group">
                                <label>Post Title</label>
                                <input type="text" class="form-control" placeholder="Placeholder" name="post_title" value="{{ old('post_title') == '' ? $post_title : old('post_title')}}">
                                @if($errors->has('post_title'))
                                    <label class="text-danger">{{ $errors->first('post_title') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option selected disabled>Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}" {{ $post_category == $cat->id ? 'selected' : '' }}>{{$cat->category}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                    <label class="text-danger">{{ $errors->first('category') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tags</label>
                                <input type="text" class="form-control" placeholder="Add Tags" name="tags" data-role="tagsinput" value="{{ old('tags') == '' ? $post_tags : old('tags')}}">
                                @if($errors->has('tags'))
                                    <label class="text-danger">{{ $errors->first('tags') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Post Media</label>
                                <input type="file" class="form-control" name="post_media[]" value="{{ old('post_media') == '' ? $post_media : old('post_media') }}" multiple>
                                <p class="help-block">Media Type: .jpg, .jpeg, .png,</p>
                                @if($errors->has('post_media'))
                                    <label class="text-danger">{{ $errors->first('post_media') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Post Content</label>
                                <textarea id="post_content" name="post">{{ old('post') == '' ? $post_content : old('post') }}</textarea>
                                @if($errors->has('post'))
                                    <label class="text-danger">{{ $errors->first('post') }}</label>
                                @endif
                            </div>

                            @if (isset($post) && !empty($post))
                                <button type="submit" class="btn btn-success" name="edit" value="true">Submit</button>
                            @else
                                <button type="submit" class="btn btn-success" name="publish" value="true">Publish</button>
                                <button type="submit" class="btn btn-info" name="save" value="true">Save Draft</button>
                            @endif
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection

@section('style')
    <link href="{{ asset('Admin/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('Admin/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(function() {
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        });

        $(document).ready(function() {
            $('#post_content').summernote();
        });
    </script>
@endsection