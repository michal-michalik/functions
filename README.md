slownie
=======

Klasa "Slownie" pozwala na zamianę liczb i kwot na ich zapis słowny.

Zakres liczb całkowitych zamienianych na zapis słowny: <-10<sup>78</sup>+1; 10<sup>78</sup>-1>

Maksymalna precyzja: 1/(10<sup>77</sup>)

Przykład użycia
---------------

```php
require_once('Slownie.php);

$slownie = new Slownie();

echo '----------------------------------------------------------------<br><br>';

$x = 17.975;
echo "$x: {$slownie->liczba($x)} <br>";
echo "$x: {$slownie->kwota($x)} <br>";

echo '<br>----------------------------------------------------------------<br><br>';

$x = -12.05;
echo "$x: {$slownie->liczba($x)} <br>";
echo "$x: {$slownie->kwota($x)} <br>";

echo '<br>----------------------------------------------------------------<br><br>';

$x = 679843264.48;
echo "$x: {$slownie->liczba($x)} <br>";
echo "$x: {$slownie->kwota($x)} <br>";

echo '<br>----------------------------------------------------------------<br><br>';

// Liczby których nie da się zapisać przy użyciu typu float z wymaganą dokładnością
// należy przekazywać do metod jako argument typu string:

$float = 100000000000.01;
echo "$float: {$slownie->liczba($float)} <br>"; // Błędny wynik

$string = '100000000000.01';
echo "$string: {$slownie->liczba($string)} <br>"; // Prawidłowy wynik

echo '<br>----------------------------------------------------------------<br><br>';

// Naprawdę duża liczbą z wysoką precyzją

$string = '65478945645123311546546545697456654978971231314564699944400212644.780651321326854021499842558899774651579122322211200031546464654';
echo "$string: {$slownie->liczba($string)} <br>";
```
