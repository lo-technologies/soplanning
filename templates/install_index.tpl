<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="reply-to" content="support@soplanning.org" />
		<meta name="email" content="support@soplanning.org" />
		<meta name="Identifier-URL" content="http://www.soplanning.org" />

		<title>SoPlanning Installation</title>

		<link href="favicon.ico" rel="icon" type="image/x-icon" />

		<link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../assets/css/styles.css" rel="stylesheet">
		<link href="../assets/css/simplePage.css" rel="stylesheet">
		<link href="../assets/css/utils.css" rel="stylesheet">
		<link href="../assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		{$xajax}

	</head>

	<body>
		<div class="container">
			<h3 class="text-center">
				<span style="font-size:30px;font-weight:bold;">Simple Online Planning</span>
			</h3>
			<div class="small-container">
				{if isset($smartyData.message)}
					{assign var=messageFinal value=$smartyData.message|formatMessage}
					<div class="alert alert-error" id="divMessage" >
						<div class="row-fluid noprint">
							<div class="span10">
								{$messageFinal}
							</div>
						</div>
					</div>
				{/if}
				{if isset($checkInstall.checkPhpVersion)}
					<div class="alert alert-error">
						<h4>{#install_wrongPhpVersion#}</h4>
						{#install_currentPhpVersion#} :{php}phpversion();{/php}
						<br />
						{#install_requiredPhpVersion#} : 5.2
					</div>
				{/if}
				{if isset($checkInstall.checkDatabaseVersion)}
					<div class="alert alert-warning">
						<h4>{#install_DBUpgradeResult#}</h4>
						{if isset($checkInstall.databaseUpgradeResult)}
							{$checkInstall.databaseUpgradeResult}
						{/if}
						<a href="../">{#install_clickLoginAgain#}</a><br />
					</div>
				{/if}
				{if isset($checkInstall.checkDBAccess)  || (isset($checkInstall.checkDatabaseVersion) && $checkInstall.checkDatabaseVersion eq 'database_empty')}
					<form action="database.php" method="post" class="form-horizontal box">
						<h2>{#install_installationDB#}</h2>
						<div class="control-group">
							<label class="control-label" for="cfgHostname">{#install_mysqlServer#} :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgHostname" id="cfgHostname" value="{$cfgHostname}">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgDatabase">{#install_DBName#} :<br/><span style="font-size:10px;">{#install_missingDBCreated#}.</span></label>
							<div class="controls">
								<input type="text" size="20" name="cfgDatabase" id="cfgDatabase" value="{$cfgDatabase}">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgHostname">{#install_mysqlLogin#} :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgUsername" id="cfgUsername" value="{$cfgUsername}">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgPassword">{#install_mysqlPassword#} :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgPassword" id="cfgPassword" value="{$cfgPassword}">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input class="btn btn-primary" type="submit" value="{#install_startInstallButton#}">
							</div>
						</div>
					</form>
				{/if}
				<ul class="inline flag text-right">
					<li><a tabindex="-1" href="?language=pt" class="tooltipEvent" data-title="Portuguese"><img src="../assets/img/flag/pt.png" alt="Portuguese"/></a></li>
					<li><a tabindex="-1" href="?language=es" class="tooltipEvent" data-title="Spanish"><img src="../assets/img/flag/es.png" alt="Spanish"/></a></li>
					<li><a tabindex="-1" href="?language=de" class="tooltipEvent" data-title="German"><img src="../assets/img/flag/de.png" alt="German"/></a></li>
					<li><a tabindex="-1" href="?language=nl" class="tooltipEvent" data-title="Dutch"><img src="../assets/img/flag/nl.png" alt="Dutch"/></a></li>
					<li><a tabindex="-1" href="?language=it" class="tooltipEvent" data-title="Italian"><img src="../assets/img/flag/it.png" alt="Italian"/></a></li>
					<li><a tabindex="-1" href="?language=fr" class="tooltipEvent" data-title="French"><img src="../assets/img/flag/fr.png" alt="French"/></a></li>
					<li><a tabindex="-1" href="?language=en" class="tooltipEvent" data-title="English"><img src="../assets/img/flag/en.png" alt="English"/></a></li>
				</ul>
				<p class="text-right text-info">
					<small><a href="mailto:support@soplanning.org">{#proposerTrad#}</a></small>
				</p>
				<p class="text-right text-info"><small>{#install_intro#}</small></p>
			</div>
		</div>
		<div class="navbar navbar-fixed-bottom footer">
			<div class="navbar-inner">
				<div class="container text-center">
					<p class="text-info">
						<a target="_blank" href="http://www.soplanning.org">SOPlanning Website</a>
						&nbsp;-&nbsp;
						<a href="mailto:support@soplanning.org">Support</a>
						&nbsp;-&nbsp;
						<a target="_blank" href="http://www.soplanning.org/en/donate.php">Donate</a>
					</p>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.1.min.js"></script>
		<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.js"></script>
	</body>
</html>