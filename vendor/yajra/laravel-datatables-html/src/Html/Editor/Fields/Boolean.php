<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class Boolean extends Checkbox
{
    /**
     * Make a new instance of a field.
     *
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        return parent::make($name, $label)->separator(',')->options(
            Options::make()->append('', 1)
        );
    }
}
