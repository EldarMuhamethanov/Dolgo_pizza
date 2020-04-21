<?php
namespace MyFunctions;

class Orders
{
    const FILEINFO = 'orders.txt';
    const AMOUNTOFINFO = 5;
    public static function get_orders($arrayOfOrders)
    {
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
    public static function set_order() {

    }
}

/**
 * 
 */
class Menu
{
    const FILEINFO = 'menu.txt';
    const AMOUNTOFINFO = 4;
	public static function get_menu($arrayOfMenu)
    {
        $fileInfo = 'menu.txt';
        $amountOfInfo = 4;
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
