$(document).ready(function(){
      //recuperation des donnees de la section
    $(document).on('click', '.edit_section', function(){
      var id_section = $(this).attr("id");
      $.ajax({
        url:"./processing/update/update_section.php",
        method:"POST",
        data:{id_section:id_section},
        dataType:"json",
        success:function(data)
        {
          $('#name_section').val(data.name_section);
          $('#id_section').val(data.id_section);
          $('#libFraisIns').val(data.libFraisIns);
          $('#montFraisIns').val(data.montFraisIns);
          $('#libFraisMens').val(data.libFraisMens);
          $('#montFraisMens').val(data.montFraisMens);
          $('#idFraisIns').val(data.idFraisIns);
          $('#idFraisMens').val(data.idFraisMens);
         
          $('#section_update').modal('show');
         
        }
      })
  });


});