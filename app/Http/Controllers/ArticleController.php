<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Images;
use Dflydev\DotAccessData\Data;
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
        $articles = Article::orderBy('id', 'DESC')->limit(5)->get();
        return response()->json([
           'success' => true,
           'articles' => $articles
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create(Request $request)
    {
        $validation = array(
            'title' => 'required|max:50',
            'description' => 'required|max:50',
            'text' => 'required',
        );

        $validator = Validator::make($request->all(),  $validation);

        if ( $validator->fails() ){
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 200);

        }
        else{

            if ( ! empty($request->file()) ) {
                $imagesArr = collect([]);

                foreach ($request->file(['files']) as $image){
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $imagesArr->push($filename);
                }
                $jsonDetails = json_encode( $imagesArr, JSON_FORCE_OBJECT);
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

            if ( ! empty($request->file()) ){
                $newArticle->storeArticleImage($request->file(['files']) );
            }

            return response()->json([
                'success' => true,
            ], 200);
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
