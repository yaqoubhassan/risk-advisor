<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\SubmissionController;
use App\Http\Requests\CreateSubmissionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $response->assertStatus(200)
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

    public function testCreateSubmissionWithError()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();
        DB::shouldReceive('commit')->never(); // Ensure commit is not called

        // Call the createSubmission method with a mocked exception
        $controller = new SubmissionController();
        $request = new CreateSubmissionRequest([]);
        $exception = new \Exception('Test exception');

        $response = $controller->createSubmission($request, $exception);

        // Assert that the response is a JSON response with an error message
        $this->assertEquals(['error' => 'Failed to submit form'], $response->getData(true));
        $this->assertEquals(500, $response->getStatusCode());
    }
}