<?php

namespace App\Controller;

use App\Security\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $user = new User();
        $file_name = 'data.json';
        $fp = fopen($file_name, 'a');

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $register_form = $request->request->all();

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
            fwrite($fp, json_encode($register_form) . "\n");

            return $this->redirect("/menu", 308);
            // do anything else you need here, like send an email

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
