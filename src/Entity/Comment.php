<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Text;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private $post;

    #[ORM\Column(type: 'datetime_immutable')]
    private $Posted_at;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: 'integer')]
    private $Likes;

    #[ORM\Column(type: 'integer')]
    private $share;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'commentsLiked')]
    private $liked;

    public function __construct()
    {
        $this->liked = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): self
    {
        $this->Text = $Text;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getPostedAt(): ?\DateTimeImmutable
    {
        return $this->Posted_at;
    }

    public function setPostedAt(\DateTimeImmutable $Posted_at): self
    {
        $this->Posted_at = $Posted_at;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->Likes;
    }

    public function setLikes(int $Likes): self
    {
        $this->Likes = $Likes;

        return $this;
    }

    public function getShare(): ?int
    {
        return $this->share;
    }

    public function setShare(int $share): self
    {
        $this->share = $share;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLiked(): Collection
    {
        return $this->liked;
    }

    public function addLiked(User $liked): self
    {
        if (!$this->liked->contains($liked)) {
            $this->liked[] = $liked;
        }

        return $this;
    }

    public function removeLiked(User $liked): self
    {
        $this->liked->removeElement($liked);

        return $this;
    }
}
