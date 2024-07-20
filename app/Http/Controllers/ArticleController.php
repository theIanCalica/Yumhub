<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy("title", "asc")->get();
        return response()->json($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "title" => "required|string",
                'description' => "required",
                'content' => "required",
                'category' => "required",
                'filePath' => "required|image|mimes:jpeg,png,jpg",
            ]);

            $path = Storage::putFile('public/articles', $request->file('filePath'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['filePath'] = $path;
            $article = Article::create($validatedData);
            return response()->json([
                "article" => $article,
                "status" => 200,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::FindOrFail($id);
        return response()->json($article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "title" => "required|string",
                'description' => "required",
                'content' => "required",
                'category' => "required",
                'filePath' => "nullable|image|mimes:jpeg,png,jpg",
            ]);
            $article = Article::FindOrFail($id);

            if ($request->hasFile('filePath')) {
                if ($article->filePath) {
                    unlink(substr($article->filePath, 22));
                    $path = Storage::putFile('public/articles', $request->file('filePath'));
                    $path = asset("storage/" . substr($path, 7));
                    $validatedData['filePath'] = $path;
                    $article->update();
                }
            } else {
                $validatedData['filePath'] = $article->filePath;
            }

            $article->update($validatedData);

            return response()->json([
                "article" => $article,
                "status" => 200,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::FindOrFail($id);
        unlink(substr($article->filePath, 22));
        $article->delete();
        return response()->json(['icon' => "success", "title" => "Deleted Successfully!"]);
    }

    public function getArticles(Request $request)
    {
        $articles = Article::latest()->paginate(3);
    }
}
