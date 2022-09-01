<?php

use Heap\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$heap = new Client(11);
$heap->track('Send Transactional Email', 'alice@example.com', array(
    'subject' => 'Welcome to My App!',
    'variation' => 'A',
));
