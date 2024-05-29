<?php

declare(strict_types=1);

namespace App\Entity\Post;

use App\Repository\Post\TagRepository;
use Cocur\Slugify\Slugify;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag
 *
 * @author Trésor-ILUNGA <hello@tresor-ilunga.tech>
 */
#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('slug', message: 'Ce slug existe déjà')]

class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank()]
    private ?string $slug = '';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'tags')]
    #[JoinTable(name: 'tags_post')]
    private Collection $posts;


    #[ORM\Column]
    #[Assert\NotNull()]
    private ?DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->posts = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->slug = (new Slugify())->slugify($this->name);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        $this->posts->removeElement($post);

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
