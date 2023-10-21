<?php

namespace Yajra\DataTables\Transformers;

use Closure;
use Illuminate\Support\Collection as LaravelCollection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\TransformerAbstract;

class FractalTransformer
{
    /**
     * @var \League\Fractal\Manager
     */
    protected Manager $fractal;

    /**
     * FractalTransformer constructor.
     *
     * @param  \League\Fractal\Manager  $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Transform output using the given transformer and serializer.
     *
     * @param  array|\Illuminate\Support\Collection  $output
     * @param  iterable  $transformer
     * @param  SerializerAbstract|null  $serializer
     * @return array
     */
    public function transform(
        array|LaravelCollection $output,
        iterable $transformer,
        SerializerAbstract $serializer = null
    ): array {
        if ($serializer !== null) {
            $this->fractal->setSerializer($this->createSerializer($serializer));
        }

        $collector = [];
        foreach ($transformer as $transform) {
            if ($transform != null) {
                $resource = new Collection($output, $this->createTransformer($transform));
                $collection = $this->fractal->createData($resource)->toArray();
                $transformed = $collection['data'] ?? $collection;
                $collector = array_map(
                    function ($item_collector, $item_transformed) {
                        if (! is_array($item_collector)) {
                            $item_collector = [];
                        }

                        return array_merge($item_collector, $item_transformed);
                    }, $collector, $transformed
                );
            }
        }

        return $collector;
    }

    /**
     * Get or create transformer serializer instance.
     *
     * @param  class-string|SerializerAbstract  $serializer
     * @return \League\Fractal\Serializer\SerializerAbstract
     */
    protected function createSerializer(SerializerAbstract|string $serializer): SerializerAbstract
    {
        if ($serializer instanceof SerializerAbstract) {
            return $serializer;
        }

        return new $serializer();
    }

    /**
     * Get or create transformer instance.
     *
     * @param  \Closure|class-string|TransformerAbstract  $transformer
     * @return \Closure|\League\Fractal\TransformerAbstract
     */
    protected function createTransformer(Closure|string|TransformerAbstract $transformer): Closure|TransformerAbstract
    {
        if ($transformer instanceof TransformerAbstract || $transformer instanceof Closure) {
            return $transformer;
        }

        return new $transformer();
    }
}
