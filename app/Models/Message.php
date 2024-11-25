<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Message extends Eloquent // Use Eloquent model from MongoDB
{
    protected $connection = 'mongodb'; // Use MongoDB connection
    protected $collection = 'messages'; // MongoDB collection name

    protected $fillable = [
        'id',
        'user_id',
        'entity_thread_id',
        'flag',
    ];
}
