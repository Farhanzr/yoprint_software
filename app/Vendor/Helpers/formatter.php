<?php

function special_chars($strings)
{
    $decodedString = [];

    if (!is_array($strings)) {
        $decodedString[] = html_entity_decode($strings, ENT_QUOTES, 'UTF-8');
    }
    else
    {
        foreach($strings as $str)
        {
            $decodedString[] = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        }
    }

    return $decodedString;
}

?>