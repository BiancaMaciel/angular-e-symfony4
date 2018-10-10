<?php

namespace App\Model;

use \App\base;

class Weather
{
  private $city;

  const PATH_FILE_LOCALES = '../src/base/locales.json';
  const PATH_FILE_WEATHER = '../src/base/weather.json';

  public function openFile($path)
  {
      $file = file_get_contents($path);
      $json = json_decode($file);
      return $json;
  }

  public function removeAccents($string){
      return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
  }

  public function findCity($city, $path)
  {
    $dataLocal = array();
    $dataLocales = $this->openFile($path);
    $cityWithoutAccents = $this->removeAccents($city);

    foreach ($dataLocales as $local) {
      $newNameLocalWithoutAccents = $this->removeAccents($local->name);
      if(strtolower($newNameLocalWithoutAccents) === strtolower($cityWithoutAccents)){
         $dataLocal = (object)[
          "id" => $local->id,
          "name" => $local->name,
          "state" => $local->state
        ];
      }
    }
    if(!empty($dataLocal))
      return $dataLocal;
    else
      return $dataLocal = ["msg" => "Cidade não encontrada!"];
  }


  public function findWeather($city)
  {
    $jsonCity = $this->findCity($city, self::PATH_FILE_LOCALES);
    $jsonWeather = $this->openFile(self::PATH_FILE_WEATHER);
    $sevenDayTemperature = array();

    foreach ($jsonWeather as $dataWeather) {

      $idFileWeather = isset($dataWeather->locale->id) ? $dataWeather->locale->id : null;

      $idFileLocales = isset($jsonCity->id) ? $jsonCity->id : null;

      if($idFileWeather === $idFileLocales){

        $data = isset($dataWeather->weather) ? $dataWeather->weather : null;
        for ($i = 0; $i < count($data); $i++) {
            $sevenDayTemperature[$i] = (object)[
              "date" => isset($data[$i]->date) ? $data[$i]->date : null ,
              "text" => isset($data[$i]->text) ? $data[$i]->text : null ,
              "temperature_min" => isset($data[$i]->temperature->min) ? $data[$i]->temperature->min : null,
              "temperature_max" => isset($data[$i]->temperature->max) ? $data[$i]->temperature->max : null,
              "rain_prob" => isset($data[$i]->rain->probability) ? $data[$i]->rain->probability : null,
              "rain_prec" => isset($data[$i]->rain->precipitation) ? $data[$i]->rain->precipitation : null
            ];
          }
      }
    }
      return $result = (object) [
        $jsonCity,
        $sevenDayTemperature
      ];
  }
}

