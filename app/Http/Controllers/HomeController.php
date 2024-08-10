<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsView;
use App\Models\News;
use App\Models\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $top_news = NewsView::join('news', 'news.id', '=', 'news_id')
            ->groupBy('news_id')
            ->orderBy(DB::raw('COUNT(news_id)'), 'DESC')
            ->take(5)
            ->get(array(DB::raw('COUNT(news_views.news_id) as total_views'), 'news.*'));


        $top_authors = NewsView::join('users', 'users.login', '=', 'author_name')
            ->groupBy('author_name')
            ->orderBy(DB::raw('COUNT(author_name)'), 'DESC')
            ->get(array(DB::raw('COUNT(news_views.news_id) as total_views'), 'users.login'));

        return view('home', [ 'top_news'  => $top_news, 'top_authors' => $top_authors  ]);
    }
}