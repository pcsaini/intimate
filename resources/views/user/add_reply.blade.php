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
                        @if (isset($reply) && !empty($reply))
                            Edit Comment
                        @else
                            Add Comment
                        @endif
                    </div>
                    <div class="panel-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form role="form" method="post" action="{{ route('user.save_reply') }}">
                            @csrf
                            <?php
                            if (isset($reply) && !empty($reply)){
                                $id = $reply->id;
                                $reply_text = $reply->reply;
                                $comment_id = $reply->comment_id;
                            }else{
                                $id = 0;
                                $reply_text ='';
                            }
                            ?>
                            <input type="hidden" name="id" value="{{ $id }}" >
                            <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                            <div class="form-group">
                                <label>Reply</label>
                                <textarea class="form-control" name="reply" placeholder="Reply" rows="8">{{ $reply_text }}</textarea>
                                @if($errors->has('reply'))
                                    <label class="text-danger">{{ $errors->first('reply') }}</label>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div>
@endsection