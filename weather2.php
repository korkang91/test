<?php
$dda = file_get_contents('php://input');
echo $dda."\n";
$input = $_POST["City"];
list($city, $cntr) = explode(" ",$input);
if($cntr == null){
echo "cntr is null<br>";
}else {
echo $cntr."<br>";
}
echo $city."<br>";
$url = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=b11103fdc1bd9e2472109021419a3693";
echo $url;
$w = curl_init($url);
$weather_options = array(
    CURLOPT_HEADER => false,
    CURLOPT_RETURNTRANSFER => true
    );
curl_setopt_array($w, $weather_options);
$a = curl_exec($w);
curl_close($w);

if (isset($a) && $a) {
    $weather = json_decode($a);
    print_r($weather);
    $current_temp = $weather->main->temp - 273.15;
    $temp_min = $weather->main->temp_min - 273.15;
    $temp_max = $weather->main->temp_max - 273.15;
    $weather_main = $weather->weather[0]->main;
    $humidity = $weather->main->humidity;
    $country = $weather->sys->country;
    $name = $weather->name;
    $weather_icon = "http://openweathermap.org/img/w/{$weather->weather[0]->icon}.png";

    echo "<pre>";
    echo "current temperature : " . $current_temp;
    echo "\nminimum temperature : " . $temp_min;
    echo "\nmaximum temperature : " . $temp_max;
    echo "\nweather : " . $weather_main;
    echo "\nhumidity : ".$humidity;
    echo "\ncountry : ".$country;
    echo "\nname : ".$name;
    echo "</pre>";
} else {
    exit(0);
}
?>
