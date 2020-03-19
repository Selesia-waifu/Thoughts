<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikesRepository")
 */
class Likes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_like;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pensamientos", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_publicacion;

    public function __construct()
    {
        $this->fecha_like= new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaLike(): ?\DateTimeInterface
    {
        return $this->fecha_like;
    }

    public function setFechaLike(\DateTimeInterface $fecha_like): self
    {
        $this->fecha_like = $fecha_like;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdPublicacion(): ?Pensamientos
    {
        return $this->id_publicacion;
    }

    public function setIdPublicacion(?Pensamientos $id_publicacion): self
    {
        $this->id_publicacion = $id_publicacion;

        return $this;
    }
}
