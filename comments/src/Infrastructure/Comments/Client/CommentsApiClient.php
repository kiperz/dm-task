<?php


namespace App\Infrastructure\Comments\Client;

use Symfony\Component\HttpClient\CurlHttpClient;

class CommentsApiClient
{
    public function __construct()
    {
        $this->client = new CurlHttpClient();
    }

    public function createComment(string $content, string $nick, array $author)
    {
        $data = [
            'content' => $content,
            'nick' => $nick,
            'author' => 'api/authors/' . $author['id'],
        ];

        $this->client->request('POST', $this->getUrl('comments'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);
    }

    public function getComments(int $page, string $authorId = null): array
    {
        $queryData = [];
        if($page)
            $queryData += ['page' => $page];
        if($authorId)
            $queryData += ['author.id' => $authorId];
        $query = \http_build_query($queryData);
        $response = $this->client->request('GET', $this->getUrl('comments') . (\mb_strlen($query) ? "?$query" : ''), [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
        return $response->toArray();
    }

    public function getAuthor(string $email): ?array
    {
        $response = $this->client->request('GET', $this->getUrl('authors') . '?email='.$email, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
        $authorsArr = $response->toArray();
        return count($authorsArr) ? $authorsArr[0] : null;
    }

    public function createAuthor(string $email): array
    {
        $data = [
            'email' => $email,
        ];

        $response = $this->client->request('POST', $this->getUrl('authors'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);
        return $response->toArray();
    }

    private function getUrl(string $endpoint): string {
        return \getenv('COMMENTS_API_URL') . '/api/' . $endpoint;
    }
}