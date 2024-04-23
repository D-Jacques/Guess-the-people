<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

// TODO : Adapter le controller User pour avoir un crud User avec la même methodologie que
// Pour riddleController

#[Route('/backoffice/user', 'backoffice_user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($selectedUserRoles = explode(',', $user->getRoles()[0]))
                $user->setRoles($selectedUserRoles);
            
            $hashedPassword = $hasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('backoffice_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{user}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($selectedUserRoles = explode(',', $user->getRoles()[0]))
                $user->setRoles($selectedUserRoles);

            if($user->getPassword()){
                $hashedPassword = $hasher->hashPassword(
                    $user,
                    $user->getPassword()
                );
                $user->setPassword($hashedPassword);
            }
            $entityManager->flush();
            return $this->redirectToRoute('backoffice_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{user}', name: 'delete')]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        try{
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash("success", "Utilisateur supprimée ave succès");
        } catch(\Exception $e){
            $this->addFlash("error", "Une erreur s'est produite durant la suppression : ". $e->getMessage() );
        }

        return $this->redirectToRoute('backoffice_user_list', [], Response::HTTP_SEE_OTHER);
    }
}
