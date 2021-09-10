$(document).ready(function(){
  //nouvelle facture
  $(document).on('click', '.facture', function(){
      var idStudent = $(this).attr("id");
 	  //mois à payer
        var ids = idStudent;
        $.post('./processing/update/monthStudent.php',{ids:ids},function(datas){
        	$('#moisE').html(datas);
      	});

        $.post('./processing/update/feeStudent.php',{idStudent:idStudent},function(data){
        	$('#infoFees').html(data);
      	});
      
      $('#idStd').val(idStudent);
      $('#formFacture').modal('show');
  });

  //
});