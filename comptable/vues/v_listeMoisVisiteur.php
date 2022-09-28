 <div id="contenu" class="ml-72 mr-12 mt-5 bg-blanc1 shadow-lg h-auto">
   <div class="pt-2 mr-2 ml-2">
     <h2 class="w-auto h-12  bg-blue1 shadow-lg border-blue1 font-semibold text-3xl text-center  ">Valider fiche de frais</h2>
     <div class="border-solid border-2 border-black mt-12 ">
       <h3 class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-xl">Mois et Visiteur à sélectionner </h3>
       <form action="index.php?uc=validerFrais&action=afficherEtat" method="post">
         <div class="w-full bg-red d-flex flex m-3">
           <div class="w-1/2 mt-5 mb-5">
             <label for="lstVisiteur" class="ml-24  w-1/4 text-regular text-l" accesskey="n">Visiteur : </label>
             <select class="w-auto rounded border-input" id="lstVisiteur" name="lstVisiteur">
               <option value="">-- Saisir un Visiteur --</option>
               <?php
                foreach ($lesVisiteurs as $unVisiteur) {
                  $id = $unVisiteur['id'];
                  $nom =  $unVisiteur['nom'];
                  $prenom =  $unVisiteur['prenom'];

                  echo "<option value=" . $id . ">" . $nom . " " . $prenom . " </option>";
                }
                ?>



             </select>
           </div>
           <div class="w-1/2 mt-5 mb-5">
             <label for="lstMois" class="ml-24 w-1/4 text-regular text-l" accesskey="n">Mois : </label>
             <select class="w-auto rounded border-input" id="lstMois" name="lstMois">
               <option value="">-- Saisir un mois --</option>
               <?php

                // tableau des mois en chaine de caractere 
                $lesMois = array(
                  "01" => "Janvier",
                  "02" => "Février",
                  "03" => "Mars",
                  "04" => "Avril",
                  "05" => "Mai",
                  "06" => "Juin",
                  "07" => "Juillet",
                  "08" => "Août",
                  "09" => "Septembre",
                  "10" => "Octobre",
                  "11" => "Novembre",
                  "12" => "Décembre"
                );

                $anneeActuel = date("Y");

                // creation des option dans la liste deroulante
                foreach ($lesMois as $unMois => $libelle) {
                  echo "<option value=" . $anneeActuel . $unMois . ">" . $libelle . " " . $anneeActuel . " </option>";
                }

                // foreach ($lesMois as $unMois) {
                //   $numMois = substr($unMois, 4, 2);
                //   $mois = $unMois['unMois'];


                //   echo "<option value='" . $mois . "'>" . $numMois . "</option>";
                // }
                ?>
             </select>
           </div>
         </div>
     </div>

     <div class="borderButtonValidation d-relative w-full mt-5 h-auto pb-5 ml-auto mr-0">
       <p class="w-full mr-0 ml-auto right-0 d-absolute ">
         <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="ok" type="submit" value="Valider" size="20" />
         <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="annuler" type="reset" value="Effacer" size="20" />
       </p>
     </div>

     </form>
   </div>