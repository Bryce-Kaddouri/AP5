<div class="border-solid border-2 border-black pb-10">
    <?php



    // echo $lesfichesValidees[0]['idVisiteur'];
    $nbFicheValidee =  count($lesfichesValidees);
    $i = 0;
    while ($i < $nbFicheValidee) {
        echo '<div class="flex bg-white shadow-lg rounded cursor-pointer pt-3 pb-3 border-solid border-2 border-black mt-3 ml-2 mr-2 text-center">
                <div dt-idVisiteur="' . $lesfichesValidees[$i]['idVisiteur'] . '" class="w-1/6">Visiteur : ' . $lesfichesValidees[$i]['nomVisiteur'] . '</div>
                <div class="w-1/6">' . $lesfichesValidees[$i]['mois'] . '</div>
                <div class="w-1/6">' . $lesfichesValidees[$i]['montantValide'] . '</div>
                <div class="w-1/6">' . $lesfichesValidees[$i]['idEtat'] . '</div>
                <div class="w-1/6">Modifié le : ' . $lesfichesValidees[$i]['dateModif'] . '</div>
                <div class="w-1/6">' . $lesfichesValidees[$i]['libEtat'] . '</div>
                </div>';
        $i = $i + 1;
    }

    ?>
</div>



</form>