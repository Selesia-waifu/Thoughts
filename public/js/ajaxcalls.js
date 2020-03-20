function like(id) {
    var Ruta = "/likes";
    $.ajax({
        type: 'POST',
        url: Ruta,
        data: ({ 'id': id }),
        async: true,
        dataType: 'json',
        success: function(data) {
            window.location.href = window.location.href;
        }
    });

}

function quitarlike(id) {
    var Ruta = "/quitarlike";
    $.ajax({
        type: 'POST',
        url: Ruta,
        data: ({ 'id': id }),
        async: true,
        dataType: 'json',
        success: function(data) {
            window.location.href = window.location.href;
        }
    });
}

function eliminar(id) {
    var Ruta = "/eliminar";
    $.ajax({
        type: 'POST',
        url: Ruta,
        data: ({ 'id': id }),
        async: true,
        dataType: 'json',
        success: function(data) {
            window.location.href = "/mostrar";
        }
    });
}