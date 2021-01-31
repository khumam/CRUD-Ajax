<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>GAUGE</title>
</head>

<body>
    <h1 class="mt-5 text-center">GAUGE JS</h1>

    <div class="row">
        <div class="col-6">
            <canvas id="gauge"></canvas>
            <div id="preview-textfield"></div>
        </div>
        <div class="col-6">
            <canvas id="gauge2"></canvas>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gauge.js/1.3.7/gauge.min.js"></script>
    <script>
        let opts = {
            angle: 0, // The span of the gauge arc
            lineWidth: 0.3, // The line thickness
            radiusScale: 0.79, // Relative radius
            pointer: {
                length: 0, // // Relative to gauge radius
                strokeWidth: 0.038, // The thickness
                color: '#000000' // Fill color
            },
            limitMax: true, // If false, max value increases automatically if value > maxValue
            limitMin: false, // If true, the min value of the gauge will be fixed
            colorStart: '#6FADCF', // Colors
            colorStop: '#8FC0DA', // just experiment with them
            strokeColor: '#E0E0E0', // to see which ones work best for you
            generateGradient: true,
            highDpiSupport: true, // High resolution support

            percentColors: [
                [0.0, "#30B32D"],
                [0.50, "#FFDD00"],
                [1.0, "#F03E3E"]
            ],
            staticLabels: {
                font: "10px sans-serif", // Specifies font
                labels: [0, 250, 500, 750, 1000], // Print labels at these values
                color: "#000000", // Optional: Label text color
                fractionDigits: 0 // Optional: Numerical precision. 0=round off.
            },
            // staticZones: [{
            //         strokeStyle: "#30B32D", //green
            //         min: 0,
            //         max: 500
            //     },
            //     {
            //         strokeStyle: "#FFDD00", //yellow
            //         min: 500,
            //         max: 750
            //     },
            //     {
            //         strokeStyle: "#F03E3E", //red
            //         min: 750,
            //         max: 1000
            //     },
            // ],

        };

        let target = document.querySelector('#gauge') // your canvas element

        let gaugeChart = new Gauge(target).setOptions(opts) // create sexy gauge!
        gaugeChart.maxValue = 1000 // set max gauge value
        gaugeChart.setMinValue(0) // Prefer setter over gauge.minValue = 0
        gaugeChart.animationSpeed = 32 // set animation speed (32 is default value)
        gaugeChart.set(950) // set actual value
        gaugeChart.setTextField(document.getElementById("preview-textfield"));

        let target2 = document.querySelector('#gauge2') // your canvas element

        let gaugeChart2 = new Gauge(target2).setOptions(opts) // create sexy gauge!
        gaugeChart2.maxValue = 1000 // set max gauge value
        gaugeChart2.setMinValue(0) // Prefer setter over gauge.minValue = 0
        gaugeChart2.animationSpeed = 32 // set animation speed (32 is default value)
        gaugeChart2.set(250) // set actual value
    </script>
</body>

</html>