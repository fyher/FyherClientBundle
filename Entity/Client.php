<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 26/09/2018
 * Time: 09:21
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Fyher\ClientBundle\Validator\Constraints\Telephone;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Fyher\ClientBundle\Validator\Constraints as FyherAssert;



/**
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("emailClient")
 */
abstract  class Client
{


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, name="nomClient")
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $nomClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $prenomClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, length=200)
     * @Assert\Email()
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $emailClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $statutClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true,length=35)
     * @FyherAssert\Telephone()
     *  @Assert\Length(
     *     min=1,
     *     max=12,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $numeroFixeClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true,length=35)
     * @FyherAssert\Telephone()
     */
    private $numeroMobileClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=4,
     *     max=6,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $codePostalClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Country()
     */
    private $paysClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     max=50,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $villeClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     max=50,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $codeInseeVilleClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     max=254,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $adresseClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *     min=1,
     *     max=45,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $departementNomClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *     min=1,
     *     max=3,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     */
    private $departementCodeClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreationClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateUpdateClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, length=255)
     */
    private $hashClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $optinClient;

    /**
     * @var floaat
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitudeClient;


    /**
     * @var floaat
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitudeClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $civiliteClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\GreaterThanOrEqual("- 18 years")
     */
    private $dateAnniversaireClient;


    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $rgpdActiveClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $activeClient;

    /**
     * @var text
     * @Gedmo\Slug(fields={"hashClient"})
     * @ORM\Column(length=255,nullable=false)
     */
    private $slugClient;


    /**
     * @ORM\ManyToMany(targetEntity="Fyher\ClientBundle\Entity\SourceClient" , fetch="EXTRA_LAZY" , cascade={"remove"})
     */
    private $idSourceClient;

    /**
     * @ORM\ManyToMany(targetEntity="Fyher\ClientBundle\Entity\Alarme" , fetch="EXTRA_LAZY" , cascade={"remove"})
     * @ORM\OrderBy({"dateCreationAlarme"="DESC"})
     */
    private $idAlarmeClient;

    /**
     * @ORM\ManyToMany(targetEntity="Fyher\ClientBundle\Entity\Notes" , fetch="EXTRA_LAZY" , cascade={"remove"})
     * @ORM\OrderBy({"dateCreationNote"="DESC"})
     */
    private $idNoteClient;

    public function __construct()
    {
        $this->idSourceClient = new ArrayCollection();
        $this->idAlarmeClient = new ArrayCollection();
        $this->idNoteClient = new ArrayCollection();
    }




    /**
     * @ORM\PrePersist
     */
    public function setDate()
    {
        $this->dateCreationClient=new \DateTime();
        $this->dateUpdateClient=new \DateTime();
        $this->hashClient=md5($this->emailClient).uniqid();
        $this->activeClient=false;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(string $emailClient): self
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getNumeroFixeClient(): ?string
    {
        return $this->numeroFixeClient;
    }

    public function setNumeroFixeClient(?string $numeroFixeClient): self
    {
        $this->numeroFixeClient = $numeroFixeClient;

        return $this;
    }

    public function getNumeroMobileClient(): ?string
    {
        return $this->numeroMobileClient;
    }

    public function setNumeroMobileClient(?string $numeroMobileClient): self
    {
        $this->numeroMobileClient = $numeroMobileClient;

        return $this;
    }

    public function getCodePostalClient(): ?string
    {
        return $this->codePostalClient;
    }

    public function setCodePostalClient(string $codePostalClient): self
    {
        $this->codePostalClient = $codePostalClient;

        return $this;
    }

    public function getPaysClient(): ?string
    {
        return $this->paysClient;
    }

    public function setPaysClient(string $paysClient): self
    {
        $this->paysClient = $paysClient;

        return $this;
    }

    public function getVilleClient(): ?string
    {
        return $this->villeClient;
    }

    public function setVilleClient(string $villeClient): self
    {
        $this->villeClient = $villeClient;

        return $this;
    }

    public function getCodeInseeVilleClient(): ?string
    {
        return $this->codeInseeVilleClient;
    }

    public function setCodeInseeVilleClient(?string $codeInseeVilleClient): self
    {
        $this->codeInseeVilleClient = $codeInseeVilleClient;

        return $this;
    }

    public function getAdresseClient(): ?string
    {
        return $this->adresseClient;
    }

    public function setAdresseClient(string $adresseClient): self
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }

    public function getDepartementNomClient(): ?string
    {
        return $this->departementNomClient;
    }

    public function setDepartementNomClient(?string $departementNomClient): self
    {
        $this->departementNomClient = $departementNomClient;

        return $this;
    }

    public function getDepartementCodeClient(): ?string
    {
        return $this->departementCodeClient;
    }

    public function setDepartementCodeClient(?string $departementCodeClient): self
    {
        $this->departementCodeClient = $departementCodeClient;

        return $this;
    }

    public function getDateCreationClient(): ?\DateTimeInterface
    {
        return $this->dateCreationClient;
    }

    public function setDateCreationClient(\DateTimeInterface $dateCreationClient): self
    {
        $this->dateCreationClient = $dateCreationClient;

        return $this;
    }

    public function getDateUpdateClient(): ?\DateTimeInterface
    {
        return $this->dateUpdateClient;
    }

    public function setDateUpdateClient(\DateTimeInterface $dateUpdateClient): self
    {
        $this->dateUpdateClient = $dateUpdateClient;

        return $this;
    }

    public function getHashClient(): ?string
    {
        return $this->hashClient;
    }

    public function setHashClient(string $hashClient): self
    {
        $this->hashClient = $hashClient;

        return $this;
    }

    public function getOptinClient(): ?bool
    {
        return $this->optinClient;
    }

    public function setOptinClient(bool $optinClient): self
    {
        $this->optinClient = $optinClient;

        return $this;
    }

    public function getActiveClient(): ?bool
    {
        return $this->activeClient;
    }

    public function setActiveClient(bool $activeClient): self
    {
        $this->activeClient = $activeClient;

        return $this;
    }

    public function getSlugClient(): ?string
    {
        return $this->slugClient;
    }

    public function setSlugClient(string $slugClient): self
    {
        $this->slugClient = $slugClient;

        return $this;
    }

    /**
     * @return Collection|SourceClient[]
     */
    public function getIdSourceClient(): Collection
    {
        return $this->idSourceClient;
    }

    public function addIdSourceClient(SourceClient $idSourceClient): self
    {
        if (!$this->idSourceClient->contains($idSourceClient)) {
            $this->idSourceClient[] = $idSourceClient;
        }

        return $this;
    }

    public function removeIdSourceClient(SourceClient $idSourceClient): self
    {
        if ($this->idSourceClient->contains($idSourceClient)) {
            $this->idSourceClient->removeElement($idSourceClient);
        }

        return $this;
    }

    /**
     * @return Collection|Alarme[]
     */
    public function getIdAlarmeClient(): Collection
    {
        return $this->idAlarmeClient;
    }

    public function addIdAlarmeClient(Alarme $idAlarmeClient): self
    {
        if (!$this->idAlarmeClient->contains($idAlarmeClient)) {
            $this->idAlarmeClient[] = $idAlarmeClient;
        }

        return $this;
    }

    public function removeIdAlarmeClient(Alarme $idAlarmeClient): self
    {
        if ($this->idAlarmeClient->contains($idAlarmeClient)) {
            $this->idAlarmeClient->removeElement($idAlarmeClient);
        }

        return $this;
    }

    /**
     * @return Collection|Notes[]
     */
    public function getIdNoteClient(): Collection
    {
        return $this->idNoteClient;
    }

    public function addIdNoteClient(Notes $idNoteClient): self
    {
        if (!$this->idNoteClient->contains($idNoteClient)) {
            $this->idNoteClient[] = $idNoteClient;
        }

        return $this;
    }

    public function removeIdNoteClient(Notes $idNoteClient): self
    {
        if ($this->idNoteClient->contains($idNoteClient)) {
            $this->idNoteClient->removeElement($idNoteClient);
        }

        return $this;
    }

    public function getRgpdActiveClient(): ?bool
    {
        return $this->rgpdActiveClient;
    }

    public function setRgpdActiveClient(bool $rgpdActiveClient): self
    {
        $this->rgpdActiveClient = $rgpdActiveClient;

        return $this;
    }

    public function getCiviliteClient(): ?string
    {
        return $this->civiliteClient;
    }

    public function setCiviliteClient(string $civiliteClient): self
    {
        $this->civiliteClient = $civiliteClient;

        return $this;
    }

    public function getDateAnniversaireClient(): ?\DateTimeInterface
    {
        return $this->dateAnniversaireClient;
    }

    public function setDateAnniversaireClient(\DateTimeInterface $dateAnniversaireClient): self
    {
        $this->dateAnniversaireClient = $dateAnniversaireClient;

        return $this;
    }

    public function getLongitudeClient(): ?float
    {
        return $this->longitudeClient;
    }

    public function setLongitudeClient(?float $longitudeClient): self
    {
        $this->longitudeClient = $longitudeClient;

        return $this;
    }

    public function getLatitudeClient(): ?float
    {
        return $this->latitudeClient;
    }

    public function setLatitudeClient(?float $latitudeClient): self
    {
        $this->latitudeClient = $latitudeClient;

        return $this;
    }

    public function getStatutClient(): ?string
    {
        return $this->statutClient;
    }

    public function setStatutClient(string $statutClient): self
    {
        $this->statutClient = $statutClient;

        return $this;
    }
   






}