<?php

declare(strict_types = 1)
;

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class Sport extends BaseChart
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
                $sql = " SELECT * FROM `intsport`WHERE cf='$cfpaz' AND giorni='$giorno[$i]'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) != 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $sport[$i] = $row['ore'];

                    }
                }
                else {
                    $sport[$i] = 0;
                }

            }
        }
        return Chartisan::build()


            ->dataset('Lunedì', [$sport[0]])

            ->dataset('Martedì', [$sport[1]])

            ->dataset('Mercoledì', [$sport[2]])

            ->dataset('Giovedì', [$sport[3]])

            ->dataset('Venerdì', [$sport[4]])

            ->dataset('Sabato', [$sport[5]])

            ->dataset('Domenica', [$sport[6]]);
    }
}