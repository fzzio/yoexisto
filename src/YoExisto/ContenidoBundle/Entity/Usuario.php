<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 11/29/14
 * Time: 2:17 PM
 */
namespace YoExisto\ContenidoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class Usuario extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * @var string
     */
    private $cedula;



    /**
     * Set cedula
     *
     * @param string $cedula
     * @return Usuario
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    
        return $this;
    }

    /**
     * Get cedula
     *
     * @return string 
     */
    public function getCedula()
    {
        return $this->cedula;
    }
    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}