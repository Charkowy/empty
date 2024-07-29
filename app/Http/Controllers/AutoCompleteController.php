<?php

namespace App\Http\Controllers;

use App\Apis\Georef\GeoAddressApi;

class AutoCompleteController extends Controller
{
    public function address($request)
    {
        $address = (new GeoAddressApi())->search([
            'max' => $request['max'],
            'provincia' => $request['state'],
            'direccion' => $request['q']
        ])->get();

        // Convertir JSON a colección
        $collection = collect(json_decode($address, true));

        // Agrupar por 'calle.id' y eliminar duplicados automáticamente
        $grouped = $collection->groupBy('calle.nombre')->map(function ($items) {
            // Tomar solo el primer ítem de cada grupo para evitar duplicados
            return $items->first();
        });

        // Devolver como respuesta JSON
        return response()->json($grouped);
    }
}
