<?php

namespace App\Controller;

use App\Security\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Users\UsersUtils;

class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $file_name = 'data/users.json';
        $fp = fopen($file_name, 'a');

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
            $register_form = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'address' => $user->getAddress(),
            ];
            if (!UsersUtils::isExist($register_form)) {
                if (UsersUtils::checkPasswordStrength($register_form['password'])) {
                    fwrite($fp, json_encode($register_form, JSON_UNESCAPED_UNICODE) . "\n");

                    $this->addFlash(
                        'success',
                        'Вы добавлены в систему'
                    );

                    return $this->redirect("/", 308);
                } else {
                    $this->addFlash(
                        'warning',
                        'Слишком простой пароль, попробуйте другой'
                    );
                }
            } else {
                $this->addFlash(
                    'warning',
                    'Пользователь существует'
                );
                return $this->redirect("/login", 308);
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
