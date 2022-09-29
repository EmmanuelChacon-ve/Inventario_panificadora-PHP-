const selectPrincipal   = document.querySelector('.select-principal select');
const selectInsumo      = document.querySelector('.insumo');
const div               = document.querySelector('.disponible');
const fragmentPrincipal = document.createDocumentFragment();
let data = [];

selectPrincipal.addEventListener('change',listenerSelect);
selectInsumo.addEventListener('change',mostrarMedida);

function listenerSelect(e){
    let insumos  = obtenerInsumos(e);
    crearArray(insumos,e);
    mostrarMedida();
}

function mostrarMedida(){
    div.textContent = '';
    if(selectInsumo.value != ''){
    let aux = selectInsumo.options[selectInsumo.selectedIndex].id;
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
    pintarMedida(nombreInsumo,nombreMedida);
    }
}

fetch('../controlador/listar.php')
.then(res => res.json())
.then(datos=> {
    data = datos[0];
    data = dividirArray();
    crearArray(data[0]);
})

function pintarMedida(nombreInsumo,nombreMedida){
    const str = `${nombreInsumo.nombre} unidad de medida utilizada ${nombreMedida} cantidad disponible ${nombreInsumo.disp}`;
    const p = document.createElement('p');
    p.textContent = str;
    div.append(p);
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
    crearOption(arreglo,e,id);
}