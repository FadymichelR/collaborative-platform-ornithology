<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObservationRepository")
 */
class Observation
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
     * @ORM\Column(name="longitude", type="string", length=255)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="lattitude", type="string", length=255)
     */
    private $lattitude;

    /**
     * @var string
     *
     * @ORM\Column(name="country",  type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", inversedBy="observation", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     *
     * @ORM\Column(name="bird_id", type="integer")
     */
    private $birdId;

    /**
     * @var string
     *
     * @ORM\Column(name="birdName", type="string", length=255)
     */
    private $birdName;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="seen", type="boolean")
     */
    private $seen;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="observations", cascade={"persist"})
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
     *
     * @return Observation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set lattiude
     *
     * @param string $lattitude
     *
     * @return Observation
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;
        return $this;
    }

    /**
     * Get lattiude
     *
     * @return string
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Observation
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Observation
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Observation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function setImage($file)
    {
        $this->image = $file;
    }
    
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set seen
     *
     * @param boolean $seen
     *
     * @return Observation
     */
    public function setSeen($seen)
    {
        $this->seen = $seen;
        return $this;
    }
    /**
     * Get seen
     *
     * @return boolean
     */
    public function getSeen()
    {
        return $this->seen;
    }
    /**
     * Set satus
     *
     * @param boolean $satus
     *
     * @return Observation
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * Get satus
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set birdName
     *
     * @param string $birdName
     *
     * @return Observation
     */
    public function setBirdName($birdName)
    {
        $this->birdName = $birdName;

        return $this;
    }

    /**
     * Get birdName
     *
     * @return string
     */
    public function getBirdName()
    {
        return $this->birdName;
    }

    /**
     * Set birdId
     *
     * @param integer $birdId
     *
     * @return Observation
     */
    public function setBirdId($birdId)
    {
        $this->birdId = $birdId;

        return $this;
    }

    /**
     * Get birdId
     *
     * @return integer
     */
    public function getBirdId()
    {
        return $this->birdId;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Observation
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
