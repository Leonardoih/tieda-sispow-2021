// VALIDAR FORMULARIOS
// validar que solo se digiten numeros
function validaNumeros(event) {
    if (event.charCode >= 48 && event.charCode <= 57) {
        return true;
    }
    return false;
}


// validar que solo digiten letras 
function validarTexto() {
    const input = document.getElementById('campo');
    if (!input.checkValidity()) {
        alert('El campo no es válido.');
    } else {
        alert('El campo es válido.');
    }
}

//DETALLE FACTURA
function selDetalle(id, producto, precio, cantidad, subtotal, total) {
    $('#id').val(id);
    $('#producto').val(producto);
    $('#precio').val(precio);
    $('#cantidad').val(cantidad);
    $('#subtotal').val(subtotal);
    $('#total').val(total);
}



// PERSONAS - CLIENTES
// funcion para selecionar la persona o el cliente y cargar los datos en el modal
function seleccionar(cod, nombres, apellidos, num_doc, correo, celular, direccion, estado) {
    $('#cod').val(cod);
    $('#nombres').val(nombres);
    $('#apellidos').val(apellidos);
    $('#num_doc').val(num_doc);
    $('#correo').val(correo);
    $('#celular').val(celular);
    $('#direccion').val(direccion);
    $('#estado').val(estado);
}

function seleccionarproducto(id_producto, nombre, precio, categoria, imagen, marca, stock, existencia) {
    $('#Id').val(id_producto);
    $('#nombre').val(nombre);
    $('#precio').val(precio);
    $('#categoria').val(categoria);
    $('#imagen').val(imagen);
    $('#marca').val(marca);
    $('#stock').val(stock);
    $('#existencia').val(existencia);
}

//funcion para enviar los datos del formulario modal devuelta 
function onEnviar() {
    //declarar variables de js y pasarle la informacion q traemos de los input
    var cod = document.getElementById("cod").value;
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var num_doc = document.getElementById("num_doc").value;
    var correo = document.getElementById("correo").value;
    var celular = document.getElementById("celular").value;
    var direccion = document.getElementById("direccion").value;
    var estado = document.getElementById("estado").value;
    var accion = document.getElementById("accion").value;
    var usuario = document.getElementById("usuario").value;
    var clave = document.getElementById("clave").value;


    // mandamos las variables por metodo post
    document.getElementById("cod").value = cod;
    document.getElementById("nombres").value = nombres;
    document.getElementById("apellidos").value = apellidos;
    document.getElementById("num_doc").value = num_doc;
    document.getElementById("correo").value = correo;
    document.getElementById("celular").value = celular;
    document.getElementById("direccion").value = direccion;
    document.getElementById("estado").value = estado;
    document.getElementById("accion").value = accion;
    document.getElementById("usuario").value = usuario;
    document.getElementById("clave").value = clave;
}

function onEnviar2() {
    //declarar variables de js y pasarle la informacion q traemos de los input
    var id = document.getElementById("Id").value;
    var nombre = document.getElementById("nombre").value;
    var precio = document.getElementById("precio").value;
    var categoria = document.getElementById("categoria").value;
    var imagen = document.getElementById("imagen").value;
    var marca = document.getElementById("marca").value;
    var stock = document.getElementById("stock").value;
    var existencia = document.getElementById("existencia").value;
    var accion = document.getElementById("accion").value;

    // mandamos las variables por metodo post
    document.getElementById("Id").value = id;
    document.getElementById("nombre").value = nombre;
    document.getElementById("precio").value = precio;
    document.getElementById("categoria").value = categoria;
    document.getElementById("imagen").value = imagen;
    document.getElementById("marca").value = marca;
    document.getElementById("stock").value = stock;
    document.getElementById("existencia").value = existencia;
    document.getElementById("accion").value = accion;
}

function seleccionarCliente(cod_cliente,estado_cliente) {
    $('#cod_cliente').val(cod_cliente);
    $('#estado_cliente').val(estado_cliente);
}

function onEnviarEstado() {

    var id = document.getElementById("cod_cliente").value;
    var estado = document.getElementById("estado_cliente").value;

    document.getElementById("cod_cliente").value = id;
    document.getElementById("estado_cliente").value = estado;

}




