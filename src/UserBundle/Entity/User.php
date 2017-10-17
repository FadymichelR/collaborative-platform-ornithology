<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Image;
use AppBundle\Entity\Observation;

/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"})
 */
class User extends FOSUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * 
     * @Assert\NotBlank(message="core.validation.user.firstname.blank", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="core.validation.user.firstname.min",
     *     maxMessage="core.validation.user.firstname.max",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     *
     * @Assert\NotBlank(message="core.validation.user.surname.blank", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="core.validation.user.surname.min",
     *     maxMessage="core.validation.user.surname.max",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Observation", mappedBy="user", cascade={"persist"})
     * @Assert\Valid()
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="user", cascade={"persist"})
     * @Assert\Valid()
     */
    private $images;




    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->observations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }




    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        //we update the Username too
        $this->setUsername($email);

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add an Observation
     *
     * @param \AppBundle\Entity\Observation $observation
     *
     * @return Observation
     */
    public function addObservation(Observation $observation)
    {
        $this->observations[] = $observation;

        $observation->setUser($this);

        return $this;
    }

    /**
     * Remove an Observation
     *
     * @param \AppBundle\Entity\Observation $observation
     */
    public function removeObservation(Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * Get Observations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Add an Image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Image
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        $image->setUser($this);

        return $this;
    }

    /**
     * Remove an Image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get Images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }




    /**
     * Mandatory, from UserInterface
     */
    public function getUsername()
    {
        return $this->email;
    }
}

