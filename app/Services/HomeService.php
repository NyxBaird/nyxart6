<?php namespace Services;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

/**
 * Class HomeService
 * @package Services
 */
class HomeService
{
    public function viewData($key = false)
    {
        $colors = [
            '#d442f4', //Pink
            '#41bbf4', //Blue
            '#cc99ff', //Light pink/purple
            '#ccffe6', //minty green
            '#800080', //Purple
            '#736AFF', //Purple-y Blue
            '#38ACEC', //Robins egg-esque blue
        ];

        $color = $colors[array_rand($colors, 1)];

        $return = [
            'version' => '6.0.1',
            'color' => $color
        ];

        if($key){
            return $return[$key];
        }

        return $return;
    }
}