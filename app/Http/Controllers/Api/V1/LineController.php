<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Deliverer;
use App\Services\ReplyMessageGenerator;
use App\Services\RequestParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Message;

class LineController extends Controller
{
    // メッセージ送信
    public function delivery()
    {
        // 1. 登録されている友だちにメッセージを送信
        $deliver = new Deliverer(env('LINE_CHANNEL_ACCESS_TOKEN'), env('LINE_CHANNEL_SECRET'));
        $deliver->deliverAll('Hello LINE!');

        return response()->json(['message' => 'sent']);
    }

    // メッセージを受け取って保存
    public function callback(Request $request)
    {
        // 受け取った情報からメッセージの情報を取り出す
        $parser = new RequestParser($request->getContent());
        $recievedMessages = $parser->getRecievedMessages();

        if ($recievedMessages->isEmpty()) {
            return response()->json(['message' => 'received(no events)']);
        }

        // メッセージをDBに保存
        foreach ($recievedMessages as $recievedMessage) {
            // 入力内容のチェック
            // ルールに一致しない入力の場合は、自動的に入力画面を表示させる
            // $validatedData = $request->validate([
            //     'recievedMessage' => 'required|max:255',
            // ]);

            // Modelを作成
            $Message = new Message;
            $Message->message = $recievedMessage->getText();
            $Message->save();
        }

        return response()->json(['message' => 'received']);
    }
}
