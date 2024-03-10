<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateSubmissionRequest;

class SubmissionController extends Controller
{
    public function createSubmission(CreateSubmissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $consumer = Consumer::firstOrCreate(
                [
                    'email' => $request->input('email')
                ],
                [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone_number' => $request->input('phone_number'),
                    'contact_preference' => $request->input('contact_preference'),
                    'street_address' => $request->input('street_address'),
                    'apartment' => $request->input('apartment'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip_code' => $request->input('zip_code')
                ]
            );

            $selectedProducts = $request->input('selectedProducts');
            foreach ($selectedProducts as $product) {
                Submission::create(
                    [
                        'consumer_id' => $consumer->id,
                        'product_id' => $product
                    ]
                );
            }

            DB::commit();

            return response()->json(
                [
                    'data' => [
                        'message' => 'Form submitted successfully'
                    ]
                ]
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to submit form: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to submit form'], 500);
        }
    }
}