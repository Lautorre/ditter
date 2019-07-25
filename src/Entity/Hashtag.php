<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HashtagRepository")
 */
class Hashtag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Deet", inversedBy="hashtags")
     */
    private $deet;

    public function __construct()
    {
        $this->deet = new ArrayCollection();
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

    /**
     * @return Collection|Deet[]
     */
    public function getDeet(): Collection
    {
        return $this->deet;
    }

    public function addDeet(Deet $deet): self
    {
        if (!$this->deet->contains($deet)) {
            $this->deet[] = $deet;
        }

        return $this;
    }

    public function removeDeet(Deet $deet): self
    {
        if ($this->deet->contains($deet)) {
            $this->deet->removeElement($deet);
        }

        return $this;
    }
}
