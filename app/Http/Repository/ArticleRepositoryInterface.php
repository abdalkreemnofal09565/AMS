<?php

namespace App\Http\Repository;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function index();

    public function all();

    public function getByUser($user);

    public function create(array $data);

    public function find($id);
    public function cachedOrFind($id);

    public function update($id, array $data);

    public function delete($id);

    public function search($query);

    public function approve(Article $article);
}
