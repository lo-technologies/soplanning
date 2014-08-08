<?php /* Smarty version 2.6.26, created on 2014-07-20 22:08:26
         compiled from www_user_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'www_user_list.tpl', 5, false),array('modifier', 'urlencode', 'www_user_list.tpl', 90, false),array('modifier', 'escape', 'www_user_list.tpl', 92, false),array('modifier', 'xss_protect', 'www_user_list.tpl', 94, false),array('modifier', 'cat', 'www_user_list.tpl', 112, false),array('modifier', 'buttonFontColor', 'www_user_list.tpl', 112, false),)), $this); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (count($this->_tpl_vars['users']) > 0): ?>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<div class="btn-group">
					<a href="javascript:xajax_modifUser();undefined;" class="btn btn-small" ><img src="assets/img/pictos/adduser.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerUser']; ?>
</a>
					<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_groupes.php" class="btn btn-small"><img src="assets/img/pictos/user_groupes.png" border="0" width="14" height="18">&nbsp;<?php echo $this->_config[0]['vars']['menuGroupesUsers']; ?>
</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<table class="table table-striped">
					<tr>
						<th>&nbsp;</th>
						<th align="center">
							<?php if ($this->_tpl_vars['order'] == 'nom'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=nom&by=desc"><?php echo $this->_config[0]['vars']['user_nom']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=nom&by=asc"><?php echo $this->_config[0]['vars']['user_nom']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=nom&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_nom']; ?>
</a>
							<?php endif; ?>
						</th>
						<th align="center">
							<?php echo $this->_config[0]['vars']['user_groupe']; ?>

						</th>
						<th align="center">
							<?php echo $this->_config[0]['vars']['user_droits_court']; ?>

						</th>
						<th align="center">
							<?php if ($this->_tpl_vars['order'] == 'email'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=email&by=desc"><?php echo $this->_config[0]['vars']['user_email']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=email&by=asc"><?php echo $this->_config[0]['vars']['user_email']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=email&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_email']; ?>
</a>
							<?php endif; ?>
						</th>
						<th align="center">
							<?php if ($this->_tpl_vars['order'] == 'user_id'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=user_id&by=desc"><?php echo $this->_config[0]['vars']['user_identifiant']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=user_id&by=asc"><?php echo $this->_config[0]['vars']['user_identifiant']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=user_id&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_identifiant']; ?>
</a>
							<?php endif; ?>
						</th>
						<th align="center">
							<?php if ($this->_tpl_vars['order'] == 'login'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=login&by=desc"><?php echo $this->_config[0]['vars']['user_login']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=login&by=asc"><?php echo $this->_config[0]['vars']['user_login']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=login&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_login']; ?>
</a>
							<?php endif; ?>
						</th>
						<th align="center">
							<?php if ($this->_tpl_vars['order'] == 'visible_planning'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=visible_planning&by=desc"><?php echo $this->_config[0]['vars']['user_visiblePlanning']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=visible_planning&by=asc"><?php echo $this->_config[0]['vars']['user_visiblePlanning']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=1&order=visible_planning&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['user_visiblePlanning']; ?>
</a>
							<?php endif; ?>
						</th>
						<th><?php echo $this->_config[0]['vars']['user_liste_NBPeriodes']; ?>
</th>
					</tr>
					<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['users'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['users']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['userTmp']):
        $this->_foreach['users']['iteration']++;
?>
						<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
							<td align="center" nowrap="nowrap">
								<a href="javascript:xajax_modifUser('<?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['user_id'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');undefined;"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
								&nbsp;
								<a href="javascript:xajax_supprimerUser('<?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['user_id'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');undefined;" onClick="javascript:return confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['user_liste_confirmSuppr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
')"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
							</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['nom'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
&nbsp;</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['nom_groupe'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
&nbsp;</td>
							<td style="font-size:9px">
								<?php if (in_array ( 'users_manage_all' , $this->_tpl_vars['userTmp']['tabDroits'] )): ?><?php echo $this->_config[0]['vars']['droits_utilisateurs']; ?>
&nbsp;<?php endif; ?>
								<?php if (in_array ( 'projects_manage_all' , $this->_tpl_vars['userTmp']['tabDroits'] ) || in_array ( 'projects_manage_own' , $this->_tpl_vars['userTmp']['tabDroits'] )): ?><?php echo $this->_config[0]['vars']['droits_projets']; ?>
&nbsp;<?php endif; ?>
								<?php if (in_array ( 'projectgroups_manage_all' , $this->_tpl_vars['userTmp']['tabDroits'] )): ?><?php echo $this->_config[0]['vars']['droits_groupesProjets']; ?>
&nbsp;<?php endif; ?>
								<?php if (in_array ( 'planning_modify_all' , $this->_tpl_vars['userTmp']['tabDroits'] ) || in_array ( 'planning_modify_own_project' , $this->_tpl_vars['userTmp']['tabDroits'] ) || in_array ( 'planning_modify_own_task' , $this->_tpl_vars['userTmp']['tabDroits'] )): ?><?php echo $this->_config[0]['vars']['droits_modifPlanning']; ?>
&nbsp;<?php endif; ?>
								<?php if (in_array ( 'parameters_modify' , $this->_tpl_vars['userTmp']['tabDroits'] )): ?><?php echo $this->_config[0]['vars']['droits_parametres']; ?>
&nbsp;<?php endif; ?>
								&nbsp;
							</td>
							<td>
								<?php if ($this->_tpl_vars['userTmp']['email'] != ""): ?>
									<a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['email'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['userTmp']['email'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
</a>
								<?php endif; ?>
								&nbsp;
							</td>
							<td>
								&nbsp;
								<?php $this->assign('couleurTexte', ((is_array($_tmp=((is_array($_tmp='#')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['userTmp']['couleur']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['userTmp']['couleur'])))) ? $this->_run_mod_handler('buttonFontColor', true, $_tmp) : buttonFontColor($_tmp))); ?>
								<span style="padding:3px;color:<?php echo $this->_tpl_vars['couleurTexte']; ?>
;background-color:#<?php echo $this->_tpl_vars['userTmp']['couleur']; ?>
"><?php echo $this->_tpl_vars['userTmp']['user_id']; ?>
</span>
							</td>
							<td><?php echo $this->_tpl_vars['userTmp']['login']; ?>
&nbsp;</td>
							<td align="center">
								<?php $this->assign('valTmp', $this->_tpl_vars['userTmp']['visible_planning']); ?>
								<?php echo $this->_config[0]['vars'][$this->_tpl_vars['valTmp']]; ?>

								&nbsp;
							</td>
							<td align="center"><?php echo $this->_tpl_vars['userTmp']['totalPeriodes']; ?>
&nbsp;</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<?php if ($this->_tpl_vars['nbPages'] > 1): ?>
						<tr>
							<td colspan="7" align="right">
								<?php if ($this->_tpl_vars['currentPage'] > 1): ?><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=<?php echo $this->_tpl_vars['currentPage']-1; ?>
">&lt;&lt; <?php echo $this->_config[0]['vars']['action_precedent']; ?>
</a>&nbsp;&nbsp;<?php endif; ?>
								<?php unset($this->_sections['pagination']);
$this->_sections['pagination']['name'] = 'pagination';
$this->_sections['pagination']['loop'] = is_array($_loop=$this->_tpl_vars['nbPages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagination']['show'] = true;
$this->_sections['pagination']['max'] = $this->_sections['pagination']['loop'];
$this->_sections['pagination']['step'] = 1;
$this->_sections['pagination']['start'] = $this->_sections['pagination']['step'] > 0 ? 0 : $this->_sections['pagination']['loop']-1;
if ($this->_sections['pagination']['show']) {
    $this->_sections['pagination']['total'] = $this->_sections['pagination']['loop'];
    if ($this->_sections['pagination']['total'] == 0)
        $this->_sections['pagination']['show'] = false;
} else
    $this->_sections['pagination']['total'] = 0;
if ($this->_sections['pagination']['show']):

            for ($this->_sections['pagination']['index'] = $this->_sections['pagination']['start'], $this->_sections['pagination']['iteration'] = 1;
                 $this->_sections['pagination']['iteration'] <= $this->_sections['pagination']['total'];
                 $this->_sections['pagination']['index'] += $this->_sections['pagination']['step'], $this->_sections['pagination']['iteration']++):
$this->_sections['pagination']['rownum'] = $this->_sections['pagination']['iteration'];
$this->_sections['pagination']['index_prev'] = $this->_sections['pagination']['index'] - $this->_sections['pagination']['step'];
$this->_sections['pagination']['index_next'] = $this->_sections['pagination']['index'] + $this->_sections['pagination']['step'];
$this->_sections['pagination']['first']      = ($this->_sections['pagination']['iteration'] == 1);
$this->_sections['pagination']['last']       = ($this->_sections['pagination']['iteration'] == $this->_sections['pagination']['total']);
?>
									<?php if ($this->_sections['pagination']['iteration'] == $this->_tpl_vars['currentPage']): ?><b><?php else: ?><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=<?php echo $this->_sections['pagination']['iteration']; ?>
"><?php endif; ?>
									<?php echo $this->_sections['pagination']['iteration']; ?>

									<?php if ($this->_sections['pagination']['iteration'] == $this->_tpl_vars['currentPage']): ?></b><?php else: ?></a><?php endif; ?>&nbsp;
								<?php endfor; endif; ?>
								<?php if ($this->_tpl_vars['currentPage'] < $this->_tpl_vars['nbPages']): ?><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/user_list.php?page=<?php echo $this->_tpl_vars['currentPage']+1; ?>
"><?php echo $this->_config[0]['vars']['action_suivant']; ?>
 &gt;&gt;</a><?php endif; ?>
							</td>
						</tr>
					<?php endif; ?>
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