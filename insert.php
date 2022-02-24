<?php

declare(strict_types=1);

use Tridy\Db;

spl_autoload_register(function (string $par): void {
    require_once "$par.trida.php";
});


$html = file_get_contents("./html/struct.html");
$html = str_replace("[@Body]", file_get_contents("./html/insert.html"), $html);





echo $html;
