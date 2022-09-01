<?php

namespace Heap;

use GuzzleHttp\Exception\GuzzleException;
use Heap\Exception\HeapException;
use Heap\Helper\Request;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private $appId;

    private Request $request;

    /**
     * Client constructor.
     *
     * @param null $appId
     */
    public function __construct($appId)
    {
        $this->appId = $appId;
        $this->request = new Request();
    }

    /**
     * @return null
     */
    public function getAppId()
    {
        return $this->appId;
    }


    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @param $event
     * @param $identity
     * @param array $properties
     *
     * @return ResponseInterface
     * @throws HeapException|GuzzleException
     */
    public function track($event, $identity, array $properties = array()): ResponseInterface
    {
        if (empty($event)) {
            throw new HeapException('You need to set the event name.');
        }

        if (empty($identity)) {
            throw new HeapException(
                'You need to set the identity. More info: https://heapanalytics.com/docs/server-side'
            );
        }

        $data = array(
            'app_id' => $this->appId,
            'event' => $event,
            'identity' => $identity,
        );

        if (!empty($properties)) {
            $data['properties'] = $properties;
        }

        return $this->request->call('POST', '/track', $data);
    }

    /**
     * @param $identity
     * @param array $properties
     *
     * @return ResponseInterface
     * @throws HeapException|GuzzleException
     */
    public function addUserProperties($identity, $properties = array()): ResponseInterface
    {
        if (empty($identity)) {
            throw new HeapException(
                'You need to set the identity. More info: https://heapanalytics.com/docs/server-side'
            );
        }

        $data = array(
            'app_id' => $this->appId,
            'properties' => $properties,
            'identity' => $identity,
        );

        return $this->request->call('POST', '/add_user_properties', $data);
    }
}
