<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Profit & Loss Chart -->
    <div class="bg-white p-6 rounded-xl border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-start gap-4">
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-chart-line text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-medium">Profit and Loss</h3>
                    <p class="text-sm text-gray-500">Company's revenues and expenses</p>
                </div>
            </div>
        </div>
        <div id="profitLossChart"></div>
    </div>

    <!-- Product Sale Chart -->
    <div class="bg-white p-6 rounded-xl border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-start gap-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-box text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-medium">Product Sale</h3>
                    <p class="text-sm text-gray-500">Number of products sold in branches</p>
                </div>
            </div>
        </div>
        <div id="productSaleChart"></div>
    </div>

    <!-- Top Supplier Chart -->
    <div class="bg-white p-6 rounded-xl border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-start gap-4">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <i class="fas fa-truck text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-medium">Top Supplier</h3>
                    <p class="text-sm text-gray-500">Suppliers with best performance</p>
                </div>
            </div>
        </div>
        <div id="topSupplierChart"></div>
    </div>
</div>

<script>
// Profit & Loss Chart
var profitLossOptions = {
    series: [{
        name: 'Revenue',
        data: [44000, 55000, 57000, 56000, 61000, 58000]
    }, {
        name: 'Expenses',
        data: [35000, 41000, 36000, 26000, 45000, 48000]
    }],
    chart: {
        type: 'bar',
        height: 200,
        toolbar: {
            show: false
        }
    },
    colors: ['#3B82F6', '#EF4444'],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            borderRadius: 4
        },
    },
    dataLabels: {
        enabled: false
    },
    grid: {
        show: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
    fill: {
        opacity: 1
    },
    legend: {
        position: 'bottom'
    }
};

// Product Sale Chart
var productSaleOptions = {
    series: [{
        data: [1560, 2420, 1980]
    }],
    chart: {
        type: 'bar',
        height: 200,
        toolbar: {
            show: false
        }
    },
    colors: ['#3B82F6', '#8B5CF6', '#F97316'],
    plotOptions: {
        bar: {
            horizontal: true,
            distributed: true,
            borderRadius: 4,
            barHeight: '40%'
        }
    },
    dataLabels: {
        enabled: false
    },
    grid: {
        show: false
    },
    xaxis: {
        categories: ['Store A', 'Store B', 'Store C'],
    }
};

// Top Supplier Chart
var topSupplierOptions = {
    series: [{
        name: 'Sales',
        data: [80, 75, 70, 65, 60, 55, 50]
    }],
    chart: {
        height: 200,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
            distributed: true,
            borderRadius: 4,
            barHeight: '40%'
        }
    },
    colors: ['#3B82F6'],
    dataLabels: {
        enabled: false
    },
    grid: {
        show: false
    },
    xaxis: {
        categories: ['John', 'Sarah', 'Mike', 'Lisa', 'Tom', 'Anna', 'Steve'],
    }
};

// Render Charts
var profitLossChart = new ApexCharts(document.querySelector("#profitLossChart"), profitLossOptions);
var productSaleChart = new ApexCharts(document.querySelector("#productSaleChart"), productSaleOptions);
var topSupplierChart = new ApexCharts(document.querySelector("#topSupplierChart"), topSupplierOptions);

profitLossChart.render();
productSaleChart.render();
topSupplierChart.render();
</script>