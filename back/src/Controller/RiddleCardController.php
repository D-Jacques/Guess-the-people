<?php

namespace App\Controller;

use App\Entity\RiddleCard;
use App\Form\Type\RiddleCardType;
use App\Repository\RiddleCardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/backoffice/riddle", "backoffice_riddle_")]
class RiddleCardController extends AbstractController {

    #[Route("/", "list")]
    public function list(RiddleCardRepository $riddleCardRepository) : Response {
        
        $riddles = $riddleCardRepository->findAll();

        return $this->render("riddle/list.html.twig", [
            'riddles' => $riddles
        ]);

    }

    #[Route("/new", "new")]
    public function new(Request $request, EntityManagerInterface $em){

        $riddleCard = new RiddleCard();

        $form = $this->createForm(RiddleCardType::class, $riddleCard);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $riddleCard = $form->getData();

            $em->persist($riddleCard);
            $em->flush();

            return $this->redirectToRoute("backoffice_riddle_list");
        }

        return $this->render("riddle/new.html.twig", [
            'riddleCard' => $riddleCard,
            'form' => $form
        ]);

    }

    #[Route("/edit/{riddleCard}", 'edit')]
    public function edit(RiddleCard $riddleCard, Request $request, EntityManagerInterface $em){

        $form = $this->createForm(RiddleCardType::class, $riddleCard);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->flush($riddleCard);

            return $this->redirectToRoute("backoffice_riddle_list");
        }

        return $this->render("riddle/edit.html.twig", [
            'riddleCard' => $riddleCard,
            'form' => $form
        ]);

    }

    #[Route('/delete/{riddleCard}', 'delete')]
    public function delete(RiddleCard $riddleCard, EntityManagerInterface $em){
        
        try{
            $em->remove($riddleCard);
            $em->flush();
            $this->addFlash("success", "Devinette supprimée ave succès");
        } catch (\Exception $e){
            $this->addFlash("error", "Une erreur s'est produite durant la suppression : ". $e->getMessage() );
        }

        return $this->redirectToRoute('backoffice_riddle_list');
    }

}