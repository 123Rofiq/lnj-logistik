<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Data::all();

        return view('posts', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title'       => 'required|max:255',
          'description' => 'required',
        ]);

        $post = Data::updateOrCreate(['id' => $request->id], [
                  'title' => $request->title,
                  'description' => $request->description
                ]);

        return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Data::find($id);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Data::find($id)->delete();

      return response()->json(['success'=>'Post Deleted successfully']);
    }
}