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
 * @Gedmo\Loggable(logEntryClass="Gedmo\Loggable\Entity\LogEntry")
 *
 */
abstract class Client
{


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, name="nomClient")
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     * @Gedmo\Versioned()
     */
    private $nomClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     * @Gedmo\Versioned()
     */
    private $prenomClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, length=200)
     * @Assert\Email()
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Gedmo\Versioned()
     */
    private $emailClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Gedmo\Versioned()
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
     * @Gedmo\Versioned()
     */
    private $numeroFixeClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true,length=35)
     * @FyherAssert\Telephone()
     * @Gedmo\Versioned()
     */
    private $numeroMobileClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=4,
     *     max=6,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     * @Gedmo\Versioned()
     */
    private $codePostalClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Country()
     * @Gedmo\Versioned()
     */
    private $paysClient;

    /**
     * @var date
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Gedmo\Versioned()
     */
    private $dateNaissanceClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $professionClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailValideClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $telephoneValideFixClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $telephoneFauxNumFixClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $telephoneValideMobClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $telephoneFauxNumMobClient;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbEnfantClient;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $impositionClient;

    /**
     * @ORM\ManyToOne(targetEntity="Fyher\ClientBundle\Entity\Csp" , fetch="EXTRA_LAZY" )
     */
    private $cspClient;

    /**
     * @ORM\ManyToOne(targetEntity="Fyher\ClientBundle\Entity\Situation" )
     */
    private $situationClient;

    /**
     * @ORM\ManyToOne(targetEntity="Fyher\ClientBundle\Entity\TrancheRevenu" )
     */
    private $trancheRevenuClient;

    /**
     * @var date
     * @ORM\Column(type="date", nullable=true)
     */
    private $anneImpositionClient;

    /**
     * @var date
     * @ORM\Column(type="date", nullable=true)
     */
    private $anneTrancheRevenuClient;


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
     * @Gedmo\Versioned()
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
     * @Gedmo\Versioned()
     */
    private $codeInseeVilleClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     max=254,
     *     minMessage="fyher.entity.minlengh",
     * maxMessage="fyher.entity.maxlength"
     * )
     * @Gedmo\Versioned()
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
     * @Gedmo\Versioned()
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
     * @Gedmo\Versioned()
     */
    private $departementCodeClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreationClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Versioned()
     */
    private $dateUpdateClient;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, length=255)
     *
     */
    private $hashClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     * @Gedmo\Versioned()
     */
    private $optinClient;

    /**
     * @var floaat
     * @ORM\Column(type="float", nullable=true)
     *
     */
    private $longitudeClient;


    /**
     * @var floaat
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitudeClient;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Gedmo\Versioned()
     *
     */
    private $civiliteClient;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\GreaterThanOrEqual("- 18 years")
     */
    private $dateAnniversaireClient;


    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rgpdActiveClient;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     * @Gedmo\Versioned()
     */
    private $activeClient;

    /**
     * @var text
     * @Gedmo\Slug(fields={"hashClient"})
     * @ORM\Column(length=255,nullable=true)
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

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(?string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(?string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(?string $emailClient): self
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getStatutClient(): ?string
    {
        return $this->statutClient;
    }

    public function setStatutClient(?string $statutClient): self
    {
        $this->statutClient = $statutClient;

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

    public function setCodePostalClient(?string $codePostalClient): self
    {
        $this->codePostalClient = $codePostalClient;

        return $this;
    }

    public function getPaysClient(): ?string
    {
        return $this->paysClient;
    }

    public function setPaysClient(?string $paysClient): self
    {
        $this->paysClient = $paysClient;

        return $this;
    }

    public function getVilleClient(): ?string
    {
        return $this->villeClient;
    }

    public function setVilleClient(?string $villeClient): self
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

    public function setAdresseClient(?string $adresseClient): self
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

    public function setDateCreationClient(?\DateTimeInterface $dateCreationClient): self
    {
        $this->dateCreationClient = $dateCreationClient;

        return $this;
    }

    public function getDateUpdateClient(): ?\DateTimeInterface
    {
        return $this->dateUpdateClient;
    }

    public function setDateUpdateClient(?\DateTimeInterface $dateUpdateClient): self
    {
        $this->dateUpdateClient = $dateUpdateClient;

        return $this;
    }

    public function getHashClient(): ?string
    {
        return $this->hashClient;
    }

    public function setHashClient(?string $hashClient): self
    {
        $this->hashClient = $hashClient;

        return $this;
    }

    public function getOptinClient(): ?bool
    {
        return $this->optinClient;
    }

    public function setOptinClient(?bool $optinClient): self
    {
        $this->optinClient = $optinClient;

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

    public function getCiviliteClient(): ?string
    {
        return $this->civiliteClient;
    }

    public function setCiviliteClient(?string $civiliteClient): self
    {
        $this->civiliteClient = $civiliteClient;

        return $this;
    }

    public function getDateAnniversaireClient(): ?\DateTimeInterface
    {
        return $this->dateAnniversaireClient;
    }

    public function setDateAnniversaireClient(?\DateTimeInterface $dateAnniversaireClient): self
    {
        $this->dateAnniversaireClient = $dateAnniversaireClient;

        return $this;
    }

    public function getRgpdActiveClient(): ?bool
    {
        return $this->rgpdActiveClient;
    }

    public function setRgpdActiveClient(?bool $rgpdActiveClient): self
    {
        $this->rgpdActiveClient = $rgpdActiveClient;

        return $this;
    }

    public function getActiveClient(): ?bool
    {
        return $this->activeClient;
    }

    public function setActiveClient(?bool $activeClient): self
    {
        $this->activeClient = $activeClient;

        return $this;
    }

    public function getSlugClient(): ?string
    {
        return $this->slugClient;
    }

    public function setSlugClient(?string $slugClient): self
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

    public function getDateNaissanceClient(): ?\DateTimeInterface
    {
        return $this->dateNaissanceClient;
    }

    public function setDateNaissanceClient(?\DateTimeInterface $dateNaissanceClient): self
    {
        $this->dateNaissanceClient = $dateNaissanceClient;

        return $this;
    }

    public function getProfessionClient(): ?string
    {
        return $this->professionClient;
    }

    public function setProfessionClient(?string $professionClient): self
    {
        $this->professionClient = $professionClient;

        return $this;
    }

    public function getEmailValideClient(): ?bool
    {
        return $this->emailValideClient;
    }

    public function setEmailValideClient(?bool $emailValideClient): self
    {
        $this->emailValideClient = $emailValideClient;

        return $this;
    }

    public function getTelephoneValideClient(): ?bool
    {
        return $this->telephoneValideClient;
    }

    public function setTelephoneValideClient(?bool $telephoneValideClient): self
    {
        $this->telephoneValideClient = $telephoneValideClient;

        return $this;
    }

    public function getTelephoneFauxNumClient(): ?bool
    {
        return $this->telephoneFauxNumClient;
    }

    public function setTelephoneFauxNumClient(?bool $telephoneFauxNumClient): self
    {
        $this->telephoneFauxNumClient = $telephoneFauxNumClient;

        return $this;
    }

    public function getNbEnfantClient(): ?int
    {
        return $this->nbEnfantClient;
    }

    public function setNbEnfantClient(?int $nbEnfantClient): self
    {
        $this->nbEnfantClient = $nbEnfantClient;

        return $this;
    }

    public function getImpositionClient(): ?float
    {
        return $this->impositionClient;
    }

    public function setImpositionClient(?float $impositionClient): self
    {
        $this->impositionClient = $impositionClient;

        return $this;
    }

    public function getAnneImpositionClient(): ?\DateTimeInterface
    {
        return $this->anneImpositionClient;
    }

    public function setAnneImpositionClient(?\DateTimeInterface $anneImpositionClient): self
    {
        $this->anneImpositionClient = $anneImpositionClient;

        return $this;
    }

    public function getAnneTrancheRevenuClient(): ?\DateTimeInterface
    {
        return $this->anneTrancheRevenuClient;
    }

    public function setAnneTrancheRevenuClient(?\DateTimeInterface $anneTrancheRevenuClient): self
    {
        $this->anneTrancheRevenuClient = $anneTrancheRevenuClient;

        return $this;
    }

    public function getCspClient(): ?Csp
    {
        return $this->cspClient;
    }

    public function setCspClient(?Csp $cspClient): self
    {
        $this->cspClient = $cspClient;

        return $this;
    }

    public function getSituationClient(): ?Situation
    {
        return $this->situationClient;
    }

    public function setSituationClient(?Situation $situationClient): self
    {
        $this->situationClient = $situationClient;

        return $this;
    }

    public function getTrancheRevenuClient(): ?TrancheRevenu
    {
        return $this->trancheRevenuClient;
    }

    public function setTrancheRevenuClient(?TrancheRevenu $trancheRevenuClient): self
    {
        $this->trancheRevenuClient = $trancheRevenuClient;

        return $this;
    }

    public function getTelephoneValideFixClient(): ?bool
    {
        return $this->telephoneValideFixClient;
    }

    public function setTelephoneValideFixClient(?bool $telephoneValideFixClient): self
    {
        $this->telephoneValideFixClient = $telephoneValideFixClient;

        return $this;
    }

    public function getTelephoneFauxNumFixClient(): ?bool
    {
        return $this->telephoneFauxNumFixClient;
    }

    public function setTelephoneFauxNumFixClient(?bool $telephoneFauxNumFixClient): self
    {
        $this->telephoneFauxNumFixClient = $telephoneFauxNumFixClient;

        return $this;
    }

    public function getTelephoneValideMobClient(): ?bool
    {
        return $this->telephoneValideMobClient;
    }

    public function setTelephoneValideMobClient(?bool $telephoneValideMobClient): self
    {
        $this->telephoneValideMobClient = $telephoneValideMobClient;

        return $this;
    }

    public function getTelephoneFauxNumMobClient(): ?bool
    {
        return $this->telephoneFauxNumMobClient;
    }

    public function setTelephoneFauxNumMobClient(?bool $telephoneFauxNumMobClient): self
    {
        $this->telephoneFauxNumMobClient = $telephoneFauxNumMobClient;

        return $this;
    }







}