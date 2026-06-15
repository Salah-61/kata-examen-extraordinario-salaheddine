<?php

namespace MiKata;

interface Resultados
{
    public function getResultado(string $partido): ?string;
}