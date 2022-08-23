    <!-- Division pour le sommaire -->
    <div id="menuGauche" class=" mt-32 ">

       <aside class="w-64" aria-label="Sidebar">
          <div id="sidebar" class=" w-64 h-full overflow-y-auto py-4 px-3 bg-nav mt-32  dark:bg-gray-800">


             <ul id="menuList" class="space-y-2">
                <div id="btn-menu" class=" w-10">
                   <svg id="btn-menuSVG" class="cursor-pointer float d-float " width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M22.9167 31.25L16.6667 25M16.6667 25L22.9167 18.75M16.6667 25H33.3333M6.25 25C6.25 22.5377 6.73498 20.0995 7.67726 17.8247C8.61953 15.5498 10.0006 13.4828 11.7417 11.7417C13.4828 10.0006 15.5498 8.61953 17.8247 7.67726C20.0995 6.73498 22.5377 6.25 25 6.25C27.4623 6.25 29.9005 6.73498 32.1753 7.67726C34.4502 8.61953 36.5172 10.0006 38.2582 11.7417C39.9993 13.4828 41.3805 15.5498 42.3227 17.8247C43.265 20.0995 43.75 22.5377 43.75 25C43.75 29.9728 41.7746 34.7419 38.2582 38.2582C34.7419 41.7746 29.9728 43.75 25 43.75C20.0272 43.75 15.2581 41.7746 11.7417 38.2582C8.22544 34.7419 6.25 29.9728 6.25 25V25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                   </svg>
                </div>

                <li id="user" class=" text-white font-regular text-xl mb-20 infoUser">
                   Visiteur :<br>
                   <span class="text-white font-semibold underline text-2xl ">
                      <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom']  ?>
                   </span>
                </li>
                <li>
                   <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100">
                      <svg class="flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="30" height="38" viewBox="0 0 32 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M9.33333 19.75H21.8333M9.33333 28.0833H21.8333M26 38.5H5.16667C4.0616 38.5 3.00179 38.061 2.22039 37.2796C1.43899 36.4982 1 35.4384 1 34.3333V5.16667C1 4.0616 1.43899 3.00179 2.22039 2.22039C3.00179 1.43899 4.0616 1 5.16667 1H16.8042C17.3567 1.00012 17.8865 1.21969 18.2771 1.61042L29.5563 12.8896C29.947 13.2802 30.1665 13.81 30.1667 14.3625V34.3333C30.1667 35.4384 29.7277 36.4982 28.9463 37.2796C28.1649 38.061 27.1051 38.5 26 38.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      <span class="ml-3 text-white text-xl infoUser">Saisir fiche de frais</span>
                   </a>
                </li>
                <li>
                   <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100">
                      <svg class="flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="40" height="30" viewBox="0 0 42 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M27.1289 15.5835C27.1289 17.2411 26.4704 18.8308 25.2983 20.0029C24.1262 21.175 22.5365 21.8335 20.8789 21.8335C19.2213 21.8335 17.6316 21.175 16.4595 20.0029C15.2874 18.8308 14.6289 17.2411 14.6289 15.5835C14.6289 13.9259 15.2874 12.3362 16.4595 11.1641C17.6316 9.99198 19.2213 9.3335 20.8789 9.3335C22.5365 9.3335 24.1262 9.99198 25.2983 11.1641C26.4704 12.3362 27.1289 13.9259 27.1289 15.5835V15.5835Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                         <path d="M1 15.5833C3.65417 7.13125 11.5521 1 20.8792 1C30.2083 1 38.1042 7.13125 40.7583 15.5833C38.1042 24.0354 30.2083 30.1667 20.8792 30.1667C11.5521 30.1667 3.65417 24.0354 1 15.5833V15.5833Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      <span class="ml-3 text-white text-xl infoUser">Mes fiches de frais</span>
                   </a>
                </li>
                <li>
                   <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                      <svg class="flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="40" height="36" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M30.1667 26L38.5 17.6667M38.5 17.6667L30.1667 9.33333M38.5 17.6667H9.33333M21.8333 26V28.0833C21.8333 29.7409 21.1749 31.3306 20.0028 32.5028C18.8306 33.6749 17.2409 34.3333 15.5833 34.3333H7.25C5.5924 34.3333 4.00269 33.6749 2.83058 32.5028C1.65848 31.3306 1 29.7409 1 28.0833V7.25C1 5.5924 1.65848 4.00269 2.83058 2.83058C4.00269 1.65848 5.5924 1 7.25 1H15.5833C17.2409 1 18.8306 1.65848 20.0028 2.83058C21.1749 4.00269 21.8333 5.5924 21.8333 7.25V9.33333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      <span class="ml-3 text-white text-xl infoUser">Déconnexion</span>
                   </a>
                </li>

             </ul>
          </div>
       </aside>
    </div>