<?php
	include("config.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_SIM_PATH; ?>css/style.css" media="screen" />
        <script src="<?php echo BASE_SIM_PATH; ?>js/script.js" type="text/javascript"></script>
		<title>SQL Injection Simulation Environment - By SQLinjections.net</title>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<div id="logo">
					<h1>SQL<span class="active" style="font-weight:bold;color:#9C0;">&laquo;</span>Injection</h1>
				</div>
				<div class="divclear"></div>
			</div>
            <div id="tabs">
              <ul>
              	<?php
					$page = str_replace(BASE_SIM_PATH, "", $_SERVER["PHP_SELF"]);
					$page = str_replace("/", "", $page);
					$page = str_replace(".php", "", $page);

					$p_arr = array("index", "instructions", "simulations", "setup", "about");
				?>
                <li><a href="<?php echo BASE_SIM_PATH.$p_arr[0]; ?>.php"><span<?php if($page == $p_arr[0]) echo ' class="active"' ?>>Home</span></a></li>
                <li><a href="<?php echo BASE_SIM_PATH.$p_arr[1]; ?>.php"><span<?php if($page == $p_arr[1]) echo ' class="active"' ?>>Intructions</span></a></li>
                <li><a href="<?php echo BASE_SIM_PATH.$p_arr[2]; ?>.php"><span<?php if($page == $p_arr[2]) echo ' class="active"' ?>>Simulations</span></a></li>
                <li><a href="<?php echo BASE_SIM_PATH.$p_arr[3]; ?>.php"><span<?php if($page == $p_arr[3]) echo ' class="active"' ?>>Setup / Reset</span></a></li>
                <li><a href="<?php echo BASE_SIM_PATH.$p_arr[4]; ?>.php"><span<?php if($page == $p_arr[4]) echo ' class="active"' ?>>About</span></a></li></li>
              </ul>
            </div>
			<div id="main">
