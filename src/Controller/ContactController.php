<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(\Swift_Mailer $mailer, Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $subject = $contact->getSubject();
            $body = $contact->getBody();
            

            $message = (new \Swift_Message($subject))
            ->setFrom('runmap@gmail.com')
            ->setTo('kevalois@gmail.com')
            ->setBody(
                $this->renderView(
                    'email/contact.html.twig',[
                    'subject' => $subject,
                    'body' => $body
                    ]),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Message envoyé');

            return $this->redirectToRoute('home');

        }

        return $this->render('contact/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}