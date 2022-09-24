    <!-- Division pour le sommaire -->
    <div id="menuGauche" class=" mt-32 ">

       <aside class="w-64" aria-label="Sidebar">
          <div id="sidebar" class="largeSidebar w-64 h-full overflow-y-auto py-4 px-3 bg-nav mt-32  dark:bg-gray-800">



             <ul id="menuList" class="space-y-2">


                <li id="user" class=" text-white font-regular text-xl mb-5 infoUser">
                   Comptable :<br>
                   <span class="text-white font-semibold  text-2xl hover:underline cursor-pointer">
                      <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?><br>
                   </span>
                </li>
                <li>
                  <!-- <a href="" title="" class=""> -->
                   <div id="btn-menu" class=" w-10"> 
                      <svg id="btn-menuSVG" class="cursor-pointer  ml-auto " width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M22.9167 31.25L16.6667 25M16.6667 25L22.9167 18.75M16.6667 25H33.3333M6.25 25C6.25 22.5377 6.73498 20.0995 7.67726 17.8247C8.61953 15.5498 10.0006 13.4828 11.7417 11.7417C13.4828 10.0006 15.5498 8.61953 17.8247 7.67726C20.0995 6.73498 22.5377 6.25 25 6.25C27.4623 6.25 29.9005 6.73498 32.1753 7.67726C34.4502 8.61953 36.5172 10.0006 38.2582 11.7417C39.9993 13.4828 41.3805 15.5498 42.3227 17.8247C43.265 20.0995 43.75 22.5377 43.75 25C43.75 29.9728 41.7746 34.7419 38.2582 38.2582C34.7419 41.7746 29.9728 43.75 25 43.75C20.0272 43.75 15.2581 41.7746 11.7417 38.2582C8.22544 34.7419 6.25 29.9728 6.25 25V25Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />   
                        </svg>
                   </div>
                  <!-- </a> -->

                </li>

                <li>
                   <a href="index.php?uc=connexion&action=valideConnexion" title="Selectionner Visiteur et mois" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100">
                   <svg class=" font-semibold flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white d-block block hover:text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6" width="43" height="54">
                     <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>


                      <span class="ml-3 text-white text-xl infoUser">Accueil</span>
                   </a>
                </li>

                <li>
                   <a href="index.php?uc=validerFrais&action=choixVisiteurMois" title="Selectionner Visiteur et mois" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100">
                      <svg class="flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="43" height="54" viewBox="0 0 43 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M9.33333 33.75H21.8333M9.33333 42.0833H21.8333M26 52.5H5.16667C4.0616 52.5 3.00179 52.061 2.22039 51.2796C1.43899 50.4982 1 49.4384 1 48.3333V19.1667C1 18.0616 1.43899 17.0018 2.22039 16.2204C3.00179 15.439 4.0616 15 5.16667 15H16.8042C17.3567 15.0001 17.8865 15.2197 18.2771 15.6104L29.5563 26.8896C29.947 27.2802 30.1665 27.81 30.1667 28.3625V48.3333C30.1667 49.4384 29.7277 50.4982 28.9463 51.2796C28.1649 52.061 27.1051 52.5 26 52.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                         <path d="M35.0352 16C35.0352 18.7614 32.7966 21 30.0352 21C27.2737 21 25.0352 18.7614 25.0352 16C25.0352 13.2386 27.2737 11 30.0352 11C32.7966 11 35.0352 13.2386 35.0352 16ZM26.4183 16C26.4183 17.9975 28.0376 19.6168 30.0352 19.6168C32.0327 19.6168 33.652 17.9975 33.652 16C33.652 14.0025 32.0327 12.3832 30.0352 12.3832C28.0376 12.3832 26.4183 14.0025 26.4183 16Z" fill="white" />
                         <path d="M25 10.5L26 9L30.1069 17.5L34 9L38.0352 5L30.1069 21.142L25 10.5Z" fill="#53CC40" />
                      </svg>

                      <span class="ml-3 text-white text-xl infoUser">Valider fiche de frais</span>
                   </a>
                </li>
                <li>
                   <a href="index.php?uc=suivrePaiement&action=selectionnerMois" title="Consultation de mes fiches de frais" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class=" flex-shrink-0 w-10 h-10 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                      </svg>


                      <span class="ml-3 text-white text-xl infoUser hover:text-black">Suivre paiement fiche de frais</span>
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