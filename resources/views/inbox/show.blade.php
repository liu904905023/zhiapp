@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">消息列表</div>

                    <div class="panel-body">
                        <form method="post" action="/inbox/{{$dialog}}/store">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="body" id=""></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right">发送</button>
                            </div>
                        </form>
                        <div class="messages-list">
                            @foreach($messages as $messageGroup)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img width="58" src="{{$messageGroup->fromUser->avatar}}" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="#">
                                                {{$messageGroup->fromUser->name}}
                                            </a>
                                        </h4>
                                        <p>
                                            <a href="/inbox/{{$messageGroup->dialog_id}}">
                                                {{$messageGroup->body}} <span class="pull-right">{{$messageGroup->created_at->format('Y-m-d h:i:s')}}</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
