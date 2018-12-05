(function(){
  const btnDelete = document.querySelectorAll('.btn-danger');
  //création du modal
  const modal = document.querySelector('#modal');
  const modalBtns= modal.querySelectorAll('button');
  //création de l'ecouteur d'ev
let urlDelete='';//url de la ressource à supprimer
  btnDelete.forEach(function(btn){
    btn.addEventListener('click',function(e){
      e.preventDefault();//bloque la requête http
      //console.log(e);//pour recuperer la position clientY
      //analyse de la position du top
      let topPositionY= e.clientY;
      //pour le deplacement du modal
      modal.style.top= topPositionY + 'px';

      //mémorisation de l'url premettant la suppression
      urlDelete=e.target.href;
      console.log(urlDelete);

    })
  })
  //confirmation de la suppression
  modalBtns[0].addEventListener('click',function(e){
    //redirection:requête Get sur l'url fourni
    window.location.href = urlDelete;
  })
  //annulation de la suppression
  modalBtns[1].addEventListener('click',function(e){
  modal.style.top = '-100px';
  })

})()
