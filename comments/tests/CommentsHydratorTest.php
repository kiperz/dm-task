<?php


use App\Domain\Comments\Hydrator\CommentsHydrator;
use PHPUnit\Framework\TestCase;

class CommentsHydratorTest extends TestCase
{
    public function testHydrateComments()
    {
        $comments = <<<'JSON'
[
   {
      "id":"1571a77a-4c90-42ac-8792-e75d9421e134",
      "author":{
         "id":"514eef48-97c3-42ca-8119-ce46bd7957d4",
         "nickname":"Kacper",
         "email":"kiperz@gmail.com",
         "created_at":"2020-11-19T15:15:39+00:00"
      },
      "content":"witam bardzo",
      "created_at":"2020-11-19T15:15:39+00:00"
   },
   {
      "id":"e1da9bb7-9758-44fc-87da-6023a5b8722e",
      "author":{
         "id":"175e5317-53be-457d-91d7-aa996ca232f3",
         "nickname":"Kiperial",
         "email":"kiperial@fakamaka.do",
         "created_at":"2020-11-19T15:25:06+00:00"
      },
      "content":"Wcale si\u0119 z tym nie zgadzam\r\n\r\nW mojej wersji wygl\u0105da\u0142o to inaczej!",
      "created_at":"2020-11-19T15:25:06+00:00"
   }
]
JSON;
        $hydrator = new CommentsHydrator();
        $parsedJson = json_decode($comments, JSON_OBJECT_AS_ARRAY);
        $comments = $hydrator->hydrateComments($parsedJson);
        $this->assertEquals(2, sizeof($comments));
        $this->assertSame("App\Domain\Comments\DataTransferObject\CommentDto", get_class($comments[0]));
        $this->assertSame("App\Domain\Comments\DataTransferObject\AuthorDto", get_class($comments[0]->getAuthor()));
        $this->assertEquals("Kacper", $comments[0]->getAuthor()->getNickname());
        $this->assertEquals(<<<TEXT
Wcale się z tym nie zgadzam

W mojej wersji wyglądało to inaczej!
TEXT, $comments[1]->getContent());
    }
}
