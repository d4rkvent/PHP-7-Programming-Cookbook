<?php
// example of PDO MySQL connection

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

try {
	$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$stmt = $pdo->query('THIS SQL STATEMENT WILL NOT WORK');
	printf('%4s | %20s | %5s | %7s' . PHP_EOL, 'ID', 'NAME', 'LEVEL', 'BALANCE');
	printf('%4s | %20s | %5s | %7s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-------');
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf('%4d | %20s | %5s | %7.2f' . PHP_EOL, 
				$row['id'], $row['name'], $row['level'], $row['balance']);
	}
} catch (PDOException $e) {
	error_log($e->getMessage());
} catch (Throwable $e) {
	error_log($e->getMessage());
}
