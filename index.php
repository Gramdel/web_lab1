<?php
    $startTime = microtime(true);
    session_start();

    if (isset($_POST['coordinateX']) && isset($_POST['coordinateY']) && isset($_POST['radius']))
    {
        $X = $_POST['coordinateX'];
        $Y = $_POST['coordinateY'];
        $R = $_POST['radius'];

        if (pointIsInTriangle($X, $Y, $R) || pointIsInRectangle($X, $Y, $R) || pointIsInCircle($X, $Y, $R))
        {
            $msg = "Да";
        }
        else
        {
            $msg = "Нет";
        }

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 6);
        date_default_timezone_set('Europe/Moscow');
        $currentTime = date('H:i:s');
        $row = "<tr><td>$X</td><td>$Y</td><td>$R</td><td>$msg</td><td>$currentTime</td><td>$executionTime</td></tr>";
        if (isset($_SESSION['rows']))
        {
            $_SESSION['rows'][] = $row;
        } else {
            $_SESSION['rows'] = array($row);
        }

        echo "<table border='1'>";
        echo "<thead><tr><td>Координата X</td><td>Координата Y</td><td>Радиус R</td><td>Попадание в область</td><td>Время выполнения</td><td>Длительность выполения</td></tr></thead>";
        echo "<tbody>";
        foreach ($_SESSION['rows'] as $row)
        {
            echo $row;
        }
        echo "</tbody>";
        echo "</table>";
    }
    else
    {
        echo "Заполните <a href='index.html'>форму</a>!";
    }

    function pointIsInTriangle($X, $Y, $R)
    {
        return ($Y <= $X + $R) && ($Y >= 0) && ($X <= 0);
    }

    function pointIsInRectangle($X, $Y, $R)
    {
        return ($Y >= -$R) && ($Y <= 0) && ($X >= -$R / 2) && ($X <= 0);
    }

    function pointIsInCircle($X, $Y, $R)
    {
        return ($X * $X + $Y * $Y <= $R * $R / 4) && ($Y >= 0) && ($X >= 0);
    }