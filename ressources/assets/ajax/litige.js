$(document).ready(function(){
      //recuperation des donnees de la section
    $(document).on('click', '.litige', function(){
      var id_student = $(this).attr("id");
      $.ajax({
        url:"./processing/update/litige.php",
        method:"POST",
        data:{id_student:id_student},
        dataType:"json",
        success:function(data)
        {
          $('#motif').val(data.motif);
          $('#total').val(data.reste);
          $('#idStudent').val(data.idStudent);
          $('#numFac').val(data.numFac);

          $('#mot').html(data.motif);
          $('#tot').html(data.reste);
         
          $('#litige').modal('show');
         
        }
      })
  });

    //solde();
    function solde(){
      var t = document.getElementById('total').value;
      var n = document.getElementById('montantPayer').value;

      document.getElementById('rest').value = t-n;
      document.getElementById('reste').value = t-n;
    }
    setInterval(solde,1);
});