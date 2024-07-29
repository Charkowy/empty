<?php

namespace App\Class;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Util
{
    public static function randomPassword($length = 8)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&()_+=-?<>.,';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function sortQueryResult(&$q, $sort_by = false)
    {
        if (is_array($sort_by)) {
            foreach ($sort_by as $field => $sort) {
                if (is_numeric($field)) {
                    $field = $sort;
                    $sort = 'ASC';
                }
                $q->orderBy($field, $sort);
            }
        }
    }

    public static function mutatorDateFormat($from_format = 'Y-m-d', $to_format = 'd/m/Y')
    {
        if (config('migration', false)) {
            return Attribute::make(
                get: fn ($value) => $value,
                set: fn ($value) => $value,
            );
        } else {
            return Attribute::make(
                get: fn ($value) => is_null($value) ? $value : Carbon::createFromFormat($from_format, $value)->format($to_format),
                set: fn ($value) => is_null($value) ? $value : Carbon::createFromFormat($to_format, $value)->format($from_format),
            );
        }
    }

    public static function strFormaterUc($string, $onlyFirst = false)
    {
        $string = trim(strtolower($string));
        return ($onlyFirst === true) ? ucfirst($string) : ucwords($string);
    }

    public static function getRouteMethodName()
    {
        return Str::after(Route::getCurrentRoute()->getActionName(), '@');
    }

    public static function getRoutePathController()
    {
        return Str::before(Route::getCurrentRoute()->getActionName(), '@');
    }

    public static function getRouteControllerName()
    {
        $path = explode('\\', Util::getRoutePathController());
        return end($path);
    }

    public static function existInRoutePath($str)
    {
        return in_array($str, explode('\\', Util::getRoutePathController()));
    }

    public static function getMonths()
    {
        $meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        unset($meses[0]);
        return $meses;
    }

    public static function byYearMonth($model, $field, $year, $month)
    {
        // Fecha inicial y final del mes recibido
        $startOfMonth = Carbon::create($year, $month, 1)->startOfDay();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth()->endOfDay();

        return $model->whereBetween($field, [$startOfMonth, $endOfMonth]);
    }
}
