<?php

/**
 * @author Radek
 * @copyright 2015
 */
$zmienna = 'To jest zawartosc zmiennej';
//pokurwiona sk³adnia echo: '' jest odbierane doslownie, "" jest interpretowane,
//jezeli zmienna zawarta w '' ma byc interpretowana, musi zostac oddzielona kropkami
echo '<p>Test echo, to jest moja zmienna: ', '$zmienna', ', a to jej zawartosc: ' .$zmienna.'</p>';

//utworzenie krotkich nazw zmiennych
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];

//sprawdzanie czy uzupelniles pola
if(!$imie || !$nazwisko)
{
    echo 'Nie uzupe³ni³eœ pól';
    exit;
}

//KONIECZNE usuwanie spacji i zbednych znakow z poczatku i konca ciagu http://php.net/manual/pl/function.trim.php
$imie = trim($imie);
$nazwisko = trim($nazwisko);

//tego nie ogarniam, proponuje abyscie sie zaglebili w to zagadnienie i mi wytlumaczyli, wypluwane wyniki sa inne niz oczekiwane
//tzn skrypt dodaje znak \ w odpowiednich miejsach co widac po wyniku wyplutym przez echo jednak w bazie zapisuje sie bez
if(!get_magic_quotes_gpc())
{
    $imie = addslashes($imie);
    $nazwisko = addslashes($nazwisko);
}

//wypisanie przekazanych wartosci poprzez metode post
echo '<p> Imie: ' .$imie. ' Nazwisko: ' .$nazwisko. '</p>';

//laczenie z baza tworzac obiekt $db,  znak @ oznacza brak wypisywania bledow na stronie
@ $db = new mysqli('mn19.webd.pl', 'rad3c_usertest', 'usertest12345', 'rad3c_testdb');

//sprawdzanie polaczenia z baza
if(mysqli_connect_errno())
{
    echo '<p>Polaczenie jest zjebane</p>';
    exit;
}

//tworzenie zapytania sql
$zapytanie = "insert into uzytkownik values ('".$imie."','".$nazwisko."')";

//wysylanie zapytania do bazy
$wynik = $db->query($zapytanie);

//sprawdzanie czy udalo sie zapisac dane w bazie
if($wynik)
{
    echo '<p>' .$db->affected_rows. ' uzytkownik zapisany do bazy</p>';
}
else
{
    echo '<p>wystapil blad</p>';
}

//zamykanie polaczenia z baza
$db->close();
?>