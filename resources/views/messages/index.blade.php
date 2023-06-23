@extends('layouts.base')
@section('title', 'Quiz 管理')

@section('content')
    <h1>English</h1>
    <div class="row mt-5 mb-3">
        <div class="col text-right">
            開始
        </div>
    </div>
    <div class="row my-3">
        <table class="table" id="quizzes-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" style="width:10%">ユーザー</th>
                    <th scope="col">会話</th>
                    <th scope="col" style="width:10%">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <th scope="row">aaaa</th>
                        <td>aaaa</td>
                        <td><button type="button" class="delete-quiz btn btn-danger btn-sm">英訳</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
