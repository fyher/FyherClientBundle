<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 11/10/2018
 * Time: 09:20
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="TrancheRevenu_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\TrancheRevenuRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TrancheRevenu
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
     * @ORM\Column(type="text", nullable=true)
    * @Assert\NotBlank(message="fyher.entity.notblank")
     *
     */
    private $nom;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Type(type="integer")
     */
    private $valeurMin;


    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     * @Assert\Type(type="integer")
     */
    private $valeurMax;

    public function getInfo(){
        return $this->nom." - ".number_format($this->valeurMin,0)."€ à ".number_format($this->valeurMax,0)."€";
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeurMin(): ?int
    {
        return $this->valeurMin;
    }

    public function setValeurMin(?int $valeurMin): self
    {
        $this->valeurMin = $valeurMin;

        return $this;
    }

    public function getValeurMax(): ?int
    {
        return $this->valeurMax;
    }

    public function setValeurMax(?int $valeurMax): self
    {
        $this->valeurMax = $valeurMax;

        return $this;
    }

}