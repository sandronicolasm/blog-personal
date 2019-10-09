<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
   * @ORM\Column(name="name", type="string")
   */
  private $name;

  /**
   * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category")
   */
  private $blogPosts;

  public function __construct()
  {
    $this->blogPosts = new ArrayCollection();
  }

  public function getBlogPosts()
  {
    return $this->blogPosts;
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

  public function addBlogPost(BlogPost $blogPost): self
  {
      if (!$this->blogPosts->contains($blogPost)) {
          $this->blogPosts[] = $blogPost;
          $blogPost->setCategory($this);
      }

      return $this;
  }

  public function removeBlogPost(BlogPost $blogPost): self
  {
      if ($this->blogPosts->contains($blogPost)) {
          $this->blogPosts->removeElement($blogPost);
          // set the owning side to null (unless already changed)
          if ($blogPost->getCategory() === $this) {
              $blogPost->setCategory(null);
          }
      }

      return $this;
  }
}