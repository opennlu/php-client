<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace OpenNLU\OpenNLU\Agent\Response;


class Fulfillment
{
    private $fulfillment;

    /**
     * Fulfillment constructor.
     * @param $fulfillment
     */
    public function __construct($fulfillment)
    {
        $this->fulfillment = $fulfillment;
    }

    public function getResponse()
    {
        return $this->fulfillment['response'];
    }
}