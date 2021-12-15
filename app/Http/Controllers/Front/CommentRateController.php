<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentRateController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'content' => 'required',
            'rate' => 'required|integer|between:1,5'
        ]);

        Comment::create([
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
            'text' => $request->get('content'),
        ]);

        $productRate = $product->rates()->wherePivot('user_id', auth()->user()->id)->first();
        if ($productRate) {
            $productRate->pivot->update(['rate' => $request->get('rate')]);
        } else {
            $product->rates()->attach(auth()->user()->id, [
                'rate' => $request->get('rate'),
            ]);
        }

        notify()->success("Comment successfully submitted.");

        return redirect()->back();
    }
}
