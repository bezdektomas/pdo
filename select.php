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

$db = new PDO("mysql:host=localhost;dbname=osoby;charset=utf8", "root", "", [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$stmt = $db->query("SELECT DISTINCT(trida) FROM lide ORDER BY trida");

$tridy = $stmt->fetchAll();

$option = "<option value=%>Všechny</option>";

foreach ($tridy as $key => $value) {
    $option .= "<option value=" . $value["trida"] . ">" . $value["trida"] . "</option>";
}

$html = str_replace("[@Option]", $option, $html);

$stmt = $db->prepare("SELECT jmeno, prijmeni, rc, login, trida FROM lide WHERE prijmeni LIKE ? AND trida LIKE ?");

$stmt->execute([
    ($_POST["prijmeni"] ?? "") . "%", $_POST["trida"] ?? "%"
]);

if ($res = $stmt->fetchAll()) {
    $vysledek = "<table>";

    $vysledek .= "<tr>";
    $vysledek .= "<th>Jméno</th>";
    $vysledek .= "<th>Příjmení</th>";
    $vysledek .= "<th>RČ</th>";
    $vysledek .= "<th>Login</th>";
    $vysledek .= "<th>Třída</th>";
    $vysledek .= "</tr>";

    foreach ($res as $key => $value) {
        $vysledek .= "<tr>";
        foreach ($value as $key => $val) {
            $vysledek .= "<td>$val</td>";
        }
        $vysledek .= "</tr>";
    }
    $vysledek .= "</table>";
}

$html = str_replace("[@TableResult]", $vysledek, $html);

echo "$html";
