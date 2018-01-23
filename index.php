<?php
/**
 * Copyright (C) 2017 by Preuß.IO GbR <https://www.preuss.io> - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 */

namespace example;

use PreussIO\NLU\NLUClient;

require __DIR__.'/vendor/autoload.php';

$nlu = new NLUClient('access_token', [
    'guzzle' => [
        'base_uri' => 'http://development.api.nlu.opennlu.com:8080'
    ]
]);

$session = $nlu->createSession();

print_r($session->parse('Ich möchte etwas kaufen')->toJson());
print_r($session->parse('pocky')->toJson());