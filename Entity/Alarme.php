<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 26/09/2018
 * Time: 15:29
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Fyher\ClientBundle\Validator\Constraints as FyherAssert;

/**
 * @ORM\Table(name="Alarme_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\AlarmeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Alarme
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
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreationAlarme;


    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateRappelAlarme;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $titreAlarme;


    /**
     * @var text
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $descriptionAlarme;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Email()
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $emailRappelAlarme;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @FyherAssert\Telephone()
     */
    private $mobileRappelAlarme;


    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $luAlarme;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLuAlarme;


    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $idClient;



    /**
     * @ORM\PrePersist
     */
    public function setDate()
    {
        $this->dateCreationAlarme=new \DateTime();
        $this->lulAlarme=false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreationAlarme(): ?\DateTimeInterface
    {
        return $this->dateCreationAlarme;
    }

    public function setDateCreationAlarme(\DateTimeInterface $dateCreationAlarme): self
    {
        $this->dateCreationAlarme = $dateCreationAlarme;

        return $this;
    }

    public function getDateRappelAlarme(): ?\DateTimeInterface
    {
        return $this->dateRappelAlarme;
    }

    public function setDateRappelAlarme(\DateTimeInterface $dateRappelAlarme): self
    {
        $this->dateRappelAlarme = $dateRappelAlarme;

        return $this;
    }

    public function getTitreAlarme(): ?string
    {
        return $this->titreAlarme;
    }

    public function setTitreAlarme(string $titreAlarme): self
    {
        $this->titreAlarme = $titreAlarme;

        return $this;
    }

    public function getDescriptionAlarme(): ?string
    {
        return $this->descriptionAlarme;
    }

    public function setDescriptionAlarme(string $descriptionAlarme): self
    {
        $this->descriptionAlarme = $descriptionAlarme;

        return $this;
    }

    public function getEmailRappelAlarme(): ?string
    {
        return $this->emailRappelAlarme;
    }

    public function setEmailRappelAlarme(string $emailRappelAlarme): self
    {
        $this->emailRappelAlarme = $emailRappelAlarme;

        return $this;
    }

    public function getMobileRappelAlarme(): ?string
    {
        return $this->mobileRappelAlarme;
    }

    public function setMobileRappelAlarme(string $mobileRappelAlarme): self
    {
        $this->mobileRappelAlarme = $mobileRappelAlarme;

        return $this;
    }

    public function getLuAlarme(): ?bool
    {
        return $this->luAlarme;
    }

    public function setLuAlarme(bool $luAlarme): self
    {
        $this->luAlarme = $luAlarme;

        return $this;
    }

    public function getDateLuAlarme(): ?\DateTimeInterface
    {
        return $this->dateLuAlarme;
    }

    public function setDateLuAlarme(\DateTimeInterface $dateLuAlarme): self
    {
        $this->dateLuAlarme = $dateLuAlarme;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }



   
}