<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\CommentRepository;
use DateTime;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"comment:read"}},
 *     denormalizationContext={"groups"={"comment:write"}},
 *     collectionOperations={"GET", "POST"},
 *     itemOperations={
 *         "GET"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false
 *          },
 *     },
 *     attributes={"order"={"created_at": "DESC"}}
 * )
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"author.id": "exact"})
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"comment:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"comment:read", "comment:write"})
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(max="1000", min="1")
     * @Groups({"comment:read", "comment:write"})
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     * @Groups({"comment:read", "comment:write"})
     */
    private $nick;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"comment:read"})
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

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

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
