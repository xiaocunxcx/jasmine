@extends('blog.layouts.base')

@section('title')
    {{ $article->title }}
@endsection

@section('content')
    <div class="container" id="content" style="margin-top: 20px;">

        <h1 style="text-align: center; margin-top: 50px;">{{ $article->title }}</h1>
        <hr>
        <div id="date" style="text-align: right;">
            {{ $article->updated_at }}
        </div>
        <div id="content" style="padding: 50px;">
            <p>
                {{ $article->body }}
            </p>
        </div>
        <div class="author" id="author" style="text-align: right;">
            {{ $article->author->name }}
        </div>
        <div id="comments" style="margin-bottom: 100px;">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="new">
                <form action="{{ URL('comment/store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="article_id" value="{{ $article->id }}">

                    <div class="form-group">
                        <label>Nickname</label>
                        <input type="text" name="nickname" class="form-control" style="width: 300px;"
                               required="required">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" style="width: 300px;">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                    <textarea name="content" id="newFormContent" class="form-control" rows="10"
                              required="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success col-lg-12">Submit</button>
                </form>
            </div>

            <script>
                function reply(a) {
                    var nickname = a.parentNode.parentNode.firstChild.nextSibling.getAttribute('data');
                    var textArea = document.getElementById('newFormContent');
                    textArea.innerHTML = '@' + nickname + ' ';
                }
            </script>

            <div class="conmments" style="margin-top: 100px;">
                @foreach ($article->comments as $comment)

                    <div class="one" style="border-top: solid 20px #efefef; padding: 5px 20px;">
                        <div class="nickname" data="{{ $comment->nickname }}">
                            @if ($comment->website)
                                <a href="{{ $comment->website }}">
                                    <h3>{{ $comment->nickname }}</h3>
                                </a>
                            @else
                                <h3>{{ $comment->nickname }}</h3>
                            @endif
                            <h6>{{ $comment->created_at }}</h6>
                        </div>
                        <div class="content">
                            <p style="padding: 20px;">
                                {{ $comment->content }}
                            </p>
                        </div>
                        <div class="reply" style="text-align: right; padding: 5px;">
                            <a href="#new" onclick="reply(this);">回复</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
