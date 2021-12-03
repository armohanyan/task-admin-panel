<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Images;
use Dflydev\DotAccessData\Data;
use Faker\ORM\Spot\ColumnTypeGuesser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use League\CommonMark\Parser\Block\SkipLinesStartingWithLettersParser;

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
        ], 200);
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

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 200);

        } else {
            $newArticle = Article::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'text' => $request->input('text'),
            ]);
            $newArticle->save();

            if (!empty($request->file())) {
                $imagesArr = collect([]);

                foreach ($request->file(['files']) as $index => $image) {
                    $name = time() . $index . '.' . $image->getClientOriginalExtension();
                    $filename = 'storage/article' . $newArticle->id . '/' . $name;
                    $image->storeAs("article{$newArticle->id}", $name, 'public');
                    $imagesArr->push($filename);
                }
                $newArticle->update(['images' => json_encode($imagesArr, JSON_FORCE_OBJECT)]);
            }

            return response()->json([
                'success' => true,
            ], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return response()->json([
            'success' => true,
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return response()->json([
            'siccess' => true,
            'article' => $article,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $validation = array(
            'title' => 'required|max:50',
            'description' => 'required|max:50',
            'text' => 'required',
        );

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ], 200);

        }
        else {

            $article->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'text' => $request->input('text'),
            ]);

            if ( ! empty($request->file())) {
                $articleImages = collect((array)json_decode($article->images));

                foreach ($request->file(['files']) as $index => $image){
                    $name = time(). '.' . $image->getClientOriginalExtension();
                    $filename = 'storage/article' . $article->id . '/' . $name ;
                    $image->storeAs("article{$article->id}", $name, 'public');
                    $articleImages->push($filename);
                }
                $article->update(['images' => json_encode( $articleImages, JSON_FORCE_OBJECT)]);
            }

            if ($request->deletedImages) {

                $deletedImages = explode(',',  $request->deletedImages);
                $articleImages = collect((array)json_decode($article->images));

                $filtered = $articleImages->filter(function ($image) use($deletedImages, $article) {
                    $dir = "/storage/article".$article->id;
                    $scan = scandir(public_path($dir));

                    if (!in_array($image, $deletedImages)) return true;
                    if (File::exists($image)) File::delete($image);
                    if(  count($scan) == 2 )   rmdir(public_path($dir));

                      return false;
                });
                $article->update(['images' => json_encode((object)$filtered)]);
            }

            return response()->json([
                'success' => true,
            ], 200);

        }
    }
        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            $article = Article::find($id);
            Article::destroy($id);
            $dir = "/storage/article".$article->id;
            File::deleteDirectory(public_path($dir));

            return response()->json([
                'success' => true,
            ], 200);
        }

        public function searchQuery($query){
            $searchedReslt = Article::where('title', 'LIKE', "%{$query}%")
                ->get();

            return response()->json([
                'success' => true,
                'queryResult' => $searchedReslt,

            ], 200);
        }
}
