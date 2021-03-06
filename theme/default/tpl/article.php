<?if(!$GLOBALS['domain']) exit;?>

<style>
	aside { border-left: 0.2em solid  #78cfd6; }
</style>


<section class="mod tc">
	<h1 class="color mbn up"><?txt('title')?></h1>
	<h2 class="color-alt"><?txt('sstitre')?></h2>
</section>


<section class="mw960p mod center mtl mbl">


	<article class="fl w80 prl pbm tj">

		<?txt('texte')?>

		<?if($res['tpl'] == "event-formulaire") include 'contact.php';?>

	</article>


	<aside class="fr w20 plt animation slide-right">

		<?
		// Date évènement
		if(stristr($res['tpl'], 'event'))
		{
			?><div class="tc mbm"><?
			if(@$GLOBALS["content"]["aaaa-mm-jj"])
			{
				//@todo faire une transformation de la date en une ligne au lieu du explode
				$date_debut = explode("-", $GLOBALS["content"]["aaaa-mm-jj"]);
				echo'<h3 class="big tc mtn mbt">'.__("Début de l'événement").'</h3>'.$date_debut['2'].'/'.$date_debut['1'].'/'.$date_debut['0'].'<br>';
			}

			input("aaaa-mm-jj", array("type" => "hidden", "class" => "meta tc"));

			?></div><?
		}?>

		<!-- Tag -->
		<div class="tc">

			<h3 class="big tc mtn mbt"><?_e("Catégories")?></h3>

			<?tag('actualites')?>

			<script>
			if(!$(".editable-tag").text()) $("#actualites").prev("h3").hide();
			else $("#actualites").addClass("mbm");
			</script>

		</div>


		<!-- Liste des autres articles -->
		<?
		$sel_article = $connect->query("SELECT * FROM ".$table_content." WHERE type='article' AND lang='".$lang."' AND state='active' AND id!='".$res['id']."' ORDER BY date_insert DESC LIMIT 0, 3");
		if($sel_article->num_rows)
		{?>
		<h3 class="big tc mtn mbt"><?_e("Derniers Articles")?></h3>

		<ul class="unstyled pan">
		<?		
		while($res_article = $sel_article->fetch_assoc())
		{
			?>
			<li class="medium mbs mls"><a href="<?=make_url($res_article['url']);?>" class="tdn"><i class="fa-li fa fa-fw fa-rss fl mrt"></i> <?=$res_article['title']?></a></li>
			<?
		}
		?>
		</ul>
		<?}?>


		<!-- Liste des autres évènements -->
		<?
		$sel_article = $connect->query("SELECT * FROM ".$table_content." WHERE type='event' AND lang='".$lang."' AND state='active' AND id!='".$res['id']."' ORDER BY date_insert DESC LIMIT 0, 3");
		if($sel_article->num_rows)
		{?>
			<h3 class="big tc ptm mbt"><?_e("Derniers Évènements")?></h3>

			<ul class="unstyled pan">
			<?
			
			while($res_article = $sel_article->fetch_assoc())
			{
				?>
				<li class="medium mbs mls"><a href="<?=make_url($res_article['url']);?>" class="tdn"><i class="fa-li fa fa-fw fa-calendar-empty fl mrt"></i> <?=$res_article['title']?></a></li>
				<?
			}
			?>
			</ul>
		<?}?>


	</aside>

</section>

<script>
	// Action si on lance le mode d'edition
	edit.push(function()
	{
		// DATEPIKER pour la date de l'event
		$.datepicker.setDefaults({
	        altField: "#datepicker",
	        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
	        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
	        dateFormat: 'yy-mm-dd',
	        firstDay: 1
	    });
		$("#aaaa-mm-jj").datepicker();
	});
</script>