<?php

namespace Users;

class UsersUtils
{
    const FILEINFO = 'data/users.json';

    public static function isExist($dataUser): bool
    {
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfUsers = [];
        for ($i = 0; $i < count($arrayOfInfo); $i++) {
            $arrayOfUsers[$i] = (array)json_decode($arrayOfInfo[$i]);
            if ($arrayOfUsers[$i]['email'] == $dataUser['email']) {
                return true;
            }
        }
        return false;
    }

    public static function checkPasswordStrength($userPass): bool
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