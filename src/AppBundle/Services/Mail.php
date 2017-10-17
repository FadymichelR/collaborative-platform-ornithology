<?php
namespace AppBundle\Services;

class Mail
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

	public function send($from,$to,$subject,$body) {

      $message = \Swift_Message::newInstance()
      ->setSubject($subject)
      ->setFrom($from)
      ->setTo($to)
      ->setBody($body,
          'text/html'
      );
      $this->mailer->send($message);

	}

}