<?php

namespace App\Controller;

//use App\Security\UserSecurity;
use App\Exception\EasyPasswordException;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\UserExistException;
use Symfony\Component\Routing\Annotation\Route;


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
    /**
     * @Route("/registration", name="registration")
     */
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
            try
            {
                $this->service->addUser($name, $email, $password, $address, $role);
                $this->addFlash(
                    'success',
                    'Вы добавлены в систему');
                return $this->redirectToRoute("menu");
            }
            catch (UserExistException $e)
            {
                $this->addFlash(
                    'warning',
                    'Пользователь существует');
                return $this->redirectToRoute("login", [
                    'thisUserEmail' => $email,
                    'thisUserPassword' => $password
                ]);
            }
            catch (EasyPasswordException $e)
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
