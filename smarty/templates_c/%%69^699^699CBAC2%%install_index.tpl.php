<?php /* Smarty version 2.6.26, created on 2014-07-20 21:56:56
         compiled from install_index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'formatMessage', 'install_index.tpl', 31, false),)), $this); ?>
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

		<?php echo $this->_tpl_vars['xajax']; ?>


	</head>

	<body>
		<div class="container">
			<h3 class="text-center">
				<span style="font-size:30px;font-weight:bold;">Simple Online Planning</span>
			</h3>
			<div class="small-container">
				<?php if (isset ( $this->_tpl_vars['smartyData']['message'] )): ?>
					<?php $this->assign('messageFinal', ((is_array($_tmp=$this->_tpl_vars['smartyData']['message'])) ? $this->_run_mod_handler('formatMessage', true, $_tmp) : formatMessage($_tmp))); ?>
					<div class="alert alert-error" id="divMessage" >
						<div class="row-fluid noprint">
							<div class="span10">
								<?php echo $this->_tpl_vars['messageFinal']; ?>

							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['checkInstall']['checkPhpVersion'] )): ?>
					<div class="alert alert-error">
						<h4><?php echo $this->_config[0]['vars']['install_wrongPhpVersion']; ?>
</h4>
						<?php echo $this->_config[0]['vars']['install_currentPhpVersion']; ?>
 :<?php phpversion(); ?>
						<br />
						<?php echo $this->_config[0]['vars']['install_requiredPhpVersion']; ?>
 : 5.2
					</div>
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['checkInstall']['checkDatabaseVersion'] )): ?>
					<div class="alert alert-warning">
						<h4><?php echo $this->_config[0]['vars']['install_DBUpgradeResult']; ?>
</h4>
						<?php if (isset ( $this->_tpl_vars['checkInstall']['databaseUpgradeResult'] )): ?>
							<?php echo $this->_tpl_vars['checkInstall']['databaseUpgradeResult']; ?>

						<?php endif; ?>
						<a href="../"><?php echo $this->_config[0]['vars']['install_clickLoginAgain']; ?>
</a><br />
					</div>
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['checkInstall']['checkDBAccess'] ) || ( isset ( $this->_tpl_vars['checkInstall']['checkDatabaseVersion'] ) && $this->_tpl_vars['checkInstall']['checkDatabaseVersion'] == 'database_empty' )): ?>
					<form action="database.php" method="post" class="form-horizontal box">
						<h2><?php echo $this->_config[0]['vars']['install_installationDB']; ?>
</h2>
						<div class="control-group">
							<label class="control-label" for="cfgHostname"><?php echo $this->_config[0]['vars']['install_mysqlServer']; ?>
 :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgHostname" id="cfgHostname" value="<?php echo $this->_tpl_vars['cfgHostname']; ?>
">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgDatabase"><?php echo $this->_config[0]['vars']['install_DBName']; ?>
 :<br/><span style="font-size:10px;"><?php echo $this->_config[0]['vars']['install_missingDBCreated']; ?>
.</span></label>
							<div class="controls">
								<input type="text" size="20" name="cfgDatabase" id="cfgDatabase" value="<?php echo $this->_tpl_vars['cfgDatabase']; ?>
">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgHostname"><?php echo $this->_config[0]['vars']['install_mysqlLogin']; ?>
 :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgUsername" id="cfgUsername" value="<?php echo $this->_tpl_vars['cfgUsername']; ?>
">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cfgPassword"><?php echo $this->_config[0]['vars']['install_mysqlPassword']; ?>
 :</label>
							<div class="controls">
								<input type="text" size="20" name="cfgPassword" id="cfgPassword" value="<?php echo $this->_tpl_vars['cfgPassword']; ?>
">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input class="btn btn-primary" type="submit" value="<?php echo $this->_config[0]['vars']['install_startInstallButton']; ?>
">
							</div>
						</div>
					</form>
				<?php endif; ?>
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
					<small><a href="mailto:support@soplanning.org"><?php echo $this->_config[0]['vars']['proposerTrad']; ?>
</a></small>
				</p>
				<p class="text-right text-info"><small><?php echo $this->_config[0]['vars']['install_intro']; ?>
</small></p>
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