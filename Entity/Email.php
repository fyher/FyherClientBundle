<?php
/**
 * Created by Fyher with PHPSTORM
 * @author: Driaux Cédric - SARL FYHER
 * Date: 12/10/2018
 * Time: 14:38
 */

namespace Fyher\ClientBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="fyher_Email")
 * @ORM\Entity(repositoryClass="Fyher\ClientBundle\Repository\EmailRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Email
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
     * @var text
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $contenuEmail;

    /**
     * @var text
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $sujetEmail;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $dateCreationEmail;


    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $dateEnvoiEmail;


    /**
     * @var text
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $fromEmail;

    /**
     * @var text
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $toEmail;

    /**
     * @var text
     * @ORM\Column(type="text", nullable=true)
     */
    private $idEmail;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $expedieByIdEmail;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="fyher.entity.notblank")
     */
    private $expedieByNomEmail;


    /**
     * @var text
     * @ORM\Column(type="text", nullable=true)
     */
    private $hashEmail;


}