@extends('layouts.app')

@section('content')


    {{-- 新規作成リンク（ログインユーザーのみ） --}}
    @auth
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-4">新規作成</a>
    @endauth


<!-- ここにページ毎のコンテンツを書く -->
<div class="prose ml-4">
    <h2 class="text-lg">タスク 一覧</h2>
</div>

@if (isset($tasks))
<table class="table table-zebra w-full my-4">
    <thead>
        <tr>
            <th>id</th>
            <th>メッセージ</th>
            <th>Status</th> <!-- ← 追加 -->
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
            <td>{{ $task->content }}</td>
            <td>{{ $task->status }}</td> <!-- ← 追加 -->
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{-- メッセージ作成ページへのリンク --}}
<a class="btn btn-primary" href="{{ route('tasks.create') }}">新規メッセージの投稿</a>

@endsection