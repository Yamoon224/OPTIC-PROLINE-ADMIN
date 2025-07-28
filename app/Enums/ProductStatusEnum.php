<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case InStock = 'in_stock';
    case OnDemand = 'on_demand';
}