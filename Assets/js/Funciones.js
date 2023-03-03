const base = document.getElementById("url").value;
const urls = base + "Reportes/ingresar";
window.addEventListener("load", function () {
    //reportes();
    //reportesTorta();
    ListarReportes();
})
$(document).ready(function () {
    $("#procesarReporte").click(function () {
        var fila = $("#tablaReportes tr").length;
        if (fila < 2) {
            Swal.fire({
                icon: 'warning',
                title: 'No hay insumos en la documentacion',
                showConfirmButton: false,
                timer: 2500
            })
        } else {
            const total = {
                totalp: $("#total").val()
            }

            $.ajax({
                url: base + "Reportes/registrar",
                type: 'POST',
                data: total,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'reporte Generado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    ListarReportes();
                }
            })
        }
    });
    $("#procesarReporte").click(function () {
        var fila = $("#tablaReportes tr").length;
        var promotor = $("#clave_promotor").val();
        if (fila < 2) {
            Swal.fire({
                icon: 'warning',
                title: 'No hay insumos en la documentacion',
                showConfirmButton: false,
                timer: 2500
            })
        } else {
            const total = {
                promotor: $("#clave_promotor").val(),
                totalP: $("#total").val()
            }
            $.ajax({
                url: base + "documentacion/registrar",
                type: 'POST',
                data: total,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'documentacion Generada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    ListarReportes();
                }
            })
        }
    });
    $("#AnularReporte").click(function () {
        Swal.fire({
            title: 'Esta seguro que desea anular?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base + "Reportes/anular",
                    type: 'POST',
                    success: function (response) {
                        ListarReportes();
                        if (response != "error") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Anulado',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });
    $(document).on("click", ".eliminar", function () {
        var id = $(this).data("id");
        $.ajax({
            url: base + "reportes/eliminar",
            type: 'POST',
            data: {
                id
            },
            success: function (response) {
                ListarReportes();
                if (response != "error") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    });
    $(".elim").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $(".confirmar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de Reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    $("#cambiar").click(function () {
        let claves = {
            actual: $("#actual").val(),
            nueva: $("#nueva").val()
        }
        $.ajax({
            url: base + "Usuarios/cambiar",
            type: "POST",
            data: {
                claves
            },
            success: function (response) {
                console.log(response);
                if (response == 1) {
                        $("#errorPass").html(`<div class="alert alert-primary" role="alert">
                                <strong>Contraseña Modificada con exito</strong>
                            </div>`);
                } else {
                    $("#errorPass").html(`<div class="alert alert-danger" role="alert">
                                <strong>Contraseña incorecta</strong>
                            </div>`);
                }
            }
        });
    });
});

function BuscarCodigo(e) {
    if (e.which == 13) {
        const codigo = document.getElementById("buscar_codigo").value;
        const url = document.getElementById("url").value;
        const urls = url + "Reportes/buscar";
        $.ajax({
            url: urls,
            type: 'POST',
            data: {
                codigo
            },
            success: function (response) {
                if (response != 0) {
                    $("#error").addClass('d-none');
                    var info = JSON.parse(response);
                    document.getElementById("id").value = info.id;
                    document.getElementById("clave_promotor").value = info.clave_promotor;
                    document.getElementById("objeto").value = info.objeto;
                    $("#stockD").val(info.cantidad);
                    document.getElementById("cantidad").value = 1;
                    document.getElementById("objetoI").innerHTML = info.objeto;
                    document.getElementById("cantidad").focus();
                } else {
                    $("#error").removeClass('d-none');
                }
            }
        });
    }
}

function IngresarCantidad(e) {
    const stockD = $("#stockD").val();
    const cantidad = document.getElementById("cantidad").value;
    if (e.which == 13) {
        if (stockD == "") {
            $('#frmReportes').trigger("reset");
            $("#buscar_codigo").focus();
            document.getElementById("objetoI").innerHTML = "";
            Swal.fire({
                icon: 'warning',
                title: 'Ingrese la cantidad',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            $.ajax({
                url: urls,
                type: 'POST',
                async: true,
                data: $("#frmReportes").serialize(),
                success: function (response) {
                    $('#frmReportes').trigger("reset");
                    $("#buscar_codigo").focus();
                    $("#objetoI").html("");
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se actualizo la cantidad del objeto',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        ListarReportes();
                    } else {
                        ListarReportes();
                    }
                }
            });
        }
    }
}

function BuscarPromotor(e) {
    const clav = $("#clave_promotor").val();
    if (e.which == 13) {
        $.ajax({
            url: base + "promotores/buscar",
            type: "POST",
            data: {
                clav
            },
            success: function (response) {
                var info = JSON.parse(response);
                $("#clave_promotor").val(info.id);
                $("#nom_prom").html(info.nombre);
                $("#dir_prom").html(info.direccion);
                $("#tel_prom").html(info.telefono);
            }
        });
    }
}

function ListarReportes() {
    $.ajax({
        url: base + "Reportes/reportes",
        type: 'POST',
        success: function (response) {
            $("#ListarReportes").html(response);
            const tl = $("#totalPagar").val();
            $("#total").val(tl);
            $("#tDocumentacion").html(tl);
            $("#totalD").html(tl);
        }
    });
}
// chart Barra

function reportes() {
    $.ajax({
        url: base + "Admin/reportes",
        type: 'POST',
        success: function (response) {
            var data = JSON.parse(response);
            var cantidad = [];
            for (var i = 0; i < data.length; i++) {
                objeto.push(data[i]['objeto']);
                cantidad.push(data[i]['cantidad']);
            }
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: objeto,
                    datasets: [{
                        label: "Stock",
                        data: cantidad,
                        backgroundColor: [
                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
                        ],
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 20,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    })
}
// chart torta
function reportesTorta() {
    $.ajax({
        url: base + "Admin/reportesTorta",
        type: 'POST',
        success: function (response) {
            var data = JSON.parse(response);
            var clave_promotor = [];
            var objeto = [];
            var total = [];
            for (var i = 0; i < data.length; i++) {
                clave_promotor.push(data[i]['clave_promotor']);
                objeto.push(data[i]['objeto']);
                total.push(data[i]['total']);
            }
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: objeto,
                    datasets: [{
                        data: total,
                        backgroundColor: [
                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
                        ]
                    }],
                },
            });
        }
    })
}