$(document).ready(function(){
      //recuperation des donnees de la section
    $(document).on('click', '.edit_parent', function(){
      var parent_id = $(this).attr("id");
      //alert(id_parent);
      $.ajax({
        url:"./processing/update/update_parent.php",
        method:"POST",
        data:{parent_id:parent_id},
        dataType:"json",
        success:function(data){

          $('#id_parent').val(data.id_parent);
          $('#parent_lastname').val(data.lastname);
          $('#parent_name').val(data.name_p);
          $('#parent_tel1').val(data.tel1);
          $('#parent_tel2').val(data.tel2);
          $('#parent_email').val(data.email);
          $('#quartier').val(data.quartier);
          $('#commune').val(data.commune);
         
          $('#editer_parent').modal('show');
         
        }
      })
  });


});