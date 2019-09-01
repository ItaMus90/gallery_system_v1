var App_chart = (function (){


    function _drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }


    return {

        drawChart : _drawChart

    }

}());
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(App_chart.drawChart);
