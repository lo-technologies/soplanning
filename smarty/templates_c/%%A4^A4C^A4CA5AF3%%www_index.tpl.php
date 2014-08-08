<?php /* Smarty version 2.6.26, created on 2014-07-20 22:01:06
         compiled from www_index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_index.tpl', 28, false),array('modifier', 'formatMessage', 'www_index.tpl', 39, false),)), $this); ?>
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

		<?php echo $this->_tpl_vars['xajax']; ?>


	</head>
	<body>
		<div class="container">
			<h3 class="text-center">
				<?php if (@CONFIG_SOPLANNING_TITLE != 'SOPlanning'): ?>
					<span style="font-size:23px;font-weight:bold;"><?php echo ((is_array($_tmp=((is_array($_tmp=@CONFIG_SOPLANNING_TITLE)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
</span>
				<?php else: ?>
					<span style="font-size:30px;font-weight:bold;">Simple Online Planning</span>
<!-- 					<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictoslogo.jpg" border="0"> -->
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['infoVersion'] )): ?>
					<small style="white-space: nowrap;">v<?php echo $this->_tpl_vars['infoVersion']; ?>
</small>
				<?php endif; ?>
			</h3>
			<div class="small-container">
				<?php if (isset ( $this->_tpl_vars['smartyData']['message'] )): ?>
					<?php $this->assign('messageFinal', ((is_array($_tmp=$this->_tpl_vars['smartyData']['message'])) ? $this->_run_mod_handler('formatMessage', true, $_tmp) : formatMessage($_tmp))); ?>
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->_tpl_vars['messageFinal']; ?>

					</div>
				<?php endif; ?>
				<form action="process/login.php" method="post" class="form-horizontal box">
					<div class="control-group">
						<label class="control-label" for="cfgHostname"><?php echo $this->_config[0]['vars']['login_login']; ?>
 :</label>
						<div class="controls">
							<input type="text" size="20" name="login" id="login">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password"><?php echo $this->_config[0]['vars']['login_password']; ?>
 :</label>
						<div class="controls">
							<input type="password" size="20" name="password" id="password">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input class="btn btn-primary" type="submit" value="GO">
							<a href="#pwdReminderModal" role="button" class="btn btn-link" data-toggle="modal"><?php echo $this->_config[0]['vars']['rappelPwdTitre']; ?>
</a>
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
					<small><a href="mailto:support@soplanning.org"><?php echo $this->_config[0]['vars']['proposerTrad']; ?>
</a></small>
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
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>