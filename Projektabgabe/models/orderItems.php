<?php

namespace dwp\model;
use \dwp\core\Model as M;

class OrderItems extends \dwp\core\Model
{
    const TABLENAME = 'orderItems';

    protected $schema = [
        'id' => [ 'type' => M::TYPE_UINTEGER ],
        'createdAt' => [ 'type' => M::TYPE_DATE ],
        'updatedAt' => [ 'type' => M::TYPE_DATE ],
        'order' => [ 'type' => M::TYPE_UINTEGER ],
        'products' => [ 'type' => M::TYPE_UINTEGER ],
        'quantity' => [ 'type' => M::TYPE_UINTEGER ]
    ];
}