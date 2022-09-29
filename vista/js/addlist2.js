const select = document.getElementById('id');


function validacion(value,e){
    if(espacioBlanco(value,e)){
        soloLetras(value,e);
    }
}

//funcion espacio en blanco

function espacioBlanco(valor,e){
   if(valor === ''){
       Swal.fire({
           icon: 'error',
           title: 'Hey!!',
           text: 'No pueden haber espacios en blanco!'
         })
       return false;
   }
   return true
}

function soloLetras(value,e){
   const regex = /^[a-z ]+$/i;
   if(!regex.test(value)){
       Swal.fire({
           icon: 'error',
           title: 'Hey!!',
           text: 'Solo cosas de panaderia por favor!'
         })
         e.value = "";
   }else{
       e.value = e.value.toUpperCase();
   }
}

function validacion2(value,e)
{
   soloNumeros(value,e);
   if(select.options[select.selectedIndex].value == 0){
        Swal.fire({
            icon: 'error',
            title: 'Hey!!',
            text: 'Seleccione un pan!'
          })
    e.value = '';
}
}

const soloNumeros = (value,e) =>{
   const regex = /^[0-9]+$/;
   if(espacioBlanco(value,e)){
       if(!regex.test(value)){
           Swal.fire({
               icon: 'error',
               title: 'Hey!!',
               text: 'Solo medidas de panaderia por favor!'
             })
             e.value = '';
       }else{
           e.value = Number(e.value);
       }
   }
}