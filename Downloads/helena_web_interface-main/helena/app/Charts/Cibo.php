<?php

declare(strict_types = 1)
;

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class Cibo extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        session_start();
        $host = "127.0.0.1";
        $username = "root";
        $db = "helena";
        $con = mysqli_connect($host, $username);
        mysqli_select_db($con, $db);
        if (isset($_SESSION['cf'])) {
            $cfpaz = $_SESSION['cf'];
            $giorno[0] = "lunedi";
            $giorno[1] = "martedi";
            $giorno[2] = "mercoledi";
            $giorno[3] = "giovedi";
            $giorno[4] = "venerdi";
            $giorno[5] = "sabato";
            $giorno[6] = "domenica";
            for ($i = 0; $i < 7; $i++) {
                $sql = " SELECT * FROM `intcibo`WHERE cf='$cfpaz' AND giorno='$giorno[$i]'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) != 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $c[$i][0] = $row['acqua'];
                        $c[$i][1] = $row['frutta'];
                        $c[$i][2] = $row['verdura'];
                        $c[$i][3] = $row['carboidrati'];
                        $c[$i][4] = $row['proteine'];
                        $c[$i][5] = $row['zuccheri'];
                    }
                }
                else {
                    $c[$i][0] = 0;
                    $c[$i][1] = 0;
                    $c[$i][2] = 0;
                    $c[$i][3] = 0;
                    $c[$i][4] = 0;
                    $c[$i][5] = 0;
                }

            }
        }
        return Chartisan::build()
            ->labels(['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'])

            ->dataset('Acqua', [$c[0][0], $c[1][0], $c[2][0], $c[3][0], $c[4][0], $c[5][0], $c[6][0]])

            ->dataset('Frutta', [$c[0][1], $c[1][1], $c[2][1], $c[3][1], $c[4][1], $c[5][1], $c[6][1]])

            ->dataset('Verdura', [$c[0][2], $c[1][2], $c[2][2], $c[3][2], $c[4][2], $c[5][2], $c[6][2]])

            ->dataset('Carboidrati', [$c[0][3], $c[1][3], $c[2][3], $c[3][3], $c[4][3], $c[5][3], $c[6][3]])

            ->dataset('Proteine', [$c[0][4], $c[1][4], $c[2][4], $c[3][4], $c[4][4], $c[5][4], $c[6][4]])

            ->dataset('Zuccheri', [$c[0][5], $c[1][5], $c[2][5], $c[3][5], $c[4][5], $c[5][5], $c[6][5]]);
    }
}