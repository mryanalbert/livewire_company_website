<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Categories;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowBlog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url()]
    public $categorySlug = null;

    public function render()
    {
        $categories = Categories::all();
        $articles = null;
        $paginate = 10;

        if ($this->categorySlug) {
            $category = Categories::where('slug', $this->categorySlug)->first();

            if (empty($category)) {
                abort(404);
            }

            $articles = Article::orderBy('created_at', 'DESC')
                ->where('category_id', $category->id)
                ->where('status', 1)
                ->paginate(2);
        } else {
            $articles = Article::orderBy('created_at', 'DESC')
                ->where('status', 1)
                ->paginate($paginate);
        }

        $latestArticles = Article::orderBy('created_at', 'DESC')
            ->where('status', 1)
            ->get()
            ->take(3);

        return view('livewire.show-blog', [
            'articles' => $articles,
            'categories' => $categories,
            'latestArticles' => $latestArticles,
        ]);
    }
}
