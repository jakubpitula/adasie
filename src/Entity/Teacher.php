<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 */
class Teacher
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Vote", mappedBy="teachers")
     */
    private $votes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Minivote", mappedBy="teacher")
     */
    private $minivotes;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->teacherVotes = new ArrayCollection();
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
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->addTeacher($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            $vote->removeTeacher($this);
        }

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
            $minivote->setTeacher($this);
        }

        return $this;
    }

    public function removeMinivote(Minivote $minivote): self
    {
        if ($this->minivotes->contains($minivote)) {
            $this->minivotes->removeElement($minivote);
            // set the owning side to null (unless already changed)
            if ($minivote->getTeacher() === $this) {
                $minivote->setTeacher(null);
            }
        }

        return $this;
    }

}
