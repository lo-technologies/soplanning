<?php /* Smarty version 2.6.26, created on 2014-07-21 15:18:01
         compiled from www_groupe_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'www_groupe_list.tpl', 18, false),array('modifier', 'escape', 'www_groupe_list.tpl', 40, false),array('modifier', 'xss_protect', 'www_groupe_list.tpl', 42, false),)), $this); ?>
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
/projets.php" class="btn btn-small" ><img src="assets/img/pictos/projets.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuListeProjets']; ?>
</a>
					<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_form.php" class="btn btn-small"><img src="assets/img/pictos/addgroupe.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerGroupe']; ?>
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
						<tr>
							<th>&nbsp;</th>
							<th align="center">
								<?php if ($this->_tpl_vars['order'] == 'nom'): ?>
									<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php?page=1&order=nom&by=desc"><?php echo $this->_config[0]['vars']['groupe_liste_nom']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
									<?php else: ?>
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php?page=1&order=nom&by=asc"><?php echo $this->_config[0]['vars']['groupe_liste_nom']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
									<?php endif; ?>
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php?page=1&order=nom&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['groupe_liste_nom']; ?>
</a>
								<?php endif; ?>
							</th>
							<th><?php echo $this->_config[0]['vars']['groupe_liste_nbProjets']; ?>
</th>
						</tr>
						<?php $_from = $this->_tpl_vars['groupes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['groupes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['groupes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['groupe']):
        $this->_foreach['groupes']['iteration']++;
?>
							<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
								<td align="center" nowrap="nowrap">
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_form.php?groupe_id=<?php echo $this->_tpl_vars['groupe']['groupe_id']; ?>
"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
									&nbsp;
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/process/groupe_save.php?groupe_id=<?php echo $this->_tpl_vars['groupe']['groupe_id']; ?>
&action=delete" onClick="javascript:return confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['groupe_liste_confirmSuppr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
')"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
								</td>
								<td><?php echo ((is_array($_tmp=$this->_tpl_vars['groupe']['nom'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
&nbsp;</td>
								<td><?php echo $this->_tpl_vars['groupe']['totalProjets']; ?>
&nbsp;</td>
							</tr>
						<?php endforeach; endif; unset($_from); ?>
						<?php if ($this->_tpl_vars['nbPages'] > 1): ?>
							<tr>
								<td colspan="7" align="right">
									<?php if ($this->_tpl_vars['currentPage'] > 1): ?><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php?page=<?php echo $this->_tpl_vars['currentPage']-1; ?>
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
/groupe_list.php?page=<?php echo $this->_sections['pagination']['iteration']; ?>
"><?php endif; ?>
										<?php echo $this->_sections['pagination']['iteration']; ?>

										<?php if ($this->_sections['pagination']['iteration'] == $this->_tpl_vars['currentPage']): ?></b><?php else: ?></a><?php endif; ?>&nbsp;
									<?php endfor; endif; ?>
									<?php if ($this->_tpl_vars['currentPage'] < $this->_tpl_vars['nbPages']): ?><a href="<?php echo $this->_tpl_vars['BASE']; ?>
/groupe_list.php?page=<?php echo $this->_tpl_vars['currentPage']+1; ?>
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