<?php

namespace App\Data;

use App\Entity\Cabinet;

class SearchData
{
    
    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $q ="";

    /**
     * @var Cabinet[]
     */
    public $cabinets = [];

    

}




