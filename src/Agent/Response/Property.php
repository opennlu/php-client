<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace OpenNLU\Client\Agent\Response;


class Property
{
    private $properties;

    /**
     * Property constructor.
     * @param array $properties
     * @internal param array $property
     */
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public function getName()
    {
        return $this->properties['name'];
    }

    public function getEntity()
    {
        return $this->properties['entity'];
    }

    public function getValue()
    {
        return $this->properties['value'];
    }
}