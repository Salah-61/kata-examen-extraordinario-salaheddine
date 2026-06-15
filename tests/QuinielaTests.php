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

    #[Test]
    function DadaUnaApuestaConSignoCorrectoSeDebeDevolverQuinielaActual()
    {
        $quiniela = new Quiniela();

        $resultado = $quiniela->gestionarQuiniela("apostar españa-brasil 1");

        $this->assertEquals("españa-brasil: 1", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaConMasDeUnaApuestaAlAñadirOtraApuestaSeDebeMostrarEstadoActualDeLaQuinielaConLaNuevaApuesta()
    {
        $quiniela = new Quiniela();

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("apostar españa-argentina x");

        $this->assertEquals("españa-brasil: 1, españa-argentina: X", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaInexistenteSeDebeDevolverMensajeDeError()
    {
        $quiniela = new Quiniela();

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-argentina");

        $this->assertEquals("La apuesta seleccionada no existe", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaExistenteYNoQuedarVaciaSeDebeDevolverQuinielaActual()
    {
        $quiniela = new Quiniela();

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $quiniela->gestionarQuiniela("apostar alemania-belgica x");
        $quiniela->gestionarQuiniela("apostar francia-españa 2");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-brasil");

        $this->assertEquals("alemania-belgica: X, francia-españa: 2", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaExistenteYQuedarVaciaSeDebeMostrarAviso()
    {
        $quiniela = new Quiniela();

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-brasil");

        $this->assertEquals("La quiniela está vacía", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlVaciarseSeDebeMostrarAviso()
    {
        $quiniela = new Quiniela();

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("vaciar");

        $this->assertEquals("La quiniela está vacía", $resultado);
    }

}
