<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

     /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Observation",mappedBy="image")
     * @ORM\JoinColumn(nullable=true)
     */
    private $observation;

    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="images", cascade={"persist"})
     * @Assert\Valid()
     */
    private $user;


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
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set observation
     *
     * @param \AppBundle\Entity\Observation $observation
     *
     * @return Image
     */
    public function setObservation(\AppBundle\Entity\Observation $observation = null)
    {
        $this->Observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return \AppBundle\Entity\Observation
     */
    public function getObservation()
    {
        return $this->Observation;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Image
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
