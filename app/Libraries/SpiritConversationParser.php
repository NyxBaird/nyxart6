<?php namespace Libraries;
/**
 * Copyright © 2011 - 2017 NyxArt.org
 * All Rights Reserved. No part of this code may be reproduced without Elize Baird's express consent.
 * http://www.nyxart.org
 *
 * Created by Elize
 */

use Domain\Spirit\ResponseType;

class SpiritConversationParser
{


    /**
     * @param ResponseType $type
     * @param $user
     * @param int $modifier
     * @return ResponseType
     */
    public function applyImpact(ResponseType $type, $user = false, $modifier = 0)
    {
        if (!$user) {
            $user = auth()->user();
        }

        if (!$user && $type->base_impact + $modifier <= 10) {
            return $type;
        } else if (!$user) {
            //WIP: Apply negative impact to session
        }
        //wip work out impact for user

        //Temporary return for if we're logged in and still need a type
        return $type;
    }
}