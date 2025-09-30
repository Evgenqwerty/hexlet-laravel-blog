{{ html()->modelForm($article, 'POST', route('articles.store'))->open() }}
@include('articles.form')
{{ html()->submit('Создать') }}
{{ html()->closeModelForm() }}
