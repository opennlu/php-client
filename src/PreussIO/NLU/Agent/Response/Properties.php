<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace PreussIO\NLU\Agent\Response;


class Properties
{
    private $properties;

    /**
     * Properties constructor.
     * @param $properties
     */
    public function __construct($properties)
    {
        $this->properties = array_map(function (array $property) {
            return new Property($property);
        }, $properties);
    }
}