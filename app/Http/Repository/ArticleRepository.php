<?php
namespace App\Http\Repository;

use App\Models\Article;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function index()
    {
        $this->popularArticles();
        return Article::approved()->get();
    }

    public function all()
    {
        return Article::all();
    }

    public function getByUser($user)
    {
        return $user->articles;
    }

    public function create($data)
    {
        $article = new Article;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->user_id = auth()->user()->id;
        $article->brief_content = $data['brief_content'] ?? null;
        $article->image = $data['image'] ?? null;

        $article->save();

        // Notify administrators when a new article is created
        $adminUsers = User::admins()->get();

        if ($adminUsers->isNotEmpty()) {
            foreach ($adminUsers as $adminUser) {
                Notification::send($adminUser, new NewArticleNotification($article));
            }
        }
        return $article;
    }

    public function cachedOrFind($id){
        $articles = Cache::get('articles'); // Replace 'article_key' with the actual key you used to cache the article

        if ($articles[$id]) {
            $article = $articles[$id];
        } else {
            // The article was not found in the cache, so you can retrieve it from the database
            $article = Article::where('is_approved',true)->where("id",$id)->first();
            if(!$article){
                return false;
            }
        }
        // Increment the view count
        $article->increment('views');
        $article->save();
        return $article;
    }

    public function find($id)
    {
        return Article::find($id);
    }

    public function update($id, $data)
    {
        $article = Article::find($id);

        if (!$article) {
            return false; // Article not found
        }

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->brief_content = $data['brief_content'] ?? null;
        $article->image = $data['image'] ?? null;

        $article->save();

        return $article;
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if ($article) {
            $article->delete();
        }
    }

    public function search($query)
    {
        // Perform a "like" search
        // Use "like" search if you need a simple search functionality and compatibility with various database systems.
        // It's suitable for smaller datasets and basic search needs.
        $likeSearchResults = Article::where('title', 'like', "%".$query."%")
            ->orWhere('content', 'like', "%".$query."%")
            ->get();

//        // Perform a full-text search (FTS)
//        //Use FTS if you need more advanced search features, better performance with large datasets,
//        //and language-specific searching.
//        // FTS is a powerful option for applications where search quality and efficiency are critical.
//        $ftsSearchResults = Article::whereRaw("MATCH(title, content) AGAINST(?)", [$query])
//            ->get();
//
//        // Merge the results from both searches
//        $articles = $likeSearchResults->concat($ftsSearchResults)->unique();

        return $likeSearchResults;
    }

    public function approve(Article $article)
    {
        $article->update(['is_approved' => true]);
        return $article;
    }

    public function popularArticles()
    {
        $articles = Cache::get('articles'); // Replace 'article_key' with the actual key you used to cache the article

        if(!$articles) {
            $articles = Article::orderBy('views', 'desc')->take(10)->get();
            $newArticles = null;
            foreach ($articles as $article) {
                // Cache the article for future use
                $newArticles[$article['id']] = $article;
            }
            Cache::put('articles', $newArticles, now()->addMinutes(5));
        }
    }
}
