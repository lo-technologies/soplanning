{* Smarty *}
{include file="www_header.tpl"}

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="soplanning-box">
				<div class="btn-group">
					<a href="{$BASE}/projets.php" class="btn btn-small" ><img src="assets/img/pictos/projets.png" border="0" width="18">&nbsp;{#menuListeProjets#}</a>
					<a href="{$BASE}/groupe_form.php" class="btn btn-small"><img src="assets/img/pictos/addgroupe.png" border="0" width="18">&nbsp;{#menuCreerGroupe#}</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="soplanning-box margin-top-10">
				{if $groupes|@count > 0}
					<table class="table table-striped">
						<tr>
							<th>&nbsp;</th>
							<th align="center">
								{if $order eq "nom"}
									{if $by eq "asc"}
										<a href="{$BASE}/groupe_list.php?page=1&order=nom&by=desc">{#groupe_liste_nom#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/asc_order.png" border="0" alt="" />
									{else}
										<a href="{$BASE}/groupe_list.php?page=1&order=nom&by=asc">{#groupe_liste_nom#}</a>&nbsp;<img src="{$BASE}/assets/img/pictos/desc_order.png" border="0" alt="" />
									{/if}
								{else}
									<a href="{$BASE}/groupe_list.php?page=1&order=nom&by={$by}">{#groupe_liste_nom#}</a>
								{/if}
							</th>
							<th>{#groupe_liste_nbProjets#}</th>
						</tr>
						{foreach name=groupes item=groupe from=$groupes}
							<tr bgcolor="#FFFFFF" onMouseOver="javascript:this.style.backgroundColor='#EEEEEE'" onMouseOut="javascript:this.style.backgroundColor='#FFFFFF'">
								<td align="center" nowrap="nowrap">
									<a href="{$BASE}/groupe_form.php?groupe_id={$groupe.groupe_id}"><img src="{$BASE}/assets/img/pictos/edit.gif" border="0" width="16" height="16" /></a>
									&nbsp;
									<a href="{$BASE}/process/groupe_save.php?groupe_id={$groupe.groupe_id}&action=delete" onClick="javascript:return confirm('{#groupe_liste_confirmSuppr#|escape:"javascript"}')"><img src="{$BASE}/assets/img/pictos/delete.gif" border="0" width="16" height="16" /></a>
								</td>
								<td>{$groupe.nom|xss_protect}&nbsp;</td>
								<td>{$groupe.totalProjets}&nbsp;</td>
							</tr>
						{/foreach}
						{if $nbPages > 1}
							<tr>
								<td colspan="7" align="right">
									{if $currentPage > 1}<a href="{$BASE}/groupe_list.php?page={$currentPage-1}">&lt;&lt; {#action_precedent#}</a>&nbsp;&nbsp;{/if}
									{section name=pagination loop=$nbPages}
										{if $smarty.section.pagination.iteration == $currentPage}<b>{else}<a href="{$BASE}/groupe_list.php?page={$smarty.section.pagination.iteration}">{/if}
										{$smarty.section.pagination.iteration}
										{if $smarty.section.pagination.iteration == $currentPage}</b>{else}</a>{/if}&nbsp;
									{/section}
									{if $currentPage < $nbPages}<a href="{$BASE}/groupe_list.php?page={$currentPage+1}">{#action_suivant#} &gt;&gt;</a>{/if}
								</td>
							</tr>
						{/if}
					</table>
				{else}
					{#info_noRecord#}
				{/if}
			</div>
		</div>
	</div>
</div>



{include file="www_footer.tpl"}