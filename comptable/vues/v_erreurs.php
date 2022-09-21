<div style="margin-left:300px" class="ml-72 mr-12 mt-5 erreur">
	<ul>

	</ul>
</div>

<div class=" ml-2  borderButtonValidation d-relative w-auto mt-5 h-auto pb-5 ml-auto mr-0">
	<div class="w-1/3">

	</div class="w-2/3">
	<div>
		<b class="w-full text-xl mr-0 ml-auto right-0 d-absolute ">
			Erreur :</b>
		<p> <?php
			foreach ($_REQUEST['erreurs'] as $erreur) {
				echo "<li>$erreur</li>";
			}
			?>
		</p>
	</div>

</div>