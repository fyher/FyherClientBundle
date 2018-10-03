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
     * @ORM\ManyToOne(targetEntity="Fyher\ClientBundle\Entity\Source")
     */
    private $idSource;


    /**
     * @var array
     * @ORM\Column(type="array", nullable=false)
     */
    private $dataSourceClient;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=false)
     */
    private $idClient;

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

    public function getIdSource(): ?Source
    {
        return $this->idSource;
    }

    public function setIdSource(?Source $idSource): self
    {
        $this->idSource = $idSource;

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

    public function getDataSourceClient()
    {
        return $this->dataSourceClient;
    }

    public function setDataSourceClient($dataSourceClient): self
    {
        $this->dataSourceClient = $dataSourceClient;

        return $this;
    }

}