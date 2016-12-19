<?php
/*
 * This file is part of Components of BeezyManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) 2017 Saint-Cyr <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace KmBundle\Service;

class BarcodeHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    /**
     * 
     * @return int of
     * the length is $length 
     */
    public function generateBarcode($length = 13)
    {
        $result = array();
        
        $code = null;
        
        for($i = 0; $i < $length; $i++){
            $code = $code.mt_rand(0, 9);
        }
        
        return $code;
    }
}
