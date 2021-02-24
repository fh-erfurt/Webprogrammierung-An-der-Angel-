<?php

namespace dwp\model;
use \dwp\core\Model as M;

class Address extends \dwp\core\Model
{
    const TABLENAME = 'address';

    protected $schema = [
        'id' => [ 'type' => M::TYPE_UINTEGER ],
        'createdAt' => [ 'type' => M::TYPE_DATE ],
        'updatedAt' => [ 'type' => M::TYPE_DATE ],
        'street' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 50,
                'null' => false,
            ],
        ],
        'streetNo' => [ 'type' => M::TYPE_UINTEGER ],
        'zip' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 5,
                'max' => 5,
                'null' => false,
            ],
        ],
        'city' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 50,
                'null' => false,
            ],
        ],
        'country' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 50,
                'null' => false,
            ],
        ]
    ];
}