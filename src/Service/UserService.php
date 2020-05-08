<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserService
{
    public function addUser(string $name, string $email, string $password, string $address, $entityManager, $userList): ?string
    {
        $user = new User();  
        $currentUser = $userList->findOneBy(['email' => $email]);
        if (!$currentUser) 
        {
            if (self::checkPassword($password))
            {
                $user->setPassword($password);
                $user->setEmail($email);
                $user->setAddress($address);
                $user->setName($name);
                UserRepository::add($user, $entityManager);
                return null;
            }
            else
            {
                return 'weak password';
            }
        }
        else
        {
            return 'User exist';
        }
    } 

    public function checkPassword(string $userPass)
    {
        $strength = 0;
        $strength += 4 * strlen($userPass);
        $countUpCase = 0;
        $countDownCase = 0;
        $countDigit = 0;
        for ($i = 0; $i < strlen($userPass); $i++) {
            if (ctype_upper($userPass[$i]))
                $countUpCase++;
            if (ctype_lower($userPass[$i]))
                $countDownCase++;
            if (is_numeric($userPass[$i]))
                $countDigit++;
            if (substr_count($userPass, $userPass[$i]) > 1)
                $strength--;
        };
        $strength += 4 * $countDigit;
        $strength += ($countUpCase > 0) ? ((strlen($userPass) - $countUpCase) * 2) : 0;
        $strength += ($countDownCase > 0) ? ((strlen($userPass) - $countDownCase) * 2) : 0;
        $strength = ctype_alpha($userPass) ? ($strength - strlen($userPass)) : $strength;
        $strength = ctype_digit($userPass) ? ($strength - strlen($userPass)) : $strength;
        if ($strength > 40)
            return true;
        return false;
    }
}