<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace PreussIO\NLU;

use GuzzleHttp\Client;
use PreussIO\NLU\Agent\Session;

class NLUClient
{
    private $guzzle;

    public function __construct($agentId, $options = [])
    {
        $options['guzzle']['base_uri'] = $options['guzzle']['base_uri'] ?? sprintf('http://api.nlu.hostinfin.com/agents/%s/', $agentId);

        $this->guzzle = new Client($options['guzzle']);
    }

    public function createSession(): Session
    {
        return new Session($this);
    }

    public function getGuzzle()
    {
        return $this->guzzle;
    }
}