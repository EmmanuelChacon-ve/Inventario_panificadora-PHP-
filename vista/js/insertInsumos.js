//variables globales
const fragmentPrincipal = document.createDocumentFragment();
const selectPrincipal   = document.querySelector('.select-principal select');
const insumoAgregar     = document.querySelector('.insumosAgregar');
const medida            = document.querySelector('.medida #medida');
const idMedidaPHP          = document.getElementById('id-medida');
let insumosNuevos;

selectPrincipal.addEventListener('change',nuevosInsumos);
insumoAgregar.addEventListener('change',obtenerMedida)
function nuevosInsumos(e){
        if(e.target.options[0].value == 0){
            e.target.options[0].remove();
        }
        let insumos = obtenerInsumos(e);
        agregarInsumo(insumos,e);
        obtenerMedida();
}

//obteniendo datos
fetch('../controlador/listar.php')
.then(res => res.json())
.then(datos=> {
    data = datos[0];
    data = dividirArray();
    crearArray(data[0]);
});

//dividiendo datos obtenidos
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

function crearArray(data,e){
    let id = [];
    const arreglo =  data.map((item) =>{
        id.push(item.id)
        let str = `ID ${item.id}: ${item.nombre}`;
        return str;
    })
    //destinguiendo entre panes e insumos
    //algunos panes no tiene insumos
    //-----------------------------------//
    crearOption(arreglo,e,id);
}

function crearOption(arreglo,e,id){
    let option;
    for(i = 0;i<arreglo.length;i++){
        option = document.createElement('option');
        option.setAttribute('value',`${id[i]}`);
        option.setAttribute('id',id[i]);
        option.textContent = arreglo[i];
        fragmentPrincipal.append(option);
    }
    if(e === undefined){
        selectPrincipal.append(fragmentPrincipal);
    }else if(e !== undefined){
        insumoAgregar.textContent = '';
        insumoAgregar.append(fragmentPrincipal);
    }
}

function encontrarIndice(){
    let aux = data.findIndex((item) =>{
        return typeof item === 'number';
    })
    return aux;
}


//encontrando insumos que el pan usa
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
///

function agregarInsumo(insumosActuales,e){
    //creando copia con el spread operator
    let aux = [...data[2]];
    let aux2;
    //eliminando los insumos repetidos 1 por 1
    for(let insumo of insumosActuales){
        aux2 = aux.findIndex((item)=>{
            return item.id == insumo.id;
        });
        //eliminando repetidos
        aux.splice(aux2,1)
    }
    insumosNuevos = aux;
    crearArray(aux,e);
}

//mostrando medida usada en ese insumo

function obtenerMedida(){
    //valor actual del insumo
    const idMedida = insumoAgregar.options[insumoAgregar.selectedIndex].id;
    data[3].forEach((item) =>{
        if(item.id == idMedida){
            const str = `cantidad en ${item.nombre}`;
            medida.placeholder = str;
            idMedidaPHP.value = item.id;
        }
    })
}

//validando campo

function soloNumeros(value)
{
    const regex = /^[0-9]+$/;
    if(!regex.test(value)){
        alert("ingrese solo numeros");
        return focus();
    }
}

