<?php

use Project\App\Components\GeoLocation\StoreInterface;

class Store implements StoreInterface{

    public function getAddress(): string {
        return 'get.address.from.store';
    }

}