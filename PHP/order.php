<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Tim Horton's Order Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            .coffee{
                display: inline-block;
                float: left;
                width:100%;
            }
            .total{
                font-size: 2em;
                position: fixed;
                bottom:5px;
                width: 100%;
                background: #6D4334;
                padding-top: 5px;
            }
            button{
                background: #BF2E32;
                border-color: #D72E32;
                border-radius: 5px;
                color: #F5F5F5;
            }
            img{
                width: 35px;
                height: auto;
            }
        </style>
    </head>
    <body>

        <div class="header">
            <img src="images/header.jpg" alt="Logo"/>
            <h1>Welcome to Tim Horton's</h1>
            <h2>Your Order:</h2>

        </div>

        <?php
        $number = filter_input(INPUT_POST, "amount", FILTER_VALIDATE_INT);
        $size = filter_input(INPUT_POST, "size", FILTER_SANITIZE_STRING);
        $cream = filter_input(INPUT_POST, "Cream", FILTER_VALIDATE_INT);
        $sugar = filter_input(INPUT_POST, "Sugar", FILTER_VALIDATE_INT);
        $price = 00.00;
        $total = 00.00;
        $scale = 4;

        function showCups($size) {
            if ($size == "s") {
                echo"<img class='cups' src=images/cup.svg style=width:10%;height:auto;>";
                $GLOBALS['price'] = 1.09;
            } elseif ($size == "m") {
                echo'<img src=images/cup.svg style=width:20%;height:auto;>';
                $GLOBALS['price'] = 1.59;
                $GLOBALS['scale'] = 5;
            } elseif ($size == "l") {
                echo'<img src=images/cup.svg style=width:30%;height:auto;>';
                $GLOBALS['price'] = 2.09;
                $GLOBALS['scale'] = 6;
            } elseif ($size == "xl") {
                echo'<img src=images/cup.svg style=width:40%;height:auto;>';
                $GLOBALS['price'] = 2.59;
                $GLOBALS['scale'] = 7;
            } else {
                echo"";
            }
            insertBreak();
        }

        function showCream($cream) {
            if ($cream != 0) {
                insertPlus();
				insertCream($cream);
            }
            insertBreak();
        }

        function insertCream($times) {
            for ($i = 0; $i < $times; $i++) {
                echo '<img style=width:';
                echo $GLOBALS["scale"];
                echo '%; src="images/cream.svg">';
            }
        }

        function showSugar($sugar) {
            if ($sugar != 0) {
                insertPlus();
				insertSugar($sugar);
            }
        }

        function insertSugar($times) {
            for ($i = 0; $i < $times; $i++) {
                echo '<img style=width:';
                echo $GLOBALS["scale"];
                echo '%; src="images/sugar.svg">';
            }
        }

        function insertPlus() {
            echo '<img style=width:';
            echo $GLOBALS["scale"];
            echo '%; src="images/plus.svg">';
        }

        function insertBreak() {
            echo '<br>';
        }

        for ($i = 0; $i < $number; $i++) {
            echo"<div class='coffee mb-3' id='coffee$number'>";
            showCups($size);
            showCream($cream);
            showSugar($sugar);
            echo"</div>";
            if ($i == ($number - 1)) {
                echo'<p style="font-size:1px;">Have a great day!</p>';
                echo'<div style="height: 50px;" ></div> ';
            }
            $total += $price;
        }
        echo'<div class ="total"> ';
        echo'Cost: $';
        echo$price;
        echo' x ';
        echo$number;
        echo' + tax(13%) = ';
        $total *= 1.13;
        echo round($total, 2);
        echo'<button class="btn" type="button" onclick="alert(\'Payed\' )">Pay</button>';
        echo'</div>';
        ?>

        <div class="footer">

        </div>
    </body>
</html>