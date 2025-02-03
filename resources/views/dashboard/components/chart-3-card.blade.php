<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Product Stock Chart -->
    <div class="relative p-6 rounded-xl border border-gray-200 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-white to-red-50 backdrop-blur-sm"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-start gap-4">
                    <div class="bg-red-100 p-3 rounded-lg">
                        <i class="fas fa-boxes text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Stok Produk</h3>
                        <p class="text-sm text-gray-500">Produk dengan stok paling sedikit</p>
                    </div>
                </div>
            </div>
            <div id="productStockChart"></div>
        </div>
    </div>

    <!-- Product Sale Chart -->
    <div class="relative p-6 rounded-xl border border-gray-200 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-50 backdrop-blur-sm"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-chart-bar text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Produk Terlaris</h3>
                        <p class="text-sm text-gray-500">Top 5 produk paling banyak terjual</p>
                    </div>
                </div>
            </div>
            <div id="productSaleChart"></div>
        </div>
    </div>

    <!-- Top Supplier Chart -->
    <div class="relative p-6 rounded-xl border border-gray-200 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 via-white to-purple-50 backdrop-blur-sm"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-start gap-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-truck text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium">Top Supplier</h3>
                        <p class="text-sm text-gray-500">Supplier dengan produk terbanyak</p>
                    </div>
                </div>
            </div>
            <div id="topSupplierChart"></div>
        </div>
    </div>
</div>

<script>
// Product Stock Chart
var productStockOptions = {
    series: [{
        name: 'Stok',
        data: @json($stockSeries)
    }],
    chart: {
        type: 'bar',
        height: 200,
        toolbar: {
            show: false
        }
    },
    colors: ['#EF4444'],
    plotOptions: {
        bar: {
            horizontal: true,
            distributed: true,
            borderRadius: 4,
            barHeight: '40%'
        }
    },
    dataLabels: {
        enabled: true,
        style: {
            fontSize: '12px'
        }
    },
    grid: {
        show: false
    },
    xaxis: {
        categories: @json($stockLabels)
    }
};

// Product Sale Chart
var productSaleOptions = {
    series: [{
        name: 'Total Terjual',
        data: @json($productSeries)
    }],
    chart: {
        type: 'bar',
        height: 200,
        toolbar: {
            show: false
        }
    },
    colors: ['#3B82F6'],
    plotOptions: {
        bar: {
            horizontal: true,
            distributed: true,
            borderRadius: 4,
            barHeight: '40%'
        }
    },
    dataLabels: {
        enabled: true,
        style: {
            fontSize: '12px'
        }
    },
    grid: {
        show: false
    },
    xaxis: {
        categories: @json($productLabels)
    }
};

// Top Supplier Chart
var topSupplierOptions = {
    series: [{
        name: 'Total Produk',
        data: @json($supplierSeries)
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
    colors: ['#8B5CF6'],
    dataLabels: {
        enabled: true,
        style: {
            fontSize: '12px'
        }
    },
    grid: {
        show: false
    },
    xaxis: {
        categories: @json($supplierLabels)
    }
};

// Render Charts
var productStockChart = new ApexCharts(document.querySelector("#productStockChart"), productStockOptions);
var productSaleChart = new ApexCharts(document.querySelector("#productSaleChart"), productSaleOptions);
var topSupplierChart = new ApexCharts(document.querySelector("#topSupplierChart"), topSupplierOptions);

productStockChart.render();
productSaleChart.render();
topSupplierChart.render();
</script>