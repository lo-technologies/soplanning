<?php /* Smarty version 2.6.26, created on 2014-07-20 22:01:48
         compiled from www_planning.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strstr', 'www_planning.tpl', 47, false),array('modifier', 'count', 'www_planning.tpl', 64, false),array('modifier', 'escape', 'www_planning.tpl', 98, false),array('modifier', 'cat', 'www_planning.tpl', 189, false),array('modifier', 'replace', 'www_planning.tpl', 189, false),array('modifier', 'urlencode', 'www_planning.tpl', 190, false),array('modifier', 'explode', 'www_planning.tpl', 295, false),array('function', 'math', 'www_planning.tpl', 81, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container-fluid">
	<div class="print">
		<?php echo $this->_config[0]['vars']['formDebut']; ?>
 : <?php echo $this->_tpl_vars['dateDebut']; ?>
 ==> <?php echo $this->_config[0]['vars']['formInfoDateFin']; ?>
 : <?php echo $this->_tpl_vars['dateFin']; ?>

	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 0px 10px;">
				<form action="process/planning.php" method="GET" class="form-inline">
					<?php if ($this->_tpl_vars['modeAffichage'] == 'mois'): ?>
						<label>
							<?php echo $this->_config[0]['vars']['formNbMois']; ?>
 :
						</label>
						<div class="input-append">
							<input name="nb_mois" type="text" size="2" value="<?php echo $this->_tpl_vars['nbMois']; ?>
" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
					<?php else: ?>
						<label>
							<?php echo $this->_config[0]['vars']['formNbJours']; ?>
 :
						</label>
						<div class="input-append">
							<input name="nb_jours" type="text" size="2" value="<?php echo $this->_tpl_vars['nbJours']; ?>
" class="input-mini" style="width:20px;" />
							<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
						</div>
					<?php endif; ?>
					<label style="margin-left:20px;">
						<?php echo $this->_config[0]['vars']['formDebut']; ?>
 :
					</label>
					<div class="input-append">
						<input name="date_debut_affiche" id="date_debut_affiche" type="text" value="<?php echo $this->_tpl_vars['dateDebut']; ?>
" class="input-mini datepicker" style="width:80px;" />
						<button class="btn btn-small" type="submit"><i class="icon-share-alt"></i></button>
					</div>
					<script><?php echo 'addEvent(window, \'load\', function(){jQuery("#date_debut_affiche").datepicker()});'; ?>
</script>
					<label style="margin-left:20px;">
						<?php echo $this->_config[0]['vars']['formInfoDateFin']; ?>
 : <?php echo $this->_tpl_vars['dateFin']; ?>

					</label>
					<div class="btn-group" style="margin-left:20px">
						<a class="btn btn-small" onClick="document.location='process/planning.php?date_debut_affiche=<?php echo $this->_tpl_vars['dateBoutonInferieur']; ?>
';"><i class="icon-backward"></i> <?php echo $this->_tpl_vars['dateBoutonInferieur']; ?>
</a>
						<a class="btn btn-small" onClick="document.location='process/planning.php?date_debut_affiche=<?php echo $this->_tpl_vars['dateBoutonSuperieur']; ?>
';"><?php echo $this->_tpl_vars['dateBoutonSuperieur']; ?>
 <i class="icon-forward"></i></a>
					</div>
					<?php if (! in_array ( 'planning_readonly' , $this->_tpl_vars['user']['tabDroits'] )): ?>
						<label style="margin-left:20px">
							<a class="btn btn-info btn-small" href="javascript:Reloader.stopRefresh();xajax_ajoutPeriode();undefined;">
								<?php if (! ((is_array($_tmp=$_SERVER['HTTP_USER_AGENT'])) ? $this->_run_mod_handler('strstr', true, $_tmp, "MSIE 8.0") : strstr($_tmp, "MSIE 8.0"))): ?>
									<img src="<?php echo $this->_tpl_vars['BASE']; ?>
/assets/img/pictos/addplanning.png" border="0" style="vertical-align:middle;padding-right:4px;">
								<?php endif; ?>
								<?php echo $this->_config[0]['vars']['menuAjouterPeriode']; ?>

							</a>
						</label>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 10px;">
				<div class="row-fluid">
										<div class="btn-group">
						<button class="btn <?php if (count($this->_tpl_vars['filtreUser']) > 0): ?>btn-danger<?php endif; ?> dropdown-toggle btn-small" data-toggle="dropdown"><?php echo $this->_config[0]['vars']['formChoixUser']; ?>
&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<?php if (count($this->_tpl_vars['filtreUser']) > 0): ?>
			                    <a href="process/planning.php?desactiverFiltreUser=1" class="btn btn-danger btn-small" style="margin-left:10px;"><?php echo $this->_config[0]['vars']['formFiltreUserDesactiver']; ?>
</a>
							<?php endif; ?>
							<li><a onClick="event.cancelBubble=true;" href="javascript:filtreUserCocheTous(true);undefined;"><?php echo $this->_config[0]['vars']['formFiltreUserCocherTous']; ?>
</a></li>
							<li><a onClick="event.cancelBubble=true;" href="javascript:filtreUserCocheTous(false);undefined;"><?php echo $this->_config[0]['vars']['formFiltreUserDecocherTous']; ?>
</a></li>
							<li class="divider"></li>
							<form action="process/planning.php" method="POST">
							<li>
								<input type="hidden" name="filtreUser" value="1">
								<table onClick="event.cancelBubble=true;" style="margin:10px;">
									<tr>
										<td nowrap="nowrap" valign="top">
											<input type="checkbox" id="gu0" value="1" onClick="filtreCocheUserGroupe('0')" /><label for="gu0" style="display:inline">&nbsp;<b><?php echo $this->_config[0]['vars']['cocheUserSansGroupe']; ?>
</b></label>
											<?php $this->assign('groupeTemp', ""); ?>

											<?php echo smarty_function_math(array('assign' => 'nbColonnes','equation' => "ceil(nbUsers / nbUsersParColonnes)",'nbUsers' => count($this->_tpl_vars['listeUsers']),'nbUsersParColonnes' => @FILTER_NB_USERS_PER_COLUMN), $this);?>

											<?php echo smarty_function_math(array('assign' => 'maxCol','equation' => "ceil(nbUsers / nbColonnes)",'nbUsers' => count($this->_tpl_vars['listeUsers']),'nbColonnes' => $this->_tpl_vars['nbColonnes']), $this);?>

											<?php $this->assign('tmpNbDansColCourante', '0'); ?>
											<?php $_from = $this->_tpl_vars['listeUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loopUsers'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loopUsers']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['userCourant']):
        $this->_foreach['loopUsers']['iteration']++;
?>
												<?php if ($this->_tpl_vars['tmpNbDansColCourante'] == $this->_tpl_vars['maxCol']): ?>
													<?php $this->assign('tmpNbDansColCourante', '0'); ?>
													</td>
													<td nowrap="nowrap" valign="top">
												<?php else: ?>
													<?php if ($this->_tpl_vars['userCourant']['user_groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
														<br /><br />
													<?php endif; ?>
												<?php endif; ?>
												<?php if ($this->_tpl_vars['userCourant']['user_groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
													<input type="checkbox" id="gu<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
" value="1" onClick="filtreCocheUserGroupe('<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
')" /> <label for="gu<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
" style="display:inline"><b><?php echo $this->_tpl_vars['userCourant']['groupe_nom']; ?>
</b></label>
												<?php endif; ?>
												<br />
												<input type="checkbox" id="user_<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
" value="<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
" name="user_<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
" onClick="checkStatutUserGroupe(this, '<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
')" <?php if (in_array ( $this->_tpl_vars['userCourant']['user_id'] , $this->_tpl_vars['filtreUser'] )): ?>checked="checked"<?php endif; ?> /> <label for="user_<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
" style="display:inline"><?php echo ((is_array($_tmp=$this->_tpl_vars['userCourant']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 (<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
)</label>
												<?php $this->assign('groupeTemp', $this->_tpl_vars['userCourant']['user_groupe_id']); ?>
												<?php $this->assign('tmpNbDansColCourante', $this->_tpl_vars['tmpNbDansColCourante']+1); ?>
											<?php endforeach; endif; unset($_from); ?>
										</td>
									</tr>
								</table>
							</li>
							<li><input type="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left:10px;" class="btn btn-small" /></li>
							</form>
						</ul>
					</div>
										<div class="btn-group">
						<button class="btn <?php if (count($this->_tpl_vars['filtreGroupeProjet']) > 0): ?>btn-danger<?php endif; ?> dropdown-toggle btn-small" data-toggle="dropdown"><?php echo $this->_config[0]['vars']['formChoixProjet']; ?>
&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<?php if (count($this->_tpl_vars['listeProjets']) == 0): ?>
								<li>&nbsp;&nbsp;<?php echo $this->_config[0]['vars']['formFiltreProjetAucunProjet']; ?>
</li>
							<?php else: ?>
								<?php if (count($this->_tpl_vars['filtreGroupeProjet']) > 0): ?>
									<a href="process/planning.php?desactiverFiltreGroupeProjet=1" class="btn btn-danger btn-small" style="margin-left:10px;"><?php echo $this->_config[0]['vars']['formFiltreProjetDesactiver']; ?>
</a>
								<?php endif; ?>
								<li><a onClick="event.cancelBubble=true;" href="javascript:filtreGroupeProjetCocheTous(true);undefined;"><?php echo $this->_config[0]['vars']['formFiltreProjetCocherTous']; ?>
</a></li>
								<li><a onClick="event.cancelBubble=true;" href="javascript:filtreGroupeProjetCocheTous(false);undefined;"><?php echo $this->_config[0]['vars']['formFiltreProjetDecocherTous']; ?>
</a></li>
								<li class="divider"></li>
								<form action="process/planning.php" method="POST">
								<li>
									<input type="hidden" name="filtreGroupeProjet" value="1">
									<table onClick="event.cancelBubble=true;" style="margin:10px;">
										<tr>
											<td nowrap="nowrap" valign="top">
												<input type="checkbox" id="g0" value="1" onClick="filtreCocheGroupe('0')" /><label for="g0" style="display:inline">&nbsp;<b><?php echo $this->_config[0]['vars']['projet_liste_sansGroupes']; ?>
</b></label>
												<?php $this->assign('groupeTemp', ""); ?>
												<?php echo smarty_function_math(array('assign' => 'nbColonnes','equation' => "ceil(nbProjets / nbProjetsParColonnes)",'nbProjets' => count($this->_tpl_vars['listeProjets']),'nbProjetsParColonnes' => @FILTER_NB_PROJECTS_PER_COLUMN), $this);?>

												<?php echo smarty_function_math(array('assign' => 'maxCol','equation' => "ceil(nbProjets / nbColonnes)",'nbProjets' => count($this->_tpl_vars['listeProjets']),'nbColonnes' => $this->_tpl_vars['nbColonnes']), $this);?>

												<?php $this->assign('tmpNbDansColCourante', '0'); ?>
												<?php $_from = $this->_tpl_vars['listeProjets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loopProjets'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loopProjets']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['projetCourant']):
        $this->_foreach['loopProjets']['iteration']++;
?>
													<?php if ($this->_tpl_vars['tmpNbDansColCourante'] == $this->_tpl_vars['maxCol']): ?>
														<?php $this->assign('tmpNbDansColCourante', '0'); ?>
														</td>
														<td nowrap="nowrap" valign="top">
													<?php else: ?>
														<?php if ($this->_tpl_vars['projetCourant']['groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
															<br /><br />
														<?php endif; ?>
													<?php endif; ?>
													<?php if ($this->_tpl_vars['projetCourant']['groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
														<input type="checkbox" id="g<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
" value="1" onClick="filtreCocheGroupe('<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
')" /> <label for="g<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
" style="display:inline"><b><?php echo $this->_tpl_vars['projetCourant']['groupe_nom']; ?>
</b></label>
													<?php endif; ?>
													<br />
													<input type="checkbox" id="projet_<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
" value="<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
" name="projet_<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
" onClick="checkStatutGroupe(this, '<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
')" <?php if (in_array ( $this->_tpl_vars['projetCourant']['projet_id'] , $this->_tpl_vars['filtreGroupeProjet'] )): ?>checked="checked"<?php endif; ?> /> <label for="projet_<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
" style="display:inline"><?php echo ((is_array($_tmp=$this->_tpl_vars['projetCourant']['nom'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 (<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
)
													<?php $this->assign('groupeTemp', $this->_tpl_vars['projetCourant']['groupe_id']); ?></label>
													<?php $this->assign('tmpNbDansColCourante', $this->_tpl_vars['tmpNbDansColCourante']+1); ?>
												<?php endforeach; endif; unset($_from); ?>
											</td>
										</tr>
									</table>
								</li>
								<li><input type="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left:10px;" class="btn" /></li>
								</form>
							<?php endif; ?>
						</ul>
					</div>
										<div class="btn-group">
						<button class="btn <?php if (count($this->_tpl_vars['filtreStatutTache']) > 0): ?>btn-danger<?php endif; ?> dropdown-toggle btn-small" data-toggle="dropdown"><?php echo $this->_config[0]['vars']['formChoixStatutTache']; ?>
&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<form action="process/planning.php" method="POST">
							<li>
									<input type="hidden" name="filtreStatutTache" value="1">
									<table onClick="event.cancelBubble=true;" style="margin:10px;">
										<tr>
											<td nowrap="nowrap" valign="top">
												<input type="checkbox" id="a_faire" name="statutsTache[]" value="a_faire" <?php if (in_array ( 'a_faire' , $this->_tpl_vars['filtreStatutTache'] )): ?>checked="checked"<?php endif; ?> /><label for="a_faire" style="display:inline">&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_statut_a_faire']; ?>
</label><br />
												<input type="checkbox" id="en_cours" name="statutsTache[]" value="en_cours" <?php if (in_array ( 'en_cours' , $this->_tpl_vars['filtreStatutTache'] )): ?>checked="checked"<?php endif; ?> /><label for="en_cours" style="display:inline">&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_statut_en_cours']; ?>
</label><br />
												<input type="checkbox" id="fait" name="statutsTache[]" value="fait" <?php if (in_array ( 'fait' , $this->_tpl_vars['filtreStatutTache'] )): ?>checked="checked"<?php endif; ?> /><label for="fait" style="display:inline">&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_statut_fait']; ?>
</label><br />
												<input type="checkbox" id="abandon" name="statutsTache[]" value="abandon" <?php if (in_array ( 'abandon' , $this->_tpl_vars['filtreStatutTache'] )): ?>checked="checked"<?php endif; ?> /><label for="abandon" style="display:inline">&nbsp;<?php echo $this->_config[0]['vars']['winPeriode_statut_abandon']; ?>
</label>
											</td>
										</tr>
									</table>
							</li>
							<li><input type="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" style="margin-left:10px;" class="btn" /></li>
							</form>
						</ul>
					</div>
										<div class="btn-group">
						<button class="btn dropdown-toggle btn-small" data-toggle="dropdown"><?php echo $this->_config[0]['vars']['formTrierPar']; ?>
&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<?php if ($this->_tpl_vars['inverserUsersProjets']): ?>
								<?php $_from = $this->_tpl_vars['triPlanningPossibleProjet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['triTemp']):
?>
									<?php $this->assign('chaineTmp', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='triProjet_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['triTemp']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['triTemp'])))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '_') : smarty_modifier_replace($_tmp, ' ', '_')))) ? $this->_run_mod_handler('replace', true, $_tmp, ',', '_') : smarty_modifier_replace($_tmp, ',', '_'))); ?>
									<li <?php if ($this->_tpl_vars['triTemp'] == $this->_tpl_vars['triPlanning']): ?>class="active"<?php endif; ?>><a href="process/planning.php?triPlanning=<?php echo ((is_array($_tmp=$this->_tpl_vars['triTemp'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['chaineTmp']]; ?>
</a></li>
								<?php endforeach; endif; unset($_from); ?>
							<?php else: ?>
								<?php $_from = $this->_tpl_vars['triPlanningPossibleUser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['triTemp']):
?>
									<?php $this->assign('chaineTmp', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='triUser_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['triTemp']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['triTemp'])))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '_') : smarty_modifier_replace($_tmp, ' ', '_')))) ? $this->_run_mod_handler('replace', true, $_tmp, ',', '_') : smarty_modifier_replace($_tmp, ',', '_'))); ?>
									<li <?php if ($this->_tpl_vars['triTemp'] == $this->_tpl_vars['triPlanning']): ?>class="active"<?php endif; ?>><a href="process/planning.php?triPlanning=<?php echo ((is_array($_tmp=$this->_tpl_vars['triTemp'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['chaineTmp']]; ?>
</a></li>
								<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
						</ul>
					</div>
					<div class="btn-group">
						<a href="javascript:window.print();" class="btn btn-small" id="btPrint" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['printAll'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/printButton.png"></a>
						<a href="export_csv.php" class="btn btn-small" id="btCSVexport" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['CSVExport'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/CSVIcon.gif"></a>
						<a href="javascript:xajax_choixPDF();undefined;" class="btn btn-small" id="btChoixPDF" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['PDFExport'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/pdf.png"></a>
						<a href="export_gantt.php" target="_blank" class="btn btn-small" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['ganttExport'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/gantt.png"></a>
						<a href="export_pdf_calendrier.php" target="_blank" class="btn btn-small" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['calendarExport'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/calendar.png"></a>
						<a href="javascript:xajax_choixIcal();undefined;" class="btn btn-small" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['icalExport'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/ical.png"></a>
						<?php if ($this->_tpl_vars['affichageLarge'] == 0): ?>
							<a href="?affichageLarge=1" class="btn btn-small" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['affichageReduit'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/scroll.png"></a>
						<?php else: ?>
							<a href="?affichageLarge=1" class="btn btn-small" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['affichageReduit'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><img align="absbottom" border="0" src="assets/img/pictos/scroll.png"></a>
						<?php endif; ?>
					</div>
										<div class="btn-group">
						<form action="process/planning.php" method="POST" class="form-search">
							<div class="input-append">
								<input type="text" name="filtreTexte" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['filtreTexte'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="span2 search-query" maxlength="50" rel="tooltip" title="<?php echo ((is_array($_tmp=$this->_config[0]['vars']['formFiltreTexte'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="filtreTexte" style="width:80px">
								<button class="btn <?php if ($this->_tpl_vars['filtreTexte'] != ""): ?>btn-danger<?php endif; ?>" type="submit"><i class="icon-search"></i></button>
								<?php if ($this->_tpl_vars['filtreTexte'] != ""): ?>
									<div class="btn-group">
										<button class="btn dropdown-toggle" data-toggle="dropdown">&nbsp;<span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="process/planning.php?desactiverFiltreTexte=1"><?php echo $this->_config[0]['vars']['formFiltreUserDesactiver']; ?>
</a></li>
										</ul>
									</div>
								<?php endif; ?>
							</div>
						</form>
					</div>
					<div class="btn-group">
						<label>
							<?php if ($this->_tpl_vars['modeAffichage'] == 'mois'): ?>
								<a class="btn btn-info btn-small" href="planning_per_day.php"><?php echo $this->_config[0]['vars']['menuPlanningJour']; ?>
</a>
							<?php else: ?>
								<a class="btn btn-info btn-small" href="planning.php"><?php echo $this->_config[0]['vars']['menuPlanningMois']; ?>
</a>
							<?php endif; ?>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div class="row-fluid">
		<div class="span12">
			<div class="soplanning-box" style="margin: 0px 10px;">
				<table id="tabPlanning" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="100" align="right">
							<table id="layerPersonnes" border="0" cellpadding="0" cellspacing="1">
								<tbody id="bodyLayerPersonnes">
									<tr id="loadingLayerPersonnes">
										<td align="center" class="entete" nowrap="nowrap"><br /><br /><?php echo $this->_config[0]['vars']['loading']; ?>
<br /><br /><br /></td>
									</tr>
								</tbody>
							</table>
						</td>
						<td valign="top">
							<div id="divConteneurPlanning" <?php if ($this->_tpl_vars['affichageLarge'] == 0): ?>style="width:700px; overflow-x:scroll"<?php endif; ?>>
								<?php echo $this->_tpl_vars['htmlTableau']; ?>

							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="span12">
			<div class="soplanning-box" style="margin: 10px;">
				<div class="row-fluid">
										<?php if ($this->_tpl_vars['nbPagesLignes'] > 1): ?>
						<div class="pagination">
							<ul>
							<?php unset($this->_sections['loopPages']);
$this->_sections['loopPages']['loop'] = is_array($_loop=$this->_tpl_vars['nbPagesLignes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loopPages']['name'] = 'loopPages';
$this->_sections['loopPages']['show'] = true;
$this->_sections['loopPages']['max'] = $this->_sections['loopPages']['loop'];
$this->_sections['loopPages']['step'] = 1;
$this->_sections['loopPages']['start'] = $this->_sections['loopPages']['step'] > 0 ? 0 : $this->_sections['loopPages']['loop']-1;
if ($this->_sections['loopPages']['show']) {
    $this->_sections['loopPages']['total'] = $this->_sections['loopPages']['loop'];
    if ($this->_sections['loopPages']['total'] == 0)
        $this->_sections['loopPages']['show'] = false;
} else
    $this->_sections['loopPages']['total'] = 0;
if ($this->_sections['loopPages']['show']):

            for ($this->_sections['loopPages']['index'] = $this->_sections['loopPages']['start'], $this->_sections['loopPages']['iteration'] = 1;
                 $this->_sections['loopPages']['iteration'] <= $this->_sections['loopPages']['total'];
                 $this->_sections['loopPages']['index'] += $this->_sections['loopPages']['step'], $this->_sections['loopPages']['iteration']++):
$this->_sections['loopPages']['rownum'] = $this->_sections['loopPages']['iteration'];
$this->_sections['loopPages']['index_prev'] = $this->_sections['loopPages']['index'] - $this->_sections['loopPages']['step'];
$this->_sections['loopPages']['index_next'] = $this->_sections['loopPages']['index'] + $this->_sections['loopPages']['step'];
$this->_sections['loopPages']['first']      = ($this->_sections['loopPages']['iteration'] == 1);
$this->_sections['loopPages']['last']       = ($this->_sections['loopPages']['iteration'] == $this->_sections['loopPages']['total']);
?>
								<?php if ($this->_tpl_vars['pageLignes'] == $this->_sections['loopPages']['iteration']): ?>
									<li class="active">
										<a href="#"><?php echo $this->_sections['loopPages']['iteration']; ?>
</a>
									</li>
									<?php else: ?>
									<li>
										<a href="<?php echo $this->_tpl_vars['BASE']; ?>
/process/planning.php?page_lignes=<?php echo $this->_sections['loopPages']['iteration']; ?>
"><?php echo $this->_sections['loopPages']['iteration']; ?>
</a>
									</li>
									<?php endif; ?>
									<?php if (! $this->_sections['loopPages']['last']): ?>

									<?php endif; ?>
								<?php endfor; endif; ?>
							</ul>
						</div>
					<?php endif; ?>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo $this->_tpl_vars['nbLignes']; ?>
 <?php echo $this->_config[0]['vars']['planning_nbLignes']; ?>
 <span class="caret"></span></a>
						<?php $this->assign('tabPages', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, @CONFIG_PLANNING_PAGES) : explode($_tmp, @CONFIG_PLANNING_PAGES))); ?>
						<ul class="dropdown-menu">
							<?php $_from = $this->_tpl_vars['tabPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valTemp']):
?>
							<li>
								<a onClick="top.location='<?php echo $this->_tpl_vars['BASE']; ?>
/process/planning.php?nb_lignes='+<?php echo $this->_tpl_vars['valTemp']; ?>
""><?php echo $this->_tpl_vars['valTemp']; ?>
 <?php echo $this->_config[0]['vars']['planning_nbLignes']; ?>
</a>
							</li>
							<?php endforeach; endif; unset($_from); ?>
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small <?php if ($this->_tpl_vars['masquerLigneVide'] == 1): ?>btn-danger<?php endif; ?>" data-toggle="dropdown" href="#"><?php echo $this->_config[0]['vars']['planning_masquerLignesVides']; ?>
 <span class="caret"></span></a>
						<ul class="dropdown-menu">
							 <?php if ($this->_tpl_vars['masquerLigneVide'] == 1): ?>
							<li>
								<a onClick="top.location='process/planning.php?masquerLigneVide=0'"><?php echo $this->_config[0]['vars']['planning_masquerLignesVides_non']; ?>
</a>
							</li>
							 <?php else: ?>
							<li>
								<a onClick="top.location='process/planning.php?masquerLigneVide=1'"><?php echo $this->_config[0]['vars']['planning_masquerLignesVides_oui']; ?>
</a>
							</li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small <?php if ($this->_tpl_vars['afficherLigneTotal'] == 1): ?>btn-danger<?php endif; ?>" data-toggle="dropdown" href="#"><?php echo $this->_config[0]['vars']['planning_afficherLigneTotal']; ?>
 <span class="caret"></span></a>
						<ul class="dropdown-menu">
							 <?php if ($this->_tpl_vars['afficherLigneTotal'] == 1): ?>
							<li>
								<a onClick="top.location='process/planning.php?afficherLigneTotal=0'"><?php echo $this->_config[0]['vars']['non']; ?>
</a>
							</li>
							 <?php else: ?>
							<li>
								<a onClick="top.location='process/planning.php?afficherLigneTotal=1'"><?php echo $this->_config[0]['vars']['oui']; ?>
</a>
							</li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="btn-group">
						<a class="btn dropdown-toggle btn-small" data-toggle="dropdown"  onclick="javascript:toggle2('divProjectTable');" ><?php echo $this->_config[0]['vars']['hide_show_table']; ?>
</a>
					</div>
									</div>
			</div>
		</div>
	</div>
	<div class="row-fluid noprint">
		<div class="soplanning-box" style="margin: 0px 10px;">
			<?php echo $this->_tpl_vars['htmlRecap']; ?>

		</div>
	</div>
</div>


<?php echo '
<script language="javascript">
destinationsDrag = new Array();

var origineCaseX;
var origineCaseY;
function modifPeriode(obj, periode_id){
	if(origineCaseX != parseInt(obj.style.left) || origineCaseY != parseInt(obj.style.top)) {
		return false;
	}
	xajax_modifPeriode(periode_id);
}

'; ?>

<?php echo $this->_tpl_vars['js']; ?>

<?php echo '

</script>
'; ?>




<script language="javascript">
var listeProjets = new Array();
listeProjets[0] = new Array();
<?php $this->assign('groupeTemp', ""); ?>
<?php $_from = $this->_tpl_vars['listeProjets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['projetCourant']):
?>
	<?php if ($this->_tpl_vars['projetCourant']['groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
		listeProjets[<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
] = new Array();
	<?php endif; ?>
	<?php if ($this->_tpl_vars['projetCourant']['groupe_id'] == ''): ?>
		listeProjets[0].push('<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
');
	<?php else: ?>
		listeProjets[<?php echo $this->_tpl_vars['projetCourant']['groupe_id']; ?>
].push('<?php echo $this->_tpl_vars['projetCourant']['projet_id']; ?>
');
	<?php endif; ?>
	<?php $this->assign('groupeTemp', $this->_tpl_vars['projetCourant']['groupe_id']); ?>
<?php endforeach; endif; unset($_from); ?>

<?php echo '
// coche ou decoche tous les projets
function filtreGroupeProjetCocheTous(action) {
	for (var groupe in listeProjets) {
		if (!document.getElementById(\'g\' + groupe)) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById(\'g\' + groupe).checked = action;
		for (var projet in listeProjets[groupe]) {
			if (!document.getElementById(\'projet_\' + listeProjets[groupe][projet])) {
				// si pas une case ? cocher existantes, on sort
				continue;
			}
			document.getElementById(\'projet_\' + listeProjets[groupe][projet]).checked = action;
		}
	}
}

// coche ou decoche les projets d\'un groupe
function filtreCocheGroupe(groupe) {
	var action = document.getElementById(\'g\' + groupe).checked;
	for (var projet in listeProjets[groupe]) {
		if (!document.getElementById(\'projet_\' + listeProjets[groupe][projet])) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById(\'projet_\' + listeProjets[groupe][projet]).checked = action;
	}
}

// decoche le groupe si on decoche un projet
function checkStatutGroupe(obj, groupe) {
	if (groupe == \'\') {
		groupe = \'0\';
	}
	if (!obj.checked) {
		document.getElementById(\'g\' + groupe).checked = false;
	}
}

'; ?>

</script>



<script language="javascript">
	var idCaseEnCoursDeplacement = false;
	var idCaseDestination = false;
</script>

<div id="divChoixDragNDrop" style="border: 1px solid #000000;background-color:#ffffff;position:absolute;z-index:100;display:none;padding:10px;" onMouseOut="masquerSousMenuDelai('divChoixDragNDrop');" onMouseOver="AnnuleMasquerSousMenu('divChoixDragNDrop');" onfocus="AnnuleMasquerSousMenu('divChoixDragNDrop')">
	<a href="javascript:windowPatienter();xajax_moveCasePeriode(idCaseEnCoursDeplacement, destination, false);undefined;"><?php echo $this->_config[0]['vars']['planning_deplacer']; ?>
</a>
	<br /><br />
	<a href="javascript:windowPatienter();xajax_moveCasePeriode(idCaseEnCoursDeplacement, destination, true);undefined;"><?php echo $this->_config[0]['vars']['planning_copier']; ?>
</a>
	<br /><br />
	<a href="javascript:location.reload();undefined;"><?php echo $this->_config[0]['vars']['planning_annuler']; ?>
</a>
</div>

<script language="javascript">
var listeUsers = new Array();
listeUsers[0] = new Array();
<?php $this->assign('groupeTemp', ""); ?>
<?php $_from = $this->_tpl_vars['listeUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userCourant']):
?>
	<?php if ($this->_tpl_vars['userCourant']['user_groupe_id'] != $this->_tpl_vars['groupeTemp']): ?>
		listeUsers[<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
] = new Array();
	<?php endif; ?>
	<?php if ($this->_tpl_vars['userCourant']['user_groupe_id'] == ''): ?>
		listeUsers[0].push('<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
');
	<?php else: ?>
		listeUsers[<?php echo $this->_tpl_vars['userCourant']['user_groupe_id']; ?>
].push('<?php echo $this->_tpl_vars['userCourant']['user_id']; ?>
');
	<?php endif; ?>
	<?php $this->assign('groupeTemp', $this->_tpl_vars['userCourant']['user_groupe_id']); ?>
<?php endforeach; endif; unset($_from); ?>


<?php echo '
// coche ou decoche tous les Users
function filtreUserCocheTous(action) {
	for (var groupe in listeUsers) {
		if (!document.getElementById(\'gu\' + groupe)) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById(\'gu\' + groupe).checked = action;
		for (var user in listeUsers[groupe]) {
			if (!document.getElementById(\'user_\' + listeUsers[groupe][user])) {
				// si pas une case ? cocher existantes, on sort
				continue;
			}
			document.getElementById(\'user_\' + listeUsers[groupe][user]).checked = action;
		}
	}
}

// coche ou decoche les users d\'un groupe
function filtreCocheUserGroupe(groupe) {
	var action = document.getElementById(\'gu\' + groupe).checked;
	for (var user in listeUsers[groupe]) {
		if (!document.getElementById(\'user_\' + listeUsers[groupe][user])) {
			// si pas une case ? cocher existantes, on sort
			continue;
		}
		document.getElementById(\'user_\' + listeUsers[groupe][user]).checked = action;
	}
}

// decoche le groupe si on decoche un user
function checkStatutUserGroupe(obj, groupe) {
	if (groupe == \'\') {
		groupe = \'0\';
	}
	if (!obj.checked) {
		document.getElementById(\'gu\' + groupe).checked = false;
	}
}
'; ?>

</script>


<script language="javascript">
<?php echo '
function copierTableauPersonnes () {
	document.getElementById(\'loadingLayerPersonnes\').style.display = \'none\';

	// on adapte le div ? la largeur de la fenetre
	document.getElementById(\'divConteneurPlanning\').style.width = document.body.offsetWidth - 80 - document.getElementById(\'tdUser_0\').offsetWidth + \'px\';

	// recopie de la premiere case
	trTemp = document.createElement("tr");
	thTemp = document.createElement("th");
	thTemp.setAttribute(\'id\', \'tdUserCopie_0\');
	trTemp.appendChild(thTemp);
	document.getElementById(\'bodyLayerPersonnes\').appendChild(trTemp);
	document.getElementById(\'tdUserCopie_0\').style.height = document.getElementById(\'tdUser_0\').offsetHeight + \'px\';
	document.getElementById(\'tdUserCopie_0\').innerHTML = \'<a id="lienInverse" href="process/planning.php?inverserUsersProjets='; ?>
<?php if ($this->_tpl_vars['inverserUsersProjets'] == 0): ?>1<?php else: ?>0<?php endif; ?><?php echo '"><img src="assets/img/pictos/switch.png" border="0" /></a>\';

	var table = document.getElementById("tabContenuPlanning");
	numeroCellule = 1;
	for (var i = '; ?>
<?php if ($this->_tpl_vars['modeAffichage'] == 'mois'): ?>4<?php else: ?>2<?php endif; ?><?php echo ', row; row = table.rows[i]; i++) {
		for (var j = 0, col; col = row.cells[j]; j++) {
			if (j == 0) {
				thACopier = col.cloneNode(true);
				thACopier.setAttribute(\'id\', \'tdUserCopie_\' + numeroCellule);
				trTemp = document.createElement("tr");
				trTemp.appendChild(thACopier);
				document.getElementById(\'bodyLayerPersonnes\').appendChild(trTemp);
				document.getElementById(\'tdUserCopie_\' + numeroCellule).style.height = col.offsetHeight + \'px\';
				numeroCellule++;
				col.style.display = \'none\';
			}
		}
	}

	document.getElementById("tdUser_0").style.display = \'none\';
}
'; ?>

</script>

<script language="javascript">
<?php echo '
addEvent(window, \'load\', copierTableauPersonnes);

Reloader.init('; ?>
<?php echo @CONFIG_REFRESH_TIMER; ?>
<?php echo ');
'; ?>


var js_choisirProjet = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_choisirProjet'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_choisirDateDebut = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_choisirDateDebut'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirFormatDate = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirFormatDate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_dateFinInferieure = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_dateFinInferieure'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirIDProjet = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirIDProjet'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirNomProjet = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirNomProjet'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirCouleur = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirCouleur'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirCharge = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirCharge'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_saisirSemaine = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_saisirSemaine'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_deposerCaseSurDate = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_deposerCaseSurDate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_deplacementOk = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_deplacementOk'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var js_patienter = '<?php echo ((is_array($_tmp=$this->_config[0]['vars']['js_patienter'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "www_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>