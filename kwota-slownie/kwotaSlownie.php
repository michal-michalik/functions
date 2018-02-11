<?php

function kwotaSlownie($number)
{
    if (is_numeric($number) === false) {
        throw new Exception("Podany argument nie jest liczbą");
    }

    
}