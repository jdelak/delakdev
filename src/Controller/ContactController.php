<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\ContactType;


class ContactController extends AbstractController
{

    /**
     * @Route("contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer){
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

        	$username = $form['name']->getData();
        	$mail = $form['email']->getData();
        	$sujet = $form['sujet']->getData();
        	$body = $form['message']->getData();;


            $transport = (new \Swift_SmtpTransport('in-v3.mailjet.com', 587))
                ->setUsername('11f25530c2b8a196cf224f83b9ace0c6')
                ->setPassword('c416a06275a7f65bf435cfd5a680f0cb')
                ->setEncryption('tls')
                ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false))
            );
            $mailer = new \Swift_Mailer($transport);
 
            $message = (new \Swift_Message('Vous avez un nouveau message sur votre site perso de '.$username))
                ->setFrom(['delakdev@gmail.com' => 'moi'])
                ->setTo(['delakdev@gmail.com' => 'Julien Delacourt'])
                ->setBody(
                	 $this->renderView(
	                'mails/contact.html.twig',
	                array('name' => $username, 'email' => $mail, 'sujet' => $sujet, 'message'=> $body)
            		),
            'text/html'
                );


            

            $mailer->send($message);

        }

        return $this->render('contact.html.twig',[
            'form' => $form->createView()
        ]);
    }
}




