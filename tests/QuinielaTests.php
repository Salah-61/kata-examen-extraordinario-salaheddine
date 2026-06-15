<?php

use MiKata\Resultados;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use MiKata\Quiniela;

class QuinielaTests extends TestCase
{
    #[Test]
    function DadaUnaApuestaConSignoIncorrectoDebeDevolverMensajeDeError()
    {
        $quiniela = new Quiniela();

        $resultado = $quiniela->gestionarQuiniela("apostar españa-brasil 9");

        $this->assertEquals("Signo no válido", $resultado);
    }

}
