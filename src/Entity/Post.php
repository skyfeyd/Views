<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;

    #[ORM\Column(type: 'string', length: 255)]
    private $file;

    #[ORM\Column(type: 'datetime_immutable')]
    private $Posted_at;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class)]
    private $comments;

    #[ORM\Column(type: 'integer')]
    private $Likes;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $Share;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'posts')]
    private $liked;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->liked = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

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

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

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
        return $this->Share;
    }

    public function setShare(int $Share): self
    {
        $this->Share = $Share;

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

    private $videoFilename;

    public function getVideoFilename()
    {
        return $this->videoFilename;
    }

    public function setVideoFilename($videoFilename)
    {
        $this->videoFilename = $videoFilename;

        return $this;
    }
}
