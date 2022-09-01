<?php

namespace Heap\Helper;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Utils;
use Heap\Exception\HeapException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Request
{
    private string $apiUri = 'https://heapanalytics.com/api';
    private Client $http;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->http = new Client();
    }

    /**
     * @param $endpoint
     *
     * @return string
     */
    public function generateUri($endpoint): string
    {
        return $this->apiUri . $endpoint;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array  $data
     *
     * @return ResponseInterface
     * @throws HeapException|GuzzleException
     */
    public function call(string $method, string $endpoint, array $data): ResponseInterface
    {
        $fullUri = $this->generateUri($endpoint);

        try {
            $response = $this->http->request($method, $fullUri, array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
                'body' => Utils::jsonEncode($data),
            ));
        } catch (ServerException $e) {
            throw new HeapException($e->getMessage());
        }

        return $response;
    }
}
