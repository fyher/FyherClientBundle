<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 11/10/2018
 * Time: 09:19
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="Situation_fyher")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\SituationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Situation
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
    private $nom;
}