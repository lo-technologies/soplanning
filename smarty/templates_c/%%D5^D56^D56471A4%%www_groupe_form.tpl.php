<?php /* Smarty version 2.6.26, created on 2014-08-02 15:22:20
         compiled from www_groupe_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_groupe_form.tpl', 34, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<div class="btn-group">
					<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/projets.php" class="btn btn-small" ><img src="assets/img/pictos/projets.png" border="0" width="18"> <?php echo $this->_config[0]['vars']['menuListeProjets']; ?>
</a>
					<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php" class="btn btn-small"><img src="assets/img/pictos/groupes.png" border="0" width="18"> <?php echo $this->_config[0]['vars']['menuListeGroupes']; ?>
</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<?php if (isset ( $this->_tpl_vars['error_fields'] )): ?>
					<div class="alert alert-error">
						<h5><?php echo $this->_config[0]['vars']['groupe_erreurChamps']; ?>
 :</h5>
						<ul>
							<?php $_from = $this->_tpl_vars['error_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
								<li><?php echo $this->_tpl_vars['field']; ?>
</li>
							<?php endforeach; endif; unset($_from); ?>
						</ul>
					</div>
				<?php endif; ?>
				<form action="<?php echo $this->_tpl_vars['BASE']; ?>
/process/groupe_save.php" method="POST" class="form-horizontal formElement">
					<input type="hidden" name="saved" value="<?php echo $this->_tpl_vars['groupe']['saved']; ?>
" />
					<input type="hidden" name="groupe_id" value="<?php echo $this->_tpl_vars['groupe']['groupe_id']; ?>
" />
					<div class="control-group">
						<label class="control-label" for="inputEmail"><?php echo $this->_config[0]['vars']['groupe_nom']; ?>
 :</label>
						<div class="input-append">
							<input name="nom" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['groupe']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="30" maxlength="100" />
							<input type="submit" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['groupe_valider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="btn btn-small" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>