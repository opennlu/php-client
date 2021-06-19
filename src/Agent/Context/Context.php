<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace OpenNLU\Client\Agent\Context;


class Context
{
    private $name;
    private $ttl;

    public function __construct($name, $ttl)
    {
        $this->name = $name;
        $this->ttl = $ttl;
    }

    public function getName()
    {
        return $this->ttl;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'ttl' => $this->ttl,
        ];
    }
}