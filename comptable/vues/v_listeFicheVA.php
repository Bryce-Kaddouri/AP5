<div class="border-solid border-2 border-black pb-10">
    <?php



    // echo $lesfichesValidees[0]['idVisiteur'];
    $nbFicheValidee =  count($lesfichesValidees);
    $i = 0;
    while ($i < $nbFicheValidee) {
    ?>
        <div class="flex bg-white shadow-lg rounded cursor-pointer pt-3 pb-3 border-solid border-2 border-black mt-3 ml-2 mr-2 text-center">
            <div dt-idVisiteur="<?php echo $lesfichesValidees[$i]['idVisiteur'] ?>" class="w-1/6">Visiteur : <?php echo $lesfichesValidees[$i]['nomVisiteur'] ?></div>
            <div class="w-1/6"><?php echo $lesfichesValidees[$i]['mois'] ?></div>
            <div class="w-1/6"><?php echo $lesfichesValidees[$i]['montantValide'] ?></div>
            <div class="w-1/6"><?php echo $lesfichesValidees[$i]['idEtat'] ?></div>
            <div class="w-1/6">Modifié le : <?php echo $lesfichesValidees[$i]['dateModif'] ?></div>
            <div class="w-1/6"><?php echo $lesfichesValidees[$i]['libEtat'] ?></div>
            <div class="w-1/6"><button dt-idVisiteur="<?php echo $lesfichesValidees[$i]['idVisiteur'] ?>" dt-moisFiche="<?php echo $lesfichesValidees[$i]['mois'] ?>" class=" btn-editFicheVA bg-red-400 p-2  rounded hover:text-bl hover:bg-blue-700 hover:text-black ">Modifier</button></div>

        </div>
    <?php $i = $i + 1;
    }

    ?>
</div>



<!-- </form> -->