<?php


namespace App\Http\Helper;

interface ResponsableInterface {

    public function getAll($query);
    public function getByCountry($country);

    public function getBySources($sources);
}
