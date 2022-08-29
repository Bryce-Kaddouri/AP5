<div id="contenu" class="ml-72 mr-12 mt-5 bg-blanc1 shadow-lg h-auto">
    <div class="pt-2 mr-2 ml-2">
        <h2 class="w-auto h-12  bg-blue1 shadow-lg border-blue1 font-semibold text-3xl text-center  ">Suivre paiement fiche de frais</h2>
        <div class="border-solid border-2 border-black mt-12 ">
            <h3 class="textOnBorder bg-blanc1 ml-12 pl-2 pr-2 font-semibold text-xl">Mois à sélectionner : </h3>
            <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
                <div class="w-full bg-red d-flex flex m-3">



                    <label for="lstMois" class="ml-24 w-1/4 text-regular text-l" accesskey="n">Mois : </label>
                    <select class="w-1/5 rounded border-input" id="lstMois" name="lstMois">
                        <?php
                        foreach ($lesMois as $unMois) {
                            $mois = $unMois['mois'];
                            $numAnnee =  $unMois['numAnnee'];
                            $numMois =  $unMois['numMois'];
                            if ($mois == $moisASelectionner) {
                        ?>
                                <option selected value="<?php echo $mois ?>"><?php echo  $numMois . "/" . $numAnnee ?> </option>
                            <?php
                            } else { ?>
                                <option value="<?php echo $mois ?>"><?php echo  $numMois . "/" . $numAnnee ?> </option>
                        <?php
                            }
                        }

                        ?>

                    </select>

                </div>
        </div>

        <div class="borderButtonValidation d-relative w-full mt-5 h-auto pb-5 ml-auto mr-0">
            <p class="w-full mr-0 ml-auto right-0 d-absolute ">
                <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="ok" type="submit" value="Valider" size="20" />
                <input class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="annuler" type="reset" value="Effacer" size="20" />
            </p>
        </div>

        </form>