<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use Auth;

class NewsController extends Controller {

    public function __construct()  {
       $this->middleware('auth');
       $this->middleware('permission:create-news|edit-news|delete-news', ['only' => ['index','show']]);
       $this->middleware('permission:create-news', ['only' => ['create','store']]);
       $this->middleware('permission:edit-news', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-news', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View  {
        return view('admin.news.index', [
            'news_list' => News::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View  {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request): RedirectResponse  {

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = $file->getClientOriginalExtension();
            $image_name = $file_name . time() . '.' . $file_extension;
            $image_path = Storage::disk('public')->putFileAs( 'news_image', $file, $image_name );
        } 
        
        $news = News::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'author' => Auth::user()->login
        ]);
        return redirect()->route('news.index')->withSuccess('Новость добавлена.');
    }


    /**
     * Display the specified resource.
     */
    public function show(News $news): View  {
        //  ????????????????????????????????
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View  {
        return view('admin.news.edit', [
            'news' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news): RedirectResponse {

        $news_data = $request->all();
        $news_data['image'] = $news->image;

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = $file->getClientOriginalExtension();
            $image_name = $file_name . time() . '.' . $file_extension;
            $news_data['image'] = Storage::disk('public')->putFileAs('news_image', $file, $image_name );
        }
        $news->update($news_data);
        return redirect()->route('news.index')->withSuccess('Новости обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): RedirectResponse {
        
        if($news->delete()) {
            unlink( public_path('storage/') . $news->image);
        }
        return redirect()->route('news.index')->withSuccess('Новость удалена.');
    }
}
