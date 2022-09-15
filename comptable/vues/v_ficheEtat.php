<div id="contenu" class=" mb-20 pb-10 mr-12 mt-5 w-full  shadow-lg h-auto">
    <div class="pt-2 mr-2 ml-2">
        <!-- <h2 class="w-auto h-12  bg-blue1 shadow-lg border-blue1 font-semibold text-3xl text-center  ">Valider fiche de frais</h2> -->
        <div class="border-solid border-2  border-black mt-12 bg-blanc2  w-auto ml-20 mr-20">
            <div class="ml-10 mr-10">

                <img src="images/logo.jpg" alt="image logo gsb" class="mt-3 w-50 shadow-lg mr-auto ml-auto">
                <h1 class="text-center text-2xl font-semibold text-blue1 mt-10">ETAT DE FRAIS ENGAGES</h1>
                <p class="text-center text-l font-regular text-blue2 mt-3">A retourner accompagné des justificatifsau plus tard le 10 du mois qui suit l’engagement des frais</p>

                <div class="w-full mb-6 ">
                    <div class="d-flex flex w-full mt-10">
                        <p class="text-xl ml-2 font-semibold">Visiteur </p>
                        <div class="ml-24 d-block block">
                            <div class="d-flex flex">
                                <p class="text-xl ">Matricule : </p>
                                <p class="ml-5 text-xl"><?php echo $lesinfosVisiteur['id'] ?></p>
                            </div>
                            <div class="d-flex flex mt-5">
                                <p class="text-xl ">Nom : </p>
                                <p class="ml-5 text-xl"><?php echo $lesinfosVisiteur['nom'] . " " . $lesinfosVisiteur['prenom'] ?></p>
                            </div>
                        </div>
                    </div>



                    <div class=" ml-2 d-flex flex w-full mt-10">
                        <p class="text-xl font-semibold">Mois : </p>
                        <div class="ml-24 d-block block">
                            <div class="d-flex flex">
                                <p class=" ml-5 text-xl"><?php echo $moisString . " " . $numAnnee ?></p>
                            </div>

                        </div>
                    </div>

                    <table class="w-full   mt-10 ">
                        <thead class="bg-blue-table ">
                            <tr>
                                <th class="pt-2 pb-2 text-xl">Frais forfaitaires</th>
                                <th class="pt-2 pb-2 text-xl">Quantité</th>
                                <th class="pt-2 pb-2 text-xl">Montant Unitaire </th>
                                <th class="pt-2 pb-2 text-xl">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            foreach ($lesinfosForfait as $info) {
                                echo '<tr>
                                        <td class="border-solid border-2 border-black bg-white">' . $info["libelle"] . '</td>
                                        <td class="border-solid border-2 border-black bg-white">' . $info["quantite"] . '</td>
                                        <td class="border-solid border-2 border-black bg-white">' . number_format($info["montant"], 2, ".") . ' EUR</td>
                                        <td class="border-solid border-2 border-black bg-white">' . number_format($info['quantite'] * $info['montant'], 2, ".")  . ' EUR</td>
                                    </tr>';
                            }
                            ?>

                            <tr>
                                <td class="bg-trasparent"></td>
                                <td></td>
                                <td></td>
                                <td class="border-solid border-2 border-black bg-white"><?php echo $totalFraisForfait['totalFraisForfait']; ?> EUR</td>

                            </tr>
                        </tbody>

                    </table>

                    <p class="ml-2 text-xl font-semibold text-center mt-10 mb-5">Autre frais</p>

                    <table class="w-full   mt-10 ">
                        <thead class="bg-blue-table border-solid border-2 border-grey-900">
                            <tr>
                                <th class="w-1/20 d-none deleteAction"></th>
                                <th class="pt-2 pb-2 w-1/4 text-xl">Date</th>
                                <th class="pt-2 w-2/4 pb-2 text-xl">Libellé</th>
                                <th class="pt-2 w-2/4 pb-2 text-xl">Montant</th>
                                <th class="pt-2 w-1/4 pb-2 text-xl">Justificatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($lesinfosHorsForfait) <= 0) {
                                echo '<tr class="">
                                <td class="bg-white w-full font-bold text-l ">Aucun Frais Hors Forfait</td>
                                        
                                    </tr>';
                            } else {
                                foreach ($lesinfosHorsForfait as $infoHF) {
                                    echo "<script>console.log(" . $lesinfosHorsForfait . "</script>";
                                    if ($infoHF['justificatif'] == "0") {
                                        $justificatifString = 'Non';
                                    } else if ($infoHF['justificatif'] == "1") {
                                        $justificatifString = 'Oui';
                                    } else {
                                        $justificatifString = 'Erreur';
                                    }
                                    echo '<tr>
                            <td  class="w-1/20 pb-1 pt-1 text-center d-none deleteAction"><button dt-idFrais="' . $infoHF['id'] . '" dt-idVisiteur="' . $infoHF['idVisiteur'] . '" class="bg-red-700 w-8 h-8 hover:bg-red-800 rounded-full btn-suppr">
                                    <div class="bg-white h-2 w-5 m-auto"></div>
                                </button> </td>
                            <td class="border-solid border-2 border-black bg-white">' . $infoHF['date'] . '</td>
                            <td class="border-solid border-2 border-black bg-white">' . $infoHF['libelle'] . '</td>
                            <td class="border-solid border-2 border-black bg-white">' . $infoHF['montant'] . ' EUR</td>
                            <td class="border-solid border-2 border-black bg-white">' . $justificatifString . '</td>
    
                        </tr>';
                                }
                                echo '
                                <tr>
                                    <td class="bg-trasparent"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="border-solid border-2 border-black bg-white">' . $totalFraisForfait['totalFraisForfait'] . ' EUR</td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class=" w-auto bg-red ml-72 block d-block mb-32">
                        <p class="text-xl w-full  font-semibold mt-6 mb-2 text-blue1">Signature</p>
                    </div>
                    <hr class="w-1/3">
                    <div class="d-block block mb-5 mt-5">
                        <p>
                            -1
                            Les frais forfaitaires doivent être justifiés par une facture acquittée faisant apparaître le montant de la TVA.
                            Ces documents ne sont pas à joindre à l’état de frais mais doivent être conservés pendant trois années. Ils
                            peuvent être contrôlés par le délégué régional ou le service comptable.
                        </p>
                        <p>
                            2-
                            Tarifs en vigueur au 01/09/2010.
                        </p>
                        <p>
                            3- Prix au kilomètre selon la puissance du véhicule déclaré auprès des services comptables.

                        <div class="block d-block">
                            <p>* (Véhicule 4CV Diesel) 0.52 € / Km</p>
                            <p>* (Véhicule 5/6CV Diesel) 0.58 € / Km</p>
                            <p>* (Véhicule 4CV Essence) 0.62 € / Km</p>
                            <p>* (Véhicule 5/6CV Essence) 0.67 € / Km</p>
                        </div>

                        </p>
                        <p>4- Tout frais « hors forfait » doit être dûment justifié par l’envoi d’une facture acquittée faisant apparaître le
                            montant de TV.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="borderButtonValidation d-relative  w-auto mt-5 h-auto pb-5 ml-20 mr-20">
            <p class="w-auto  ">
                <button id="supprimerLigne" class="pl-5 pr-5 pb-1 pt-1  bg-red-600 text-white text-l font-regular rounded hover:bg-red-700 cursor-pointer" type="submit" size="20">Supprimer une ligne</button>
                <button id="attenteLigneFiche" class="pl-5 pr-5 pb-1 pt-1  bg-blue-600 text-white text-l font-regular rounded hover:bg-blue-700 cursor-pointer" id="annuler" type="reset" value="Effacer" size="20">Mettre en attente</button>
                <button dt-idmoisFiche="<?php echo $infosFiche['mois'] ?>" dt-idVisiteur="<?php echo $infosFiche['idVisiteur'] ?>" id="validerFiche" class="validerFiche pl-5 pr-5 pb-1 pt-1  bg-green-600 text-white text-l font-regular rounded hover:bg-green-700 cursor-pointer" size="20">Valider la fiche</button>
            </p>
        </div>
    </div>
    </form>
</div>