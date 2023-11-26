<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{

    protected array $safedParms = [];

    protected array $columnMap = [];

    public array $operatorMap = [];
    public function transform(Request $request): array
    {
        $eloQuery = [];

        foreach ($this->safedParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $colm = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$colm, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }


        return $eloQuery;
    }
}