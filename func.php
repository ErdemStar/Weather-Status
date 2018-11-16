<?php

  function Say()
  {
    echo '<h1 class="display-3">Hello ,World!</h1>';
  }

  function Get_Location()
  {
    $ip_addr  = $_SERVER['REMOTE_ADDR'];
    //$ip_addr = '31.223.7.26';
    $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip_addr));
    if($query && $query['status'] == 'success')
    {
      /*
      echo '<p class="lead">Your country : ' . $query['country'] . '</p>';
      echo '<p class="lead">Your city : ' . $city = $query['city'] . '</p>';
      echo '<p class="lead">Your ip address : ' . $ip_addr . '</p>';
      */
      return $query['country'] . "," . $city = $query['city'] . "," . $ip_addr;
    }
    else
    {
      echo 'Unable to get location';
    }

  }

  function Get_Weather()
  {
    $API_KEY = "XXXXXXX";
    @list(,$city,) = explode("," , Get_Location());
    $q = "https://api.openweathermap.org/data/2.5/weather?q=". $city ."&appid=" . $API_KEY;
    $query =  file_get_contents($q);
    $json_d = json_decode($query , true);
    foreach ($json_d as $key => $value) {
      if ($key == "weather")
      {
        foreach ($value as $k => $v)
        {
          return ($v["main"] . "," . $v["description"]);
        }
      }
    }


  }

  function Write_Location_Info()
  {
    @list($country,$city,$ip_addr) = explode("," , Get_Location());
    echo '<p class="lead">Your country : ' . $country . '</p>';
    echo '<p class="lead">Your city : ' . $city . '</p>';
    echo '<p class="lead">Your ip address : ' . $ip_addr . '</p>';
  }
  function Write_Weather_Status()
  {
    $tmp = Get_Weather();
    list($main,$desc) = explode("," , $tmp);
    echo '<p class="lead">Weather status : ' . $main . '</p>';
    echo '<p class="lead">Description : ' . $desc . '</p>';

  }
?>
