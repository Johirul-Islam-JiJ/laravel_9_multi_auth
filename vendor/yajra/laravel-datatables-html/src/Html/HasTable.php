<?php

namespace Yajra\DataTables\Html;

use Illuminate\Support\Arr;

trait HasTable
{
    /**
     * Retrieves HTML table attribute value.
     *
     * @param  string  $attribute
     * @return string
     */
    public function getTableAttribute(string $attribute): string
    {
        return $this->tableAttributes[$attribute] ?? '';
    }

    /**
     * Get table computed table attributes.
     *
     * @return array
     */
    public function getTableAttributes(): array
    {
        return $this->tableAttributes;
    }

    /**
     * Sets HTML table "id" attribute.
     *
     * @param  string  $id
     * @return $this
     */
    public function setTableId(string $id): static
    {
        return $this->setTableAttribute('id', $id);
    }

    /**
     * Get HTML table "id" attribute.
     *
     * @return string
     */
    public function getTableId(): string
    {
        return $this->getTableAttribute('id');
    }

    /**
     * Sets HTML table attribute(s).
     *
     * @param  array|string  $attribute
     * @param  string|null  $value
     * @return $this
     */
    public function setTableAttribute(array|string $attribute, string $value = null): static
    {
        if (is_array($attribute)) {
            return $this->setTableAttributes($attribute);
        }

        $this->tableAttributes[$attribute] = $value;

        return $this;
    }

    /**
     * Sets multiple HTML table attributes at once.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function setTableAttributes(array $attributes): static
    {
        foreach ($attributes as $attribute => $value) {
            $this->tableAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Add class names to the "class" attribute of HTML table.
     *
     * @param  array|string  $class
     * @return $this
     */
    public function addTableClass(array|string $class): static
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = Arr::get(array_change_key_case($this->tableAttributes), 'class');

        $classes = preg_split('#\s+#', $currentClass.' '.$class, -1, PREG_SPLIT_NO_EMPTY);
        $class = implode(' ', array_unique((array) $classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Remove class names from the "class" attribute of HTML table.
     *
     * @param  array|string  $class
     * @return $this
     */
    public function removeTableClass(array|string $class): static
    {
        $class = is_array($class) ? implode(' ', $class) : $class;
        $currentClass = $this->getTableAttribute('class');

        $classes = array_diff(
            (array) preg_split('#\s+#', $currentClass, -1, PREG_SPLIT_NO_EMPTY),
            (array) preg_split('#\s+#', $class, -1, PREG_SPLIT_NO_EMPTY)
        );
        $class = implode(' ', array_unique($classes));

        return $this->setTableAttribute('class', $class);
    }

    /**
     * Compile table headers and to support responsive extension.
     *
     * @return array
     */
    protected function compileTableHeaders(): array
    {
        $th = [];

        $this->collection->each(function (Column $column) use (&$th) {
            $only = Arr::only(
                $column->toArray(),
                ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide']
            );

            $attributes = array_merge(
                $only,
                $column->attributes,
                isset($column['titleAttr']) ? ['title' => $column['titleAttr']] : []
            );

            $thAttr = $this->html->attributes($attributes);
            $th[] = '<th'.$thAttr.'>'.$column['title'].'</th>';
        });

        return $th;
    }

    /**
     * Compile table search headers.
     *
     * @return array
     */
    protected function compileTableSearchHeaders(): array
    {
        $search = [];

        $this->collection->each(function (Column $column) use (&$search) {
            $search[] = $column['searchable'] ? '<th>'.($column['search'] ?? '').'</th>' : '<th></th>';
        });

        return $search;
    }

    /**
     * Compile table footer contents.
     *
     * @return array
     */
    protected function compileTableFooter(): array
    {
        $footer = [];

        $this->collection->each(function (Column $column) use (&$footer) {
            if (is_array($column->footer)) {
                $footerAttr = $this->html->attributes(
                    Arr::only($column->footer, ['class', 'id', 'title', 'width', 'style', 'data-class', 'data-hide'])
                );

                $title = $column->footer['title'] ?? '';

                $footer[] = '<th '.$footerAttr.'>'.$title.'</th>';
            } else {
                $footer[] = '<th>'.$column->footer.'</th>';
            }
        });

        return $footer;
    }
}
