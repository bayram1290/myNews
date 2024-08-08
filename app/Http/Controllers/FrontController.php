<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\News;

class FrontController extends Controller {
    
    public function index(): View { 
        $news = News::orderBy('created_at', 'desc')->paginate('4');
            // if ($request->ajax()) {
            //     return view('data', compact('items'));
            // }
        return view('pages.front.index', [ 
            'news_list' =>  $news
        ]);
    }

    public function showSingleNews(string $id): View {
        return view('pages.front.show_single_news', ['news_data' => News::findOrFail($id)]);
    }
    
}
