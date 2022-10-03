<table>
  <tr>
    <th class="action">&nbsp;</th>
    <th class="date w-1/4 bg-blue-table border-solid border-2 border-grey-900">Date</th>
    <th class="libelle w-2/4 bg-blue-table border-solid border-2 border-grey-900">Libellé</th>
    <th class="montant w-1/4 bg-blue-table border-solid border-2 border-grey-900">Montant</th>

  </tr>

  <?php


  foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
    $libelle = $unFraisHorsForfait['libelle'];
    $date = $unFraisHorsForfait['date'];
    $montant = $unFraisHorsForfait['montant'];
    $id = $unFraisHorsForfait['id'];
  ?>
    <tr>
      <td class="w-1/20 pb-2 pt-2 text-center deleteAction"><button dt-idVisiteur="<?php echo $id ?>" class="bg-red-700 w-8 h-8 hover:bg-red-800 rounded-full btn-suppr">
          <div class="bg-white h-1 w-4 m-auto"></div>
        </button> </td>
      <td class="border-solid border-2 border-black-900 pl-5"> <?php echo $date ?> </td>
      <td class="border-solid border-2 border-black-900 pl-5"><?php echo $libelle ?> </td>
      <td class="border-solid border-2 border-black-900 pl-5"><?php echo $montant ?> EUR</td>
    </tr>
  <?php

  }
  ?>
  <?php if (count($lesFraisHorsForfait) == 0) { ?>
    <tr class="ml-2">
      <td colspan="4" class="text-center border-solid border-2 border-black-900 pl-5 h-8 pb-2 pt-2 font-bold">Aucun frais hors forfait</td>
    </tr>
  <?php } else { ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="border-solid border-2 border-black-900 pl-5 h-8 pb-2 pt-2 font-bold"><?php echo $totalFraisHorsForfait['totalFraisHorsForfait']; ?> EUR</td>
    </tr>

  <?php } ?>

</table>
<div class="mt-8">

  <form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
    <div class="border-solid border-2 border-black">

      <fieldset>
        <legend class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-xl ">Nouvel élément hors forfait
        </legend>
        <div class="w-full bg-red d-flex flex m-3">
          <label class="ml-24 w-1/4 text-regular text-l" for="txtDateHF">Date (jj/mm/aaaa):</label>
          <input type="date" class="w-1/5 rounded border-input" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value="" required>
        </div>
        <div class="w-full bg-red d-flex flex m-3">
          <label class="ml-24 w-1/4 text-regular text-l" for="txtLibelleHF">Libellé</label>
          <input type="text" class="w-1/5 rounded border-input" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" required />
        </div>
        <div class="w-full bg-red d-flex flex m-3">
          <label class="ml-24 w-1/4 text-regular text-l" for="txtLibelleHF">Justificatif</label>
          <div class="flex d-flex gap-14">
            <div>
              <input type="radio" id="justificatif" name="justificatif" value="1" required>
              <label for="oui">Oui</label>
            </div>
            <div>
              <input type="radio" id="non" name="justificatif" value="0" required>
              <label for="non">Non</label>
            </div>
          </div>
        </div>
        <div class="w-full bg-red d-flex flex m-3">
          <label for="txtMontantHF" class="ml-24 w-1/4 text-regular text-l">Montant </label>
          <input type="number" min="0.00" max="10000.00" step="0.01" class="w-1/5 rounded border-input" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" required />
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