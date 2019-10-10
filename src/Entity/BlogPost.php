<?php
namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string")
   */
  private $title;

  /**
   * @var string
   *
   * @ORM\Column(name="body", type="text")
   */
  private $body;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="text")
   */
  private $description;

  /**
   * @var bool
   *
   * @ORM\Column(name="draft", type="boolean")
   */
  private $draft = false;

  /**
   * @ORM\ManyToOne(targetEntity="Category", inversedBy="blogPosts")
   */
  private $category;

  public function getTitle(): ?string
  {
      return $this->title;
  }

  public function setTitle(string $title): self
  {
      $this->title = $title;

      return $this;
  }

  public function getBody(): ?string
  {
      return $this->body;
  }

  public function setBody(string $body): self
  {
      $this->body = $body;

      return $this;
  }

  public function getDraft(): ?bool
  {
      return $this->draft;
  }

  public function setDraft(bool $draft): self
  {
      $this->draft = $draft;

      return $this;
  }

  public function getCategory(): ?Category
  {
      return $this->category;
  }

  public function setCategory(?Category $category): self
  {
      $this->category = $category;

      return $this;
  }
  /**
   * @var Media
   *
   * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media")
   * @ORM\JoinColumns({
   *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
   * })
   */
  private $picture;

  public function getPicture(): ?Media
  {
      return $this->picture;
  }

  public function setPicture(?Media $picture): self
  {
      $this->picture = $picture;

      return $this;
  }

  public function getDescription(): ?string
  {
      return $this->description;
  }

  public function setDescription(string $description): self
  {
      $this->description = $description;

      return $this;
  }

  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime")
   */
  private $updatedAt;

  /**
   * @ORM\PrePersist
   * @ORM\PreUpdate
   */
  public function updatedTimestamps()
  {
    $this->updatedAt = new \DateTime('now');

    if ($this->getCreatedAt() == null) {
      $this->createdAt = new \DateTime('now');
    }
  }

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeInterface $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

}