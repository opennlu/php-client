<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace OpenNLU\Client;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use OpenNLU\Client\Agent\Session;

class OpenNLU
{
    private $guzzle;
    private $jwtToken;
    private $jwtClaims;

    public function __construct($jwtToken, $options = [])
    {
        $this->jwtToken = $jwtToken;
        $this->jwtClaims = JWT::jsonDecode(JWT::urlsafeB64Decode(explode('.', $this->jwtToken)[1]));

        $options['guzzle']['base_uri'] = $options['guzzle']['base_uri'] ?? 'https://api.nlu.opennlu.net';

        $this->guzzle = new Client($options['guzzle']);
    }

    public function getJwtToken()
    {
        return $this->jwtToken;
    }

    public function getJwtClaims()
    {
        return $this->jwtClaims;
    }

    public function createSession(): Session
    {
        return new Session($this);
    }

    public function getGuzzle(): Client
    {
        return $this->guzzle;
    }
}