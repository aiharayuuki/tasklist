@extends('layouts.app')

@section('content')

<!-- ここにページごとのコンテンツを書く -->
<div class="prose ml-4">
  <h2>id = {{ $task->id }} 詳細ページ</h2>
</div>

<table class="table w-full my-4">
  <tr>
    <th>id</th>
    <td>{{ $task->id }}</td>
  </tr>

  <tr>
    <th>メッセージ</th>
    <td>{{ $task->content }}</td>
  </tr>

  <tr>
    <th>ステータス</th> <!--  追加 -->
    <td>{{ $task->status }}</td> <!--  追加 -->
  </tr>
</table>

{{-- メッセージ編集ページへのリンク --}}
<a class="btn btn-outline" href="{{ route('tasks.edit', $task->id) }}">このメッセージを編集</a>


{{-- メッセージ削除フォーム --}}
<form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="my-2">
  @csrf
  @method('DELETE')

  <button type="submit" class="btn btn-error btn-outline"
    onclick="return confirm('id = {{ $task->id }} のメッセージを削除します。よろしいですか？')">削除</button>
</form>


@endsection