<?php /* Smarty version 2.6.26, created on 2014-08-02 15:22:55
         compiled from user_group_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'user_group_form.tpl', 6, false),)), $this); ?>
<form class="form-horizontal" method="POST" action="" target="_blank" onsubmit="return false;">
	<div class="control-group">
		<label class="control-label"><?php echo $this->_config[0]['vars']['user_groupe']; ?>
 :</label>
		<div class="controls">
			<input id="nom" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['groupe']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="50" maxlength="150" />
		</div>
	</div>
	<input type="button" class="btn btn-primary" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['submit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" style="margin-left: 180px;" onclick="xajax_submitFormUserGroupe('<?php echo ((is_array($_tmp=$this->_tpl_vars['groupe']['user_groupe_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
', $('nom').value);"/>
</form>