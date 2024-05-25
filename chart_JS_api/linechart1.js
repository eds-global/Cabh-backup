function getLinechart1(duration, typology, nearByStation, pollutants, post_url){
    console.log("function called " + duration + typology + nearByStation + pollutants);
    $.ajax({
        url: post_url, // URL of the PHP file
        type: 'POST', // Use POST method
        //contentType: 'application/json',
        data: { 
            duration: duration,
            typology: typology,
            location: nearByStation,
            pollutants: pollutants
            }, // Data to send in the request
        success: function(response) {
            // Handle the successful response
            //alert(response);
            var result = JSON.parse(response);
            if(result.ApiResponse=="Success"){
                indoordata = result.Data;
                updateLineChart(indoordata, pollutants);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.error('Error:', textStatus, errorThrown);
        }
    });
}

function maybeDisposeRoot(divId) {
    am5.array.each(am5.registry.rootElements, function (root) {
      if (root.dom.id == divId) {
        root.dispose();
      }
    });
  };
function updateLineChart(chart_data, pollutants){
  var label = "";
  var unit = "";
  if (pollutants == "pm25"){
    label = "PM 2.5: ";
    unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
  }
  if (pollutants == "pm10"){
    label = "PM 10: ";
    unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";

  }
  if (pollutants == "aqi"){
    label = "AQI ";
    unit = ""
  }
  if (pollutants == "co2"){
    label = "CO[fontSize:10px; verticalAlign: sub;]2[/]): ";
    unit = "(ppm)";
  }
  if (pollutants == "voc"){
    label = "TVOC: ";
    unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";

  }
  
  
    
    /**
 * ---------------------------------------
 * This demo was created using amCharts 5.
 * 
 * For more information visit:
 * https://www.amcharts.com/
 * 
 * Documentation is available at:
 * https://www.amcharts.com/docs/v5/
 * ---------------------------------------
 */

    maybeDisposeRoot("linechart1");
    
// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("linechart1");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true,
  paddingLeft: 0
}));


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "none"
}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.2,
  baseInterval: {
    timeUnit: "minute",
    count: 15
  },
  renderer: am5xy.AxisRendererX.new(root, {
    minorGridEnabled:true
  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {
    pan:"zoom"
  }) 
}));

yAxis.children.moveValue(am5.Label.new(root, {
  text: label + ' ' + unit,
  textAlign: 'center',
  y: am5.p50,
    rotation: -90,
  fontWeight: 'bold'
}),0);
// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.LineSeries.new(root, {
  name: "Indoor",
  xAxis: xAxis,
  yAxis: yAxis,
  stroke: "#023170",
  valueYField: pollutants,
  valueXField: "datetime",
  tooltip: am5.Tooltip.new(root, {
    labelText: label + "{valueY} "
  }),
  legendLabelText: "{name}",
}));


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));
// Processor needs to be set before data
series.data.processor = am5.DataProcessor.new(root, {
    numericFields: [pollutants],
    dateFields: ["datetime"],
    dateFormat: "yyyy-MM-dd HH:mm:ss"
  });

// Set data
series.data.setAll(chart_data);

// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
  width: am5.percent(100),
  /* paddingLeft: 20, */
  height: 30,
  x: am5.percent(50)
}));

// When legend item container is hovered, dim all the series except the hovered one
legend.itemContainers.template.events.on("pointerover", function(e) {
  var itemContainer = e.target;

  // As series list is data of a legend, dataContext is series
  var series = itemContainer.dataItem.dataContext;

  chart.series.each(function(chartSeries) {
    if (chartSeries != series) {
      chartSeries.strokes.template.setAll({
        strokeOpacity: 0.15,
        stroke: "#023170",
      });
    } else {
      chartSeries.strokes.template.setAll({
        strokeWidth: 3
      });
    }
  })
})

// When legend item container is unhovered, make all series as they are
legend.itemContainers.template.events.on("pointerout", function(e) {
  var itemContainer = e.target;
  var series = itemContainer.dataItem.dataContext;

  chart.series.each(function(chartSeries) {
    chartSeries.strokes.template.setAll({
      strokeOpacity: 1,
      strokeWidth: 1,
      stroke: "#023170"
    });
  });
})

legend.itemContainers.template.set("width", am5.p100);
legend.valueLabels.template.setAll({
  width: am5.p100,
  textAlign: "right"
});

// It's is important to set legend data after all the events are set on template, otherwise events won't be copied
legend.data.setAll(chart.series.values);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);
}