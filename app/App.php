<?php

namespace App;

use App\Services\RequestService;
use App\Services\DBService;

class App
{

    public function fetchData()
    {
        $http = new RequestService();
        $db = new DBService();

        $currentPage = 0;
        $lastPage = 0;

        echo 'Fetching Started!';

        do {

            $currentPage++;
            $response = $http->get('https://trial.craig.mtcserver15.com/api/properties', [
                'page[number]' => $currentPage,
                'page[size]' => 100,
                'api_key' => $_ENV['API_KEY']
            ]);

            if (!$response) {
                echo 'Unsuccesfull API Call!';
            }

            $jsonResponse = json_decode($response, true);

            $fields = [
                'property_type_id',
                'county',
                'country',
                'town',
                'description',
                'address',
                'image_full',
                'image_thumbnail',
                'latitude',
                'longitude',
                'num_bedrooms',
                'num_bathrooms',
                'price',
                'type',
                'property_type_description',
            ];

            echo $currentPage.' of '. $lastPage.' ,';

            if(isset($jsonResponse['data']) && is_array($jsonResponse['data'])){
                $values = array_map(function ($data) {
                    $data['property_type_description'] = $data['property_type']['description'];
                    unset($data['uuid']);
                    unset($data['created_at']);
                    unset($data['updated_at']);
                    unset($data['property_type']);
                    return array_values($data);
                }, $jsonResponse['data']);

                $db->insertMulti('properties', $fields, $values);
            }
            if($lastPage == 0){
                $lastPage = $jsonResponse['last_page'];
            }
        } while ($lastPage > $currentPage);

        echo 'Succesfully Compleated!';
    }
}