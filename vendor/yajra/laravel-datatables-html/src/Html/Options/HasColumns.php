<?php

namespace Yajra\DataTables\Html\Options;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Column;

/**
 * DataTables - Columns option builder.
 *
 * @see https://datatables.net/reference/option/
 */
trait HasColumns
{
    /**
     * Set columnDefs option value.
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable|callable  $value
     * @return $this
     * @see https://datatables.net/reference/option/columnDefs
     */
    public function columnDefs(array|Arrayable|callable $value): static
    {
        if (is_callable($value)) {
            $value = app()->call($value);
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        if (is_array($value)) {
            foreach ($value as $key => $def) {
                if ($def instanceof Arrayable) {
                    $value[$key] = $def->toArray();
                }
            }
        }

        $this->attributes['columnDefs'] = $value;

        return $this;
    }

    /**
     * Add a columnDef option.
     *
     * @param  array|\Illuminate\Contracts\Support\Arrayable|callable  $value
     * @return $this
     * @see https://datatables.net/reference/option/columnDefs
     */
    public function addColumnDef(array|Arrayable|callable $value): static
    {
        if (is_callable($value)) {
            $value = app()->call($value);
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        $this->attributes['columnDefs'][] = $value;

        return $this;
    }

    /**
     * Set columns option value.
     *
     * @param  array  $columns
     * @return $this
     * @see https://datatables.net/reference/option/columns
     */
    public function columns(array $columns): static
    {
        $this->collection = new Collection;

        foreach ($columns as $key => $value) {
            if (! is_a($value, Column::class)) {
                if (is_array($value)) {
                    $attributes = array_merge($value, [
                        'name' => $value['name'] ?? $value['data'] ?? $key,
                        'data' => $value['data'] ?? $key,
                    ]);
                } else {
                    $attributes = [
                        'name' => $value,
                        'data' => $value,
                    ];
                }

                $this->collection->push(new Column($attributes));
            } else {
                $this->collection->push($value);
            }
        }

        return $this;
    }

    /**
     * Add a column in collection using attributes.
     *
     * @param  array|\Yajra\DataTables\Html\Column  $attributes
     * @return $this
     */
    public function addColumn(array|Column $attributes): static
    {
        if (is_array($attributes)) {
            $this->collection->push(new Column($attributes));
        } else {
            $this->add($attributes);
        }

        return $this;
    }

    /**
     * Add a Column object in collection.
     *
     * @param  \Yajra\DataTables\Html\Column  $column
     * @return $this
     */
    public function add(Column $column): static
    {
        $this->collection->push($column);

        return $this;
    }

    /**
     * Add a Column object at the beginning of collection.
     *
     * @param  \Yajra\DataTables\Html\Column  $column
     * @return $this
     */
    public function addBefore(Column $column): static
    {
        $this->collection->prepend($column);

        return $this;
    }

    /**
     * Add a column at the beginning of collection using attributes.
     *
     * @param  array|\Yajra\DataTables\Html\Column  $attributes
     * @return $this
     */
    public function addColumnBefore(array|Column $attributes): static
    {
        if (is_array($attributes)) {
            $this->collection->prepend(new Column($attributes));
        } else {
            $this->addBefore($attributes);
        }

        return $this;
    }

    /**
     * Get collection of columns.
     *
     * @return \Illuminate\Support\Collection<array-key, Column>
     */
    public function getColumns(): Collection
    {
        return $this->collection;
    }

    /**
     * Remove column by name.
     *
     * @param  array  $names
     * @return $this
     */
    public function removeColumn(...$names): static
    {
        foreach ($names as $name) {
            // @phpstan-ignore-next-line
            $this->collection = $this->collection->filter(function (Column $column) use ($name) {
                return $column->name !== $name;
            })->flatten();
        }

        return $this;
    }
}
