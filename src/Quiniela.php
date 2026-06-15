<?php

namespace MiKata;

class Quiniela
{

    public function gestionarQuiniela(string $instruccion): string
    {
        $partesIntruccion = explode(' ', trim($instruccion));
        $instruccion = strtolower($partesIntruccion[0] ?? '');
        $partido = strtolower($partesIntruccion[1]);
        $signo = strtolower($partesIntruccion[2]);


        if ($signo != '1' && $signo != 'x' && $signo != '2') {
            return "Signo no válido";
        }

        return "$partido: $signo";
    }
}
