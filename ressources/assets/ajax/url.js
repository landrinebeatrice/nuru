function getCashFlow(file,filtre,month='void'){
    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();

    }else{
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("smsCashFlow").innerHTML = this.responseText;
        }
    };

    var month = month;
    if(month != 'void'){
        xmlhttp.open("GET","modules/"+file+"?idclass="+filtre+"&month="+month,true);

    }else{
        xmlhttp.open("GET","modules/"+file+"?filtre="+filtre,true);

    }
    
    xmlhttp.send();
}
