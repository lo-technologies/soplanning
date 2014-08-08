<?php /* Smarty version 2.6.26, created on 2014-07-20 22:01:48
         compiled from www_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_header.tpl', 11, false),array('modifier', 'formatMessage', 'www_header.tpl', 119, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="reply-to" content="support@soplanning.org" />
		<meta name="email" content="support@soplanning.org" />
		<meta name="Identifier-URL" content="http://www.soplanning.org" />
		<meta name="robots" content="noindex,follow" />

		<title><?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SOPLANNING_TITLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
</title>

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
		<script src="assets/plugins/jqueryui/i18n/jquery.ui.datepicker-<?php echo $this->_tpl_vars['lang']; ?>
.js"></script>

				<script type="text/javascript" src="assets/plugins/window/prototype.js"></script>

				<script type="text/javascript" src="assets/plugins/jscolor/jscolor.js"></script>

				<script type="text/javascript" src="assets/js/sousmenu.js"></script>

		<script type="text/javascript" src="assets/js/fonctions.js"></script>

		<link href="assets/plugins/select2/select2.css" rel="stylesheet">
		<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>

		<link href="assets/css/print.css" rel="stylesheet" media="print">

		<?php echo $this->_tpl_vars['xajax']; ?>


	</head>

	<body>
		<?php if (isset ( $this->_tpl_vars['user'] )): ?>
			<div class="navbar navbar-inverse noprint">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="<?php echo $this->_tpl_vars['BASE']; ?>
/planning.php"><?php echo @CONFIG_SOPLANNING_TITLE; ?>
&nbsp;<small><?php echo $this->_tpl_vars['infoVersion']; ?>
</small></a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li class="dropdown">
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/planning.php" class="dropdown-toggle"><img src="./assets/img/pictos/logo.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuAfficherPlanning']; ?>
</a>
									<ul class="dropdown-menu dropdown-menu-hover">
										<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/planning.php"><img src="./assets/img/pictos/logo.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuAfficherPlanning']; ?>
</a></li>
										<?php if (! in_array ( 'planning_readonly' , $this->_tpl_vars['user']['tabDroits'] )): ?>
											<li><a href="javascript:Reloader.stopRefresh();xajax_ajoutPeriode();undefined;"><img src="./assets/img/pictos/addplanning.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuAjouterPeriode']; ?>
</a></li>
										<?php endif; ?>
									</ul>
								</li>
								<?php if (in_array ( 'projects_manage_all' , $this->_tpl_vars['user']['tabDroits'] ) || in_array ( 'projects_manage_own' , $this->_tpl_vars['user']['tabDroits'] )): ?>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/projets.php" class="dropdown-toggle"><img src="./assets/img/pictos/projets.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuListeProjets']; ?>
</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/projets.php"><img src="./assets/img/pictos/projets.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuListeProjets']; ?>
</a></li>
											<li><a href="javascript:Reloader.stopRefresh();xajax_ajoutProjet();undefined;"><img src="./assets/img/pictos/addprojet.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuAjouterProjet']; ?>
</a></li>
											<?php if (in_array ( 'projectgroups_manage_all' , $this->_tpl_vars['user']['tabDroits'] )): ?>
												<li><a href="groupe_list.php"><img src="./assets/img/pictos/groupes.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuListeGroupes']; ?>
</a></li>
											<?php endif; ?>
										</ul>
									</li>
								<?php endif; ?>
								<?php if (in_array ( 'users_manage_all' , $this->_tpl_vars['user']['tabDroits'] )): ?>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php" class="dropdown-toggle"><img src="./assets/img/pictos/users.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuGestionUsers']; ?>
</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php"><img src="./assets/img/pictos/users.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuGestionUsers']; ?>
</a></li>
											<li><a href="javascript:xajax_modifUser();undefined;"><img src="./assets/img/pictos/adduser.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerUser']; ?>
</a></li>
											<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_groupes.php"><img src="./assets/img/pictos/user_groupes.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuGroupesUsers']; ?>
</a></li>
										</ul>
									</li>
								<?php endif; ?>
								<?php if (in_array ( 'parameters_all' , $this->_tpl_vars['user']['tabDroits'] )): ?>
									<li class="divider-vertical"></li>
									<li class="dropdown active">
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/options.php" class="dropdown-toggle"><img src="./assets/img/pictos/options.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuOptions']; ?>
</a>
										<ul class="dropdown-menu dropdown-menu-hover">
											<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/options.php"><img src="./assets/img/pictos/options.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuOptions']; ?>
</a></li>
											<li><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/feries.php"><img src="./assets/img/pictos/feries.png" border="0">&nbsp;<?php echo $this->_config[0]['vars']['menuFeries']; ?>
</a></li>
										</ul>
									</li>
								<?php endif; ?>
							</ul>
						</div>
						<ul class="nav pull-right">
							<li>
								<a href="javascript:xajax_modifProfil();undefined;"><?php echo $this->_tpl_vars['user']['nom']; ?>
 (<?php echo $this->_tpl_vars['user']['user_id']; ?>
)</a>
							</li>
							<li>
								<a href="process/login.php?action=logout"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/logout.png" alt=" " style="height: 20px;"/></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if (isset ( $this->_tpl_vars['smartyData']['message'] )): ?>
			<?php $this->assign('messageFinal', ((is_array($_tmp=$this->_tpl_vars['smartyData']['message'])) ? $this->_run_mod_handler('formatMessage', true, $_tmp) : formatMessage($_tmp))); ?>
			<div class="container-fluid">
				<div id="divMessage" class="alert <?php if ($this->_tpl_vars['smartyData']['message'] == 'changeNotOK'): ?>alert-error<?php else: ?>alert-success<?php endif; ?>">
					<p><?php echo $this->_tpl_vars['messageFinal']; ?>
</p>
				</div>
			</div>
		<?php endif; ?>

				<script type="text/javascript" src="assets/js/cooltip.js"></script>
		<script type="text/javascript">ctPageDefaults(WIDTH, 260, FGCOLOR, '#EBEBE0', null, 1, TEXTSIZE, '11px'); </script>
		<div id="ctDiv" style="position: absolute; visibility: hidden; z-index: 100000000;" class="divTooltip"></div>
