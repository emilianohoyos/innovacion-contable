<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function listComments(Request $request)
    {
        $rules = [
            'application_id' => 'required|exists:applications,id',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $data = Comment::with('createdBy')->where('application_id', $validatedData['application_id'])->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No comments found for this application.'], 404);
        }

        return response()->json(['message' => $data]);
    }

    public function store(Request $request)
    {
        $rules = [
            'application_id' => 'required|exists:applications,id',
            'comment' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $user = auth('api')->user();
        $userId = $user->id;


        // Supongamos que tienes un modelo Comment para guardar los comentarios
        Comment::create([
            'description' => $validatedData['comment'],
            'created_by' => $userId,
            'application_id' => $validatedData['application_id'],
        ]);

        return response()->json([
            "status" => true,
            'message' => 'Comment stored successfully.'
        ], 200);
    }
}
