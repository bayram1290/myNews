<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\News;
use App\Models\User;
use App\Models\NewsView;
use Response;

class FrontController extends Controller {

    public function index(): View {
        $news_list = News::orderBy('created_at', 'desc')->paginate('4');
        return view('pages.front.index', compact('news_list'));
    }

    public function showSingleNews(string $id): View {
        if(auth()->check() && auth()->user()->name !== News::find($id)->author) {
            if(count(NewsView::where(['news_id' => $id, 'session_id' => request()->getSession()->getId()])->get()) < 1) {
                NewsView::create([
                    'news_id' => $id,
                    'session_id' => request()->getSession()->getId(),
                    'author_name' => News::find($id)->author
                ]);
            }
        }
        $view_count = count(NewsView::where('news_id', $id)->get('news_id'));
        return view('pages.front.show_single_news', ['news_data' => News::findOrFail($id), 'news_view' => $view_count ]);
    }

    public function index_api(Request $request) {
        $json['code']=200;
        $news_list = News::orderBy('created_at', 'desc')->paginate('4');
        $json['news_list']=$news_list;
        return Response::json($json);
    }
}
