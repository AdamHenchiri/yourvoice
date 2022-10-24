<?php

namespace App\Covoiturage\Model\DataObject;

abstract Class AbstractDataObject
{
    public abstract function formatTableau(): array;
}