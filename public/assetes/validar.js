



function validar(value){
      var vdiario= document.querySelector('#diario');
      var vmes= document.querySelector('#mes');
      var vperiodico= document.querySelector('#periodico');

      if(value==2){
          vdiario.style.display="block";
          vperiodico.style.display="none";
          vmes.style.display="none";
      }
      if(value==3){
        vdiario.style.display="none";
        vmes.style.display="block";
        vperiodico.style.display="none";

      }
      if(value==4){
        vdiario.style.display="none";
        vmes.style.display="none";
        vperiodico.style.display="block";

      }

}