<?php
namespace MyFunctions;

class MyFunctions
{
    public static function get_orders($array)
    {
        $str = file('orders.txt');
	    $i = 0;
	    $i_array = 0;
	    $count = 0;
	    $array = [];
	    while ($i < count($str)){
	        array_push($array, []);
	        while ($i_array < 6){
	            list($key, $value) = explode(':', $str[$i]);

	            $array[$count][$key] = $value;
	            $i++;
	            $i_array++;
	        }
	        $i++;
	        $count++;
	        $i_array = 0;
	    }
	    return $array;
    }
    public static function get_menu($array)
    {
        $str = file('menu.txt');
	    $i = 0;
	    $i_array = 0;
	    $count = 0;
	    $array = [];
	    while ($i < count($str)){
	        array_push($array, []);
	        while ($i_array < 4){
	            list($key, $value) = explode(':', $str[$i]);

	            $array[$count][$key] = $value;
	            $i++;
	            $i_array++;
	        }
	        $i++;
	        $count++;
	        $i_array = 0;
	    }
	    return $array;
    }
}
