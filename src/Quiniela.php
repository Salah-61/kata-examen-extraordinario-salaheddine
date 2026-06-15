<?php

namespace MiKata;

class Quiniela
{

    public function gestionarQuiniela(string $instruccion): string
    {
        $partesIntruccion = explode(' ', trim($instruccion));
        $signo = strtolower($partesIntruccion[2]);

        if ($signo != '1' || $signo != 'x' || $signo != '2') {
            return "Signo no válido";
        }

        return "";
    }
}
