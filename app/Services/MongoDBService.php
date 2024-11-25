<?php

namespace App\Services;

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

class MongoDBService
{
    protected $client;

    public function __construct()
    {
        $uri = env('DB_MONGO_URI', 'mongodb+srv://mohamedfarouk:teYmR3cQTGTFLlrg@cluster00.xoa7w.mongodb.net/?retryWrites=true&w=majority');
        $apiVersion = new ServerApi(ServerApi::V1);

        // Create the MongoDB client
        $this->client = new Client($uri, [], ['serverApi' => $apiVersion]);
    }

    // Ping the MongoDB server to verify the connection
    public function ping()
    {
        try {
            $this->client->selectDatabase('admin')->command(['ping' => 1]);
            return "Pinged your deployment. You successfully connected to MongoDB!";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    // Insert data into the MongoDB collection
    public function insertData(string $database, string $collection, array $data)
    {
        try {
            $collectionInstance = $this->client->selectDatabase($database)->selectCollection($collection);
            $result = $collectionInstance->insertOne($data);

            return $result->getInsertedId();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
