<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 26/09/2018
 * Time: 15:25
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="Source_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\SourceRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Source
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
     */
    private $nomSource;


    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Url()
     */
    private $urlSource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSource(): ?string
    {
        return $this->nomSource;
    }

    public function setNomSource(string $nomSource): self
    {
        $this->nomSource = $nomSource;

        return $this;
    }

    public function getUrlSource(): ?string
    {
        return $this->urlSource;
    }

    public function setUrlSource(?string $urlSource): self
    {
        $this->urlSource = $urlSource;

        return $this;
    }


}