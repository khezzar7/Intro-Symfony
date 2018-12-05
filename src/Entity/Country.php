<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
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
     * @ORM\OneToMany(targetEntity="App\Entity\Proverb", mappedBy="country")
     */
    private $proverbs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="country")
     */
    private $users;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\City", cascade={"persist", "remove"})
     */
    private $capital;

    /**
     * @ORM\Column(type="integer")
     */
    private $population;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adjective;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flag;



    public function __construct()
    {

        $this->proverbs = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @return Collection|Proverb[]
     */
    public function getProverbs(): Collection
    {
        return $this->proverbs;
    }

    public function addProverb(Proverb $proverb): self
    {
        if (!$this->proverbs->contains($proverb)) {
            $this->proverbs[] = $proverb;
            $proverb->setCountry($this);
        }

        return $this;
    }

    public function removeProverb(Proverb $proverb): self
    {
        if ($this->proverbs->contains($proverb)) {
            $this->proverbs->removeElement($proverb);
            // set the owning side to null (unless already changed)
            if ($proverb->getCountry() === $this) {
                $proverb->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCountry($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCountry() === $this) {
                $user->setCountry(null);
            }
        }

        return $this;
    }

    public function getCapital(): ?City
    {
        return $this->capital;
    }

    public function setCapital(City $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getAdjective(): ?string
    {
        return $this->adjective;
    }

    public function setAdjective(string $adjective): self
    {
        $this->adjective = $adjective;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

  

}
