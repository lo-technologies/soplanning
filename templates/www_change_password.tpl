{include file="www_header.tpl"}

<br /><br /><br /><br />

<table align="center" cellpadding="0" cellspacing="0" width="450" class="blocHomepage">
<tr>
	<td align="center" style="padding-bottom:16px;">
		{if $smarty.const.CONFIG_SOPLANNING_TITLE neq "SOPlanning"}
			<span style="font-size:23px;font-weight:bold;">{$smarty.const.CONFIG_SOPLANNING_TITLE|escape:'html'|escape:'javascript'}</span>
		{else}
			<img src="assets/img/pictos/logo.jpg" border="0">
		{/if}

		{if isset($planningVersion)}
		v{$planningVersion}
		{/if}
	</td>
</tr>
</table>

<br /><br /><br />
<table align="center" cellpadding="0" cellspacing="0" width="450" class="blocHomepage">
<tr>
	<td align="center" style="padding-bottom:16px;">
		<table width="300" align="center">
			<tr>
				<td align="right"><b>{#login_login#} :</b></td>
				<td>{$userTmp.login}</td>
			</tr>
			<tr>
				<td class="normal" align="right"><b>{#rappelPwdNouveauPassword#} :</b></td>

				<td><input type="password" size="20" id="password"></td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					<input class="normal" type="submit" value="GO" style="width:40px;" onClick="xajax_nouveauPwd($('password').value);undefined;">
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>

{include file="www_footer.tpl"}