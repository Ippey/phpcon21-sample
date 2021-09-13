<?php

namespace App\Entity;

use App\Repository\TheaterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=TheaterRepository::class)
 */
class Theater
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=TheaterRoom::class, mappedBy="theater")
     */
    private $theaterRooms;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="theater")
     * @Ignore()
     */
    private $users;

    public function __construct()
    {
        $this->theaterRooms = new ArrayCollection();
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
     * @return Collection|TheaterRoom[]
     */
    public function getTheaterRooms(): Collection
    {
        return $this->theaterRooms;
    }

    public function addTheaterRoom(TheaterRoom $theaterRoom): self
    {
        if (!$this->theaterRooms->contains($theaterRoom)) {
            $this->theaterRooms[] = $theaterRoom;
            $theaterRoom->setTheater($this);
        }

        return $this;
    }

    public function removeTheaterRoom(TheaterRoom $theaterRoom): self
    {
        if ($this->theaterRooms->removeElement($theaterRoom)) {
            // set the owning side to null (unless already changed)
            if ($theaterRoom->getTheater() === $this) {
                $theaterRoom->setTheater(null);
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
            $user->setTheater($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTheater() === $this) {
                $user->setTheater(null);
            }
        }

        return $this;
    }
}
