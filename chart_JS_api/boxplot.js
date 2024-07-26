function getBoxplot(duration, typology, spaceType, sensorID, pollutants, post_url){
    console.log("function called lol" + duration + typology + spaceType +  sensorID + pollutants);
    $.ajax({
        url: post_url, // URL of the PHP file
        type: 'POST', // Use POST method
        //contentType: 'application/json',
        data: { 
            duration: duration,
            typology: typology,
            spaceType: spaceType,
            sensorID: sensorID,
            pollutants: pollutants
            }, // Data to send in the request
        success: function(response) {
            // Handle the successful response
            //alert(response);
            console.log(response);
            var result = JSON.parse(response);
            if(result.ApiResponse=="Success"){
                indoordata = result.Data;
                updateBoxChart(indoordata, pollutants);
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

function updateBoxChart(chart_data, pollutants){
    
    label="";
    unit = "";
    if (pollutants == "pm25"){
        label = "PM 2.5:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
      }
      if (pollutants == "pm10"){
        label = "PM 10:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
    
      }
      if (pollutants == "aqi"){
        label = "AQI:";
        unit = ""
      }
      if (pollutants == "co2"){
        label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
        unit = "(ppm)";
      }
      if (pollutants == "voc"){
        label = "TVOC:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
    
      }
      maybeDisposeRoot("boxchart1");
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("boxchart1");
        
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
        
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(
          am5xy.XYChart.new(root, {
            focusable: true,
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX"
          })
        );
        
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(
          am5xy.DateAxis.new(root, {
            baseInterval: { timeUnit: "minute", count: 15 },
            renderer: am5xy.AxisRendererX.new(root, {
              pan: "zoom",
              minorGridEnabled: true,
              minGridDistance: 70
            }),
            tooltip: am5.Tooltip.new(root, {})
          })
        );
        
        var yAxis = chart.yAxes.push(
          am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {
              pan: "zoom"
            })
          })
        );
        
        yAxis.children.moveValue(am5.Label.new(root, {
            text: label.substring(0, label.length - 1) + ' ' + unit,
            textAlign: 'center',
            y: am5.p50,
              rotation: -90,
            fontWeight: 'bold'
          }),0);
        var color = root.interfaceColors.get("background");
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(
          am5xy.CandlestickSeries.new(root, {
            // fill: am5.color("#023170"),
            // stroke: am5.color("#023170"),
            name: "Indoor",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "Q1",
            openValueYField: "Q3",
            lowValueYField: "min_reading",
            highValueYField: "max_reading",
            valueXField: "date_time1",
            tooltip: am5.Tooltip.new(root, {
              pointerOrientation: "horizontal",
              labelText: "Q3: {openValueY}\nMin: {lowValueY}\nMax: {highValueY}\nQ1: {valueY},\nmedian: {median}"
            })
          })
        );
        //https://www.amcharts.com/docs/v5/charts/xy-chart/series/candlestick-series/
        //set color of chart
        series.columns.template.states.create("riseFromOpen", {
            fill: am5.color("#2fb996"),
            stroke: am5.color("#2fb996")
          });
          
          series.columns.template.states.create("dropFromOpen", {
            fill: am5.color("#2fb996"),
            stroke: am5.color("#2fb996")
          });
        
        // mediana series
        var medianaSeries = chart.series.push(
          am5xy.StepLineSeries.new(root, {
            stroke: root.interfaceColors.get("background"),
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "median",
            valueXField: "date_time1",
            noRisers: true
          })
        );
              // color changes
                        series.columns.template.adapter.add("fill", function(fill, target) {
                          var dataItem = target.dataItem;
                          if (dataItem.valueY > dataItem.median) {
                              return am5.color("#FF0000"); // Above median color (red for example)
                          } else {
                              return am5.color("#0000FF"); // Below or equal median color (blue for example)
                          }
                      });
        
        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
          xAxis: xAxis
        }));
        cursor.lineY.set("visible", false);


        // Function to convert string numbers to actual numbers
        function convertToNumbers(data) {
        return data.map(item => {
          return {
            date_time1: item.date_time1,
            min_reading: parseFloat(item.min_reading),
            max_reading: parseFloat(item.max_reading),
            Q1: parseFloat(item.Q1),
            median: parseFloat(item.median),
            Q3: parseFloat(item.Q3)
          };
        });
      }
  
      // Process the raw data
      let processedData = convertToNumbers(chart_data);
        var data = processedData
        
        
        
        series.data.processor = am5.DataProcessor.new(root, {
          dateFields: ["date_time1"],
          dateFormat: "yyyy-MM-dd hh:mm"
        });
        
        series.data.setAll(data);
        medianaSeries.data.setAll(data);

        
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000, 100);
        medianaSeries.appear(1000, 100);
        chart.appear(1000, 100);
        
        }); // end am5.ready()


}