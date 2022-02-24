<?php

declare(strict_types=1);

spl_autoload_register(function (string $par): void {
    require_once "class/$par.trida.php";
});


$html = file_get_contents("./html/struct.html");
$html = str_replace("[@Body]", file_get_contents("./html/uvod.html"), $html);


echo $html;
