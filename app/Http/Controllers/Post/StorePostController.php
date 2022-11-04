<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StorePostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $input = $request->validate([
            'caption' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);


        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $galeri = time()."_".$image->getClientOriginalName();
            $image->move($destinationPath, $galeri);
            $input['image'] = "$galeri";
        }

        $request->user()->posts()->create($input);

        return redirect()->back()->with('success', 'Post Created !');
    }
}
