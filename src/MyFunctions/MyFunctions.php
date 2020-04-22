<?php
namespace MyFunctions;

class Orders
{
    const FILEINFO = 'orders.txt';
    const AMOUNTOFINFO = 5;
    public static function getOrders()
    {
        $arrayOfOrders = [];
        $arrayOfInfo = file(self::FILEINFO);
	    $counter = 0;
	    $inserted_counter = 0;
	    $countPosition = 0;
	    while ($counter < count($arrayOfInfo)){
	        array_push($arrayOfOrders, []);
	        $arrayOfOrders[$countPosition] = $arrayOfOrders[$countPosition] + ['number' => '#' . strval($countPosition + 1)];
	        while ($inserted_counter < self::AMOUNTOFINFO){
	            list($key, $value) = explode(':', $arrayOfInfo[$counter]);
                $arrayOfOrders[$countPosition][$key] = $value;
                $counter++;
                $inserted_counter++;
	        }
            $counter++;
            $countPosition++;
            $inserted_counter = 0;
	    }
	    return $arrayOfOrders;
    }
}

/**
 * 
 */
class Menu
{
    const FILEINFO = 'menu.txt';
    const AMOUNTOFINFO = 4;
	public static function getMenu()
    {
        $arrayOfMenu = [];
        $arrayOfInfo = file(self::FILEINFO);
        $counter = 0;
        $inserted_counter = 0;
        $countPosition = 0;
        while ($counter < count($arrayOfInfo)){
            array_push($arrayOfMenu, []);
            while ($inserted_counter < self::AMOUNTOFINFO){
                list($key, $value) = explode(':', $arrayOfInfo[$counter]);
                $arrayOfMenu[$countPosition][$key] = $value;
                $counter++;
                $inserted_counter++;
            }
            $arrayOfMenu[$countPosition] = $arrayOfMenu[$countPosition] + ['id' => strval($countPosition + 1)];
            $counter++;
            $countPosition++;
            $inserted_counter = 0;
        }
        return $arrayOfMenu;
    }
}

class WorkWithUsers{
    const FILEINFO = 'data.json';
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
        $exist = false;
        $arrayOfUsers = [];
        for($i= 0; $i< count($arrayOfInfo); $i++){
            $arrayOfUsers[$i] = (array) json_decode($arrayOfInfo[$i]);
            if ($arrayOfUsers[$i]['email'] == $dataUser['email']) {
                $exist = true;
            }
        }
        return $exist;
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