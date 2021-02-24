<?php

namespace dwp\model;
use \dwp\core\Model as M;

class Order extends \dwp\core\Model
{
    const TABLENAME = 'order';

    protected $schema = [
        'id' => [ 'type' => M::TYPE_UINTEGER ],
        'createdAt' => [ 'type' => M::TYPE_DATE ],
        'updatedAt' => [ 'type' => M::TYPE_DATE ],
        'payMethod' => [ 'type' => M::TYPE_UINTEGER ],
        'account' => [ 'type' => M::TYPE_UINTEGER ]
    ];
}