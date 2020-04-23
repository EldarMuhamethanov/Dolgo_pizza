<?php
namespace MyFunctions;

class Orders
{
    const FILEINFO = 'orders.json';
    public static function getOrders()
    {
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfOrders = [];
        for($i= 0; $i< count($arrayOfInfo); $i++) {
            $arrayOfOrders[$i] = (array) json_decode($arrayOfInfo[$i]);
            $arrayOfOrders[$i]['number'] = $i + 1;
        }
        return $arrayOfOrders;
    }
    public static function setOrders($pointOfMenu)
    {
        $fp = fopen(self::FILEINFO, 'a');
        $arrayOfOrder = [
            "pizza" => $pointOfMenu['title_pizza'],
            "cost" => $pointOfMenu['cost'],
            "user" => 'Имя пользователя',
            "addres" => 'Адресс пользователя',
            "status" => 'ready',];
        fwrite($fp,"\n" . json_encode($arrayOfOrder,JSON_UNESCAPED_UNICODE));
    }
}

/**
 * 
 */
class Menu
{
    const FILEINFO = 'menu.json';
	public static function getMenu()
    {
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfMenu = [];
        for($i= 0; $i< count($arrayOfInfo); $i++) {
            $arrayOfMenu[$i] = (array) json_decode($arrayOfInfo[$i]);
            $arrayOfMenu[$i]['id'] = $i + 1;
        }
        return $arrayOfMenu;
    }
}

class WorkWithUsers{
    const FILEINFO = 'users.json';
    public static function getUsers(){
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfUsers = [];
        for($i= 0; $i< count($arrayOfInfo); $i++){
            $arrayOfUsers[$i] = (array) json_decode($arrayOfInfo[$i]);
            $arrayOfUsers[$i]['number'] = $i + 1;
        }
        return $arrayOfUsers;
    }

    public static function isExist($dataUser){
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfUsers = [];
        for($i= 0; $i< count($arrayOfInfo); $i++){
            if ($arrayOfUsers[$i]['email'] == $dataUser['email']) {
                return true;
            }
        }
        return false;
    }

    public static function checkPasswordStrength($userPass) {
        $strength = 0;
        $strength += 4 * strlen($userPass);
        $countUpCase = 0;
        $countDownCase = 0;
        $countDigit = 0;
        for ($i = 0; $i < strlen($userPass); $i++)
        {
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