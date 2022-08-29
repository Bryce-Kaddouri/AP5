<div style="margin-left:300px" class="ml-72 mr-12 mt-5 erreur">
	<ul>
		<?php
		foreach ($_REQUEST['erreurs'] as $erreur) {
			echo "<li>$erreur</li>";
		}
		?>
	</ul>
</div>