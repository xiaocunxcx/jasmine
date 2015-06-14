<?php namespace App\Http\Controllers\Blog;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Blog;
use Illuminate\Http\Request;

use Redirect, Input, Auth;

class ArticleController extends Controller {

    public function index() {
        $articles = Blog::where('type', 'Article')->paginate(2);
        return view('blog.articles.index')->withArticles($articles);
    }

    public function show($id)
    {
        $article = Blog::find($id);
        if ($article->type == 'Article') {
            return view('blog.articles.show')->withArticle($article);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('blog.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        $article = new Blog();
        $article->title = Input::get('title');
        $article->body = Input::get('body');
        $article->user_id = 1;//Auth::user()->id;

        if ($article->save()) {
            return Redirect::to('blog.home');
        } else {
            return Redirect::back()->withInput()->withErrors('Save Failed！');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.articles.edit')->withPage(Page::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles,title,'.$id.'|max:255',
            'body' => 'required',
        ]);

        $page = Page::find($id);
        $page->title = Input::get('title');
        $page->body = Input::get('body');
        $page->user_id = 1;//Auth::user()->id;

        if ($page->save()) {
            return Redirect::to('admin');
        } else {
            return Redirect::back()->withInput()->withErrors('Save Failed！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return Redirect::to('admin');
    }

}
