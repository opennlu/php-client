<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace OpenNLU\Client\Agent;

use OpenNLU\Client\Agent\Response\Response;
use OpenNLU\Client\OpenNLU;

class Session
{
    private $nlu;
    private $context = [];
    private $response;

    public function __construct(OpenNLU $nlu)
    {
        $this->nlu = $nlu;
        $this->response = json_decode((string) $nlu->getGuzzle()->request('POST', sprintf('agents/%s/sessions', $nlu->getJwtClaims()->agent_id), [
            'headers'  => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $nlu->getJwtToken()),
            ],
            'body' => json_encode([])
        ])->getBody(), true);
    }

    public function parse($message): Response
    {
        return new Response($this->nlu, $this, $message);
    }

    public function getId()
    {
        return $this->response['id'];
    }

    public function setContextStore($context)
    {
        return $this->context = $context;
    }

    public function getContextStore()
    {
        return $this->context;
    }
}