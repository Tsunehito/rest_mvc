<?php 
	require_once('../Library/Loader.php');

	use Library\Loader;
	use Library\Router;
	use Library\Settings;
	use Library\Database;

	Loader::startAutoload();
	Settings::start();

	Database::connect(Settings::get("db"));

	$res = $_GET['resource'];
	unset($_GET['resource']);

	Router::dispatchPage($res);

