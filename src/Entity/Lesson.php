<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $lesson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\categories", inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idcategories;

    public function __construct()
    {
        $this->categories_idcategories = new ArrayCollection();
    }

    public function getId()
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

    public function getLesson(): ?string
    {
        return $this->lesson;
    }

    public function setLesson(string $lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * @return Collection|categories[]
     */
    public function getCategoriesIdcategories(): Collection
    {
        return $this->categories_idcategories;
    }

    public function addCategoriesIdcategory(categories $categoriesIdcategory): self
    {
        if (!$this->categories_idcategories->contains($categoriesIdcategory)) {
            $this->categories_idcategories[] = $categoriesIdcategory;
            $categoriesIdcategory->setLesson($this);
        }

        return $this;
    }

    public function removeCategoriesIdcategory(categories $categoriesIdcategory): self
    {
        if ($this->categories_idcategories->contains($categoriesIdcategory)) {
            $this->categories_idcategories->removeElement($categoriesIdcategory);
            // set the owning side to null (unless already changed)
            if ($categoriesIdcategory->getLesson() === $this) {
                $categoriesIdcategory->setLesson(null);
            }
        }

        return $this;
    }

    public function getIdcategories(): ?categories
    {
        return $this->idcategories;
    }

    public function setIdcategories(?categories $idcategories): self
    {
        $this->idcategories = $idcategories;

        return $this;
    }
}
