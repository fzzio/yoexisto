<?php

namespace YoExisto\ContenidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 */
class Area
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Municipio
     */
    private $municipio;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Area
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Area
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
     * Set municipio
     *
     * @param \YoExisto\ContenidoBundle\Entity\Municipio $municipio
     * @return Area
     */
    public function setMunicipio(\YoExisto\ContenidoBundle\Entity\Municipio $municipio = null)
    {
        $this->municipio = $municipio;
    
        return $this;
    }

    /**
     * Get municipio
     *
     * @return \YoExisto\ContenidoBundle\Entity\Municipio 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }



    public function __toString(){
        return "" . $this->nombre;
    }
}