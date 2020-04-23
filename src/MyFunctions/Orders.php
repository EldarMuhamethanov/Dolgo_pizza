<?php
namespace Orders;

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
        return null;
    }
}