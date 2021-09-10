$(document).ready(function(){
      //recuperation des donnees
    $(document).on('click', '.facture', function(){
      var idStudent = $(this).attr("id");
      alert(idStudent);
      function billModal(idStudent){
        var fee_id = document.getElementById('infoFees').value;
        if(fee_id != 0){
          $.ajax({
            url:"./processing/update/update_fees.php",
            method:"POST",
            data:{fee_id:fee_id, idStudent:idStudent},
            dataType:"json",
            success:function(data){
              $('#montot').val(data.montant);
              $('#idfee').val(data.id_frais);
              $('#libele').val(data.libele);

              if(data.frequence == 'unique'){
                $('div #infoMonth').addClass("hidden");
                $('div #infoPaye').removeClass("hidden");

              }else{
                 $('div').removeClass("hidden");
              }
              $('#mt').html(data.montant);

            }
          })
        }else{
          $('div #infoMonth').addClass("hidden");
          $('div #infoPaye').addClass("hidden");
        }

      }setInterval(billModal,100);
      billModal(idStudent);
     
    });
 

    solde();
    function solde(){
      var t = document.getElementById('montot').value;
      var n = document.getElementById('mp').value;

      $('#r').html(t-n);
      document.getElementById('sld').value = t-n;
    }
    setInterval(solde,1);
});