<script>

</script>
<div class="w-1/2 mr-0 ml-auto">
	<div class=" erreur">
		<ul>
			<?php
			foreach ($_REQUEST['erreurs'] as $erreur) {
				echo "<li>$erreur</li>";
			}
			?>
		</ul>
	</div>
</div>