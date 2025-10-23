<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>OPONY</title>
</head>
<?php
    header('refresh: 10');
    $polaczenie = mysqli_connect("localhost","root","","opony");
?>
<body>
    <main>
        <nav>
            <?php
                $zapytanie = "SELECT * FROM OPONY ORDER BY cena ASC LIMIT 10";
                $kwerenda = mysqli_query($polaczenie,$zapytanie);
                while(($wynik = mysqli_fetch_row($kwerenda)) != null){
                    $obraz = $wynik[3];
                    if ($obraz=="zimowa") {
                        $obraz = "zima.png";
                    }elseif ($obraz=="letnia") {
                        $obraz = "lato.png";
                    }elseif ($obraz=="uniwersalna") {
                        $obraz = "uniwer.png";
                    }
                    echo("<div class=opona>");
                    echo("<img src='grafiki/$obraz'></img>");
                    echo("<h4>Opona: $wynik[1] $wynik[2]</h4>");
                    echo("<h3>Cena: $wynik[4]</h3>");
                    echo("</div>");
                }
            ?>
            <a href="https://opona.pl">więcej ofert</a>
        </nav>
        <aside>
            <img src="grafiki/opona.png" alt="Opona">
            <h2>Opona dnia</h2>
            <?php
                $zapytanie = "SELECT `producent`,`model`,`sezon`,`cena` FROM `OPONY` WHERE `nr_kat` = 9;";
                $kwerenda = mysqli_query($polaczenie,$zapytanie);
                while(($wynik = mysqli_fetch_row($kwerenda)) != null){
                    echo("<h2>$wynik[0] model $wynik[1]</h2>");
                    echo("<h2>Sezon: $wynik[2]</h2>");
                    echo("<h2>Tylko $wynik[3] zł!</h2>");
                }
            ?>
        </aside>
        <article>
            <h2>Najnowsze zamówienie</h2>
            <?php
                $zapytanie = "SELECT zamowienie.id_zam,zamowienie.ilosc,opony.cena,opony.model FROM opony JOIN zamowienie ON opony.nr_kat=zamowienie.nr_kat ORDER BY RAND() LIMIT 1;";
                $kwerenda = mysqli_query($polaczenie,$zapytanie);
                while(($wynik = mysqli_fetch_row($kwerenda)) != null){
                    $cena = $wynik[1]*$wynik[2];
                    echo("<h2>$wynik[0] $wynik[1] sztuki modelu $wynik[3]</h2>");
                    echo("<h2>Wartość zamówienia $cena zł</h2>");
                }
            ?>
        </article>
    </main>
    <footer>
        <p>Stronę wykonał: </p>
    </footer>
</body>
<?php
    mysqli_close($polaczenie);
?>
</html>