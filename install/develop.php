<?php

die('Хуй');
header("Content-Type: text/html; charset=utf-8");
//set_time_limit(0);
require_once "../app/Config/framework.php";

$sqlLog = Request::getVar("sql");
if ($sqlLog) {

    $db = Request::getVar("db");
    $mode = Configurator::getCurrentMode();
    //Configurator::init($mode);
    $oConn = Application::getConnection($db);
    $sql = stripslashes(html_entity_decode(urldecode(Request::getVar("sql"))));

    try {
        $res = $oConn->getRows(" EXPLAIN " . $sql);
    } catch (Exception $e) {
        echo "Недопустимая операция "."<br/><br/>";
        echo $e->getMessage();
        die();
    }
    $html = "<a href='{$_SERVER['HTTP_REFERER']}'>НАЗАД</a>";
    $html .= "<h1>План SQL запроса : </h1>";
    $html .= "<b>{$sql}</b><br/><br/>";
    $html .= "<table width='100%' border='1'>";
    $html .= "<tr>";
    $html .= "	<td>id</td>";
    $html .= "	<td>select type</td>";
    $html .= "	<td>table</td>";
    $html .= "	<td>type</td>";
    $html .= "	<td>possible keys</td>";
    $html .= "	<td>key</td>";
    $html .= "	<td>key len</td>";
    $html .= "	<td>ref</td>";
    $html .= "	<td>rows</td>";
    $html .= "	<td>Extra</td>";
    $html .= "</tr>";

    for ($i = 0; $i < count($res); $i++) {
        $html .= "<tr>";
        foreach ($res[$i] as $item) {
            $item = htmlentities($item ? $item : "NULL");
            $html .= "<td>{$item}</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";

    $html .= "<h3>Читаем подробнее об EXPLAIN</h3>";
    $html .= "<a href='http://www.mysql.ru/docs/man/EXPLAIN.html' target='_blank'>Здесь информация из документации</a><br/>";
    $html .= "<a href='http://phpclub.ru/detail/article/mysql_optimize' target='_blank'>Оптимизация запросов в MySQL</a><br/>";
    echo $html;
    die();
}

echo "<h1><a href='install.php'>Install Page</a></h1>";
echo "<h1><a href='develop.php'>Development tools</a></h1>";
echo "<h3>Create your business entity class</h3>";

$form = <<<EOT
	<form action="" method="post">
	<table border=0>
	<tr>
		<td width="150">
		Table <input type="text" name="table" value=""/><br/>
		</td>
	</tr>
	<tr>
		<td width="150">	
		Entity class name <input type="text" name="class" value=""/><br/>
		</td>
	</tr>
	<tr>
		<td width="150">	
		Config name <input type="text" name="config" value="develop"/><br/>
		</td>
	</tr>
	<tr>
		<td width="150">	
		Connection name <input type="text" name="connection" value="master"/><br/>
		</td>
	</tr>	
	<tr>
		<td width="150">	
		<input type="submit" value="Generate!" />
		</td>
	</tr>	
	</table>
	</form>
EOT;

echo $form;

if (Request::getMethod() == "POST") {
    echo "Result code</br>";
    echo "<textarea rows=50 cols=150>";
    require_once "../install/tools/generator/index.php";
    echo "</textarea>";
}