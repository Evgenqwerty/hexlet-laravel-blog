@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="text-decoration-none">
        Создать статью
    </a>

    @if($articles->count())
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Делаем имя статьи ссылкой -->
                                <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none">
                                    {{ $article->name }}
                                </a>
                                <br>
                                <a href="{{ route('articles.edit', $article->id) }}" class="text-decoration-none">
                                    Редактировать {{ $article->name }}
                                </a>
                                <br>
                                <!-- Ссылка удаления с data-method -->
                                <a href="{{ route('articles.destroy', $article->id) }}"
                                   data-method="delete"
                                   data-confirm="Вы уверены, что хотите удалить статью '{{ $article->name }}'?"
                                   rel="nofollow"
                                   class="text-danger text-decoration-none">
                                    Удалить
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                            <small class="text-muted">
                                Created: {{ $article->created_at->format('d.m.Y') }} <br><br>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No articles found.
        </div>
    @endif

    <!-- ВСТРАИВАЕМ JavaScript НАПРЯМУЮ В ШАБЛОН -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Обработчик для ссылок с data-method
            document.body.addEventListener('click', function(e) {
                // Ищем ближайшую ссылку с data-method
                const link = e.target.closest('a[data-method]');

                if (!link) return;

                // Отменяем стандартное поведение ссылки
                e.preventDefault();

                // Получаем атрибуты
                const method = link.getAttribute('data-method').toUpperCase();
                const action = link.getAttribute('href');
                const confirmMessage = link.getAttribute('data-confirm');

                // Запрос подтверждения (если есть data-confirm)
                if (confirmMessage && !confirm(confirmMessage)) {
                    return; // Пользователь отменил удаление
                }

                // Создаем скрытую форму
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = action;
                form.style.display = 'none';

                // Добавляем скрытое поле для метода (Laravel спойлер)
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = method;
                form.appendChild(methodInput);

                // Добавляем CSRF токен
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = '{{ csrf_token() }}'; // Blade-хелпер для CSRF токена
                form.appendChild(tokenInput);

                // Добавляем форму в документ
                document.body.appendChild(form);

                // Отправляем форму
                form.submit();
            });
        });
    </script>
    <!-- КОНЕЦ JavaScript -->
@endsection
