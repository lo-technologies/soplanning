{* Smarty *}
{include file="www_header.tpl"}

<div class="container">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list soplanning-box" id="myTab">
				<li class="active">
					<a href="#global">{#options_configGenerale#}</a>
				</li>
				<li>
					<a href="#planning">{#options_planning#}</a>
				</li>
				<li>
					<a href="#divers">{#options_divers#}</a>
				</li>
				<li>
					<a href="#smtp">{#options_smtp#}</a>
				</li>
				<li>
					<a href="#testmail">{#options_envoyerMailTest#}</a>
				</li>
			</ul>
		</div>
		<div class="span9">
			<div class="soplanning-box">
				<div class="tab-content">
					<div class="tab-pane active" id="global">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									{#options_configGenerale#}
								</legend>
								<div class="control-group">
									<label class="control-label" for="inputEmail">{#options_titre#} :</label>
									<div class="controls">
										<input type="text" name="SOPLANNING_TITLE" id="inputEmail" value="{$smarty.const.CONFIG_SOPLANNING_TITLE|escape:'html'|escape:'javascript'}">
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_titre#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">{#options_url#} :</label>
									<div class="controls">
										<input type="text" name="SOPLANNING_URL" id="inputEmail" value="{$smarty.const.CONFIG_SOPLANNING_URL}">
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_url#|escape:"quotes"|cat:'<br>'|cat:$urlSuggeree}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="{#submit#}" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="planning">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									{#options_planning#}
								</legend>
								<div class="control-group">
									<label class="control-label" for="inputEmail">{assign var=jours value=","|explode:$smarty.const.CONFIG_DAYS_INCLUDED} {#options_joursInclus#} :</label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="1" id="chklundi" {if in_array('1', $jours)}checked="checked"{/if}> {#day_1#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="2" id="chkmardi" {if in_array('2', $jours)}checked="checked"{/if}> {#day_2#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="3" id="chkmercredi" {if in_array('3', $jours)}checked="checked"{/if}> {#day_3#}
										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="4" id="chkjeudi" {if in_array('4', $jours)}checked="checked"{/if}> {#day_4#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="5" id="chkvendredi" {if in_array('5', $jours)}checked="checked"{/if}> {#day_5#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="6" id="chksamedi" {if in_array('6', $jours)}checked="checked"{/if}> {#day_6#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="DAYS_INCLUDED[]" value="0" id="chkdimanche" {if in_array('0', $jours)}checked="checked"{/if}> {#day_0#}
										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">{assign var=heuresAffichees value=","|explode:$smarty.const.CONFIG_HOURS_DISPLAYED} {#options_heuresIncluses#} :</label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="0" {if in_array('0', $heuresAffichees)}checked="checked"{/if}> 0{#tab_h#}-1{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="1" {if in_array('1', $heuresAffichees)}checked="checked"{/if}> 1{#tab_h#}-2{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="2" {if in_array('2', $heuresAffichees)}checked="checked"{/if}> 2{#tab_h#}-3{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="3" {if in_array('3', $heuresAffichees)}checked="checked"{/if}> 3{#tab_h#}-4{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="4" {if in_array('4', $heuresAffichees)}checked="checked"{/if}> 4{#tab_h#}-5{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="5" {if in_array('5', $heuresAffichees)}checked="checked"{/if}> 5{#tab_h#}-6{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="6" {if in_array('6', $heuresAffichees)}checked="checked"{/if}> 6{#tab_h#}-7{#tab_h#}
										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="7" {if in_array('7', $heuresAffichees)}checked="checked"{/if}> 7{#tab_h#}-8{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="8" {if in_array('8', $heuresAffichees)}checked="checked"{/if}> 8{#tab_h#}-9{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="9" {if in_array('9', $heuresAffichees)}checked="checked"{/if}> 9{#tab_h#}-10{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="10" {if in_array('10', $heuresAffichees)}checked="checked"{/if}> 10{#tab_h#}-11{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="11" {if in_array('11', $heuresAffichees)}checked="checked"{/if}> 11{#tab_h#}-12{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="12" {if in_array('12', $heuresAffichees)}checked="checked"{/if}> 12{#tab_h#}-13{#tab_h#}
										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="13" {if in_array('13', $heuresAffichees)}checked="checked"{/if}> 13{#tab_h#}-14{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="14" {if in_array('14', $heuresAffichees)}checked="checked"{/if}> 14{#tab_h#}-15{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="15" {if in_array('15', $heuresAffichees)}checked="checked"{/if}> 15{#tab_h#}-16{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="16" {if in_array('16', $heuresAffichees)}checked="checked"{/if}> 16{#tab_h#}-17{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="17" {if in_array('17', $heuresAffichees)}checked="checked"{/if}> 17{#tab_h#}-18{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="18" {if in_array('18', $heuresAffichees)}checked="checked"{/if}> 18{#tab_h#}-19{#tab_h#}
										</label>
									</div>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="19" {if in_array('19', $heuresAffichees)}checked="checked"{/if}> 19{#tab_h#}-20{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="20" {if in_array('20', $heuresAffichees)}checked="checked"{/if}> 20{#tab_h#}-21{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="21" {if in_array('21', $heuresAffichees)}checked="checked"{/if}> 21{#tab_h#}-22{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="22" {if in_array('22', $heuresAffichees)}checked="checked"{/if}> 22{#tab_h#}-23{#tab_h#}
										</label>
										<label class="checkbox inline">
											<input type="checkbox" name="HOURS_DISPLAYED[]" value="23" {if in_array('23', $heuresAffichees)}checked="checked"{/if}> 23{#tab_h#}-0{#tab_h#}
										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_dureeDefautJour#} :</label>
									<div class="controls">
										<input name="DURATION_DAY" type="text" value="{$smarty.const.CONFIG_DURATION_DAY}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_dureeDefaut#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
										{#options_dureeDefautMatin#} :
										<input name="DURATION_AM" type="text" value="{$smarty.const.CONFIG_DURATION_AM}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_dureeDefaut#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
										{#options_dureeDefautApresmidi#} :
										<input name="DURATION_PM" type="text" value="{$smarty.const.CONFIG_DURATION_PM}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_dureeDefaut#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_nbMoisDefaut#} :</label>
									<div class="controls">
										<input name="DEFAULT_NB_MONTHS_DISPLAYED" type="text" value="{$smarty.const.CONFIG_DEFAULT_NB_MONTHS_DISPLAYED}" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_nbjoursDefaut#} :</label>
									<div class="controls">
										<input name="DEFAULT_NB_DAYS_DISPLAYED" type="text" value="{$smarty.const.CONFIG_DEFAULT_NB_DAYS_DISPLAYED}" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_nbLignes#} :</label>
									<div class="controls">
										<input name="DEFAULT_NB_ROWS_DISPLAYED" type="text" value="{$smarty.const.CONFIG_DEFAULT_NB_ROWS_DISPLAYED}" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_nbJoursPasses#} :</label>
									<div class="controls">
										<input name="DEFAULT_NB_PAST_DAYS" type="text" value="{$smarty.const.CONFIG_DEFAULT_NB_PAST_DAYS}" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_raffraichissement#} :</label>
									<div class="controls">
										<input name="REFRESH_TIMER" type="text" value="{$smarty.const.CONFIG_REFRESH_TIMER}" class="input-mini" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_hauteurLigne#} :</label>
									<div class="controls">
										<input name="PLANNING_LINE_HEIGHT" type="text" value="{$smarty.const.CONFIG_PLANNING_LINE_HEIGHT}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_hauteurLigne#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_uneTacheParJour#} :</label>
									<div class="controls">
										<select name="PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY" class="input-mini">
											<option value="0" {if $smarty.const.CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY eq 0}selected="selected"{/if}>{#non#}</option>
											<option value="1" {if $smarty.const.CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY eq 1}selected="selected"{/if}>{#oui#}</option>
										</select>
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_uneTacheParJour#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_repeterHeaderDate#} :</label>
									<div class="controls">
										<input name="PLANNING_REPEAT_HEADER" type="text" value="{$smarty.const.CONFIG_PLANNING_REPEAT_HEADER}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_repeterHeaderDate#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="{#submit#}" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="divers">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									{#options_divers#}
								</legend>
								<div class="control-group">
									<label class="control-label">{#options_couleursProjets#} :</label>
									<div class="controls">
										<input name="PROJECT_COLORS_POSSIBLE" type="text" value="{$smarty.const.CONFIG_PROJECT_COLORS_POSSIBLE}" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_couleursPossibles#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_lienDefaut#} :</label>
									<div class="controls">
										<input name="DEFAULT_PERIOD_LINK" type="text" value="{$smarty.const.CONFIG_DEFAULT_PERIOD_LINK}" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_LinkPeriod#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_urlRedirection#} :</label>
									<div class="controls">
										<input name="LOGOUT_REDIRECT" type="text" value="{$smarty.const.CONFIG_LOGOUT_REDIRECT}" class="input-large" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_redirect#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="{#submit#}" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="smtp">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									{#options_smtp#}
								</legend>
								<div class="control-group">
									<label class="control-label">{#options_smtp_host#} :</label>
									<div class="controls">
										<input name="SMTP_HOST" type="text" value="{$smarty.const.CONFIG_SMTP_HOST|escape:'html'|escape:'javascript'}" class="input-large" />
										{#options_smtp_port#} :
										<input name="SMTP_PORT" type="text" value="{$smarty.const.CONFIG_SMTP_PORT|escape:'html'|escape:'javascript'}" class="input-mini" />
										&nbsp;<a href="#" onmouseover="return coolTip('{#options_aide_smtp#|escape:"quotes"}', WIDTH, 270)"  onmouseout="nd()" href="javascript:undefined;"><i class="icon-question-sign"></i></a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_smtp_secure#}</label>
									<div class="controls">
										<select id="" name="SMTP_SECURE" class="input-large">
											<option value="" {if $smarty.const.CONFIG_SMTP_SECURE eq ""}selected="selected"{/if}>{#options_smtp_nonSecurise#}</option>
											<option value="ssl" {if $smarty.const.CONFIG_SMTP_SECURE eq "ssl"}selected="selected"{/if}>SSL</option>
											<option value="tls" {if $smarty.const.CONFIG_SMTP_SECURE eq "tls"}selected="selected"{/if}>TLS</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_smtp_from#} :</label>
									<div class="controls">
										<input name="SMTP_FROM" type="text" value="{$smarty.const.CONFIG_SMTP_FROM|escape:'html'|escape:'javascript'}" class="input-large" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_smtp_login#} :</label>
									<div class="controls">
										<input name="SMTP_LOGIN" type="text" value="{$smarty.const.CONFIG_SMTP_LOGIN|escape:'html'|escape:'javascript'}" class="input-large" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">{#options_smtp_password#} :</label>
									<div class="controls">
										<input name="SMTP_PASSWORD" type="password" size="30" value="{if $smarty.const.CONFIG_SMTP_LOGIN neq ""}XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX{/if}" class="input-large"/>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="{#submit#}" style="margin-left: 392px;"/>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane" id="testmail">
						<form action="process/options.php" method="POST" class="form-horizontal formElement">
							<fieldset>
								<legend>
									{#options_envoyerMailTest#}
								</legend>
								<div class="control-group">
									<label class="control-label">{#options_envoyerMailTest_destinataire#} :</label>
									<div class="controls">
										<input name="mailTestDestinataire" type="text" class="input-xlarge" />
									</div>
								</div>
								<input type="submit" class="btn btn-primary" value="{#submit#}" style="margin-left: 392px;" {if $smarty.const.CONFIG_SMTP_HOST eq '' || $smarty.const.CONFIG_SMTP_PORT eq '' || $smarty.const.CONFIG_SMTP_FROM eq ''}disabled="disabled"{/if}/>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
{literal}
	jQuery(document).ready(function(){
		jQuery("a[data-toggle=popover]")
			.popover()
			.click(function(e) {
		  	e.preventDefault()
		});
	});

	jQuery('#myTab a').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	})
{/literal}
</script>

{include file="www_footer.tpl"}