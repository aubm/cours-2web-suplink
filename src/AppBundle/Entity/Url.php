<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="urls")
 */
class Url
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="original_url", type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner une url")
     * @Assert\Url(message="Cette valeur n'est pas une url valide")
     */
    private $original_url;

    /**
     * @ORM\Column(name="shortened_url", type="string", length=255)
     */
    private $shortened_url;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="hits", type="integer")
     */
    private $hits;

    public function __construct()
    {
        $this->hits = 0;
        $this->shortened_url = 'aaa';
    }

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
    public function getOriginalUrl()
    {
        return $this->original_url;
    }

    /**
     * @param mixed $original_url
     */
    public function setOriginalUrl($original_url)
    {
        $this->original_url = $original_url;
    }

    /**
     * @return mixed
     */
    public function getShortenedUrl()
    {
        return $this->shortened_url;
    }

    /**
     * @param mixed $shortened_url
     */
    public function setShortenedUrl($shortened_url)
    {
        $this->shortened_url = $shortened_url;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param mixed $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }
}