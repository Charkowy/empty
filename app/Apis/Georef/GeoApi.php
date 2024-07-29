<?php

namespace App\Apis\Georef;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class GeoApi
{
    private $endpoint;
    private $model;
    private $georef;

    public function __construct()
    {
        $this->endpoint = get_class($this)::ENDPOINT;
        $this->model = get_class($this)::MODEL;
    }

    private function getClient()
    {
        return $this->georef ?? $this->setClient();
    }

    private function setClient($client = null)
    {
        $this->georef = $client ?? new Http;
        return $this->georef;
    }

    public function get()
    {
        return $this->{$this->model};
    }

    /**
     * parameters recibe los atributos por los cuales permite ser filtrado el endpoint, si es null devuelde todos los items
     */
    private function load($endpoint, $attributes = [])
    {
        try {
            $items = json_decode($this->getClient()::get(env('GEOREF_URL') . '/' . $endpoint, $attributes));
            return collect($items->{$this->endpoint});
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e);
        }
    }

    /**
     * Los filtros es un array para filtrar por atributo valor, cuando cumpla con todos los filtros es aceptada para return
     */
    public function filter($filters = null)
    {
        $count_filter = 0;
        $this->{$this->model} =  $this->{$this->model}->filter(function ($element) use ($filters, $count_filter) {
            // Verifica si todos los filtros coinciden
            foreach ($filters as $attribute => $value) {
                // Si el valor del atributo del objeto deserializado no coincide con el valor del filtro, devuelve falso
                if ($element->{$attribute} == $value) {
                    $count_filter++;
                }
            }

            return ($count_filter == count($filters));
        });
        return $this;
    }

    public function search($attributes)
    {
        $this->{$this->model} = $this->load($this->endpoint, $attributes);
        return $this;
    }

    public function find($id)
    {
        $this->{$this->model} = $this->getClient()->get($this->endpoint . '/' . $id);
        return $this;
    }

    public function all()
    {
        $this->{$this->model} = $this->load($this->endpoint);
        return $this;
    }
}
