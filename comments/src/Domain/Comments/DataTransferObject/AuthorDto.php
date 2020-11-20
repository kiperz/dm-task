<?php
namespace App\Domain\Comments\DataTransferObject;

class AuthorDto
{
    private string $email;
    private string $nickname;

    public function __construct(string $email, string $nickname)
    {
        $this->email = $email;
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function toArray(): array
    {
        return [
            "email" => $this->email,
            "nickname" => $this->nickname
        ];
    }
}