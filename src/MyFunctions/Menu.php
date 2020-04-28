<?php

namespace Menu;

class Menu
{
    const FILEINFO = 'data/menu.json';

    public static function getMenu(): array
    {
        $arrayOfInfo = file(self::FILEINFO);
        $arrayOfMenu = [];
        for ($i = 0; $i < count($arrayOfInfo); $i++) {
            $arrayOfMenu[$i] = (array)json_decode($arrayOfInfo[$i]);
            $arrayOfMenu[$i]['id'] = $i + 1;
        }
        return $arrayOfMenu;
    }
}