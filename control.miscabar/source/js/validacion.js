const formulario = document.getElementById('form-Producto');
const inputs = document.querySelectorAll('#form-Producto input' );

const expresiones ={
codigo: /^[A-za-z0-9]{1,20}$/,
descripcion: /^[A-za-z0-9 -]{1,300}$/,
decimal: /^\d+(\.\d{1,2})?$/
}

const validarCampo =(expresion, input)=>{
    if(expresion.test(input.value)){
        return true;
    }else{
      alert ("EL Dato Ingresado No es Valido");
        return false;
    }
} 
const ValidarInputs = (e) => {
    switch(e.target.name){
        case 'ipt_Codigo':
        validarCampo(expresiones.codigo, e.target);
            break;
        case 'ipt_Descripcion':
            validarCampo(expresiones.descripcion, e.target);
            break;
        case 'ipt_Costo':
            validarCampo(expresiones.decimal, e.target);
            break;
        case 'ipt_porcentaje':
            validarCampo(expresiones.decimal, e.target);
            break;
        case 'ipt_venta':
            validarCampo(expresiones.decimal, e.target);
            break;
        case 'ipt_Mayoreo':
            validarCampo(expresiones.descripcion, e.target);
            break;
        case 'ipt_departamento':
            validarCampo(expresiones.descripcion, e.target);
            break;
        case 'ipt_proveedor':
            validarCampo(expresiones.descripcion, e.target);
            break;
        case 'ipt_marca':
            break;
    }
}

inputs.forEach(input => {
    input.addEventListener('keyup', ValidarInputs);
    input.addEventListener('blur', ValidarInputs);
});


function Cancelar(){
    
    document.getElementById('ipt_Codigo').value ="";
    document.getElementById('ipt_Descripcion').value ="";
    document.getElementById('ipt_Costo').value =0.00;
    document.getElementById('ipt_venta').value =0.00;
    document.getElementById('ipt_porcentaje').value =20.00;
    document.getElementById('ipt_Mayoreo').value = 0.00;
    document.getElementById('ipt_departamento').value = "Sin Departamento";
    document.getElementById('ipt_proveedor').value ="Sin Proveedor";
    document.getElementById('ipt_marca').value ="Sin Marca";
}

formulario.addEventListener('submit', e=>{
    ValidarInputs;
    e.document.action;
    e.preventDefault();
});

const CalculoPrecio = document.getElementById('ipt_porcentaje');
CalculoPrecio.addEventListener("change", e=>{
    numero = 1 - (document.getElementById('ipt_porcentaje').value/100);
    document.getElementById('ipt_venta').value = document.getElementById('ipt_Costo').value/numero;
});
const CalculoPrecio2 = document.getElementById('ipt_Costo');
CalculoPrecio2.addEventListener('change', e=>{
    numero = 1 - (document.getElementById('ipt_porcentaje').value/100);
    document.getElementById('ipt_venta').value = document.getElementById('ipt_Costo').value/numero;

});

function ValidarRadios(action){
    // obtenemos todos los input radio del grupo presentacion que esten chequeados
    // si no hay ninguno lanzamos alerta
    if(!document.querySelector('input[name="presentacion"]:checked')) {
      alert('Error, rellena el campo presentacion');
      }

    //action.submit();
}

const formTabla = document.getElementById("formTablaProductos"); 
formTabla.addEventListener('submit',e=>{
    e.action;
});

function enviarCodigo(action){
    action.submit();
}


