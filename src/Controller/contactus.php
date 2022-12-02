<?php
namespace App\Controller;

use App\Entity\Client;
use App\Form\ContactusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class contactus extends AbstractController {
    #[Route('/contactus', name: 'app_contactus')]
    public function addclient (Request $request,ManagerRegistry $doctrine): Response{
        $client = new Client();
        $form = $this->createForm(ContactusType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($client);
            $entityManager->flush();
            return new Response('Bienvenue !');
        }

        return $this ->renderForm('contact/contactus.html.twig',[
            'form'=>$form ,
            "controller_name"=>"contactus"]
        );
        

    }

 
} 