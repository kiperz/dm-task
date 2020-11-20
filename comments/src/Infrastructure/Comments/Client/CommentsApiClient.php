<?php


namespace App\Infrastructure\Comments\Client;


use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\VarDumper\VarDumper;

class CommentsApiClient
{
    public function __construct()
    {
        $this->client = new CurlHttpClient();
    }

    public function createComment(array $data)
    {
        $this->client->request('POST', $this->getUrl(), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);
    }

    public function getComments(): array
    {
        $response = $this->client->request('GET', $this->getUrl(), [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
        VarDumper::dump($response->getContent());
        return $response->toArray();
    }

    private function getUrl(): string {
        return $_ENV['COMMENTS_API_URL']. '/api/comments';
    }
}