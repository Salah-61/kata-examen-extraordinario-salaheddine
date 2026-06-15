<?php

use MiKata\Menu;
use MiKata\Resultados;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use MiKata\Quiniela;

class QuinielaTests extends TestCase
{
    #[Test]
    function DadaUnaApuestaConSignoIncorrectoDebeDevolverMensajeDeError()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $resultado = $quiniela->gestionarQuiniela("apostar españa-brasil 9");

        $this->assertEquals("Signo no válido", $resultado);
    }

    #[Test]
    function DadaUnaApuestaConSignoCorrectoSeDebeDevolverQuinielaActual()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $resultado = $quiniela->gestionarQuiniela("apostar españa-brasil 1");

        $this->assertEquals("españa-brasil: 1", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaConMasDeUnaApuestaAlAñadirOtraApuestaSeDebeMostrarEstadoActualDeLaQuinielaConLaNuevaApuesta()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("apostar españa-argentina x");

        $this->assertEquals("españa-brasil: 1, españa-argentina: X", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaInexistenteSeDebeDevolverMensajeDeError()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-argentina");

        $this->assertEquals("La apuesta seleccionada no existe", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaExistenteYNoQuedarVaciaSeDebeDevolverQuinielaActual()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $quiniela->gestionarQuiniela("apostar alemania-belgica x");
        $quiniela->gestionarQuiniela("apostar francia-españa 2");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-brasil");

        $this->assertEquals("alemania-belgica: X, francia-españa: 2", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlIntenerQuitarUnaApuestaExistenteYQuedarVaciaSeDebeMostrarAviso()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("quitar españa-brasil");

        $this->assertEquals("La quiniela está vacía", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaAlVaciarseSeDebeMostrarAvisoYVaciarLaQuiniela()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("vaciar");

        $this->assertempty($quiniela->partidosApostados);
        $this->assertEquals("La quiniela está vacía", $resultado);
    }

    #[Test]
    function DadaUnaQuinielaConUnSoloPartidoInexistenteSeDebeMostraAciertosCero()
    {
        $resultadosMock = $this->createMock(Resultados::class);
        $resultadosMock->method('getResultado')->willReturn(null);
        $quiniela = new Quiniela($resultadosMock);

        $quiniela->gestionarQuiniela("apostar españa-brasil 1");
        $resultado = $quiniela->gestionarQuiniela("aciertos");

        $this->assertEquals("Aciertos: 0", $resultado);
    }

}
