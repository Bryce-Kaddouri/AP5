<table>
  <caption class="w-full text-xl font-semibold ml-0">Descriptif des éléments hors forfait
  </caption>
  <tr>
    <th class="action">&nbsp;</th>
    <th class="date w-1/4 bg-blue-table border-solid border-2 border-grey-900">Date</th>
    <th class="libelle w-2/4 bg-blue-table">Libellé</th>
    <th class="montant w-1/4 bg-blue-table">Montant</th>

  </tr>

  <?php
  foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
    $libelle = $unFraisHorsForfait['libelle'];
    $date = $unFraisHorsForfait['date'];
    $montant = $unFraisHorsForfait['montant'];
    $id = $unFraisHorsForfait['id'];
  ?>
    <tr>
      <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
      <td> <?php echo $date ?></td>
      <td><?php echo $libelle ?></td>
      <td><?php echo $montant ?></td>
    </tr>
  <?php

  }
  ?>

</table>

<div class="mt-8">

  <form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
    <div class="border-solid border-2 border-black">

      <fieldset>
        <legend class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-xl ">Nouvel élément hors forfait
        </legend>
        <div class="w-full bg-red d-flex flex m-3">
          <label class="ml-24 w-1/4 text-regular text-l" for="txtDateHF">Date (jj/mm/aaaa):</label>
          <input type="text" class="w-1/5 rounded border-input" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value="">
        </div>
        <div class="w-full bg-red d-flex flex m-3">
          <label class="ml-24 w-1/4 text-regular text-l" for="txtLibelleHF">Libellé</label>
          <input type="text" class="w-1/5 rounded border-input" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
        </div>
        <div class="w-full bg-red d-flex flex m-3">
          <label for="txtMontantHF" class="ml-24 w-1/4 text-regular text-l">Montant </label>
          <input type="text" class="w-1/5 rounded border-input" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
        </div>
      </fieldset>
    </div>
    <div class="borderButtonValidation d-relative w-full mt-5 h-auto pb-5 ml-auto mr-0">
      <p>
        <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="ajouter" type="submit" value="Ajouter" size="20" />
        <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="effacer" type="reset" value="Effacer" size="20" />
      </p>
    </div>

  </form>
</div>
</div>