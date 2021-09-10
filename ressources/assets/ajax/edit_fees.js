$(document).ready(function(){
      //recuperation des donnees de la section
    $(document).on('click', '.edit_frais', function(){
      var fee_id = $(this).attr("id");
      //alert(id_parent);
      $.ajax({
        url:"./processing/update/update_fees.php",
        method:"POST",
        data:{fee_id:fee_id},
        dataType:"json",
        success:function(data){

          $('#libele').val(data.libele);
          $('#montant').val(data.montant);
          $('#section').val(data.section_id).select();
          $('#id_frais').val(data.id_frais);
         
          $('#fees_update').modal('show');
         
        }
      })
  });


});