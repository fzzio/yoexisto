<?php

namespace YoExisto\ContenidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 */
class Municipio
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $areas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Municipio
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
     * @return Municipio
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
     * Add areas
     *
     * @param \YoExisto\ContenidoBundle\Entity\Area $areas
     * @return Municipio
     */
    public function addArea(\YoExisto\ContenidoBundle\Entity\Area $areas)
    {
        $this->areas[] = $areas;
    
        return $this;
    }

    /**
     * Remove areas
     *
     * @param \YoExisto\ContenidoBundle\Entity\Area $areas
     */
    public function removeArea(\YoExisto\ContenidoBundle\Entity\Area $areas)
    {
        $this->areas->removeElement($areas);
    }

    /**
     * Get areas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreas()
    {
        return $this->areas;
    }



    public function __toString(){
        return "" . $this->nombre;
    }

}
