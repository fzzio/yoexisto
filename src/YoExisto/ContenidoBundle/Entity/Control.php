<?php

namespace YoExisto\ContenidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Control
 */
class Control
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $usuario;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
     */
    private $positivos;

    /**
     * @var integer
     */
    private $negativos;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Donde
     */
    private $donde;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Que
     */
    private $que;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $votos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->votos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Control
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Control
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Control
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set positivos
     *
     * @param integer $positivos
     * @return Control
     */
    public function setPositivos($positivos)
    {
        $this->positivos = $positivos;
    
        return $this;
    }

    /**
     * Get positivos
     *
     * @return integer 
     */
    public function getPositivos()
    {
        return $this->positivos;
    }

    /**
     * Set negativos
     *
     * @param integer $negativos
     * @return Control
     */
    public function setNegativos($negativos)
    {
        $this->negativos = $negativos;
    
        return $this;
    }

    /**
     * Get negativos
     *
     * @return integer 
     */
    public function getNegativos()
    {
        return $this->negativos;
    }

    /**
     * Set donde
     *
     * @param \YoExisto\ContenidoBundle\Entity\Donde $donde
     * @return Control
     */
    public function setDonde(\YoExisto\ContenidoBundle\Entity\Donde $donde = null)
    {
        $this->donde = $donde;
    
        return $this;
    }

    /**
     * Get donde
     *
     * @return \YoExisto\ContenidoBundle\Entity\Donde 
     */
    public function getDonde()
    {
        return $this->donde;
    }

    /**
     * Set que
     *
     * @param \YoExisto\ContenidoBundle\Entity\Que $que
     * @return Control
     */
    public function setQue(\YoExisto\ContenidoBundle\Entity\Que $que = null)
    {
        $this->que = $que;
    
        return $this;
    }

    /**
     * Get que
     *
     * @return \YoExisto\ContenidoBundle\Entity\Que 
     */
    public function getQue()
    {
        return $this->que;
    }

    /**
     * Add votos
     *
     * @param \YoExisto\ContenidoBundle\Entity\Voto $votos
     * @return Control
     */
    public function addVoto(\YoExisto\ContenidoBundle\Entity\Voto $votos)
    {
        $this->votos[] = $votos;
    
        return $this;
    }

    /**
     * Remove votos
     *
     * @param \YoExisto\ContenidoBundle\Entity\Voto $votos
     */
    public function removeVoto(\YoExisto\ContenidoBundle\Entity\Voto $votos)
    {
        $this->votos->removeElement($votos);
    }

    /**
     * Get votos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotos()
    {
        return $this->votos;
    }
    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Control
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Control
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}