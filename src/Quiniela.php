<?php

namespace MiKata;

class Quiniela
{
    private array $partidosApostados = [];

    public function gestionarQuiniela(string $instruccion): string
    {
        $partesIntruccion = explode(' ', trim($instruccion));
        $instruccion = strtolower($partesIntruccion[0] ?? '');
        $partido = strtolower($partesIntruccion[1]);
        $signo = strtoupper($partesIntruccion[2]);

        if ($instruccion === 'apostar') {
            if ($signo != '1' && $signo != 'X' && $signo != '2') {
                return "Signo no válido";
            }
            $this->partidosApostados[$partido] = $signo;
        }

        foreach ($this->partidosApostados as $partido => $signo) {
            $listaPartidosFormateados .= "$partido: $signo, ";
        }
        $listaPartidosFormateados = rtrim($listaPartidosFormateados, ', ');

        return $listaPartidosFormateados;
    }

}
