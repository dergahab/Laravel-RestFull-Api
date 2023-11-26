<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;


class InvoiceFilter extends ApiFilter
{
    protected array $safedParms = [
        "customerId" => ["eq"],
        "status" => ["eq", "ne"],
        "amount" => ["eq", "gt", "lt", "gte", "lte"],
        "billAt" => ["eq", "gt", "lt", "gte", "lte"],
        "paidAt" => ["eq", "gt", "lt", "gte", "lte"],
    ];

    protected array $columnMap = [
        'customerId' => 'customer_id',
        'billedAt' => 'billed_at',
        'paidAt' => 'paid_at'
    ];

    public array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '<',
        'gte' => '=>',
        'ne' => '!='
    ];
}