<?php

namespace App\Constants;

class ProductConstants
{

    const STATUS_OPTIONS =[
        StatusConstants::ACTIVE => StatusConstants::ACTIVE,
        StatusConstants::INACTIVE => StatusConstants::INACTIVE,
    ];

    const SHOP_ORDER_OPTIONS = [
        "created_at_latest" => [
            "label" => "Newest",
            "column" => "created_at",
            "order" => "asc"
        ],
        "created_at_desc" => [
            "label" => "Oldest",
            "column" => "created_at",
            "order" => "desc"
        ],
        "status_" => [
            "label" => "In stock",
            "column" => "status" ,
            'order' => "asc"
        ],

    ];
}
