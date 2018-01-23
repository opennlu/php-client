<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace PreussIO\NLU\Agent\Response;

use PreussIO\NLU\Agent\Context\Context;
use PreussIO\NLU\Agent\Session;
use PreussIO\NLU\NLUClient;

class Response
{
    private $nlu;
    private $session;
    private $message;
    private $response;
    private $fulfillment;
    private $properties;
    private $contexts;

    /**
     * AgentResponse constructor.
     * @param NLUClient $nlu
     * @param Session $session
     * @param string $message
     */
    public function __construct(NLUClient $nlu, Session $session, string $message)
    {
        $this->nlu = $nlu;
        $this->session = $session;
        $this->message = $message;

        $this->response = json_decode((string) $nlu->getGuzzle()->request('POST', sprintf('agents/%s/sessions/%s/parse', $nlu->getJwtClaims()->agent_id, $session->getId()), [
            'headers'  => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $nlu->getJwtToken()),
            ],
            'body' => json_encode([
                'query' => $message,
                'context' => array_map(function (Context $context) {
                    return $context->toArray();
                }, $session->getContextStore()),
            ])
        ])->getBody(), true);

        $this->fulfillment = new Fulfillment($this->response['fulfillment']);
        $this->properties = new Properties($this->response['properties']);
        $this->contexts = $session->setContextStore(array_map(function (array $context) {
            return new Context($context['name'], $context['ttl']);
        }, $this->response['context']));
    }

    public function getMessage()
    {
        return $this->response['message'];
    }

    public function getScore()
    {
        return $this->response['score'];
    }

    public function getIntent()
    {
        return $this->response['intent'];
    }

    public function getFulfillment()
    {
        return $this->fulfillment;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function getContexts()
    {
        return $this->contexts;
    }

    public function toJson()
    {
        return $this->response;
    }
}