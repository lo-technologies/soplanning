<?php /* Smarty version 2.6.26, created on 2014-07-21 13:13:43
         compiled from www_projets.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'www_projets.tpl', 67, false),array('modifier', 'default', 'www_projets.tpl', 71, false),array('modifier', 'xss_protect', 'www_projets.tpl', 130, false),array('modifier', 'cat', 'www_projets.tpl', 142, false),array('modifier', 'buttonFontColor', 'www_projets.tpl', 142, false),array('modifier', 'sqldate2userdate', 'www_projets.tpl', 158, false),)), $this); ?>
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
					<?php if (in_array ( 'projectgroups_manage_all' , $this->_tpl_vars['user']['tabDroits'] )): ?>
						<a href="groupe_list.php" class="btn btn-small"><img src="assets/img/pictos/groupes.png" border="0" style="height: 16px;"/> <?php echo $this->_config[0]['vars']['menuListeGroupes']; ?>
</a>
					<?php endif; ?>
					<a href="javascript:xajax_ajoutProjet('projets');undefined;" class="btn btn-small"><img src="assets/img/pictos/addprojet.png" border="0" style="height: 16px;"/> <?php echo $this->_config[0]['vars']['menuAjouterProjet']; ?>
</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<form action="projets.php" method="GET" class="form-inline">
					<label><?php echo $this->_config[0]['vars']['projet_liste_afficherProjets']; ?>
 :</label>
					<div class="btn-group" data-toggle="buttons-radio">
						<button type="button" class="btn btn-small<?php if ($this->_tpl_vars['filtrageProjet'] == 'tous'): ?> active<?php endif; ?>" onclick="top.location='?filtrageProjet=tous';"><?php echo $this->_config[0]['vars']['projet_liste_afficherProjetsTous']; ?>
</button>
						<button type="button" class="btn btn-small<?php if ($this->_tpl_vars['filtrageProjet'] != 'tous'): ?> active<?php endif; ?>" onclick="top.location='?filtrageProjet=date';"><?php echo $this->_config[0]['vars']['projet_liste_afficherProjetsParDate']; ?>
</button>
					</div>
					<?php if ($this->_tpl_vars['filtrageProjet'] != 'tous'): ?>
						<label style="margin-left:20px;">
							<?php echo $this->_config[0]['vars']['formNbMois']; ?>
:
						</label>
						<div class="input-append">
							<input name="nb_mois" type="text" size="2" value="<?php echo $this->_tpl_vars['nbMois']; ?>
" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
						<label>
							<?php echo $this->_config[0]['vars']['formDebut']; ?>
:
						</label>
						<div class="input-append">
							<input name="date_debut_affiche" id="date_debut_affiche" style="width:80px;" type="text" value="<?php echo $this->_tpl_vars['dateDebut']; ?>
" class="input-mini datepicker" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
						<script><?php echo 'addEvent(window, \'load\', function(){jQuery("#date_debut_affiche").datepicker()});'; ?>
</script>
						<label>
							<?php echo $this->_config[0]['vars']['formInfoDateFin']; ?>
 : <?php echo $this->_tpl_vars['dateFin']; ?>

						</label>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<form action="" method="GET" class="form-inline">
					<label class="checkbox inline"><?php echo $this->_config[0]['vars']['projet_liste_afficherProjets']; ?>
 :</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="a_faire" value="a_faire" <?php if (in_array ( 'a_faire' , $this->_tpl_vars['listeStatuts'] )): ?>checked="checked"<?php endif; ?>><?php echo $this->_config[0]['vars']['projet_liste_statutAfaire']; ?>

					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="en_cours" value="en_cours" <?php if (in_array ( 'en_cours' , $this->_tpl_vars['listeStatuts'] )): ?>checked="checked"<?php endif; ?>><?php echo $this->_config[0]['vars']['projet_liste_statutEnCours']; ?>

					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="fait" value="fait" <?php if (in_array ( 'fait' , $this->_tpl_vars['listeStatuts'] )): ?>checked="checked"<?php endif; ?>><?php echo $this->_config[0]['vars']['projet_liste_statutFait']; ?>

					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="statut[]" id="abandon" value="abandon" <?php if (in_array ( 'abandon' , $this->_tpl_vars['listeStatuts'] )): ?>checked="checked"<?php endif; ?>><?php echo $this->_config[0]['vars']['projet_liste_statutAbandon']; ?>

					</label>
					<input type="submit" value="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['formAfficher'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="btn btn-small" style="margin-left: 10px;"/>

					<div class="btn-group" style="margin-left:70px">
						<div class="input-append">
							<input type="text" style="width:150px;" name="rechercheProjet" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['rechercheProjet'])) ? $this->_run_mod_handler('default', true, $_tmp, "") : smarty_modifier_default($_tmp, "")); ?>
" />
							<input type="submit" value="<?php echo $this->_config[0]['vars']['projet_liste_chercher']; ?>
" class="btn <?php if ($this->_tpl_vars['rechercheProjet'] != ""): ?>btn-danger<?php endif; ?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				<table class="table table-striped">
					<tr style="font-weight:bold;">
						<td colspan="2" align="center">
							<?php if ($this->_tpl_vars['order'] == 'nom'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="?order=nom&by=desc"><?php echo $this->_config[0]['vars']['projet_liste_projet']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="?order=nom&by=asc"><?php echo $this->_config[0]['vars']['projet_liste_projet']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="?order=nom&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['projet_liste_projet']; ?>
</a>
							<?php endif; ?>
						</td>
						<td align="center">
							<?php if ($this->_tpl_vars['order'] == 'nom_createur'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="?order=nom_createur&by=desc"><?php echo $this->_config[0]['vars']['projet_liste_createur']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="?order=nom_createur&by=asc"><?php echo $this->_config[0]['vars']['projet_liste_createur']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="?order=nom_createur&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['projet_liste_createur']; ?>
</a>
							<?php endif; ?>
						</td>
						<td align="center" nowrap="nowrap">
							<?php if ($this->_tpl_vars['order'] == 'charge'): ?>
								<?php if ($this->_tpl_vars['by'] == 'asc'): ?>
									<a href="?order=charge&by=desc"><?php echo $this->_config[0]['vars']['projet_liste_charge']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/asc_order.png" border="0" alt="" />
								<?php else: ?>
									<a href="?order=charge&by=asc"><?php echo $this->_config[0]['vars']['projet_liste_charge']; ?>
</a>&nbsp;<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/desc_order.png" border="0" alt="" />
								<?php endif; ?>
							<?php else: ?>
								<a href="?order=charge&by=<?php echo $this->_tpl_vars['by']; ?>
"><?php echo $this->_config[0]['vars']['projet_liste_charge']; ?>
</a>
							<?php endif; ?>
						</td>
						<td align="center">
							<?php echo $this->_config[0]['vars']['projet_liste_livraison']; ?>

						</td>
						<td align="center">
							<?php echo $this->_config[0]['vars']['projet_liste_commentaires']; ?>

						</td>
					</tr>
					<tr>
						<td colspan="6" style="font-size:14px; background-color:#ECE9D8;"><b><?php echo $this->_config[0]['vars']['projet_liste_sansGroupes']; ?>
</b></td>
					</tr>
					<?php $this->assign('groupeCourant', ""); ?>
					<?php $_from = $this->_tpl_vars['projets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['projet']):
?>
						<?php if ($this->_tpl_vars['projet']['groupe_id'] != $this->_tpl_vars['groupeCourant']): ?>
							<td colspan="6" style="font-size:14px; background-color:#ECE9D8;"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['nom_groupe'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
</b></td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['projet']['statut'] == 'a_faire'): ?>
							<?php $this->assign('couleurLigne', "#ffffff"); ?>
						<?php elseif ($this->_tpl_vars['projet']['statut'] == 'en_cours'): ?>
							<?php $this->assign('couleurLigne', "#B0FB04"); ?>
						<?php elseif ($this->_tpl_vars['projet']['statut'] == 'fait'): ?>
							<?php $this->assign('couleurLigne', "#FFBE7D"); ?>
						<?php elseif ($this->_tpl_vars['projet']['statut'] == 'abandon'): ?>
							<?php $this->assign('couleurLigne', "#9D9D9D"); ?>
						<?php endif; ?>
						<tr style="background-color:<?php echo $this->_tpl_vars['couleurLigne']; ?>
;" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='<?php echo $this->_tpl_vars['couleurLigne']; ?>
'">
							<td width="25" style="font-size:8px;background-color:#<?php echo $this->_tpl_vars['projet']['couleur']; ?>
;color:<?php echo ((is_array($_tmp=((is_array($_tmp="#")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['projet']['couleur']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['projet']['couleur'])))) ? $this->_run_mod_handler('buttonFontColor', true, $_tmp) : buttonFontColor($_tmp)); ?>
"><?php echo $this->_tpl_vars['projet']['projet_id']; ?>
</td>
							<td>
								<?php if (in_array ( 'projects_manage_all' , $this->_tpl_vars['user']['tabDroits'] ) || ( in_array ( 'projects_manage_own' , $this->_tpl_vars['user']['tabDroits'] ) && $this->_tpl_vars['projet']['createur_id'] == $this->_tpl_vars['user']['user_id'] )): ?>
									<a onClick="javascript:xajax_modifProjet('<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
', 'projets');undefined;" style="cursor:pointer;"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/edit.gif" border="0" width="16" height="16" alt="Modifier" align="absbottom" /></a>
									&nbsp;
									<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/process/projet.php?projet_id=<?php echo $this->_tpl_vars['projet']['projet_id']; ?>
&action=delete&origine=projets" onClick="javascript:return confirm('<?php echo ((is_array($_tmp=$this->_config[0]['vars']['projet_liste_confirmSuppr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
')"><img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/delete.gif" border="0" width="16" height="16" alt="supprimer"  align="absbottom" /></a>
								<?php endif; ?>
								&nbsp;
								<?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['nom'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>

							</td>
							<td>
								<?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['nom_createur'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>

							</td>
							<td width="80" align="center"><?php echo $this->_tpl_vars['projet']['charge']; ?>
</td>
							<td width="80" align="center">
								<?php if ($this->_tpl_vars['projet']['livraison'] != '' && $this->_tpl_vars['projet']['livraison'] != '0000-00-00'): ?>
									<a href="planning.php?livraison=<?php echo $this->_tpl_vars['projet']['livraison']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['livraison'])) ? $this->_run_mod_handler('sqldate2userdate', true, $_tmp) : sqldate2userdate($_tmp)); ?>
</a>
								<?php endif; ?>
							</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['projet']['iteration'])) ? $this->_run_mod_handler('xss_protect', true, $_tmp) : xss_protect($_tmp)); ?>
</td>
						</tr>
						<?php $this->assign('groupeCourant', $this->_tpl_vars['projet']['groupe_id']); ?>
					<?php endforeach; endif; unset($_from); ?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>