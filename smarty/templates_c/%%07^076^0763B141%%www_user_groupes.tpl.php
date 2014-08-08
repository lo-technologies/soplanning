<?php /* Smarty version 2.6.26, created on 2014-07-21 11:18:49
         compiled from www_user_groupes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'www_user_groupes.tpl', 19, false),array('modifier', 'escape', 'www_user_groupes.tpl', 41, false),)), $this); ?>
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
/user_list.php" class="btn btn-small" ><img src="assets/img/pictos/users.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuGestionUsers']; ?>
</a>
					<a href="javascript:xajax_modifUserGroupe();undefined;" class="btn btn-small"><img src="assets/img/pictos/adduser_groupes.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerUserGroupe']; ?>
</a>
					<a href="javascript:xajax_modifUser();undefined;" class="btn btn-small"><img src="assets/img/pictos/adduser.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerUser']; ?>
</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<?php if (count($this->_tpl_vars['groupes']) > 0): ?>
					<table class="table table-striped">
						<tr align="middle">
							<th>&nbsp;</th>
							<th align="center">
								<?php if ($this->_tpl_vars['order'] == 'nom'): ?>
									<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_groupes.php?page=1&order=nom&by=desc"><?php echo $this->_config[0]['vars']['user_groupe']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
									<?php else: ?>
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_groupes.php?page=1&order=nom&by=asc"><?php echo $this->_config[0]['vars']['user_groupe']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
									<?php endif; ?>
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_groupes.php?page=1&order=nom&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_groupe']; ?>
</a>
								<?php endif; ?>
							</th>
							<th><?php echo $this->_config[0]['vars']['user_groupe_nbUsers']; ?>
</th>
						</tr>
						<?php $_from = $this->_tpl_vars['groupes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['groupes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['groupes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['groupe']):
        $this->_foreach['groupes']['iteration']++;
?>
							<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
								<td align="center" nowrap="nowrap" width="60">
									<a href="javascript:xajax_modifUserGroupe(<?php echo $this->_tpl_vars['groupe']['user_groupe_id']; ?>
);undefined;"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
									&nbsp;
									<a href="javascript:if(confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['confirm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
'))<?php echo '{'; ?>
javascript:xajax_supprimerUserGroupe(<?php echo $this->_tpl_vars['groupe']['user_groupe_id']; ?>
);<?php echo '}'; ?>
;undefined;"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
								</td>
								<td><?php echo $this->_tpl_vars['groupe']['nom']; ?>
&nbsp;</td>
								<td><?php echo $this->_tpl_vars['groupe']['totalUsers']; ?>
&nbsp;</td>
							</tr>
						<?php endforeach; endif; unset($_from); ?>
					</table>
				<?php else: ?>
					<?php echo $this->_config[0]['vars']['info_noRecord']; ?>

				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>