<?php

namespace Yajra\DataTables\Html\Editor\Fields;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @template TKey of array-key
 * @template TValue
 */
class Options extends Collection
{
    /**
     * Return a Yes/No options.
     *
     * @return static
     */
    public static function yesNo(): static
    {
        $data = [
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0],
        ];

        return new static($data);
    }

    /**
     * Get options from a model.
     *
     * @param  class-string<Model>|\Illuminate\Database\Eloquent\Builder  $model
     * @param  string  $value
     * @param  string  $key
     * @return Collection
     */
    public static function model(string|EloquentBuilder $model, string $value, string $key = 'id'): Collection
    {
        if (! $model instanceof EloquentBuilder) {
            $model = $model::query();
        }

        return $model->get()->map(function ($model) use ($value, $key) {
            return [
                'value' => $model->{$key},
                'label' => $model->{$value},
            ];
        });
    }

    /**
     * Get options from a table.
     *
     * @param  \Closure|\Illuminate\Database\Query\Builder|string  $table
     * @param  string  $value
     * @param  string  $key
     * @param  \Closure|null  $callback
     * @param  string|null  $connection
     * @return Collection
     */
    public static function table(
        Closure|Builder|string $table,
        string $value,
        string $key = 'id',
        Closure $callback = null,
        string $connection = null
    ): Collection {
        $query = DB::connection($connection)
                   ->table($table)
                   ->select("$value as label", "$key as value");

        if (is_callable($callback)) {
            $callback($query);
        }

        return $query->get()->map(function ($row) {
            return (array) $row;
        });
    }

    /**
     * Return a True/False options.
     *
     * @return static
     */
    public static function trueFalse(): static
    {
        $data = [
            ['label' => __('True'), 'value' => 1],
            ['label' => __('False'), 'value' => 0],
        ];

        return new static($data);
    }

    /**
     * Push an item onto the end of the collection.
     *
     * @param  string  $value
     * @param  int|string  $key
     * @return static
     */
    public function append(string $value, int|string $key): static
    {
        return $this->push(['label' => $value, 'value' => $key]);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  TValue  $value
     * @param  TKey  $key
     * @return static
     */
    public function prepend($value, $key = null): static
    {
        $data = ['label' => $value, 'value' => $key];

        return parent::prepend($data);
    }
}
