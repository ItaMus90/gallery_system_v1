var App_chart = (function (){

    var _data = null;

    function _setDataChart() {

        var json_obj = document.getElementById("json_data").value;

        json_obj = JSON.parse(json_obj);

        if (_isObject(json_obj)){

            _data = [
                ['Task', 'Hours per Day'],
                ['Views',     json_obj.views],
                ['Photos',      json_obj.photos],
                ['Users',  json_obj.users],
                ['Comments', json_obj.comments]
            ];

            console.log(_data);

        } else {

            _data = false;

        }

    }

    function _isObject(obj) {

        return obj !== undefined && obj !== null && obj.constructor == Object;

    }

    function _drawChart() {

        var json_obj = document.getElementById("json_data").value;

        json_obj = JSON.parse(json_obj);

        if (!_data || _data === null)
            return false;

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Views',     json_obj.views],
            ['Comments', parseInt(json_obj.comments)],
            ['Users',  parseInt(json_obj.users)],
            ['Photos', parseInt(json_obj.photos)]
        ]);



        var options = {
            legend: 'none',
            pieSliceText: 'label',
            backgroundColor: 'transparent',
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }


    return {

        setDataChart : _setDataChart,
        drawChart : _drawChart

    }

}());
App_chart.setDataChart();
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(App_chart.drawChart);


