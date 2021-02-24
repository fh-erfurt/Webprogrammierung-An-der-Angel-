<?php

namespace dwp\model;
use \dwp\core\Model as M;

class Account extends \dwp\core\Model
{
    const TABLENAME = 'account';

    protected $schema = [
        'id' => [ 'type' => M::TYPE_UINTEGER ],
        'createdAt' => [ 'type' => M::TYPE_DATE ],
        'updatedAt' => [ 'type' => M::TYPE_DATE ],
        'firstName' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 50,
                'null' => false,
            ],
        ],
        'lastName' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 50,
                'null' => false,
            ],
        ],
        'birthdate' => [ 'type' => M::TYPE_DATE ],
        'email' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'min' => 2,
                'max' => 120,
                'null' => false,
            ],
        ],
        'password' => [ 
            'type' => M::TYPE_STRING,
            'validate' => [
                'max' => 255,
                'null' => false,
            ],
        ],
        'address' => [ 'type' => M::TYPE_UINTEGER ]
    ];
}