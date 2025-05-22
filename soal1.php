<?php



$jml = $_GET['jml'];
echo "<table border=1>\n";
echo <<<HTML
<style>
    table {
        border:1px solid black;
        display:flex
        width:25%
    }
    td {
        border: 1px solid black;
        width: 10rem;
        text-align: center;
        padding: 5px;
    }
</style>


HTML;
echo "<table>";
for ($a = $jml; $a > 0; $a--) {
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }
    // show total column
    echo "<tr>\n";
    echo "<td colspan=\"$a\">nilai total = $total</td>\n";
    echo "</tr>\n";

    // show column based on jml and add number to be added above
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    echo "</tr>\n";
}

echo "</table>";
