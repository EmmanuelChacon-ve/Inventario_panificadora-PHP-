const select = document.getElementById('id_unidad');
const minima = document.getElementById('minima');
const maxima = document.getElementById('maxima');
const dispo  = document.getElementById('disponible');

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





dispo.addEventListener('blur',(e) =>{
    let max = Number(maxima.value);
    let min = Number(minima.value);
    let actual = Number(e.target.value);
    if(actual > max || actual < min){
        Swal.fire({
            title: 'La cantidad disponible tiene que ser entre los campos anteriores',
            width: 600,
            padding: '3em',
            color: '#716add',
          })
          e.target.value = '';
    }
})

minima.addEventListener('blur',(e) =>{
    if(espacioBlanco(maxima.value.e)){
        if(Number(minima.value) > Number(e.target.value))
    {
        Swal.fire({
            title: 'Existencia minima no puede ser mayor a existencia maxima',
            width: 600,
            padding: '3em',
            color: '#716add',
          })
          minima.value = '';
    }
    }
})

maxima.addEventListener('blur',(e) =>{
    if(espacioBlanco(maxima.value.e)){
        if(Number(minima.value) > Number(e.target.value))
    {
        Swal.fire({
            title: 'Existencia minima no puede ser mayor a existencia maxima',
            width: 600,
            padding: '3em',
            color: '#716add',
          })
          maxima.value = '';
    }
    }
    
})
