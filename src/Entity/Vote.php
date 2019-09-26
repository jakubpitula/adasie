<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Minivote", mappedBy="vote", cascade={"persist", "remove"})
     */
    private $minivotes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ip;

    public function __construct()
    {
        $this->minivotes = new ArrayCollection();
        $this->date = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $minivote->setVote($this);
        }

        return $this;
    }

    public function removeMinivote(Minivote $minivote): self
    {
        if ($this->minivotes->contains($minivote)) {
            $this->minivotes->removeElement($minivote);
            // set the owning side to null (unless already changed)
            if ($minivote->getVote() === $this) {
                $minivote->setVote(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }
}
