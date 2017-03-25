<?php
namespace AppBundle\Utils;

class ArrayFilter {

  public static function getFilterData($pattern, $keys_raw)
  {
    $filter = [];

    foreach ($keys_raw as $key) {
      $output = preg_match($pattern, $key, $coincidencia);
      if($output){
        array_push($filter, $coincidencia);
      }
    }

    $filter = ArrayFilter::cleanArray($filter);

    return $filter;
  }

  public static function cleanArray($arrayRaw)
  {
    $arrayResult = [];
    $size = count($arrayRaw);

    for($i = 0; $i < $size; $i++){
        array_push($arrayResult, $arrayRaw[$i][0]);
    }

    sort($arrayResult, SORT_STRING);
    return $arrayResult;

  }

}
