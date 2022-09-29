<div class="w-auto ml-auto mr-5 mt-2 pb-3">
	<div class="w-1/2 mr-0 ml-auto">
		<?php
		$i = 1;
		foreach ($_REQUEST['erreurs'] as $erreur) {
		?>
			<div class=" notification numNotif<?php echo $i; ?> is-danger is-light">
				<button class="delete" dt-numNotif="<?php echo $i; ?>"></button>
				<?php echo "<li>$erreur</li>";
				?>
			</div>
		<?php
			$i += 1;
		}
		?>
	</div>
</div>