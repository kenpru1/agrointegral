$(document).ready(function() {

    // Add body-small class if window less than 768px
    if ($(this).width() < 769) {
        $('body').addClass('body-small')
    } else {
        $('body').removeClass('body-small')
    }

    // MetisMenu
    $('#side-menu').metisMenu();
    // Collapse ibox function
    $('.collapse-link').on('click', function() {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.children('.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function() {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').on('click', function() {
        var content = $(this).closest('div.ibox');
        content.remove();
    });
    // Fullscreen ibox function
    $('.fullscreen-link').on('click', function() {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        $('body').toggleClass('fullscreen-ibox-mode');
        button.toggleClass('fa-expand').toggleClass('fa-compress');
        ibox.toggleClass('fullscreen');
        setTimeout(function() {
            $(window).trigger('resize');
        }, 100);
    });

    // Close menu in canvas mode
    $('.close-canvas-menu').on('click', function() {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // Run menu of canvas
    $('body.canvas-menu .sidebar-collapse').slimScroll({
        height: '100%',
        railOpacity: 0.9
    });
    // Open close right sidebar
    $('.right-sidebar-toggle').on('click', function() {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // Initialize slimscroll for right sidebar
    $('.sidebar-container').slimScroll({
        height: '100%',
        railOpacity: 0.4,
        wheelStep: 10
    });

    // Open close small chat
    $('.open-small-chat').on('click', function() {
        $(this).children().toggleClass('fa-comments').toggleClass('fa-remove');
        $('.small-chat-box').toggleClass('active');
    });
    // Initialize slimscroll for small chat
    $('.small-chat-box .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });
    // Minimalize menu

    $('.navbar-minimalize').on('click', function() {

        $("nav").toggleClass("mini-navbar");
    });
    var data1 = [
        [0, 4],
        [1, 8],
        [2, 5],
        [3, 10],
        [4, 4],
        [5, 16],
        [6, 5],
        [7, 11],
        [8, 6],
        [9, 11],
        [10, 30],
        [11, 10],
        [12, 13],
        [13, 4],
        [14, 3],
        [15, 3],
        [16, 6]
    ];
    var data2 = [
        [0, 1],
        [1, 0],
        [2, 2],
        [3, 0],
        [4, 1],
        [5, 3],
        [6, 1],
        [7, 5],
        [8, 2],
        [9, 3],
        [10, 2],
        [11, 1],
        [12, 0],
        [13, 2],
        [14, 8],
        [15, 0],
        [16, 0]
    ];
    $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
        data1, data2
    ], {
        series: {
            lines: {
                show: false,
                fill: true
            },
            splines: {
                show: true,
                tension: 0.4,
                lineWidth: 1,
                fill: 0.4
            },
            points: {
                radius: 0,
                show: true
            },
            shadowSize: 2
        },
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#d5d5d5'
        },
        colors: ["#1ab394", "#1C84C6"],
        xaxis: {},
        yaxis: {
            ticks: 4
        },
        tooltip: false
    });
    var doughnutData = {
        labels: ["App", "Software", "Laptop"],
        datasets: [{
            data: [300, 50, 100],
            backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
        }]
    };
    var doughnutOptions = {
        responsive: false,
        legend: {
            display: false
        }
    };
    /* var ctx4 = document.getElementById("doughnutChart").getContext("2d");
     new Chart(ctx4, {
         type: 'doughnut',
         data: doughnutData,
         options: doughnutOptions
     });
     var doughnutData = {
         labels: ["App", "Software", "Laptop"],
         datasets: [{
             data: [70, 27, 85],
             backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
         }]
     };
     var doughnutOptions = {
         responsive: false,
         legend: {
             display: false
         }
     };
     var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
     new Chart(ctx4, {
         type: 'doughnut',
         data: doughnutData,
         options: doughnutOptions
     });*/
});
$(document).ready(function() {
    $('.dataTables').DataTable({
        pageLength: 25,
        responsive: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            buttons: {
                copyTitle: 'Copiando a la memoria',
                copyKeys: 'presione <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> para copiar. <br><br>.',
                copySuccess: {
                    _: '%d lineas copiadas',
                    1: '1 linea copiada'
                }
            }

        },
        "aaSorting": [
            [0, "desc"]
        ],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
            extend: 'copy', text:'Copiar'
        }, {
            extend: 'csv'
        }, {
            extend: 'excel',
        }, {
            extend: 'pdf',
        }, {
            extend: 'print',text:'Imprimir',
            customize: function(win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
            }
        }]
    });
});