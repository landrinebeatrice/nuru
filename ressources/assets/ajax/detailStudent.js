    //recuperation des donnees de l'eleve et ajout des values au champ du modal
    $(document).on('click', '.detailStudent', function(){
      var user_id = $(this).attr("id");
      $.ajax({
        url:"./processing/update/detail_student.php",
        method:"POST",
        data:{user_id:user_id},
        dataType:"json",
        success:function(data){
          $('#nms').html(data.name_student);
          $('#pstns').html(data.middlename_student);
          $('#pns').html(data.lastname_student);
          $('#tls').html("+243"+data.tel_student);
          $('#ln').html(data.lieu_naissance);
          $('#dn').html(data.date_naissance);
          if(data.arret_bus == ""){
            $('#ab').html('--R.A.S--');
          }else{
            $('#ab').html(data.arret_bus);
          }
          $('#ft').html(data.frais_transport+" USD");
          if(data.sexe == "F"){
            $('#sx').html("FEMININ");
          }else{
            $('#sx').html("MASCULIN");
          }
          $('#di').html(data.date_inscription)

          $('#nmp').html(data.ng);
          $('#cp').html(data.cp);
          $('#tlp').html(data.tlp);
          $('#emp').html(data.email);
          $('#qrt').html(data.qrt);
          $('#cmn').html(data.cmn);
  
          $('#detail_eleve').modal('show');
        }
      })
    });
