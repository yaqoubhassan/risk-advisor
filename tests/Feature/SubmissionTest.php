<?php

namespace Tests\Feature;

use GuzzleHttp\Exception\ServerException;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\SubmissionController;
use App\Http\Requests\CreateSubmissionRequest;
use App\Models\Consumer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testCreateSubmission()
    {
        Product::factory()->count(4)->create();

        $requestData = [
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '1234567890',
            'contact_preference' => 'email',
            'street_address' => '123 Main St',
            'apartment' => 'Apt 1',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip_code' => '12345',
            'selectedProducts' => [1, 2] // Assuming product IDs
        ];

        $response = $this->json('POST', route('submissions.store'), $requestData);

        $response->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'message' => 'Form submitted successfully'
                    ]
                ]
            );

        // Assert that the consumer, user, and submissions were created
        $this->assertDatabaseHas(
            'consumers',
            [
                'email' => 'test@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '1234567890',
                'contact_preference' => 'email',
                'street_address' => '123 Main St',
                'apartment' => 'Apt 1',
                'city' => 'Anytown',
                'state' => 'CA',
                'zip_code' => '12345',
            ]
        );

        // Assert that submissions were created for each selected product
        $this->assertDatabaseHas(
            'submissions',
            [
                'consumer_id' => 1, // Assuming consumer ID
                'product_id' => 1
            ]
        );
        $this->assertDatabaseHas(
            'submissions',
            [
                'consumer_id' => 1, // Assuming consumer ID
                'product_id' => 2
            ]
        );
    }


    public function testCreateSubmissionWithValidationError()
    {
        Product::factory()->count(4)->create();

        $requestData = [];

        $response = $this->json('POST', route('submissions.store'), $requestData);

        $response->assertStatus(422);

        // Assert that the consumer, user, and submissions were created

    }


    public function testCreateSubmissionWithError()
    {
        $request = $this->mock(CreateSubmissionRequest::class);
        $request->shouldReceive('validated')->andThrow(new \Exception('Exception Error'));

        Log::shouldReceive('error')->once()->with('Failed to submit form: Exception Error');

        $controller = new SubmissionController();
        $response = $controller->createSubmission($request);

        $this->assertEquals(500, $response->getStatusCode());
    }
}
