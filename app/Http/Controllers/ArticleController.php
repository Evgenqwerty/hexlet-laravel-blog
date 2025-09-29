<?php

namespace App\Http\Controllers;

use App\Models\Article;
// Нам понадобится объект запроса
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Вывод формы
    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы
        $article = new Article();
        return view('articles.create', compact('article'));
    }

    // Здесь нам понадобится объект запроса для извлечения данных
    public function store(Request $request)
    {
        // Проверка введенных данных. Если будут ошибки, то возникнет исключение. Иначе возвращаются данные формы
        $data = $request->validate([
            'name' => 'required|unique:articles',
            'body' => 'required|min:100',
        ]);

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }
}
