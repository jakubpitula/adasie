<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Minivote", mappedBy="category", cascade={"persist", "remove"})
     */
    private $minivotes;

    public function __construct()
    {
        $this->minivotes = new ArrayCollection();
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

    /**
     * @return Collection|Minivote[]
     */
    public function getMinivotes(): Collection
    {
        return $this->minivotes;
    }

    public function addMinivote(Minivote $minivote): self
    {
        if (!$this->minivotes->contains($minivote)) {
            $this->minivotes[] = $minivote;
            $minivote->setCategory($this);
        }

        return $this;
    }

    public function removeMinivote(Minivote $minivote): self
    {
        if ($this->minivotes->contains($minivote)) {
            $this->minivotes->removeElement($minivote);
            // set the owning side to null (unless already changed)
            if ($minivote->getCategory() === $this) {
                $minivote->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
