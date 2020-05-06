<?php

namespace App\Controller;

//use App\Security\UserSecurity;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $userList = $this->getDoctrine()->getRepository(User::class);
            $currentUser = $userList->findOneBy(['email' => $form->get('email')->getData()]);
            if (!$currentUser) {
                $user->setPassword(
                    $form->get('password')->getData()
                );
                $user->setEmail(
                    $form->get('email')->getData()
                );
                $user->setAddress(
                    $form->get('address')->getData()
                );
                $user->setName(
                    $form->get('name')->getData()
                );
                $entityManager->persist($user);
    
                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Вы добавлены в систему');
                return $this->redirect("/", 308);
            }
            else
            {
                $this->addFlash(
                    'warning',
                    'Пользователь существует');
                return $this->redirect("/login", 308);
            }
            
            
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
