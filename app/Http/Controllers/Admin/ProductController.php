<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Review;

use Lang;
use MyFunctions;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyFunctions::changeLanguage();

        $products = Product::withTrashed()
                            ->with('images')
                            ->with('category')
                            ->orderBy('deleted_at')
                            ->orderBy('name')
                            ->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyFunctions::changeLanguage();

        $categories  = Category::where(
            'parent_id', '!=', config('custom.default_parent')
        )->orderBy('name')->pluck('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->save();
        
        $productId = Product::where('name', $request->name)->get();
        foreach ($request->images as $image) {
            $filename = $image->move(config('custom.image.path_product'), $image->getClientOriginalName());
            $image = new Image;
            $image->image = $filename;
            $image->imageable_id = $productId[0]['id'];
            $image->imageable_type = config('custom.image.product');
            $image->save();
        }

        return redirect()->route('admin.product.index')->with('msg', Lang::get('custom.msg.product_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        MyFunctions::changeLanguage();

        $product = Product::find($id);
        $images = Product::where('id', $id)->with('images')->get();
        $arrImg = [];
        for ($i=0; $i < count($images[0]['images']); $i++) { 
            $images[0]['images'][$i]['image'];
            array_push($arrImg, $images[0]['images'][$i]['image']);
        } 

        $promotion = 0;
        if (Product::find($id)->promotionDetail) {
            $promotion = Product::find($id)->promotionDetail;
        }

        $reviews = Review::where('product_id', $id)->with('user')->orderBy('created_at')->get();
        $countVote = count($reviews);
        $totalVote = 0;
        $avgVote = 0;
        if (count($reviews) > 0) {
            $votes = $reviews->pluck('rate');
            foreach ($votes as $vote) {
                $totalVote += $vote;
            }
            $avgVote = round($totalVote / count($votes));
        }

        return view('admin.products.show', compact('product', 'arrImg', 'promotion', 'reviews', 'countVote', 'avgVote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        MyFunctions::changeLanguage();

        $product = Product::withTrashed()
                            ->where('id', $id)
                            ->with('images')
                            ->get();
        $categories  = Category::where('parent_id', '!=', config('custom.default_parent'))
                                ->orderBy('name')
                                ->pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->save();

        if ($request->images != null) {
            $imgInits = Image::where('imageable_id', $id)
                                ->where('imageable_type', config('custom.image.product'))
                                ->delete();

            foreach ($request->images as $image) {
                $filename = $image->move(config('custom.image.path_product'), $image->getClientOriginalName());
                $image = new Image;
                $image->image = $filename;
                $image->imageable_id = $id;
                $image->imageable_type = config('custom.image.product');
                $image->save();
            }
        }

        return redirect()->route('admin.product.index')->with('msg', Lang::get('custom.msg.product_edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('msg', Lang::get('custom.msg.product_deleted'));
    }

    public function reuse(Request $request)
    {
        $product = Product::withTrashed()->where('name', $request->name)->restore();

        return response()->json(['statusReuse' => 1, 'msg' => Lang::get('custom.msg.reuse_success')]);
    }
    
}
