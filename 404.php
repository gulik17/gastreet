<?php
session_name('gss');
session_start();

$img = 'maze'.rand(1, 3).'.png';

if ( isset($_SESSION["lang"]) && ($_SESSION["lang"] == 'en') ) {
    $title = 'Error 404 - Not Found';
    $desc = 'Go to Home page';
} else {
    $title = '404 - страница не найдена';
    $desc = 'Перейти на Главную страницу';
} ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                background:#000;
                color:#fff;
                font-size:12px;
                line-height:18px;
                margin:0;
                padding:0;
                font-family:Arial, Helvetica, sans-serif;
                font-size:14px;
                text-align: center;
                padding: 5% 0 0 0;
                background: url(/images/404-bg.jpg);
                width: 100%;
                height: 100%;
                background-size: cover;}
            canvas {
                z-index: 6;
                position: relative;}
            img {
                display: none;}
            button {
                padding: 8px;}
            a,a:hover{color:#fff;}
            b,strong{
                font-weight:bold;
                color:#fff;}
            h1,h2,h3,h4,h5,h6{
                font-family:"Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
                line-height:1.2;
                text-transform:uppercase;
                font-weight:normal;}
            h2 {font-size:26px;}
            #block-on-center{
                position: relative;
                margin-bottom: 4rem;
                border: none;
                width: 100%;
                text-align: center;
                z-index: 1;}
            body:before{
                content:" ";
                display:block;
                width:100%;
                height:100%;
                position:fixed;
                background-color:rgba(0,0,0,.4);
                top:0;
                left:0;}
            @media all and (max-width:600px){
                h2{font-size:20px;}
            }
        </style>
        <script>
            // Определяем глобальные переменные для холста и контекста 
            var canvas;
            var context;

            // Отслеживаем текущую позицию значка
            var x = 0;
            var y = 0;

            // Скорость перемещения значка
            var dx = 0;
            var dy = 0;

            window.onload = function() {
                // Подготавливаем холст
                canvas = document.getElementById("canvas");
                context = canvas.getContext("2d");
                // Рисуем фон лабиринта
                drawMaze('/images/game/<?=$img?>', 268, 5);
                // При нажатии клавиши вызываем функцию processKey()
                window.onkeydown = processKey;
            };


            // Таймер, включающий и отключающий новый лабиринт в любое время
            var timer;

            function drawMaze(mazeFile, startingX, startingY) {
                // Остановить таймер (если запущен)
                clearTimeout(timer);
                // Остановить перемещение значка
                dx = 0;
                dy = 0;
                // Загружаем изображение лабиринта
                var imgMaze = new Image();
                imgMaze.onload = function() {
                    // Изменяем размер холста в соответствии 
                    // с размером изображения лабиринта
                    canvas.width = imgMaze.width;
                    canvas.height = imgMaze.height;
                    // Рисуем лабиринт
                    context.drawImage(imgMaze, 0,0);
                    // Рисуем значок
                    x = startingX;
                    y = startingY;
                    var imgFace = document.getElementById("face");
                    context.drawImage(imgFace, x, y);
                    context.stroke();
                    // Рисуем следующий кадр через 10 миллисекунд
                    timer = setTimeout("drawFrame()", 10);
                };
                imgMaze.src = mazeFile;
            }

            function processKey(e) {
                // Если значок находится в движении, останавливаем его
                dx = 0;
                dy = 0;
                // Если нажата стрелка вверх, начинаем двигаться вверх
                if (e.keyCode == 38) {
                    dy = -1;
                }
                // Если нажата стрелка вниз, начинаем двигаться вниз
                if (e.keyCode == 40) {
                    dy = 1;
                }
                // Если нажата стрелка влево, начинаем двигаться влево
                if (e.keyCode == 37) {
                    dx = -1;
                }
                // Если нажата стрелка вправо, начинаем двигаться вправо
                if (e.keyCode == 39) {
                    dx = 1;
                }
            }

            function checkForCollision() {
                // Перебираем все пикселы и инвертируем их цвет
                var imgData = context.getImageData(x-1, y-1, 15+2, 15+2);
                var pixels = imgData.data;

                // Получаем данные для одного пиксела
                for (var i = 0; n = pixels.length, i < n; i += 4) {
                    var red = pixels[i];
                    var green = pixels[i+1];
                    var blue = pixels[i+2];
                    var alpha = pixels[i+3];

                    // Смотрим на наличие черного цвета стены, что указывает на столкновение
                    if (red == 0 && green == 0 && blue == 0) {
                      return true;
                    }
                    // Смотрим на наличие серого цвета краев, что указывает на столкновение
                    if (red == 169 && green == 169 && blue == 169) {
                      return true;
                    }
                }
                // Столкновения не было
                return false;
            }

            function drawFrame() {
                // Обновляем кадр только если значок движется
                if (dx != 0 || dy != 0) {
                    // Закрашиваем перемещение значка желтым цветом
                    context.beginPath();
                    context.fillStyle = "rgb(254,244,207)";
                    context.rect(x, y, 15, 15);
                    context.fill()
                    // Обновляем координаты значка, создавая перемещение
                    x += dx;
                    y += dy;
                    // Проверка столкновения со стенками лабиринта (вызывается доп. функция)
                    if (checkForCollision()) {
                        x -= dx;
                        y -= dy;
                        dx = 0;
                        dy = 0;
                    }

                    // Перерисовываем значок
                    var imgFace = document.getElementById("face");
                    context.drawImage(imgFace, x, y);

                    // Проверяем дошел ли пользователь до финиша.
                        // Если дошел, то выводим сообщение
                    if (y > (canvas.height - 17)) {
                        alert("Ты победил!");
                        return;
                    }
                }

                // Рисуем следующий кадр через 10 миллисекунд
                timer = setTimeout("drawFrame()", 10);
            }
        </script>
    </head>
    <body>
        <div id="block-on-center">
            <h2><?= $title ?></h2> 
            <p><a href="/"><?= $desc ?></a></p>
            <p>Или сыграй в мини-игру :-)</p>
        </div>
        <canvas id="canvas" width="597" height="598"></canvas>
        <img id="face" src="/images/game/face.png">
    </body>
</html>