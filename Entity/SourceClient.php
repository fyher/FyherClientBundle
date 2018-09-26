<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 26/09/2018
 * Time: 15:32
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="SourceClient_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\SourceClientRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SourceClient
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
    private $dateCreationSourceClient;

    /**
     * @ORM\ManyToMany(targetEntity="Fyher\ClientBundle\Entity\Source")
     */
    private $idSource;

    public function __construct()
    {
        $this->idSource = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreationSourceClient(): ?\DateTimeInterface
    {
        return $this->dateCreationSourceClient;
    }

    public function setDateCreationSourceClient(\DateTimeInterface $dateCreationSourceClient): self
    {
        $this->dateCreationSourceClient = $dateCreationSourceClient;

        return $this;
    }

    /**
     * @return Collection|Source[]
     */
    public function getIdSource(): Collection
    {
        return $this->idSource;
    }

    public function addIdSource(Source $idSource): self
    {
        if (!$this->idSource->contains($idSource)) {
            $this->idSource[] = $idSource;
        }

        return $this;
    }

    public function removeIdSource(Source $idSource): self
    {
        if ($this->idSource->contains($idSource)) {
            $this->idSource->removeElement($idSource);
        }

        return $this;
    }
}