<?php

declare(strict_types = 1)
;

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class Salute extends BaseChart
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
            $sql = "SELECT * FROM `salute` WHERE cf='$cfpaz'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $sint[0] = $row['sintomo1'];
                $sint[1] = $row['sintomo2'];
                $sint[2] = $row['sintomo3'];

            }
            for ($i = 0; $i < 3; $i++) {
                $sql = " SELECT * FROM `intsalute`WHERE cf='$cfpaz' AND sintomo='$sint[$i]'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) != 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $s[$i][0] = $row['int_1'];
                        $s[$i][1] = $row['int_2'];
                        $s[$i][2] = $row['int_3'];
                        $s[$i][3] = $row['int_4'];
                        $s[$i][4] = $row['int_5'];
                        $s[$i][5] = $row['int_6'];
                        $s[$i][6] = $row['int_7'];

                    }
                }
                else {
                    $s[$i][0] = 0;
                    $s[$i][1] = 0;
                    $s[$i][2] = 0;
                    $s[$i][3] = 0;
                    $s[$i][4] = 0;
                    $s[$i][5] = 0;
                    $s[$i][6] = 0;
                }

            }
        }
        return Chartisan::build()
            ->dataset($sint[0], [$s[0][0], $s[0][1], $s[0][2], $s[0][3], $s[0][4], $s[0][5], $s[0][6]])

            ->dataset($sint[1], [$s[1][0], $s[1][1], $s[1][2], $s[1][3], $s[1][4], $s[1][5], $s[1][6]])

            ->dataset($sint[2], [$s[2][0], $s[2][1], $s[2][2], $s[2][3], $s[2][4], $s[2][5], $s[2][6]]);
    }
}