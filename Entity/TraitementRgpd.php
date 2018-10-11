<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 27/09/2018
 * Time: 07:56
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="TraitementRgpd")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\TraitementRgpdRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TraitementRgpd
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;


    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $numeroActiviteTraitement;


    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateTraitement;

    /**
     * @var integer
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $designationActiviteTraitement;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $nomResponsableTraitement;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $nomLogicielTraitement;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $objectifTraitement;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $categoriePersonnesTraitement;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $categorieDonneeCollecteeTraitement;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $sensibleDonneeTraitement;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $dureeConservationDonneeTraitement;

    /**
     * @var text
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $mesureSecuriteTraitement;


    /**
     * @ORM\PrePersist
     */
    public function setDate()
    {
        $this->dateTraitement=new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroActiviteTraitement(): ?int
    {
        return $this->numeroActiviteTraitement;
    }

    public function setNumeroActiviteTraitement(int $numeroActiviteTraitement): self
    {
        $this->numeroActiviteTraitement = $numeroActiviteTraitement;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->dateTraitement;
    }

    public function setDateTraitement(\DateTimeInterface $dateTraitement): self
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    public function getDesignationActiviteTraitement(): ?string
    {
        return $this->designationActiviteTraitement;
    }

    public function setDesignationActiviteTraitement(string $designationActiviteTraitement): self
    {
        $this->designationActiviteTraitement = $designationActiviteTraitement;

        return $this;
    }

    public function getNomResponsableTraitement(): ?string
    {
        return $this->nomResponsableTraitement;
    }

    public function setNomResponsableTraitement(string $nomResponsableTraitement): self
    {
        $this->nomResponsableTraitement = $nomResponsableTraitement;

        return $this;
    }

    public function getNomLogicielTraitement(): ?string
    {
        return $this->nomLogicielTraitement;
    }

    public function setNomLogicielTraitement(string $nomLogicielTraitement): self
    {
        $this->nomLogicielTraitement = $nomLogicielTraitement;

        return $this;
    }

    public function getObjectifTraitement(): ?string
    {
        return $this->objectifTraitement;
    }

    public function setObjectifTraitement(string $objectifTraitement): self
    {
        $this->objectifTraitement = $objectifTraitement;

        return $this;
    }

    public function getCategoriePersonnesTraitement(): ?string
    {
        return $this->categoriePersonnesTraitement;
    }

    public function setCategoriePersonnesTraitement(string $categoriePersonnesTraitement): self
    {
        $this->categoriePersonnesTraitement = $categoriePersonnesTraitement;

        return $this;
    }

    public function getCategorieDonneeCollecteeTraitement(): ?string
    {
        return $this->categorieDonneeCollecteeTraitement;
    }

    public function setCategorieDonneeCollecteeTraitement(string $categorieDonneeCollecteeTraitement): self
    {
        $this->categorieDonneeCollecteeTraitement = $categorieDonneeCollecteeTraitement;

        return $this;
    }

    public function getSensibleDonneeTraitement(): ?bool
    {
        return $this->sensibleDonneeTraitement;
    }

    public function setSensibleDonneeTraitement(bool $sensibleDonneeTraitement): self
    {
        $this->sensibleDonneeTraitement = $sensibleDonneeTraitement;

        return $this;
    }

    public function getDureeConservationDonneeTraitement(): ?int
    {
        return $this->dureeConservationDonneeTraitement;
    }

    public function setDureeConservationDonneeTraitement(int $dureeConservationDonneeTraitement): self
    {
        $this->dureeConservationDonneeTraitement = $dureeConservationDonneeTraitement;

        return $this;
    }

    public function getMesureSecuriteTraitement(): ?string
    {
        return $this->mesureSecuriteTraitement;
    }

    public function setMesureSecuriteTraitement(string $mesureSecuriteTraitement): self
    {
        $this->mesureSecuriteTraitement = $mesureSecuriteTraitement;

        return $this;
    }
}