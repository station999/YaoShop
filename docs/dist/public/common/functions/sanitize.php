<?php
    function sanitize($before)
    {
        $after = array(); 
        foreach($before as $key => $value)
        {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $after;
    }