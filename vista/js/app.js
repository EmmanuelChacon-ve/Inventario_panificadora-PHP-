const selectPrincipal   = document.querySelector('.select-principal select');
const selectInsumo      = document.querySelector('.insumo');
const div               = document.querySelector('.disponible');
const botones           = document.querySelectorAll('.button');
const fragmentPrincipal = document.createDocumentFragment();
const utilidad          = document.querySelector('.utilidad');
const idRegistro        = document.getElementById('id_registro');
const placeHolder = document.querySelector('.editar-form .valor-nuevo');
let insumosActuales;
let gatillo = false;
let data = [];

selectPrincipal.addEventListener('change',listenerSelect);
selectInsumo.addEventListener('change',mostrarMedida);

function listenerSelect(e){
        idRegistro.value = 0;
        if(e.target.options[0].value == 0){
            e.target.options[0].remove();
        }
        let insumos  = obtenerInsumos(e);
        crearArray(insumos,e);
        if(e.target.value != 0 ){
            mostrarMedida();
        }else{
            pintarBotones();
            div.textContent = '';
        }
}

function mostrarMedida(){
    div.textContent = '';
    if(selectInsumo.value != ''){
    let pan = selectPrincipal.options[selectPrincipal.selectedIndex].id;
    let aux = selectInsumo.options[selectInsumo.selectedIndex].id;
    obtenerIdTabla(pan,aux);
    let cantidadUtilizada;
    data[1].forEach((item) =>{
        if(item.id == pan &&  item.nombre == aux){
            cantidadUtilizada = item.cantidad;
        }
    });
    let aux2 = data[2].findIndex((item) =>{
        return item.id === aux;
    })
    const nombreInsumo = data[2][aux2];
    let nombreMedida;
    data[3].forEach((item) =>{
        if(item.id === nombreInsumo.unidad){
            nombreMedida = item.nombre;
        }
    })
    pintarMedida(nombreInsumo,nombreMedida,cantidadUtilizada);
    }else{
        pintarMedida(undefined);
    }
}

fetch('../controlador/listar.php')
.then(res => res.json())
.then(datos=> {
    data = datos[0];
    data = dividirArray();
    crearArray(data[0]);
})

function pintarMedida(nombreInsumo,nombreMedida,cantidadUtilizada){
    const p = document.createElement('p');
    if(nombreInsumo === undefined){
        const str = 'no hay insumos registrados';
        p.append(str);
        div.append(p);
        pintarBotones();
        return
    }
    const str = `${nombreInsumo.nombre} unidad de medida utilizada ${nombreMedida} 
    cantidad disponible ${nombreInsumo.disp} ${nombreMedida}
    cantidad utilizada por el pan ${cantidadUtilizada} ${nombreMedida}`;
    p.textContent = str;
    nombreMedida;
    medidaEnInput(nombreMedida);
    div.append(p);
    pintarBotones();
}

function pintarBotones(){
        botones.forEach((item) =>{
            item.style.visibility = 'visible';
        })
}

function obtenerInsumos(e){
    //sacando insumos de cada pan
    let aux = data[1];
    let panActual = e.target.value;
    let aux2 = aux.filter((item) =>{
        return item.id === panActual
    });
    aux2 = aux2.map((item)=>{
        return item.nombre;
    })
    //nombre de cada insumo
    aux = data[2];
    let insumos = aux.filter((item) =>{
        let {id,nombre} = item;
        for(i = 0;i < aux2.length;i++){
            if(id === aux2[i]){
                return nombre;
            }
        }
        
    }) ;
    return insumos;
}

function dividirArray(){
    let arrayFiltrado = [];
    for(i = 0;i<data.length;i++){
        let aux = data.splice(0,encontrarIndice()+1)
        aux.pop();
        arrayFiltrado.push(aux);
    }
    //data = arrayFiltrado;
    return arrayFiltrado;
}

function encontrarIndice(){
    let aux = data.findIndex((item) =>{
        return typeof item === 'number';
    })
    return aux;
}


function crearOption(arreglo,e,id){
    let option;
    for(i = 0;i<arreglo.length;i++){
        option = document.createElement('option');
        option.setAttribute('value',`${i+1}`);
        option.setAttribute('id',id[i]);
        option.textContent = arreglo[i];
        fragmentPrincipal.append(option);
    }
    if(e === undefined){
        selectPrincipal.append(fragmentPrincipal);
    }else if(e !== undefined){
        selectInsumo.textContent = '';
        selectInsumo.append(fragmentPrincipal);
    }
}

function crearArray(data,e){
    let id = [];
    const arreglo =  data.map((item) =>{
        id.push(item.id)
        let str = `ID ${item.id}: ${item.nombre}`;
        return str;
    })
    //destinguiendo entre panes e insumos
    //algunos panes no tiene insumos
    if(data[0] !== undefined){
        if(data[0].hasOwnProperty('disp')){
            insumosActuales = id;
        }
    }
    //-----------------------------------//
    crearOption(arreglo,e,id);
}

function obtenerIdTabla(pan,insumo)
{
    aux = [...data[1]];
    aux = aux.filter((item) =>{
        return item.id == pan && item.nombre == insumo;
    });
    idRegistro.value = aux[0].registro;
}


//editar

const botonEditar = document.querySelector('.editarButton');
const container   = document.querySelector('.editar');
botonEditar.addEventListener('click',editar);

function editar(){
    //que no sea un array vacio
    let e = selectInsumo.options[selectInsumo.selectedIndex];
    if(e !== undefined)
    {
        container.style.visibility = 'visible';
    }
}

//evitando submit para validar

const formularioEditar = document.querySelector('.editar-form');
const valorNuevo       = document.querySelector('.valor-nuevo');

formularioEditar.addEventListener('submit',conexion);

function conexion(e){
    let aux = false;
    e.preventDefault();
    const data = new FormData(formularioEditar);
    aux = validandoEdit(data); 
    data.append('id',idRegistro.value);
    let request;
    if(aux === true){
        if(window.XMLHttpRequest){
            
            request = new XMLHttpRequest();
        }else{
            request = new ActiveXObject('Microsoft.XMLHTTP');
        } 
    
        request.addEventListener('load', () =>
        {
            if(request.response){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'cantidad de insumo modificada con exito',
                    showConfirmButton: false,
                    timer: 1500
                  })
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        });
    
        request.open(
            'POST',//metodo de envio porque no acepta post
            '../controlador/edit/editarInsumo.php', //destino
            true, //si queremos que sea asincrono
            request.responseType = 'json' //tipo de elemento enviado
        );
    
        request.send(data);
    }

}

const validandoEdit = (data) =>{
    const regex = /^[0-9]*$/;
    if(selectInsumo.options[selectInsumo.selectedIndex] === undefined){
        alert('no hay insumos registrados a este pan');
        return false;
    }else if(data.get('nueva-medida') === ''){
        alert('ingrese una nueva medida');
        valorNuevo.focus();
        return false;
    }else if(!regex.test(data.get('nueva-medida'))){
        alert('ingrese solo numeros');
        valorNuevo.focus();
        return false;
    }else if(data.get('nueva-medida') == 0){
        alert('ingrese un numero mayor a cero si no borre el insumo');
        valorNuevo.focus;
        return false;
    }else{
        return true;
    }
}


const medidaEnInput = (tipoInsumo) =>{
    placeHolder.placeholder = `cantidad en ${tipoInsumo}`;
};





