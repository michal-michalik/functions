<?php

class Slownie
{
    public function liczba($number)
    {
        if (is_numeric($number) === false) {
            throw new Exception("Podany argument nie jest liczbą");
        }

        if ($number == 0) {
            return "zero";
        }

    }

    public function kwota($number)
    {

    }
}
