<?php

declare(strict_types=1);

use Tridy\Db;

spl_autoload_register(function (string $par): void {
    require_once "$par.trida.php";
});
$html = file_get_contents("./html/struct.html");
$html = str_replace("[@Body]", file_get_contents("./html/select.html"), $html);

// ! Sem zapište kód, který zajistí SQL dotazem do databáze uložení potřebných údajů do HTML tabulky a výsledný kód uloží 
// ! jako textový řetězec v proměnné $vysledek.


echo "$html";
