<?php

namespace App\Services\geoPlgin;
use Illuminate\Support\Facades\Http;

class BaseUrl{
    
    protected $base_url;

    public function __construct()
    {
        $this->base_url = env('GEO_LPUGIN_BASE_URL');
    }
}