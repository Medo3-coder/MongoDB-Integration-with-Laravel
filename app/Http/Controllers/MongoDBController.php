<?php

namespace App\Http\Controllers;

use App\Services\MongoDBService;
use Illuminate\Http\Request;

class MongoDBController extends Controller
{

    protected $mongoService;

    public function __construct(MongoDBService $mongoService)
    {
        $this->mongoService = $mongoService;
    }

    public function testMongoConnection()
    {
        $message = $this->mongoService->ping();

        return response()->json([
            'message' => $message,
        ]);
    }

    public function storeEntityThread(Request $request)
    {
        try {
            // Validate request data
            $data = $request->validate([
                'name' => 'required|string',
                'created_by' => 'required|integer',
                'entity_id' => 'required|integer',
                'item_id' => 'required|integer',
                'creator_role_id' => 'required|integer',
                'sent' => 'required|integer|in:0,1,2',
                'reason' => 'nullable|string',
                'original_body' => 'nullable|string',
                'record_status' => 'nullable|string|max:1',
            ]);

            // Database and collection names for MongoDB
            $database = env('DB_MONGO_DATABASE');
            $collection = 'entity_threads';

            // Save data to MongoDB using the MongoDB service
            $insertedId = $this->mongoService->insertData($database, $collection, $data);

            // Successful response
            return response()->json([
                'message' => 'EntityThread saved successfully!',
                'inserted_id' => $insertedId,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other errors
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeMessage(Request $request)
    {
        try {
            // Validate request data
            $data = $request->validate([
                'user_id' => 'required|integer',
                'entity_thread_id' => 'required|integer',
                'flag' => 'required|boolean',
            ]);

            // Database and collection names for MongoDB
            $database = env('DB_MONGO_DATABASE');
            $collection = 'messages';

            $insertedId = $this->mongoService->insertData($database, $collection, $data);

            return response()->json([
                'message' => 'Message saved successfully!',
                'inserted_id' => $insertedId,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ]);
        }

    }
}
