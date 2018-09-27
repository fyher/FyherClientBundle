<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 27/09/2018
 * Time: 07:54
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="Param_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\ParamRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Param
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
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $nomParam;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $valueParam;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomParam(): ?string
    {
        return $this->nomParam;
    }

    public function setNomParam(string $nomParam): self
    {
        $this->nomParam = $nomParam;

        return $this;
    }

    public function getValueParam(): ?string
    {
        return $this->valueParam;
    }

    public function setValueParam(?string $valueParam): self
    {
        $this->valueParam = $valueParam;

        return $this;
    }

   
}