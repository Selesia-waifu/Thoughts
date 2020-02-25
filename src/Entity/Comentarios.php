<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentariosRepository")
 */
class Comentarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $contenido_comentario;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_comentario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comentarios")
     */
    private $Id_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pensamientos", inversedBy="comentarios")
     */
    private $Id_pensamiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenidoComentario(): ?string
    {
        return $this->contenido_comentario;
    }

    public function setContenidoComentario(string $contenido_comentario): self
    {
        $this->contenido_comentario = $contenido_comentario;

        return $this;
    }

    public function getFechaComentario(): ?\DateTimeInterface
    {
        return $this->fecha_comentario;
    }

    public function setFechaComentario(\DateTimeInterface $fecha_comentario): self
    {
        $this->fecha_comentario = $fecha_comentario;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->Id_user;
    }

    public function setIdUser(?User $Id_user): self
    {
        $this->Id_user = $Id_user;

        return $this;
    }

    public function getIdPensamiento(): ?Pensamientos
    {
        return $this->Id_pensamiento;
    }

    public function setIdPensamiento(?Pensamientos $Id_pensamiento): self
    {
        $this->Id_pensamiento = $Id_pensamiento;

        return $this;
    }
}
