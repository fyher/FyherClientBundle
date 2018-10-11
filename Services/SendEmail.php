<?php
namespace Fyher\ClientBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Templating\EngineInterface;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\TranslatorInterface;

class SendEmail
{
    protected $mailer;
    protected $templating;
    protected $em;
    protected $translate;


    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, EntityManagerInterface $em,TranslatorInterface $translate)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->em = $em;
        $this->translate=$translate;


    }


    public function envoiEmail($template,$to,$subject,$body){


        $body = $this->templating->render($template,array("contenu"=>$body));
        return $this->sendMessage($to, $this->translate->trans($subject), $body);

    }

    protected function sendMessage($to, $subject, $body)
    {
        $mail = (new \Swift_Message());

        $mail->setFrom("contact@fyher.com","test" )
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType("text/html");

        return $this->mailer->send($mail);
    }
}