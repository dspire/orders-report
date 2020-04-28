// todo: fetch data link without ui components, testing
//  ... use fetch fn


// search: apple, all
// search: apple, client
// search: apple, 100

let datasetMock = [
    {"client": "Dell", "product": "X", "total": 100.00, "ordered_at": '03/05/19'},
    {"client": "Dell", "product": "X", "total": 700.00, "ordered_at": '03/05/19'},
    {"client": "Apple", "product": "X", "total": 1100.25, "ordered_at": '01/02/19'},
];


let searchStore = {
    "searchPhrase": "",
    "filter": "all",
}

let datasetDriver = {
    "offset": "0",
    "size": "12",
    "sortRow": ""
}

let orderStore = {
    direction: {
        client: 1,
        total: 0,
    },
    positionStack: []
}

// #action-search.click()
//     input: {searchPhrase, filter}





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
        gridColumns: ["name", "power", "recognition"],
        gridData: [
            { name: "Chuck Norris", power: Infinity, recognition: 100 },
            { name: "Bruce Lee", power: 9000, recognition: 90 },
            { name: "Jackie Chan", power: 7000, recognition: 70 },
            { name: "Jet Li", power: 8000, recognition: 40 }
        ]
    }
});

// chart
let chartLabels = ['A', 'B', 'C', 'D', 'E'];
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
