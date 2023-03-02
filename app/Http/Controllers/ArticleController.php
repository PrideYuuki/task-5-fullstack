<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Articles::with('category')->get();
        return view('article.index', compact('articles'));
    }
    public function create(): View
    {
        $category = Category::get();
        return view('article.create', compact('category'));
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10',
            'category'      => 'required'
        ]);
        $userId = auth::id();

        $image = $request->file('image');
        $image->storeAs('public/articles', $image->hashName());

        Articles::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'image'     => $image->hashName(),
            'user_id'   => $userId,
            'categories_id' => $request->category
        ]);

        return redirect()->route('articles.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(string $id): View
    {
        $articles = Articles::findOrFail($id);
        $category = Category::get();
        return view('article.edit', compact('articles','category'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10',
            'category'      => 'required'
        ]);

        $post = Articles::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/articles', $image->hashName());
            Storage::delete('public/articles/'.$post->image);
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
                'categories_id' => $request->category
            ]);
        } else {
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'categories_id' => $request->category
            ]);
        }


        return redirect()->route('articles.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id): RedirectResponse
    {

        $post = Articles::findOrFail($id);

        Storage::delete('public/posts/'. $post->image);

        $post->delete();

        return redirect()->route('articles.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
