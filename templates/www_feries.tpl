{* Smarty *}

{include file="www_header.tpl"}

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<a href="javascript:xajax_modifFerie();undefined;" class="btn btn-small" ><img src="assets/img/pictos/feries.png" border="0" width="18">&nbsp;{#menuCreerFerie#}</a>
				<div class="btn-group">
					<button class="btn btn-small" data-toggle="dropdown">{#feries_import#}&nbsp;<span class="caret"></span></button>
					<ul class="dropdown-menu">
						{foreach from=$fichiers item=fichier}
							<li><a onClick="event.cancelBubble=true;" href="javascript:if(confirm('{#feries_confirmImport#}')){literal}{{/literal}document.location='process/feries.php?fichier={$fichier|basename}'{literal}}{/literal}">{$fichier|basename}</a></li>
						{/foreach}
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				{if $feries|@count > 0}
					<table class="table table-striped">
						<tr>
							<th width="70">&nbsp;</th>
							<th align="center" width="100">
								<b>{#feries_date#}</b>
							</th>
							<th align="center">
								<b>{#feries_libelle#}</b>
							</th>
						</tr>
						{foreach name=feries item=ferie from=$feries}
							<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
								<td align="center" nowrap="nowrap">
									<a href="javascript:xajax_modifFerie('{$ferie.date_ferie|urlencode}');undefined;"><img src="{$BASE}/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
									&nbsp;
									<a href="javascript:xajax_supprimerFerie('{$ferie.date_ferie|urlencode}');undefined;" onClick="javascript:return confirm('{#confirm#|escape:"javascript"}')"><img src="{$BASE}/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
								</td>
								<td align="center">
									{$ferie.date_ferie|sqldate2userdate}&nbsp;
								</td>
								<td>
									{$ferie.libelle}
								</td>
							</tr>
						{/foreach}
					</table>
				{else}
					{#info_noRecord#}
				{/if}
			</div>
		</div>
	</div>
</div>

{include file="www_footer.tpl"}