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
    <link rel="stylesheet" type="text/css" href="/css/index.css" />
    <link rel="stylesheet" type="text/css" href="/css/grid.css" />
    <link rel="stylesheet" type="text/css" href="/css/custom.css" />
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
                <input type="text" placeholder="Search.." name="searchPhrase">
                <select class="selectScope" name="filter">
                    <option value="all">All</option>
                    <option value="client">Client</option>
                    <option value="product">Product</option>
                    <option value="total">Total</option>
                </select>
                <button type="submit" id="action-search"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>

        <div>
            <canvas id="myChart"></canvas>
        </div>

        <div>
            {{ Html::mailto($emailUrl, $emailTitle) }}
        </div>

        <!-- demo root element -->
        <div id="demo">
{{--            <form id="search">--}}
{{--                Search <input name="query" v-model="searchQuery" />--}}
{{--            </form>--}}
            <demo-grid
                :heroes="gridData"
                :columns="gridColumns"
                :filter-key="searchQuery"
            >
            </demo-grid>
        </div>
    </div>
</div>
<footer class="footer"></footer>

<!-- component template -->
<script type="text/x-template" id="grid-template">
    <table>
        <thead>
        <tr>
            <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{ active: sortKey == key }">
                @{{ key | capitalize }}
                <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
              </span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredHeroes">
            <td v-for="key in columns">
                @{{entry[key]}}
            </td>
        </tr>
        </tbody>
    </table>
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="/js/main.js"></script>

</body>
</html>
