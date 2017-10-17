<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Observation",inversedBy="image")
     * @ORM\JoinColumn(nullable=true)
     */
    private $observation;

    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    private $file;

    const PATH = '%kernel.project_dir%/web/uploads/images';

    public function upload()
    {   
        $name = md5(uniqid()).'.'.$this->file->getClientOriginalName();
        $this->file->move(self::PATH, $name);
        $this->image = $name;
        return;
    }

    public function getFile()
    {
    return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
    $this->file = $file;
    }

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
    public function setObservation(\AppBundle\Entity\Observation $observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return \AppBundle\Entity\Observation
     */
    public function getObservation()
    {
        return $this->observation;
    }
}
