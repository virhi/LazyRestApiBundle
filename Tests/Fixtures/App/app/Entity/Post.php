<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 10/01/15
 * Time: 02:32
 */
namespace Virhi\LazyRestApiBundle\Tests\Fixtures\App\app\Entity;

class Post 
{
    protected $id;
    protected $titre;
    protected $post;
    protected $sousTitre;
    protected $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getSousTitre()
    {
        return $this->sousTitre;
    }

    /**
     * @param mixed $sousTitre
     */
    public function setSousTitre($sousTitre)
    {
        $this->sousTitre = $sousTitre;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }


} 