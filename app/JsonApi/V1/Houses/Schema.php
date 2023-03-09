<?php

namespace App\JsonApi\V1\Houses;

use CloudCreativity\LaravelJsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected string $resourceType = 'houses';

    /**
     * @param \App\Model\House $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource): string
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param \App\Model\House $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource): array
    {
        return [
            'name' => $resource->name,
            'bedroomCount' => $resource->bedroom_count,
            'bathroomCount' => $resource->bathroom_count,
            'storeyCount' => $resource->storey_count,
            'garageCount' => $resource->garage_count,
            'price' => $resource->price,
        ];
    }
}
