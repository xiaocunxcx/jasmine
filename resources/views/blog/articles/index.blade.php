@extends('blog.layouts.base')

@section(('title'))
    Jasmine的秘密花园
@endsection


@section('content')
    <div class="container" id="content" style="margin-top: 20px;">
        <ul>
            @foreach ($articles as $article)
                <li style="margin: 50px 0;">
                    <div class="title">
                        <a href="{{ URL('article/'.$article->id) }}">
                            <h4>{{ $article->title }}</h4>
                        </a>
                    </div>
                    <div class="body">
                        <p>{{ $article->body }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
