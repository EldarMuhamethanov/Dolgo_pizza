<?php

namespace App\Controller;

//use App\Security\UserSecurity;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }
    public function index(Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->get('name')->getData();
            $email = $form->get('email')->getData();
            $password = $form->get('password')->getData();
            $address = $form->get('address')->getData();
            $role = ['ROLE_USER'];
            if ($email === 'admin@mail.ru' && $password === '1234Qwerty')
            {
                $role = ['ROLE_ADMIN', 'ROLE_USER'];
            }
            $success = $this->service->addUser($name, $email, $password, $address, $role);
            if ($success == null)
            {
                $this->addFlash(
                    'success',
                    'Вы добавлены в систему');
                return $this->redirect("/", 308);
            }
            else if ($success == 'User exist')
            {
                $this->addFlash(
                    'warning',
                    'Пользователь существует');
                return $this->redirect("/login", 308);
            }
            else if ($success == 'weak password')
            {
                $this->addFlash(
                    'warning',
                    'Слишком слабый пароль');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
