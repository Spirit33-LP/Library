<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
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
    private $Title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Nb_Pages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Style;

    /**
     * @ORM\Column(type="boolean")
     */
    private $In_Stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->Nb_Pages;
    }

    public function setNbPages(?int $Nb_Pages): self
    {
        $this->Nb_Pages = $Nb_Pages;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->Style;
    }

    public function setStyle(?string $Style): self
    {
        $this->Style = $Style;

        return $this;
    }

    public function getInStock(): ?bool
    {
        return $this->In_Stock;
    }

    public function setInStock(bool $In_Stock): self
    {
        $this->In_Stock = $In_Stock;

        return $this;
    }
}
