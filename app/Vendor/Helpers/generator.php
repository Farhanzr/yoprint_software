<?php

function uploadIDGenerator()
{
    $date = now()->format('Ymd');
    $random_no = rand(0,9999);

    return $date.$random_no;
}
?>