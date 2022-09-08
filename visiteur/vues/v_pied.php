<!-- Division pour le pied de page -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<style>
  .flip {
    transform: rotate(-180deg);
  }
</style>
<script>
  $(document).ready(function() {

    $('#btn-menu').click(function() {
      $(".infoUser").toggle(
        function() {
          $(".infoUser").addClass('d-none')
          $("#sidebar").addClass('w-18')
          // $('#btn-menuSVG').addClass('rotate180')
          $('#btn-menuSVG').css('transform', 'rotate(180deg)')

        },
        function() {
          $(".infoUser").removeClass('d-none')
          $("#sidebar").removeClass('w-64')
          $('#btn-menuSVG').addClass('rotate180')
          console.log('test retour')

        }
      );
    })
  });
</script>

<!-- import cdn sweetAlert-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../visiteur/js/script.js"></script>
</body>

</html>