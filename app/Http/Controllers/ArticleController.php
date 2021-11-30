<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Images;
use Faker\ORM\Spot\ColumnTypeGuesser;
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
    public function create(Request $request)
    {
        dd( $request->file());
        $validation = array(
            'title' => 'required|max:50',
            'description' => 'required|max:50',
            'text' => 'required',
        );

        $validator = Validator::make($request->all(), $validation);

        if ( $validator->fails() ){

            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 200);

        }
        else{

            if ( ! empty($request->images)) {
                $imagesArr = collect([]);

                foreach ($request->images as $image){
                    $requestImage = $request->file($image) ;
                    $filename = time() . '.' . $requestImage->getClientOriginalExtension();
                    $imagesArr->push($filename);
                }

                $jsonDetails = json_encode( $imagesArr, JSON_FORCE_OBJECT);
                dd($imagesArr);
            }
            else{
                $jsonDetails = NULL;
            }

            $newArticle = Article::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'text' => $request->input('text'),
                'images' => $jsonDetails,
            ]);
            $newArticle->save();
//
//            Image::make($requestImage)->resize(400, 400)
//                ->save();
            $newArticle->storeArticleImage();

//
//            if( $request->has('images') ){
//
//                $filename = time() . '.' . $request->images[0];
//
//                $newArticle->create([
//                   'image' => $filename
//                ]);
//
//                Image::make($requestImage)->resize(400, 400)
//                    ->save( public_path( $album
//                            ->getImagePath(Auth::user()->id,  $album->id ) . $filename ));

//
//            }

//
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
