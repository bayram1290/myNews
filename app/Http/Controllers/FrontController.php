<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\News;
use Response;

class FrontController extends Controller {
    
    public function index(): View { 
        $news_list = News::orderBy('created_at', 'desc')->paginate('4');
        return view('pages.front.index', compact('news_list'));
    }

    public function showSingleNews(string $id): View {
        return view('pages.front.show_single_news', ['news_data' => News::findOrFail($id)]);
    }


    public function index_api(Request $request) {
        $json['code']=200;
        $news_list = News::orderBy('created_at', 'desc')->paginate('4');
        $json['news_list']=$news_list;
        return Response::json($json);
    }
    
}
