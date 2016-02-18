<?php
/**
 * @author Rajaram.R
 * @copyright 2015
 */

App::uses('Component', 'Controller');

class GooglemapComponent extends Component
{
    /**
     * The Google Maps API key holder
     * @var string
     */


    public function getlatitudeandlongitude($address)
    {

        $prepAddr = str_replace(' ', '+', $address);

        $url = 'http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false';

        $c = curl_init();
        // echo "<pre>";print_r($c);exit();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        $output = curl_exec($c);
        curl_close($c);
        $output = json_decode($output, true);

        $latitude = $output['results'][0]['geometry']['location']['lat'];
        $longitude = $output['results'][0]['geometry']['location']['lng'];
        $address_comp = $output['results'][0]['address_components'];

        if (is_array($address_comp)) {
            foreach ($address_comp as $key => $value) {

                switch ($value->types[0]) {
                    case 'locality':
                        $city = $value->long_name;
                        break;

                    case 'administrative_area_level_1':
                        $state = $value->long_name;
                        break;

                    case 'country':
                        $country = $value->long_name;
                        break;
                }
            }
        }
        return array('lat' => $latitude, 'long' => $longitude, 'city' => $city, 'state' => $state, 'country' => $country);

    }


    /**
     * Get Driving Distance
     * @param Source latitude & longitude, Destination latitude & longitude
     * @return Distance between source and destination
     */
    public function getDrivingDistance($sourceLat, $sourceLong, $destinationLat, $destinationLong)
    {
        $url = "http://maps.googleapis.com/maps/api/directions/json?origin=$sourceLat,$sourceLong&destination=$destinationLat,$destinationLong&sensor=false";
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        $jsonResponse = curl_exec($c);
        curl_close($c);
        $dataset = json_decode($jsonResponse);
        if (!$dataset || !isset($dataset->routes[0]->legs[0]->distance->value)) {
            return 0;
        }

        $distance = array(
            'distanceValue' => $dataset->routes[0]->legs[0]->distance->value,
            'distanceText' => $dataset->routes[0]->legs[0]->distance->text,
            'durationValue' => $dataset->routes[0]->legs[0]->duration->value,
            'durationText' => $dataset->routes[0]->legs[0]->duration->text
        );

        return $distance;
    }

} //end class