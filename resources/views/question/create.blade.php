@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">post question</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="/questions" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <input type="text" value="{{old('title')}}" name="title" id="title" placeholder="title" class="form-control">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select class="js-example-basic-multiple form-control" name="topics[]" multiple="multiple">
                                </select>
                            </div>
                                <div class="form-group">
                            <script id="container" name="body" type="text/plain" ></script>
                                </div>
                                <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">submit</button>
                                </div>
                            </form>

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
