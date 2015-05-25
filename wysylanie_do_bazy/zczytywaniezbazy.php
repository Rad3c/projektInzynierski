<?php
//USUWANIE Z BAZY

@ $imie = $_POST['imie'];
@ $nazwisko = $_POST['nazwisko'];

$db = new mysqli('mn19.webd.pl', 'rad3c_usertest', 'usertest12345', 'rad3c_testdb');

if(mysqli_connect_errno())
{
    echo '<p> polaczenie z baza jest walniete</p>';
}

if($imie && $nazwisko)
{
    $zapytanieUsuwanie = "DELETE FROM uzytkownik WHERE imie = '$imie' and nazwisko = '$nazwisko'";
    $result = $db->query($zapytanieUsuwanie);
    if(($db->affected_rows) > 0)
    {

        if ($result)
        {
            echo "<p>Deleted Successfully</p>";
            echo "<p> $db->affected_rows wiersz usuniety: $imie $nazwisko </p>";
        }
        else
        {
            echo "ERROR!";        
        }
    }
    else
    {
        echo '<p>Brak takiego wpisu w bazie</p>';
    }
}

echo '<p>','<a href="index.php?page=home">Index.php</a>','</p>';
?>

<html>
<body>
<p>Podaj imie i nazwisko aby usunac z bazy</p>
<form action="zczytywaniezbazy.php" method=post>
        <p>Podaj imie
        <input name="imie" type="text"/></p>
        <p>Podaj nazwisko
        <input name="nazwisko" type="text"/></p>
        <input name="submit" type="submit" value="Wyslij"/>
    </form>
</html>
</body>


//GENEROWANIE TABELI
<?php

/**
 * @author Radek
 * @copyright 2015
 */    
$zapytanie = "select * from uzytkownik";

$wynik = $db->query($zapytanie);

$iloscWierszy = $wynik->num_rows;

echo "<table cellpadding=\"2\" border=1>";
for($i=0; $i < $iloscWierszy; $i++)
{
    //Zapisuje wiersz wyniku w tablicy asocjacyjnej:
$wiersz = $wynik->fetch_assoc();
echo "<tr>";
echo "<td>".($wiersz['imie']). "</td>";
echo "<td>".($wiersz['nazwisko']). "</td>";
echo "</tr>";
}
echo "</table> <br> <br>";
?>
