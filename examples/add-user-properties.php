<?php

use Heap\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$heap = new Client(11);
$heap->addUserProperties('bob@example.com', array(
    'age' => '25',
    'language' => 'English',
    'profession' => 'Scientist',
));
