<div id="contenu" class="ml-72 mr-12 mt-5 bg-blanc1 shadow-lg h-auto">
  <div class="pt-2 mr-2 ml-2">
    <h2 class="w-auto h-12  bg-blue1 shadow-lg border-blue1 font-semibold text-3xl text-center  ">Renseigner ma fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?></h2>

    <form method="POST" action="index.php?uc=gererFrais&action=validerMajFraisForfait" class="mt-12">
      <div class="border-solid border-2 border-black">

        <fieldset>
          <legend style="z-index: 10" class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-xl ">Eléments forfaitisés
          </legend>
          <?php
          foreach ($lesFraisForfait as $unFrais) {
            $idFrais = $unFrais['idfrais'];
            $libelle = $unFrais['libelle'];
            $quantite = $unFrais['quantite'];
          ?>

            <div class="w-full d-flex flex m-3">
              <label class="ml-24 w-1/4 text-regular text-l" for="idFrais"><?php echo $libelle ?></label>
              <input type="text" class="w-1/5 rounded border-input" id="idFrais" name="lesFrais[<?php echo $idFrais ?>]" size="10" maxlength="5" value="<?php echo $quantite ?>">
            </div>

          <?php
          }
          ?>
        </fieldset>
      </div>
      <div class="borderButtonValidation d-relative w-full mt-5 h-auto pb-5 ml-auto mr-0">
        <p class="w-full mr-0 ml-auto right-0 d-absolute ">
          <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="ok" type="submit" value="Valider" size="20" />
          <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="annuler" type="reset" value="Effacer" size="20" />
        </p>
      </div>

    </form>
  </div>