<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="reply-to" content="support@soplanning.org" />
		<meta name="email" content="support@soplanning.org" />
		<meta name="Identifier-URL" content="http://www.soplanning.org" />
		<meta name="robots" content="noindex,follow" />

		<title>{$smarty.const.CONFIG_SOPLANNING_TITLE|escape:'html'|escape:'javascript'}</title>

		<link href="favicon.ico" rel="icon" type="image/x-icon" />

		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
		<link href="assets/css/utils.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="assets/plugins/jqueryui/css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">

		<script src="assets/js/jquery-1.10.1.min.js"></script>
		<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="assets/plugins/jqueryui/js/jquery-ui.js"></script>
		<script src="assets/plugins/jqueryui/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/plugins/jqueryui/i18n/jquery.ui.datepicker-{$lang}.js"></script>

		{* prototype window *}
		<script type="text/javascript" src="assets/plugins/window/prototype.js"></script>

		{* palette de couleur*}
		<script type="text/javascript" src="assets/plugins/jscolor/jscolor.js"></script>

		{* layer pour choix des projets � afficher *}
		<script type="text/javascript" src="assets/js/sousmenu.js"></script>

		<script type="text/javascript" src="assets/js/fonctions.js"></script>

		<link href="assets/plugins/select2/select2.css" rel="stylesheet">
		<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>

		<link href="assets/css/print.css" rel="stylesheet" media="print">

		{$xajax}

	</head>

	<body>
		{if isset($user)}
			<div class="navbar navbar-inverse noprint">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="{$BASE}/planning.php">{$smarty.const.CONFIG_SOPLANNING_TITLE}&nbsp;<small>{$infoVersion}</small></a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li class="dropdown">
									<a href="{$BASE}/planning.php" class="dropdown-toggle"><img src="./assets/img/pictos/logo.png" border="0">&nbsp;{#menuAfficherPlanning#}</a>
									<ul class="dropdown-menu dropdown-menu-hover">
										<li><a href="{$BASE}/planning.php"><img src="./assets/img/pictos/logo.png" border="0">&nbsp;{#menuAfficherPlanning#}</a></li>
										{if !in_array("planning_readonly", $user.tabDroits)}
											<li><a href="javascript:Reloader.stopRefresh();xajax_ajoutPeriode();undefined;"><img src="./assets/img/pictos/addplanning.png" border="0">&nbsp;{#menuAjouterPeriode#}</a></li>
										{/if}
									</ul>
								</li>
								{if in_array("projects_manage_all", $user.tabDroits) || in_array("projects_manage_own", $user.tabDroits)}
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="{$BASE}/projets.php" class="dropdown-toggle"><img src="./assets/img/pictos/projets.png" border="0">&nbsp;{#menuListeProjets#}</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="{$BASE}/projets.php"><img src="./assets/img/pictos/projets.png" border="0">&nbsp;{#menuListeProjets#}</a></li>
											<li><a href="javascript:Reloader.stopRefresh();xajax_ajoutProjet();undefined;"><img src="./assets/img/pictos/addprojet.png" border="0">&nbsp;{#menuAjouterProjet#}</a></li>
											{if in_array("projectgroups_manage_all", $user.tabDroits)}
												<li><a href="groupe_list.php"><img src="./assets/img/pictos/groupes.png" border="0">&nbsp;{#menuListeGroupes#}</a></li>
											{/if}
										</ul>
									</li>
								{/if}
								{if in_array("users_manage_all", $user.tabDroits)}
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="{$BASE}/user_list.php" class="dropdown-toggle"><img src="./assets/img/pictos/users.png" border="0">&nbsp;{#menuGestionUsers#}</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="{$BASE}/user_list.php"><img src="./assets/img/pictos/users.png" border="0">&nbsp;{#menuGestionUsers#}</a></li>
											<li><a href="javascript:xajax_modifUser();undefined;"><img src="./assets/img/pictos/adduser.png" border="0">&nbsp;{#menuCreerUser#}</a></li>
											<li><a href="{$BASE}/user_groupes.php"><img src="./assets/img/pictos/user_groupes.png" border="0">&nbsp;{#menuGroupesUsers#}</a></li>
										</ul>
									</li>
								{/if}
								{if in_array("parameters_all", $user.tabDroits)}
									<li class="divider-vertical"></li>
									<li class="dropdown active">
										<a href="{$BASE}/options.php" class="dropdown-toggle"><img src="./assets/img/pictos/options.png" border="0">&nbsp;{#menuOptions#}</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="{$BASE}/options.php"><img src="./assets/img/pictos/options.png" border="0">&nbsp;{#menuOptions#}</a></li>
											<li><a href="{$BASE}/feries.php"><img src="./assets/img/pictos/feries.png" border="0">&nbsp;{#menuFeries#}</a></li>
										</ul>
									</li>
								{/if}
							</ul>
						</div>
						<ul class="nav pull-right">
							<li>
								<a href="javascript:xajax_modifProfil();undefined;">{$user.nom} ({$user.user_id})</a>
							</li>
							<li>
								<a href="process/login.php?action=logout"><img src="{$BASE}/assets/img/pictos/logout.png" alt=" " style="height: 20px;"/></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		{/if}

		{if isset($smartyData.message)}
			{assign var=messageFinal value=$smartyData.message|formatMessage}
			<div class="container-fluid">
				<div id="divMessage" class="alert {if $smartyData.message eq 'changeNotOK'}alert-error{else}alert-success{/if}">
					<p>{$messageFinal}</p>
				</div>
			</div>
		{/if}

		{* cooltip pour les rollover, à laisser ici sinon ça genere un espace en haut de page *}
		<script type="text/javascript" src="assets/js/cooltip.js"></script>
		<script type="text/javascript">ctPageDefaults(WIDTH, 260, FGCOLOR, '#EBEBE0', null, 1, TEXTSIZE, '11px'); </script>
		<div id="ctDiv" style="position: absolute; visibility: hidden; z-index: 100000000;" class="divTooltip"></div>

