<?php

namespace App\Services\geoPlgin;
use Illuminate\Support\Facades\Http;

class geoPlginServices extends BaseUrl{

    public function getCountryAndCity($ip_address){
        $request = [
            'ip' => $ip_address,
        ];

        $response = Http::withHeaders([
            'Authorization'=> ''
        ])->asForm()->get($this->base_url .'/json.gp?ip=',  $request);

        $json_response = $response->json();
        $body_response = $response->body();
    
        if($response->failed()){
            return false;
        }
        return $json_response;
    }

}