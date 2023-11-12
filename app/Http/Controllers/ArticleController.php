<?php

namespace App\Http\Controllers;

use App\Http\Repository\ArticleRepositoryInterface; // Import the repository interface
use App\Http\Requests\ArticleRequestApprove;
use App\Http\Requests\ArticleRequestCreate;
use App\Http\Requests\ArticleRequestDelete;
use App\Http\Requests\ArticleRequestUpdate;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;

    }

    public function index()
    {
        $articles = $this->articleRepository->index();
        return view('home', compact('articles'));
    }

    public function article()
    {
        $articles = $this->articleRepository->all();
        return view('articles.articles', compact('articles'));
    }

    public function myArticle()
    {
        $user = auth()->user();
        $articles = $this->articleRepository->getByUser($user);
        return view('articles.articles', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequestCreate $request)
    {
        $data = $request->only(['title', 'content', 'brief_content']);
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $data['image'] = $imagePath;
        }
        $article = $this->articleRepository->create($data);

        return redirect('/myArticle')->with('success', 'Article created successfully');
    }

    public function show($id)
    {

        $article = $this->articleRepository->cachedOrFind($id);
        if(!$article){
            return false;
        }
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->articleRepository->find($id);
        return view('articles.edit', compact('article'));
    }

    public function update(ArticleRequestUpdate $request, $id)
    {
        $data = $request->only(['title', 'content', 'brief_content']);

        $article = $this->articleRepository->find($id);

        if (!$article) {
            return redirect('/articles')->with('error', 'Article not found');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $data['image'] = $imagePath;
        }

        $this->articleRepository->update($id, $data);

        return redirect('/myArticle')->with('success', 'Article updated successfully');
    }

    public function destroy(ArticleRequestDelete $articleReq,$id)
    {
        $this->articleRepository->delete($id);
        return redirect()->route('articles.myArticle');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $articles = $this->articleRepository->search($query);

        return view('home', compact('articles'));
    }

    public function approve(ArticleRequestApprove $articleReq,Article $article)
    {
        $this->articleRepository->approve($article);

        return redirect()->route('articles.articles')->with('success', 'Article approved successfully.');
    }
}
