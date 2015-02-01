<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 11/29/14
 * Time: 2:17 PM
 */
namespace YoExisto\ContenidoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
     * @var string
     */
    private $activacion;

    /**
     * @var string
     */
    private $foto;


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

    /**
     * @return string
     */
    public function getActivacion()
    {
        return $this->activacion;
    }

    /**
     * @param string $activacion
     */
    public function setActivacion($activacion)
    {
        $this->activacion = $activacion;
    }




    

    /**
     * Set foto
     *
     * @param string $foto
     * @return Que
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }





    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    private $path;

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        // return __DIR__.'/../../../../web/'.$this->getUploadDir();
        return $this->get('kernel')->getRootDir().'/../web/' .$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/profile/';
    }



    public function upload(   $upload_dir   )
    {



        $upload_dir = $upload_dir . $this->getUploadDir();

        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $upload_dir ,
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->foto = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }




}