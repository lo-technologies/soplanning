<?php /* Smarty version 2.6.26, created on 2014-07-20 22:09:37
         compiled from profil_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profil_form.tpl', 7, false),)), $this); ?>
<form class="form-horizontal" method="POST" action="" target="_blank" name="formUser"  onSubmit="return false;">
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_identifiant']; ?>
 :</label>
		<div class="controls">
			<?php if ($this->_tpl_vars['user_form']['saved'] == 1): ?>
				<input id="user_id" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" readonly/>
			<?php else: ?>
				<input id="user_id" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="3" maxlength="3" />
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_nom']; ?>
 :</label>
		<div class="controls">
			<input type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" readonly/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_email']; ?>
 :</label>
		<div class="controls">
			<input id="email_user" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="40" maxlength="255" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_login']; ?>
 :</label>
		<div class="controls">
			<input type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" readonly/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_password']; ?>
 :</label>
		<div class="controls">
			<input id="password_tmp" type="password" value="" size="20" maxlength="20" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_notifications']; ?>
 :</label>
		<div class="controls">
			<label class="radio inline">
				<input type="radio" id="notificationsOui" name="notifications" value="oui" <?php if ($this->_tpl_vars['user_form']['notifications'] == 'oui'): ?>checked="checked"<?php endif; ?>>&nbsp;<?php echo $this->_config[0]['vars']['oui']; ?>

			</label>
			<label class="radio inline">
				<input type="radio" id="notificationsNon" name="notifications" value="non" <?php if ($this->_tpl_vars['user_form']['notifications'] == 'non'): ?>checked="checked"<?php endif; ?> style="margin-left:20px;">&nbsp;<?php echo $this->_config[0]['vars']['non']; ?>

			</label>
		</div>
	</div>
	<input type="button" class="btn btn-primary" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" onClick="xajax_submitFormProfil('<?php echo ((is_array($_tmp=$this->_tpl_vars['user_form']['user_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
', $('email_user').value, $('password_tmp').value, $('notificationsOui').checked);" style="margin-left: 180px;"/>
</form>