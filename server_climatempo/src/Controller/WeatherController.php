<?php

namespace App\Controller;

use App\Model\Weather;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class WeatherController
 * @package App\Controller
 *
 */
class WeatherController extends FOSRestController
{

  /**
  * @param mixed\null $city
  * @Rest\Get("/weather/{city}", name="get_weather")
  * @return \Symfony\Component\HttpFoundation\JsonResponse
  */
  public function getWeather($city)
  {
    $weather = new Weather();
    $result = $weather->findWeather($city);
    return new JsonResponse($result);
  }
}
