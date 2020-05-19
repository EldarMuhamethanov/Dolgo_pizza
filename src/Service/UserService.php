<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Exception\UserExistException;
use App\Exception\EasyPasswordException;

class UserService
{
    private $repository;

    private $encoder; 

    public function __construct($repository, UserPasswordEncoderInterface $encoder)
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }

    public function addUser(string $name, string $email, string $password, string $address, array $role = [])
    {
        $user = new User();  
        $currentUser = $this->findUserByField($email);
        if (!$currentUser) 
        {
            if ($this->checkPassword($password))
            {
                $user->setPassword(
                    $this->encoder->encodePassword($user, $password)
                );
                $user->setEmail($email);
                $user->setAddress($address);
                $user->setName($name);
                $user->setUsername($email);
                $user->setRoles($role);
                $this->repository->add($user);
            }
            else
            {
                throw new EasyPasswordException();
            }
        }
        else
        {
            throw new UserExistException();
        }
    } 

    public function getAllUsers()
    {
        return $this->repository->getAll();
    }

    public function findUserByField(string $field)
    {
        return $this->repository->findByFieldValue('email', $field);
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