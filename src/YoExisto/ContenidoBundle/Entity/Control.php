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
     * @var string
     */
    private $estado;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Donde
     */
    private $donde;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Que
     */
    private $que;


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
     * @param string $estado
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
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
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
}
