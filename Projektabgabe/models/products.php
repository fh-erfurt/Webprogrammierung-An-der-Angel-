<?php

namespace dwp\model;
use \dwp\core\Model as M;

class Products extends \dwp\core\Model
{
    const TABLENAME = 'products';

    protected $schema = [
        'id' => [ 'type' => M::TYPE_UINTEGER ],
        'createdAt' => [ 'type' => M::TYPE_DATE ],
        'updatedAt' => [ 'type' => M::TYPE_DATE ],
        'name' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 100,
                'null' => false,
            ],
        ],
        'image' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'max' => 100,
                'null' => true,
            ],
        ],
        'price' => [ 'type' => M::TYPE_DECIMAL ],
        'discount' => [ 'type' => M::TYPE_UINTEGER ],
        'amount' => [ 'type' => M::TYPE_UINTEGER ],
        'size' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'max' => 50,
                'null' => true,
            ],
        ],
        'weight' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'max' => 50,
                'null' => true,
            ],
        ],
        'color' => [ 'type' => M::TYPE_UINTEGER ],
        'material' => [ 'type' => M::TYPE_UINTEGER ],
        'manufacturer' => [ 'type' => M::TYPE_UINTEGER ],
        'category' => [ 'type' => M::TYPE_UINTEGER ]
 
    ];
}