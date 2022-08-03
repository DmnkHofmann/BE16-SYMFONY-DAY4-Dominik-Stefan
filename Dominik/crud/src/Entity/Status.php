<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Available = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvailable(): ?string
    {
        return $this->Available;
    }

    public function setAvailable(string $Available): self
    {
        $this->Available = $Available;

        return $this;
    }
}