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

        if ($instruccion === 'quitar') {
            if (!array_key_exists($partido, $this->partidosApostados)) {
                return "La apuesta seleccionada no existe";
            }
            unset($this->partidosApostados[$partido]);
            if (empty($this->partidosApostados)) {
                return "La quiniela está vacía";
            }
        }

        foreach ($this->partidosApostados as $partido => $signo) {
            $listaPartidosFormateados .= "$partido: $signo, ";
        }
        $listaPartidosFormateados = rtrim($listaPartidosFormateados, ', ');

        return $listaPartidosFormateados;
    }

}
