<?php

namespace Tests;

class FunctionalTestCase extends TestCase
{
    public $baseUrl = 'http://localhost';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function get($uri, array $headers = [], array $data = []): self
    {
        return parent::json('GET', $uri, $data, $this->addXmlHttpHeader($headers));
    }

    public function post($uri, array $data = [], array $headers = []): self
    {
        return parent::json('POST', $uri, $data, $this->addXmlHttpHeader($headers));
    }

    private function addXmlHttpHeader(array $headers): array
    {
        if (!isset($headers['X-Requested-With'])) {
            $headers['X-Requested-With'] = 'XMLHttpRequest';
        }

        return $headers;
    }
}
