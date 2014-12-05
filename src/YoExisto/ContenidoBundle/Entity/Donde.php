<?php

namespace YoExisto\ContenidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donde
 */
class Donde
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
    private $latitud;

    /**
     * @var string
     */
    private $longitud;

    /**
     * @var string
     */
    private $descripcion;


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
     * @return Donde
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
     * Set latitud
     *
     * @param string $latitud
     * @return Donde
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    
        return $this;
    }

    /**
     * Get latitud
     *
     * @return string 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     * @return Donde
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    
        return $this;
    }

    /**
     * Get longitud
     *
     * @return string 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Donde
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
     * @var \YoExisto\ContenidoBundle\Entity\Municipio
     */
    private $municipio;

    /**
     * @var \YoExisto\ContenidoBundle\Entity\Area
     */
    private $area;


    /**
     * Set municipio
     *
     * @param \YoExisto\ContenidoBundle\Entity\Municipio $municipio
     * @return Donde
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

    /**
     * Set area
     *
     * @param \YoExisto\ContenidoBundle\Entity\Area $area
     * @return Donde
     */
    public function setArea(\YoExisto\ContenidoBundle\Entity\Area $area = null)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area
     *
     * @return \YoExisto\ContenidoBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }
}