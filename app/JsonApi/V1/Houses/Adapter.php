<?php

namespace App\JsonApi\V1\Houses;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new \App\Model\House(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        $filters = $filters->filter(fn ($e) => !\is_null($e));

        $this->filterWithScopes($query, $filters->except('name', 'price'));

        if ($name = $filters->get('name')) {
            $query->where('houses.name', 'like', "%{$name}%");
        }

        if ($price = $filters->get('price')) {
            if (!is_array($price)) {
                $query->where('houses.price', '=', $price);

                return;
            }

            if (isset($price[0]) && isset($price[1])) {
                $price = ['from' => $price[0], 'to' => $price[1]];
            }

            if (isset($price['from'])) {
                $query->where('houses.price', '>=', $price['from']);
            }
            if (isset($price['to'])) {
                $query->where('houses.price', '<=', $price['to']);
            }
        }
    }
}
