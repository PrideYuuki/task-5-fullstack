<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(): View
    {
        $category = Category::latest()->paginate(5);
        return view('category.index', compact('category'));
    }
    public function create(): View
    {
        return view('category.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name'     => 'required',
        ]);
        $userId = auth::id();

        Category::create([
            'name'     => $request->name,
            'user_id'  => $userId
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(string $id): View
    {
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required',
        ]);

        $category = Category::findOrFail($id);

            $category->update([
                'name'     => $request->name,
            ]);


        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
