<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;


class EntityThread extends Eloquent // Use Eloquent model from MongoDB
{
    protected $connection = 'mongodb'; // Use MongoDB connection
    protected $collection = 'entity_threads'; // MongoDB collection name

    protected $fillable = [
        'id',
        'name',
        'created_by',
        'created_at',
        'entity_id',
        'item_id',
        'creator_role_id',
        'sent',
        'reason',
        'original_body',
        'record_status',
    ];

}
