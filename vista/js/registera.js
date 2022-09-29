// const formulario = document.querySelector(".formulario");
// const alerta     = document.querySelector(".alert");
// formulario.addEventListener("submit",validacion);

// // function validacion(e){
// //     e.preventDefault();
// //     gatillo = false;
// //     let data = new FormData(formulario);
// //     if(camposVacios(data) === true){
// //         soloLetras(data.get("nombre"),e);
// //         soloLetras(data.get("apellido"),e);
// //         validarPassword(data.get("password"));
// //         igualdad(data);
// //     }
// //     if(gatillo === false){
// //     alerta.style.visibility = "hidden";
// //     Swal.fire(
// //     'Excelente!',
// //     'te has registro con exito!',
// //     'success'
// // )
// //     const xhr = new XMLHttpRequest();
// //     xhr.open("POST", "coneccion.php", true);
// //     xhr.send(data);
// //     }
// // };

// const mensaje = (error) =>{
//     gatillo = true;
//     const mensaje = alerta.querySelector(".mensaje");
//     mensaje.classList.add("error");
//     mensaje.textContent = error;
//     alerta.style.visibility = "visible";
// }

// const soloLetras = (nombre,e)=>{
//     const regex  = /^[A-Z]+$/i;
//     if(!regex.test(nombre))
//     {
//         mensaje("por favor ingrese solo letras en los campos de nombre y apellido");
//         e.target.focus();
//     }
// }

// const camposVacios = (data) =>{
//     for(const item of data.values()){
//         if(item === ""){
//             mensaje("por favor rellene todos los campos");
//             return false
//         }
//     }
//     return true
// }

// const validarPassword = (contra)=>{
//     // explicacion del regex https://www.revivemyvote.com/preguntas-javascript/regex-para-la-contrasena-debe-contener-al-menos-ocho-caracteres-al-menos-un-numero-y-letras-mayusculas-y-minusculas-y-caracteres-especiales/
//     const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/
//     if(!regex.test(contra)){
//         mensaje("la contraseña debe tener ocho caracteres, incluida una letra mayúscula, un carácter especial y caracteres alfanuméricos");
//     }
// }

// const igualdad = (data)=>{
//     const contra = data.get("password");
//     const confirmacion = data.get("confirm-password");
//     if(contra !== confirmacion)
//     {
//         mensaje("la contraseña no concuerda");
//     }
// }


// function validacion(event){
//     event.preventDefault();
//     let aux = false;
//     console.log(false);
//     // const data = new FormData(formulario);
//     // aux = camposVacios(data);
//     // console.log(aux);
//     // let request;

//     // if(window.XMLHttpRequest){
        
//     //     request = new XMLHttpRequest();
//     // }else{
//     //     request = new ActiveXObject('Microsoft.XMLHTTP');
//     // } 

//     // request.addEventListener('load', () =>
//     // {
//     //     console.log(request.response);
//     // });

//     // request.open(
//     //     'POST',//metodo de envio porque no acepta post
//     //     './insert.php', //destino
//     //     true, //si queremos que sea asincrono
//     //     request.responseType = 'json' //tipo de elemento enviado
//     // );

//     // request.send(data);

// }

function campoVacio(value){
    if(value == ''){
        Swal.fire({
            icon: 'error',
            title: 'Oops.. Llena los espacios en blanco',
            text: 'Espacio Vacio!',
            footer: ''
          })
    }else{
        return value.toUpperCase();
    }
}

const validarPassword = (contra,e)=>{
    // explicacion del regex https://www.revivemyvote.com/preguntas-javascript/regex-para-la-contrasena-debe-contener-al-menos-ocho-caracteres-al-menos-un-numero-y-letras-mayusculas-y-minusculas-y-caracteres-especiales/
    const regex = /^(?=[^A-Z\s]*[A-Z])(?=[^a-z\s]*[a-z])(?=[^\d\s]*\d)(?=\w*[\W_])\S{8,}$/;
    if(!regex.test(contra)){
        Swal.fire({
            icon: 'error',
            title: 'Oops.. Llena los espacios en blanco',
            text: 'la contraseña debe tener ocho caracteres, incluida una letra mayúscula, un carácter especial y caracteres alfanuméricos',
            footer: ''
          })
          e.value = '';
    }
}