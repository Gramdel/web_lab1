<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>lab1</title>
    <style>
        .mainHeading::first-line {
            color: #4a98ff;
            font-size: 25pt;
        }
        .mainHeading {
            margin-top: 1.5%;
            margin-left: 1.5%;
            color: #114da4;
            font-family: fantasy;
            font-size: 23pt;
        }
        #content {
            margin-top: 1.5%;
            margin-left: 1.5%;
            font-family: "Calibri", sans-serif;
            font-size: large;
        }
        #content div {
            margin-bottom: 1.5%;
        }
        .inputBlock {
            font-size: larger;
            font-style: italic;
        }
        button {
            font-family: "Calibri Light", sans-serif;
            width: 20.9%;
            padding-bottom: 3px;
            font-size: 15pt;
        }
        input {
            margin-left: 1%;
        }
        input:invalid {
            color: red;
        }
    </style>
</head>
<body>

<header>
    <div class="mainHeading">
        Асташин Сергей Сергеевич<br>
        Группа: P3230 Вариант: 30003
    </div>
</header>

<div id="content">
    <form action="core.php" method="post" name="pointCheckForm">
        <div class="inputBlock">
            <b>Изменение X:</b><label><input type="checkbox" name="coordinateX" checked onclick="changeCheckBoxBehavior(this)" value="-3"/>-3</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="-2"/>-2</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="-1"/>-1</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="0"/>0</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="1"/>1</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="2"/>2</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="3"/>3</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="4"/>4</label><label><input type="checkbox" name="coordinateX" onclick="changeCheckBoxBehavior(this)" value="5"/>5</label>
        </div>
        <div class="inputBlock">
            <b>Изменение Y:</b><label data-validate="Обязательное поле"><input type="text" name="coordinateY" style="margin-left: 1.2%; width: 12.5%; font-size: 16pt; font-style: italic; font-family: 'Calibri', sans-serif;" pattern="(-?[0-2]\.\d*(?=[1-9])[1-9])|0|(-?[12])" required title="Число из промежутка (-3...3); разделитель целой и дробной части - точка (.); незначащие нули не писать!" autocomplete="off"/></label>
        </div>
        <div class="inputBlock">
            <b>Изменение R:</b><label><input type="checkbox" name="radius" checked onclick="changeCheckBoxBehavior(this)" value="1"/>1</label><label><input type="checkbox" name="radius" onclick="changeCheckBoxBehavior(this)" value="1.5"/>1.5</label><label><input type="checkbox" name="radius" onclick="changeCheckBoxBehavior(this)" value="2"/>2</label><label><input type="checkbox" name="radius" onclick="changeCheckBoxBehavior(this)" value="2.5"/>2.5</label><label><input type="checkbox" name="radius" onclick="changeCheckBoxBehavior(this)" value="3"/>3</label>
        </div>
        <button type="submit">Отправить</button>
    </form>
    <?php
        session_start();
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
    ?>
</div>
</body>
</html>
<script>
    function changeCheckBoxBehavior(element)
    {
        let checkboxes = document.getElementsByName(element.name);
        for (let i = 0; i < checkboxes.length; i++)
        {
            checkboxes[i].checked = false;
        }
        element.checked = true;
    }
</script>