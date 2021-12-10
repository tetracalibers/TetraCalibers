<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Top;
use App\Models\Profile;
use App\Models\Blog;
use App\Models\latexbook;
use App\Models\Subject;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Arr;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sitemap = App::make("sitemap");

        $topImages = [
            ['url' => URL::to('/images/Top/meta/tomixy.jpg')]
        ];
        $sitemap->add(URL::to('/'), now(), '1.0', 'always', $topImages, 'TetraCalibers');

        // プロフィール
        $profile = Profile::findOrFail(1);
        $profileImages = [
            ['url' => $profile->metaimage]
        ];
        $sitemap->add(URL::to('/profile'), $profile->updated_at, '0.8', 'daily', $profileImages, 'Profile of tomixy');

        $blogs = Blog::query()->orderBy('updated_at', 'desc')->get();
        foreach ($blogs as $blog) {
            $blogImages = [
                ['url' => $blog->metaimage]
            ];
            $sitemap->add(route('front.blog.show', compact('blog')), $blog->updated_at, '0.8', 'weekly', $blogImages, $blog->title);
        }

        $latexbooks = latexbook::query()->orderBy('updated_at', 'desc')->get();
        foreach ($latexbooks as $latexbook) {
            $latexbookImages = [
                ['url' => $latexbook->thumbnail]
            ];
            $sitemap->add(URL::to('/LaTeXbooks/' . $latexbook->slug), $latexbook->updated_at, '0.8', 'monthly', $latexbookImages, $latexbook->title);
        }

        $subjects = Subject::query()->orderBy('updated_at', 'desc')->get();
        foreach ($subjects as $subject) {
            $subjectImages = [
                ['url' => $subject->logo]
            ];
            $sitemap->add(URL::to('/clearnotes', ['subject' => $subject->slug]), $subject->updated_at, '0.4', 'monthly', $subjectImages, $subject->name);
        }

        $allTag = Tag::all();
        foreach ($allTag as $tag) {
            if ($tag->blogs()->count() > 0) {
                $tagImages = [
                    ['url' => $tag->logo]
                ];
                $articles = $tag->blogs()->pluck('updated_at', 'blog_id')->sortByDesc('updated_at')->toArray();
                [$keys, $values] = Arr::divide($articles);
                $latestArticle = Blog::findOrFail($keys[0]);
                $sitemap->add(route('front.tags.show', compact('tag')), $latestArticle->updated_at, '0.6', 'weekly', $tagImages, $tag->name);
            }
        }

        // 出力
        return $sitemap->render('xml');
        // XMLファイルで出力する場合
        // $sitemap->store('xml', 'mysitemap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
