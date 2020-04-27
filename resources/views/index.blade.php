<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script src="https://unpkg.com/vue"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/grid.css" />
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /** custom styles **/
        .footer,
        .push {
            height: 50px;
        }
    </style>
    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <table>
            <thead>
            <tr>
                <th v-for="key in columns"
                    @click="sortBy(key)"
                    :class="{ active: sortKey == key }">
                    {{ key | capitalize }}
                    <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
              </span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="entry in filteredHeroes">
                <td v-for="key in columns">
                    {{entry[key]}}
                </td>
            </tr>
            </tbody>
        </table>
    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div>
            <!-- The form -->
            <div class="search-form" data-action="/search">
                <input type="text" placeholder="Search.." name="search">
                <select class="selectScope" name="filter">
                    <option value="all">All</option>
                    <option value="client">Client</option>
                    <option value="product">Product</option>
                    <option value="total">Total</option>
                </select>
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>

        <div>
            <canvas id="myChart"></canvas>
        </div>

        <div>
            {{ Html::mailto($emailUrl, $emailTitle) }}
        </div>

        <hr>
        <!-- demo root element -->
        <div id="demo">
            <form id="search">
                Search <input name="query" v-model="searchQuery" />
            </form>
            <demo-grid
                :heroes="gridData"
                :columns="gridColumns"
                :filter-key="searchQuery"
            >
            </demo-grid>
        </div>

{{--        <div class="links">--}}
{{--            <a href="https://laravel.com/docs">Docs</a>--}}
{{--            <a href="https://laracasts.com">Laracasts</a>--}}
{{--            <a href="https://laravel-news.com">News</a>--}}
{{--            <a href="https://blog.laravel.com">Blog</a>--}}
{{--            <a href="https://nova.laravel.com">Nova</a>--}}
{{--            <a href="https://forge.laravel.com">Forge</a>--}}
{{--            <a href="https://vapor.laravel.com">Vapor</a>--}}
{{--            <a href="https://github.com/laravel/laravel">GitHub</a>--}}
{{--        </div>--}}
    </div>
</div>
<footer class="footer"></footer>

<script>
    // register the grid component
    Vue.component("demo-grid", {
        template: "#grid-template",
        props: {
            heroes: Array,
            columns: Array,
            filterKey: String
        },
        data: function() {
            var sortOrders = {};
            this.columns.forEach(function(key) {
                sortOrders[key] = 1;
            });
            return {
                sortKey: "",
                sortOrders: sortOrders
            };
        },
        computed: {
            filteredHeroes: function() {
                var sortKey = this.sortKey;
                var filterKey = this.filterKey && this.filterKey.toLowerCase();
                var order = this.sortOrders[sortKey] || 1;
                var heroes = this.heroes;
                if (filterKey) {
                    heroes = heroes.filter(function(row) {
                        return Object.keys(row).some(function(key) {
                            return (
                                String(row[key])
                                    .toLowerCase()
                                    .indexOf(filterKey) > -1
                            );
                        });
                    });
                }
                if (sortKey) {
                    heroes = heroes.slice().sort(function(a, b) {
                        a = a[sortKey];
                        b = b[sortKey];
                        return (a === b ? 0 : a > b ? 1 : -1) * order;
                    });
                }
                return heroes;
            }
        },
        filters: {
            capitalize: function(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }
        },
        methods: {
            sortBy: function(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
            }
        }
    });

    // bootstrap the demo
    var demo = new Vue({
        el: "#demo",
        data: {
            searchQuery: "",
            gridColumns: ["name", "power"],
            gridData: [
                { name: "Chuck Norris", power: Infinity },
                { name: "Bruce Lee", power: 9000 },
                { name: "Jackie Chan", power: 7000 },
                { name: "Jet Li", power: 8000 }
            ]
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    let chartLabels = ['A', 'B', 'C'];
    let chartDataset = [22, 7, 1, 23, 39, 4, 12];

    let customLabels = chartLabels.map(q => '`' + q + '`');

    let ctx = document.getElementById('myChart').getContext('2d');
    let chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: customLabels,
            datasets: [{
                label: 'Week Revenue',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: chartDataset
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>


</body>
</html>
