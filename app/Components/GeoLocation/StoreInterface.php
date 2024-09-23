<?php

namespace Project\App\Components\GeoLocation;
interface StoreInterface
{
    public function getAddress(): string;
}