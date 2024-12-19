<?php

namespace App\Entity;

use App\Enums\ActionEnum;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;
use ReturnTypeWillChange;
use Symfony\Component\Security\Http\AccessMap;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stock $stock = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: 'string', enumType: ActionEnum::class)]
    private ?ActionEnum  $action = null;
    

    public function getAction(): ?ActionEnum
    {
        return $this->action;
    }

    public function setAction(?ActionEnum $action): static
    {
        $this->action = $action;
        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): Application
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->price * $this->quantity;
    } 


}

