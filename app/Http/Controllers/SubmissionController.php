<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateSubmissionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SubmissionController extends Controller
{
    public function createSubmission(CreateSubmissionRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $payload = $request->validated();
            ['email' => $email, 'selectedProducts' => $selectedProducts] = $payload;

            $consumer = Consumer::firstOrCreate(
                [
                    'email' => $email
                ],
                $payload
            );

            $consumerId = $consumer->id;
            $data = array_map(function ($productId) use ($consumerId) {
                return [
                    'product_id' => $productId,
                    'consumer_id' => $consumerId,
                ];
            }, $selectedProducts);
            $consumer->submissions()->createMany($data);

            DB::commit();

            return response()->json(
                [
                    'data' => [
                        'message' => 'Form submitted successfully'
                    ]
                ],
                201,
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to submit form: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to submit form'], 500);
        }
    }
}
