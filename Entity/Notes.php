<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 26/09/2018
 * Time: 15:51
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="Notes_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\NotesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Notes
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
     * @var string
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $titreNote;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Length(
     *     min=1,
     *     minMessage="fyher.entity.minlengh"
     * )
     */
    private $descriptionNote;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreationNote;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
    * @Assert\Email()
     */
    private $emailAuteurNote;


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
        $this->dateCreationNote=new \DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreNote(): ?string
    {
        return $this->titreNote;
    }

    public function setTitreNote(string $titreNote): self
    {
        $this->titreNote = $titreNote;

        return $this;
    }

    public function getDescriptionNote(): ?string
    {
        return $this->descriptionNote;
    }

    public function setDescriptionNote(string $descriptionNote): self
    {
        $this->descriptionNote = $descriptionNote;

        return $this;
    }

    public function getDateCreationNote(): ?\DateTimeInterface
    {
        return $this->dateCreationNote;
    }

    public function setDateCreationNote(\DateTimeInterface $dateCreationNote): self
    {
        $this->dateCreationNote = $dateCreationNote;

        return $this;
    }

    public function getEmailAuteurNote(): ?string
    {
        return $this->emailAuteurNote;
    }

    public function setEmailAuteurNote(string $emailAuteurNote): self
    {
        $this->emailAuteurNote = $emailAuteurNote;

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