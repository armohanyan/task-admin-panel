<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        $validation = array(
            'title' => 'required|max:50',
            'description' => 'required|max:50',
            'text' => 'required',
            'images*' => 'mimes:jpeg,jpg,png,gif|max:10000'
        );

        $validator = Validator::make($request->all(), $validation);

        if ( $validator->fails() ){

            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 200);

        }
        else{
//
//            if( $request->hasFile('image') ){
//
//                $requestImage = $request->file("image-$albumId") ;
//                $filename = time() . '.' . $requestImage->getClientOriginalExtension();
//
//                $image = new Album ;
//                $image->body = $filename;
//                $image->user()->associate( Auth::user() );
//                $album->images()->save($image) ;
//
//                Image::make($requestImage)->resize(400, 400)
//                    ->save( public_path( $album
//                            ->getImagePath(Auth::user()->id,  $album->id ) . $filename ));
//
//                return redirect()->back()->with('info', 'Image uploaded successfully');
//
//            }

//            $newArticle = Article::create([
//                'title' => $request->input('firstname'),
//                'description' => $request->input('surname'),
//                'text' => $request->input('email'),
//                'image' => bcrypt($request->input('password'))
//            ]);


            return response()->json(['success' => true], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
