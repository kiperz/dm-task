<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use App\Repository\CommentRepository;
use DateTime;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={"GET", "POST"},
 *     itemOperations={
 *         "GET"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false
 *          },
 *     },
 *     attributes={"order"={"created_at": "ASC"}}
 * )
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "write"})
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(max="1000", min="1")
     * @Groups({"read", "write"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read"})
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new DateTime();
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
