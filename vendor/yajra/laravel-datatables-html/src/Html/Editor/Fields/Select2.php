<?php

namespace Yajra\DataTables\Html\Editor\Fields;

/**
 * @see https://editor.datatables.net/plug-ins/field-type/editor.select2
 */
class Select2 extends Select
{
    protected string $type = 'select2';

    /**
     * @param  bool  $state
     * @return $this
     */
    public function allowClear(bool $state = true): static
    {
        return $this->opts(['allowClear' => $state]);
    }

    /**
     * @param  string  $value
     * @return $this
     */
    public function placeholder(string $value): static
    {
        return $this->optsPlaceholder($value);
    }

    /**
     * @param  string  $text
     * @param  string  $id
     * @return $this
     */
    public function optsPlaceholder(string $text = '', string $id = ''): static
    {
        return $this->opts([
            'placeholder' => [
                'id' => $id,
                'text' => $text,
            ],
        ]);
    }

    /**
     * Set select2 ajax option.
     *
     * @param  array|string  $value
     * @return $this
     */
    public function ajax(array|string $value): static
    {
        $ajax = $this->opts['ajax'] ?? [];

        if (is_array($value)) {
            return $this->opts(['ajax' => array_merge($ajax, $value)]);
        }

        return $this->opts(['ajax' => array_merge($ajax, ['url' => $value])]);
    }

    /**
     * Set select2 ajax url option.
     *
     * @param  string  $value
     * @return $this
     */
    public function ajaxUrl(string $value): static
    {
        return $this->ajax(['url' => $value]);
    }

    /**
     * Set select2 ajaxDelay option.
     *
     * @param  int  $value
     * @return $this
     */
    public function ajaxDelay(int $value = 250): static
    {
        return $this->ajax(['delay' => $value]);
    }

    /**
     * Set select2 ajax data option.
     *
     * @param  array|string  $data
     * @return $this
     */
    public function ajaxData(array|string $data): static
    {
        if (is_array($data)) {
            $script = 'function(params) {';
            foreach ($data as $key => $value) {
                $value = json_encode($value);
                $script .= " params.$key = $value; ";
            }
            $script .= 'return params; }';

            $data = $script;
        }

        return $this->ajax(['data' => $data]);
    }

    /**
     * Set select2 ajax processResults option to process a paginated results.
     *
     * @param  string  $display
     * @param  string  $id
     * @param  string  $wrap
     * @return $this
     */
    public function processPaginatedResults(string $display = 'text', string $id = 'id', string $wrap = 'results'): static
    {
        $script = 'function(data, params) { ';
        $script .= 'params.page = params.page || 1; ';
        $script .= "data.$wrap.map(function(e) { e.text = e.$display; e.id = e.$id; return e; }); ";
        $script .= "return { results: data.$wrap, pagination: { more: data.meta.current_page < data.meta.last_page } };";
        $script .= '}';

        return $this->processResults($script);
    }

    /**
     * Set select2 ajax processResults option.
     *
     * @param  string  $value
     * @return $this
     */
    public function processResults(string $value): static
    {
        return $this->ajax(['processResults' => $value]);
    }
}
