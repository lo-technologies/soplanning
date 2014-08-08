<div class="alert">
	{foreach from=$infos item=info key=titre}
		{assign var=nomTexteTmp value="version_"|cat:$titre}
		<b>{$smarty.config.$nomTexteTmp}</b> : {$info}
		<br />
	{/foreach}

	<div align="right" style="font-size:9px">
		<a href="javascript:desactiverRappelVersion();undefined">{#version_nePlusRappeler#}</a>
	</div>
</div>