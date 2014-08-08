<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="reply-to" content="support@soplanning.org" />
		<meta name="email" content="support@soplanning.org" />
		<meta name="Identifier-URL" content="http://www.soplanning.org" />
		<meta name="robots" content="noindex,follow" />

		<title>SoPlanning</title>

		<link href="favicon.ico" rel="icon" type="image/x-icon" />

		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
		<link href="assets/css/simplePage.css" rel="stylesheet">
		<link href="assets/css/utils.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		{$xajax}

	</head>
	<body>
		<div class="container">
			<h3 class="text-center">
				{if $smarty.const.CONFIG_SOPLANNING_TITLE neq "SOPlanning"}
					<span style="font-size:23px;font-weight:bold;">{$smarty.const.CONFIG_SOPLANNING_TITLE|escape:'html'|escape:'javascript'}</span>
				{else}
					<span style="font-size:30px;font-weight:bold;">Simple Online Planning</span>
<!-- 					<img src="{$BASE}/assets/img/pictoslogo.jpg" border="0"> -->
				{/if}
				{if isset($infoVersion)}
					<small style="white-space: nowrap;">v{$infoVersion}</small>
				{/if}
			</h3>
			<div class="small-container">
				{if isset($smartyData.message)}
					{assign var=messageFinal value=$smartyData.message|formatMessage}
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{$messageFinal}
					</div>
				{/if}
				<form action="process/login.php" method="post" class="form-horizontal box">
					<div class="control-group">
						<label class="control-label" for="cfgHostname">{#login_login#} :</label>
						<div class="controls">
							<input type="text" size="20" name="login" id="login">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">{#login_password#} :</label>
						<div class="controls">
							<input type="password" size="20" name="password" id="password">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input class="btn btn-primary" type="submit" value="GO">
							<a href="#pwdReminderModal" role="button" class="btn btn-link" data-toggle="modal">{#rappelPwdTitre#}</a>
						</div>
					</div>
				</form>
				<ul class="inline flag text-right">
					<li><a tabindex="-1" href="?language=pt" class="tooltipEvent" data-title="Portuguese"><img src="assets/img/flag/pt.png" alt="Portuguese"/></a></li>
					<li><a tabindex="-1" href="?language=es" class="tooltipEvent" data-title="Spanish"><img src="assets/img/flag/es.png" alt="Spanish"/></a></li>
					<li><a tabindex="-1" href="?language=de" class="tooltipEvent" data-title="German"><img src="assets/img/flag/de.png" alt="German"/></a></li>
					<li><a tabindex="-1" href="?language=nl" class="tooltipEvent" data-title="Dutch"><img src="assets/img/flag/nl.png" alt="Dutch"/></a></li>
					<li><a tabindex="-1" href="?language=it" class="tooltipEvent" data-title="Italian"><img src="assets/img/flag/it.png" alt="Italian"/></a></li>
					<li><a tabindex="-1" href="?language=fr" class="tooltipEvent" data-title="French"><img src="assets/img/flag/fr.png" alt="French"/></a></li>
					<li><a tabindex="-1" href="?language=en" class="tooltipEvent" data-title="English"><img src="assets/img/flag/en.png" alt="English"/></a></li>
				</ul>
				<p class="text-right text-info">
					<small><a href="mailto:support@soplanning.org">{#proposerTrad#}</a></small>
				</p>
				<div id="infosVersion" style="display:none"></div>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.1.min.js"></script>
		<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="assets/plugins/jqueryui/js/jquery-ui.js"></script>
		<script type="text/javascript" src="assets/js/login.js"></script>
		<script type="text/javascript" src="assets/js/fonctions.js"></script>

		<script language="javascript">
			document.getElementById('login').focus();

			setTimeout("xajax_checkAvailableVersion();", 5000);

		</script>
		{include file="www_footer.tpl"}