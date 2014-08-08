
{#mail_supprTache_corps#}

{#winPeriode_projet#} : {$projet.nom} ({$projet.projet_id})
{#winPeriode_debut#} : {$periode.date_debut|sqldate2userdate}
{if $periode.date_fin neq ""}{#winPeriode_fin#} : {$periode.date_fin|sqldate2userdate}{else}{#mail_tacheDuree#} : {$periode.duree|sqltime2usertime}{/if}

{if $periode.titre neq ""}{#winPeriode_titre#} : {$periode.titre}{/if}

{if $periode.notes neq ""}{#winPeriode_commentaires#} : {$periode.notes}{/if}

{if $periode.lien neq ""}{#winPeriode_lien#} : {$periode.lien}{/if}

{if $smarty.const.CONFIG_SOPLANNING_URL}{$smarty.const.CONFIG_SOPLANNING_URL}{/if}
