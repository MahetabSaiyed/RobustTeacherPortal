<?php

    /**
     * Class: Function
     * Desc: Common Use of Function will be define here.
     */
    class Functions
    {
        public static function createString($len = 0)
        {
            $rStr = "1qazPOL2wsxIK3edcUJM4rfvYHN5tgbTGB6yhnRFV7ujmEDC8ikWSX9olQAZ0p";
            $nStr = str_shuffle($rStr);
            $cStr = substr($nStr, 0, $len);
            return $cStr;
        }

    }
    