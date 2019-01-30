<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Villano
 *
 * @ORM\Table(name="villano")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VillanoRepository")
 */
class Villano
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="villano", type="string", length=255)
     */
    private $villano;

    /**
     * @var string
     *
     * @ORM\Column(name="superpoder", type="string", length=255)
     */
    private $superpoder;

    /**
     * @var string
     *
     * @ORM\Column(name="escondite", type="string", length=255)
     */
    private $escondite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set villano
     *
     * @param string $villano
     *
     * @return Villano
     */
    public function setVillano($villano)
    {
        $this->villano = $villano;

        return $this;
    }

    /**
     * Get villano
     *
     * @return string
     */
    public function getVillano()
    {
        return $this->villano;
    }

    /**
     * Set superpoder
     *
     * @param string $superpoder
     *
     * @return Villano
     */
    public function setSuperpoder($superpoder)
    {
        $this->superpoder = $superpoder;

        return $this;
    }

    /**
     * Get superpoder
     *
     * @return string
     */
    public function getSuperpoder()
    {
        return $this->superpoder;
    }

    /**
     * Set escondite
     *
     * @param string $escondite
     *
     * @return Villano
     */
    public function setEscondite($escondite)
    {
        $this->escondite = $escondite;

        return $this;
    }

    /**
     * Get escondite
     *
     * @return string
     */
    public function getEscondite()
    {
        return $this->escondite;
    }
}

