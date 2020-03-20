<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PensamientosRepository")
 */
class Pensamientos
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=8000)
     */
    private $Contenido;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_pensamiento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pensamientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentarios", mappedBy="Id_pensamiento",cascade={"remove"})
     */
    private $comentarios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Likes", mappedBy="id_publicacion",cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Contadorlikes;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->fecha_pensamiento= new \DateTime();
        $this->Contadorlikes="0";
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id):self 
    {
        $this->id = $id;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->Contenido;
    }

    public function setContenido(string $Contenido): self
    {
        $this->Contenido = $Contenido;

        return $this;
    }

    public function getFechaPensamiento(): ?\DateTimeInterface
    {
        return $this->fecha_pensamiento;
    }

    public function setFechaPensamiento(\DateTimeInterface $fecha_pensamiento): self
    {
        $this->fecha_pensamiento = $fecha_pensamiento;

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

    /**
     * @return Collection|Comentarios[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentarios $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setIdPensamiento($this);
        }

        return $this;
    }

    public function removeComentario(Comentarios $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getIdPensamiento() === $this) {
                $comentario->setIdPensamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Likes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setIdPublicacion($this);
        }

        return $this;
    }

    public function removeLike(Likes $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getIdPublicacion() === $this) {
                $like->setIdPublicacion(null);
            }
        }

        return $this;
    }

    public function getContadorlikes(): ?string
    {
        return $this->Contadorlikes;
    }

    public function setContadorlikes(string $Contadorlikes): self
    {
        $this->Contadorlikes = $Contadorlikes;

        return $this;
    }

   

    

    
    
}
