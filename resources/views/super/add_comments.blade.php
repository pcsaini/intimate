@extends('super.master')

@section('page_title', 'Add Comment - Intimate Blog')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Add Comment</li>
        </ol>
    </div><!--/.row-->

    <div class="row">

        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @if (isset($comment) && !empty($comment))
                    Edit Comment
                    @else
                    Add Comment
                    @endif
                </div>
                <div class="panel-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form role="form" method="post" action="{{ route('super.save_comments') }}">
                        @csrf
                        <?php
                        if (isset($comment) && !empty($comment)){
                            $id = $comment->id;
                            $comment_text = $comment->comments;
                            $post_id = $comment->post_id;
                        }else{
                            $id = 0;
                            $comment_text ='';
                        }
                        ?>
                        <input type="hidden" name="id" value="{{ $id }}" >
                        <input type="hidden" name="post_id" value="{{ $post_id }}">
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea class="form-control" name="comment" placeholder="Comment" rows="8">{{ $comment_text }}</textarea>
                            @if($errors->has('comment'))
                                <label class="text-danger">{{ $errors->first('comment') }}</label>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--/.row-->
</div>
@endsection