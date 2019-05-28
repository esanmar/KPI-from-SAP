
$.get('http://aerometalls.com/ttss/data.csv', function(data) {
  // Split the lines
  var lines = data.split('\n');
  var data = [];

  // Iterate over the lines and add categories or series
  $.each(lines, function(lineNo, line) {
    var items = line.split(', ');
    data.push([
    	lineNo,
      items[0],
      getTimeStamp(items[1]),
      getTimeStamp(items[2])
    ]);
  });

  // Create the chart
  Highcharts.chart('container', {
  	chart: {
    	inverted: true
    },
    yAxis: {
    	type: 'datetime'
    },
    tooltip: {
    	pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.high:%b %e, %H:%M} - {point.low:%b %e, %H:%M}</b><br/>'
    },
    series: [{
    	type: 'columnrange',
      data: data,
      keys: ['x','name','low','high']
    }]
  });
});

function getTimeStamp(rawData) {
  var date = rawData.split(/[/ :]/);
	return Date.UTC(date[2],date[1],date[0],date[3],date[4]);
}