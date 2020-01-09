function setFuncionalidades(cargo){
    if(cargo==2){
      modal_footer = document.getElementsByClassName("modal-footer").length;
  for(var i=0; i<modal_footer; i++){
    document.getElementsByClassName("modal-footer")[i].style.display = "none";
  } 
  modal_header = document.getElementsByClassName("modal-header-1").length;
  for(var i=0; i<modal_header; i++){
    document.getElementsByClassName("modal-header-1")[i].style.display = "none";
  } 
  
  

  }
  }
  