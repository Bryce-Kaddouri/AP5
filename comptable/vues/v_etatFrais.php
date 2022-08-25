<div class="border-solid border-2 border-black mt-12 mb-10">

  <h3 class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-2xl">Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?>
  </h3>
  <div class="mr-2 ml-2 mb-8">
    <p class="mt-10">
      <span class="font-semibold text-xl underline mr-3">État : </span><?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br>
      <span class="font-semibold text-xl underline mr-3">Montant validé :</span> <?php echo $montantValide ?> (e)


    </p>
    <table class="w-full">
      <caption class="text-xl font-semibold mt-5 mb-5 ml-0">Eléments forfaitisés </caption>
      <tr class="w-full">
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $libelle = $unFraisForfait['libelle'];
        ?>
          <th class="w-1/4 pb-2 pt-2 bg-blue-table border-solid border-2 border-black"> <?php echo $libelle ?></th>
        <?php
        }
        ?>
      </tr>
      <tr>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $quantite = $unFraisForfait['quantite'];
        ?>
          <td class="border-solid border-2 border-black text-xl text-center"><?php echo $quantite ?> </td>
        <?php
        }
        ?>
      </tr>
    </table>
    <div class="mt-5 mb-10">
      <p>Descriptif des éléments hors forfait : ?????????????????
        <br> justificatifs reçus : <?php echo $nbJustificatifs ?>
        <!-- count doc justificatif -->
      </p>
    </div>
    <table class="w-full">
      <tr>
        <th class="w-1/4 pb-2 pt-2 bg-blue-table border-solid border-2 border-black">Date</th>
        <th class="w-1/4 bg-blue-table border-solid border-2 border-black">Libellé</th>
        <th class='w-1/4  bg-blue-table border-solid border-2 border-black'>Montant</th>
      </tr>
      <?php
      foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
        $date = $unFraisHorsForfait['date'];
        $libelle = $unFraisHorsForfait['libelle'];
        $montant = $unFraisHorsForfait['montant'];
      ?>
        <tr>
          <td class="border-solid border-2 border-black text-xl text-center"><?php echo $date ?></td>
          <td class="border-solid border-2 border-black text-xl text-center"><?php echo $libelle ?></td>
          <td class="border-solid border-2 border-black text-xl text-center"><?php echo $montant ?></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</div>
</div>