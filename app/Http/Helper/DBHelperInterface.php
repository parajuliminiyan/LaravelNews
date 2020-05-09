<?php


namespace App\Http\Helper;


interface DBHelperInterface {

     function saveToDataBase($data,$category=null,$souces=null,$country=null);

}
