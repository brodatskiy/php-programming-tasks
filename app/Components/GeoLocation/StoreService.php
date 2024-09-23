<?php

use Project\App\Components\GeoLocation\StoreInterface;

class StoreService
{
    private GeoService $geoService;

    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }

    public function getStoreCoordinates(StoreInterface $store): string
    {
        return $this->geoService->getCoordinates($store->getAddress());
    }

}
