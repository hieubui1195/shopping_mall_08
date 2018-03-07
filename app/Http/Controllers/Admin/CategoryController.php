<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

use MyFunctions;
use Lang;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyFunctions::changeLanguage();

        $categories = Category::withTrashed()
                                ->with('getParent')
                                ->orderBy('parent_id')
                                ->orderBy('name')
                                ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyFunctions::changeLanguage();

        $type = Input::get('type');

        if ($type == config('custom.form_type.create_main')) {
            return view('admin.categories.main');
        } elseif ($type == config('custom.form_type.create_sub')) {
            $mainCategories  = Category::where('parent_id', config('custom.default_parent'))
                                        ->orderBy('name')
                                        ->pluck('name', 'id');

            return view('admin.categories.sub', compact('mainCategories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->parent_id = $request->parentId;
        $category->save();

        return redirect()->route('admin.category.index')
                            ->with('msg', Lang::get('custom.msg.category_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        
        if ($category->parent_id == config('custom.default_parent')) {
            return view('admin.categories.editMain', compact('category'));
        } else {
            $mainCategories  = Category::where('parent_id', config('custom.default_parent'))
                                        ->orderBy('name')
                                        ->pluck('name', 'id');

            return view('admin.categories.editSub', compact('category', 'mainCategories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parentId;
        $category->save();

        return redirect()->route('admin.category.index')->with('msg', Lang::get('custom.msg.category_edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $subs = Category::find($id)->sub;
        $subIds = $subs->pluck('id');

        $category->delete();
        Category::destroy($subIds);
        
        return redirect()->back()->with('msg', Lang::get('custom.msg.category_deleted'));
    }

}
