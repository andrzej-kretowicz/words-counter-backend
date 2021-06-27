<?php

namespace App\Entity;

use App\Entity\Interfaces\UserInterface;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, SymfonyUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Ip
     */
    private string $ip;

    /**
     * @ORM\OneToMany(targetEntity=Word::class, mappedBy="user")
     */
    private $word;

    public function __construct()
    {
        $this->word = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return Collection|Word[]
     */
    public function getWords(): Collection
    {
        return $this->word;
    }

    public function addWord(Word $word): self
    {
        if (!$this->word->contains($word)) {
            $this->word[] = $word;
            $word->setUser($this);
        }

        return $this;
    }

    public function removeWord(Word $word): self
    {
        if ($this->word->removeElement($word)) {
            // set the owning side to null (unless already changed)
            if ($word->getUser() === $this) {
                $word->setUser(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): ?string
    {
        return null;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {

    }

    public function getUsername(): ?string
    {
        return $this->getIp();
    }

    public function getUserIdentifier(): string
    {
        return $this->getIp();
    }
}
