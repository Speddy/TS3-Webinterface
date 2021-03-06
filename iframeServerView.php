<?php
	/*
		First-Coder Teamspeak 3 Webinterface for everyone
		Copyright (C) 2017 by L.Gmann

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <http://www.gnu.org/licenses/>.
		
		for help look http://first-coder.de/
	*/
	
	/*
		Includes
	*/
	require_once("./config/config.php");
	require_once("./config/instance.php");
	require_once("./lang/lang.php");
	require_once("./php/classes/ts3admin.class.php");
	
	/*
		Teamspeak Function
	*/
	$tsAdmin = new ts3admin($ts3_server[$_GET['instanz']]['ip'], $ts3_server[$_GET['instanz']]['queryport']);
	
	if($tsAdmin->getElement('success', $tsAdmin->connect()))
	{
		$tsAdmin->login($ts3_server[$_GET['instanz']]['user'], $ts3_server[$_GET['instanz']]['pw']);
		$tsAdmin->selectServer($_GET['port'], 'port', true);
		
		$server = $tsAdmin->serverInfo();
	};
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/sonstige/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="./css/bootstrap/bootstrap.css" />
		<style>
			.tree-background-success
			{
				background-color: rgba(0, 199, 0, 0.2);
				border: 1px solid rgba(0,255,0,0.4);
				border-radius: 4px;
			}
			
			.tree-background-failed
			{
				background-color: rgba(199, 0, 0, 0.2);
				border: 1px solid rgba(255,0,0,0.4);
				border-radius: 4px;
			}
		</style>
	</head>
	<body style="color:#<?php echo htmlentities($_GET['color']); ?>;background-color:<?php echo htmlentities($_GET['bodybgcolor']); ?>;font-size:<?php echo htmlentities($_GET['fontsize']); ?>">
		<div class="col-lg-12 col-md-12" id="tree_loading" style="margin-top:20px;margin-bottom:20px;text-align:center;background-color:<?php echo htmlentities($_GET['spinbgcolor']); ?>;">
			<h3><?php echo $language['ts_tree_loading']; ?></h3><br /><i style="font-size:100px;" class="fa fa-cogs fa-spin"></i>
		</div>
		<div class="col-lg-12 col-md-12 tree <?php echo ($server['data']['virtualserver_status'] == 'online') ? 'tree-background-success' : 'tree-background-failed'; ?>" id="tree" style="padding:20px;display:none;">
			<div id="header_tree">
				<div style="float:left;">
					<div id="server_name" class="servername">&nbsp;&nbsp;<?php echo htmlentities($server['data']['virtualserver_name']); ?></div>
				</div>
				<div style="float:right;text-align:right;" id="server_icon"></div>
				<div style="clear:both;"></div>
			</div>
			<div id="tree_content"></div>
		</div>
	</body>
	
	<script language="JavaScript">
		var instanz						=	'<?php echo htmlentities($_GET['instanz']); ?>',
			port 						= 	'<?php echo htmlentities($_GET['port']); ?>',
			treeInterval				= 	<?php echo TEAMSPEAKTREE_INTERVAL; ?>;
	</script>
	<script src="./js/jquery/jquery-2.2.0.js"></script>
	<script src="./js/webinterface/teamspeakTree.js"></script>
</html>