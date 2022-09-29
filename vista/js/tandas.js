const selectPrincipal = document.getElementById('id');
const fragmentPrincipal = document.createDocumentFragment();

selectPrincipal.addEventListener('change',(e) =>{
    if(e.target.options[0].value == 0){
        e.target.options[0].remove();
    }
})

fetch('../../controlador/listar.php')
.then(res => res.json())
.then(datos=> {
    data = datos[0];
    data = dividirArray();
    crearArray(data[0]);
});

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

function crearArray(data,e){
    let id = [];
    const arreglo =  data.map((item) =>{
        id.push(item.id)
        let str = `ID ${item.id}: ${item.nombre}`;
        return str;
    })
    crearOption(arreglo,e,id);
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


