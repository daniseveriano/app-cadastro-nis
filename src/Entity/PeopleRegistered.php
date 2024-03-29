<?php

namespace App\Entity;

use App\Repository\PeopleRegisteredRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeopleRegisteredRepository::class)]
class PeopleRegistered
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $nis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNis(): ?string
    {
        return $this->nis;
    }

    public function setNis(string $nis): static
    {
        $this->nis = $nis;

        return $this;
    }
}
