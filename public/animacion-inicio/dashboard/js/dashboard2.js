(
    function ($) {
        "use strict";

        // Reemplazar los datos estáticos con los datos obtenidos de PHP
        var data = {
            labels: [],
            series: []
        };

        // Agregar los datos de PHP a la variable 'data'
        datosProductos.forEach(function(producto) {
            data.labels.push(producto.label);
            data.series.push({
                value: producto.value,
                colors: ["#333", "#222", "#111"]
            });
        });
        

        var options = {
            labelInterpolationFnc: function (value) {
                return value[0]
            }
        };

        var responsiveOptions = [
            ['screen and (min-width: 640px)', {
                chartPadding: 30,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function (value) {
                    return value;
                }
            }],
            ['screen and (min-width: 1024px)', {
                labelOffset: 80,
                chartPadding: 20
            }]
        ];

        new Chartist.Pie('.ct-pie-chart', data, options, responsiveOptions);

    })(jQuery);
