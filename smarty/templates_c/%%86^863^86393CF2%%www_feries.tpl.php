<?php /* Smarty version 2.6.26, created on 2014-07-20 22:09:15
         compiled from www_feries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'basename', 'www_feries.tpl', 14, false),array('modifier', 'count', 'www_feries.tpl', 24, false),array('modifier', 'urlencode', 'www_feries.tpl', 38, false),array('modifier', 'escape', 'www_feries.tpl', 40, false),array('modifier', 'sqldate2userdate', 'www_feries.tpl', 43, false),)), $this); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<a href="javascript:xajax_modifFerie();undefined;" class="btn btn-small" ><img src="assets/img/pictos/feries.png" border="0" width="18">&nbsp;<?php echo $this->_config[0]['vars']['menuCreerFerie']; ?>
</a>
				<div class="btn-group">
					<button class="btn btn-small" data-toggle="dropdown"><?php echo $this->_config[0]['vars']['feries_import']; ?>
&nbsp;<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<?php $_from = $this->_tpl_vars['fichiers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fichier']):
?>
							<li><a onClick="event.cancelBubble=true;" href="javascript:if(confirm('<?php echo $this->_config[0]['vars']['feries_confirmImport']; ?>
'))<?php echo '{'; ?>
document.location='process/feries.php?fichier=<?php echo ((is_array($_tmp=$this->_tpl_vars['fichier'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)); ?>
'<?php echo '}'; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['fichier'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)); ?>
</a></li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<?php if (count($this->_tpl_vars['feries']) > 0): ?>
					<table class="table table-striped">
						<tr>
							<th width="70">&nbsp;</th>
							<th align="center" width="100">
								<b><?php echo $this->_config[0]['vars']['feries_date']; ?>
</b>
							</th>
							<th align="center">
								<b><?php echo $this->_config[0]['vars']['feries_libelle']; ?>
</b>
							</th>
						</tr>
						<?php $_from = $this->_tpl_vars['feries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['feries'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['feries']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ferie']):
        $this->_foreach['feries']['iteration']++;
?>
							<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
								<td align="center" nowrap="nowrap">
									<a href="javascript:xajax_modifFerie('<?php echo ((is_array($_tmp=$this->_tpl_vars['ferie']['date_ferie'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');undefined;"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
									&nbsp;
									<a href="javascript:xajax_supprimerFerie('<?php echo ((is_array($_tmp=$this->_tpl_vars['ferie']['date_ferie'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');undefined;" onClick="javascript:return confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['confirm'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
')"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
								</td>
								<td align="center">
									<?php echo ((is_array($_tmp=$this->_tpl_vars['ferie']['date_ferie'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
&nbsp;
								</td>
								<td>
									<?php echo $this->_tpl_vars['ferie']['libelle']; ?>

								</td>
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