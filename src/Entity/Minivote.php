<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MinivoteRepository")
 */
class Minivote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="minivotes",  cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="minivotes", cascade={"persist"})
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vote", inversedBy="minivotes", cascade={"persist"})
     */
    private $vote;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getVote(): ?Vote
    {
        return $this->vote;
    }

    public function setVote(?Vote $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
