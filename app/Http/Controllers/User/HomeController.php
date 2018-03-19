<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Cart;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class HomeController extends Controller
{
    public function getProd(Request $request, $id)
    {
        $product = Product::find($id);
        $images = Product::productImages($id);
        $arrImg = [];
        for ($i = 0; $i < count($images[0]['images']); $i++) { 
            $images[0]['images'][$i]['image'];
            array_push($arrImg, $images[0]['images'][$i]['image']);
        } 

        $promotion = 0;
        if (Product::find($id)->promotionDetail) {
            $promotion = Product::find($id)->promotionDetail;
        }

        $reviews = Review::reviewProduct($id);
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

        $reviewLimits = Review::reviewLimit($id);
        if ($request->ajax()) {
            return view('user.partials.review', compact('review', 'reviewLimits'));
        }

        return view('user.layouts.product-details', compact('product', 'arrImg', 'promotion', 'reviews', 'countVote', 'avgVote', 'reviewLimits'));     
    }

    public function checkReview(Request $request)
    {
        $existed = false;
        $count = Review::reviewExist($request->productId, $request->userId)->count();
        if ($count > 0) {
            $existed = true;
        }

        return response()->json(['status' => $existed]);
    }

    public function sendReview(Request $request)
    {
        Review::create([
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'title' => $request->title,
            'content' => $request->content,
            'rate' => $request->rate,
        ]);

        $reviewLimits = Review::reviewLimit($request->productId);

        return view('user.partials.review', compact('reviewLimits'));
    }

    public function getReview(Request $request)
    {
        $review = Review::getReview($request->id);

        return response()->json([
            'productId' => $review[0]['product_id'],
            'title' => $review[0]['title'],
            'content' => $review[0]['content'],
            'rate' => $review[0]['rate'],
        ]);
    }

    public function editReview(Request $request)
    {
        Review::reviewFind($request->id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'rate' => $request->rate,
        ]);

        $reviewLimits = Review::loadMore($request->id, $request->productId);
        
        if (!$reviewLimits->isEmpty()) {
            return view('user.partials.review', compact('reviewLimits'));
        }
    }

    public function deleteReview(Request $request, $id)
    {
        if ($request->ajax()) {
            Review::destroy($request->id);
            $reviewLimits = Review::reviewLimit($request->productId);

            return view('user.partials.review', compact('reviewLimits'));
        }
    }
    
    public function loadReviewAjax(Request $request)
    {
        $reviewLimits = Review::loadMore($request->id, $request->productId);
        
        if (!$reviewLimits->isEmpty()) {
            return view('user.partials.review', compact('reviewLimits'));
        }
    }
}
