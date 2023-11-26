<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;


class CustomerFilter extends ApiFilter
{
    protected array $safedParms = [
        "name" => ["eq"],
        "type" => ["eq"],
        "email" => ["eq"],
        "address" => ["eq"],
        "city" => ["eq"],
        "state" => ["eq"],
        "postalCode" => ["eq", "gt", "lt"],
    ];

    protected array $columnMap = [
        'postalCode' => 'postal_code',
    ];

    public array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '<',
        'gte' => '=>',
    ];

}