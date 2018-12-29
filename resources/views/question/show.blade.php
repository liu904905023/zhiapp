@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{!! $question->title !!}

                        @foreach($question->topics as $topic)
                            <a href="/topic/{{$topic->id}}" class="topic">{{$topic->name}}</a>
                        @endforeach</div>

                    <div class="panel-body">
                        {!! $question->body !!}

                    </div>
                    <div class="actions">
                        @if(Auth::check()&&Auth::user()->owns($question))
                            <span class="edit">
                                <a href="/questions/{{$question->id}}/edit">edit</a>
                            </span>
                            <form action="/questions/{{$question->id}}" method="post" class="delete-form">
                                {!! method_field('delete') !!}
                                {!! csrf_field() !!}
                                <button class="button is-naked delete-button">delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <span>{{$question->followers_count}} followers</span>
                    </div>
                    <div class="panel-body">
                        <a href="/question/{{$question->id}}" class="btn btn-default">
                            follow answer
                        </a>
                        <a href="" class="btn btn-primary">write</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {{$question->answers_count}} answers
                    </div>

                    <div class="panel-body content">
                        @foreach($question->answers as $answer)
                            <div class="media">
                                <a class="pull-left" href="">
                                    <img src="{{$answer->user->avatar}}" class="media-object" width="46" alt="{{$answer->user->name}}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{$answer->user->id}}">
                                            {!! $answer->user->name !!}
                                        </a>
                                    </h4>
                                    {!! $question->title !!}
                                </div>

                            </div>
                        @endforeach
                        @if(Auth::check())
                        <form action="/questions/{{$question->id}}/answer" method="post">

                            {!! csrf_field() !!}
                            <div class="form-group{{$errors->first('body')? ' has-error':""}}">
                                <script id="container" name="body" style="height:120px" type="text/plain">
                                    {{old("body")}}
                                </script>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-success pull-right" type="submit">submit</button>
                        </form>
                            @else
                                <a href="/login" class="btn btn-success btn-block">login</a>
                        @endif
                    </div>

                </div>

                </div>

            </div>
        </div>

    </div>

@section('js')

    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
        ue.ready(function() {
//            ue.execCommand('serverparam', '_token', Laravel.csrfToken); // 设置 CSRF token.
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
        $(document).ready(function() {

            $('.js-example-basic-multiple').select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                createTag: function(params) {//解决部分浏览器开启 tags: true 后无法输入中文的BUG
                    if (/[,;，； ]/.test(params.term)) {//支持【逗号】【分号】【空格】结尾生成tags
                        var str = params.term.trim().replace(/[,;，；]*$/, '');
                        return { id: str, text: str }
                    } else {
                        return null;
                    }
                },
                ajax: {
                    url: '/api/topics',
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {

                        return {

                            q: params.term

                        };

                    },

                    processResults: function (data, params) {

                        return {

                            results: data

                        };

                    },

                    cache: true

                },
                templateResult: formatTopic,

                templateSelection: formatTopicSelection,

                escapeMarkup: function (markup) { return markup; }

            });

            function formatTopic (topic) {

                return "<div class='select2-result-repository clearfix'>" +

                "<div class='select2-result-repository__meta'>" +

                "<div class='select2-result-repository__title'>" +

                topic.name ? topic.name : "Laravel"   +

                    "</div></div></div>";

            }


            function formatTopicSelection (topic) {

                return topic.name || topic.text;

            }
        });
    </script>

@endsection
@endsection
