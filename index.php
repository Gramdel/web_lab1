<?php
    $startTime = microtime(true);
    session_start();

    if (isset($_POST['coordinateX']) && isset($_POST['coordinateY']) && isset($_POST['radius']))
    {
        $X = $_POST['coordinateX'];
        $Y = $_POST['coordinateY'];
        $R = $_POST['radius'];

        $allowedValuesOfX = ['-3', '-2', '-1', '0', '1', '2', '3', '4', '5'];
        $allowedValuesOfR = ['1', '1.5', '2', '2.5', '3'];

        if (in_array($X, $allowedValuesOfX) && preg_match("/^((-?[0-2]\.\d*(?=[1-9])[1-9])|0|(-?[12]))$/", $Y) && in_array($R, $allowedValuesOfR))
        {
            if (pointIsInTriangle($X, $Y, $R) || pointIsInRectangle($X, $Y, $R) || pointIsInCircle($X, $Y, $R))
            {
                $msg = "Да";
            }
            else
            {
                $msg = "Нет";
            }

            date_default_timezone_set('Europe/Moscow');
            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 6);
            $currentTime = date('d.m.y H:i:s');

            $row = "<tr><td>$X</td><td>$Y</td><td>$R</td><td>$msg</td><td>$currentTime</td><td>$executionTime</td></tr>";
            if (isset($_SESSION['rows']))
            {
                $_SESSION['rows'][] = $row;
            }
            else
            {
                $_SESSION['rows'] = array($row);
            }
        }
        else
        {
            echo "Ошибка в формате введённых данных! Используйте <a href='index.html'>форму</a>.</br>";
        }

        if (isset($_SESSION['rows']))
        {
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
            echo "История запросов пуста.<br>";
        }
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