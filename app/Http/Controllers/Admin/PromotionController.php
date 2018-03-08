<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Image;
use App\Models\PromotionDetail;
use Carbon\Carbon;
use MyFunctions;
use Lang;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyFunctions::changeLanguage();

        $promotions = Promotion::withTrashed()
                                ->orderBy('deleted_at')
                                ->orderBy('start_date')
                                ->get();

        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyFunctions::changeLanguage();

        $products = Product::all()->pluck('name', 'id');

        return view('admin.promotions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        $subStart = substr((string) $request->promotionRage, 0, 19);
        $subEnd = substr((string) $request->promotionRage, 21, 30);
        $start = date('Y-m-d H:i:s', strtotime($subStart));
        $end = date('Y-m-d H:i:s', strtotime($subEnd));

        $promotion = new Promotion;
        $promotion->name = $request->name;
        $promotion->start_date = $start;
        $promotion->end_date = $end;
        $promotion->save();

        $promotionId = DB::table('promotions')->max('id');

        // Images table
        $filename = $request->image->move(config('custom.image.path_promotion'), $request->image->getClientOriginalName());
        $image = new Image;
        $image->image = $filename;
        $image->imageable_id = $promotionId;
        $image->imageable_type = config('custom.image.promotion');
        $image->save();

        // Promotion Details table
        foreach ($request->products as $product) {
            $detail = new PromotionDetail;
            $detail->promotion_id = $promotionId;
            $detail->product_id = $product;
            $detail->percent = $request->percent;
            $detail->save();
        }

        return redirect()->route('admin.promotion.index')->with('msg', Lang::get('custom.msg.promotion_added'));
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

        $promotion = Promotion::find($id);
        $promotionDetails = PromotionDetail::where('promotion_id', $id)->with('product')->get();

        return view('admin.promotions.show', compact('promotion', 'promotionDetails'));
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

        $promotion = Promotion::find($id);
        $products = Product::all()->pluck('name', 'id');
        $promotionDetails = Promotion::find($id)->promotionDetails->pluck('product_id');
        $percent = Promotion::find($id)->promotionDetails->pluck('percent');
        $image = Promotion::find($id)->image->image;

        return view('admin.promotions.edit', compact('promotion', 'products', 'promotionDetails', 'percent', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionRequest $request, $id)
    {
        
        $subStart = substr((string) $request->promotionRage, 0, 19);
        $subEnd = substr((string) $request->promotionRage, 21, 30);
        $start = date('Y-m-d H:i:s', strtotime($subStart)); 
        $end = date('Y-m-d H:i:s', strtotime($subEnd));

        $promotion = Promotion::find($id);
        $promotion->name = $request->name;
        $promotion->start_date = $start;
        $promotion->end_date = $end;
        $promotion->save();

        // Images table
        if ($request->image != null) {
            $filename = $request->image->move(config('custom.image.path_promotion'), $request->image->getClientOriginalName());
            $image = Image::where('imageable_id', $id)
                            ->where('imageable_type', config('custom.image.promotion'))
                            ->get();
            $image->image = $filename;
            $image->imageable_id = $id;
            $image->imageable_type = config('custom.image.promotion');
            $image->save();
        }

        // Promotion Details table
        $oldDetails = PromotionDetail::where('promotion_id', $id)
                                        ->delete();
        foreach ($request->products as $product) {
            $detail = new PromotionDetail;
            $detail->promotion_id = $id;
            $detail->product_id = $product;
            $detail->percent = $request->percent;
            $detail->save();
        }

        return redirect()->route('admin.promotion.index')->with('msg', Lang::get('custom.msg.promotion_edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();

        return redirect()->back()->with('msg', Lang::get('custom.msg.promotion_deleted'));
    }

    public function rejectItem(Request $request)
    {
        $promotionDetailId = $request->promotionDetailId;
        $promotionDetail = PromotionDetail::find($promotionDetailId);
        $promotionDetail->delete();

        return response()->json(['msg' => Lang::get('custom.msg.promotion_item_rejected')]);
    }
}
