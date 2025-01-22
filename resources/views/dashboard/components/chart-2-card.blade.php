<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Target Penjualan Chart (2 grid) -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-medium">Sales and Target Overtime</h3>
                <p class="text-sm text-gray-500">Company sales target for the last 6 months</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium">Total Sales:</span>
                    <span class="text-sm text-blue-600">Rp 60,540.00</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium">Total Target:</span>
                    <span class="text-sm text-orange-500">Rp 48,250.00</span>
                </div>
            </div>
        </div>
        <div id="targetPenjualanChart"></div>
    </div>

    <!-- Kategori Produk Chart (1 grid) -->
    <div class="bg-white p-6 rounded-xl border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-medium">Kategori Produk</h3>
                <p class="text-sm text-gray-500">Distribution by category</p>
            </div>
        </div>
        <div id="kategoriProdukChart"></div>
    </div>
</div>

<script>
// Target Penjualan Chart
var targetPenjualanOptions = {
    series: [{
        name: 'Sales',
        data: [35000, 28000, 30000, 38000, 32000, 35000]
    }, {
        name: 'Target',
        data: [32000, 25000, 27000, 35000, 30000, 32000]
    }],
    chart: {
        height: 350,
        type: 'line',
        toolbar: {
            show: false
        }
    },
    colors: ['#3B82F6', '#F97316'],
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth',
        width: 2
    },
    grid: {
        borderColor: '#f1f1f1',
    },
    xaxis: {
        categories: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right'
    }
};

// Kategori Produk Chart
var kategoriProdukOptions = {
    series: @json($series), // Data jumlah produk per kategori
    chart: {
        type: 'pie',
        height: 350
    },
    labels: @json($labels), // Data nama kategori
    colors: ['#3B82F6', '#8B5CF6', '#F97316', '#EF4444', '#10B981'], // Tambah warna sesuai jumlah kategori
    legend: {
        position: 'bottom'
    },
    dataLabels: {
        formatter: function (val) {
            return val.toFixed(1) + "%"
        }
    }
};

// Render Charts
var targetPenjualanChart = new ApexCharts(document.querySelector("#targetPenjualanChart"), targetPenjualanOptions);
var kategoriProdukChart = new ApexCharts(document.querySelector("#kategoriProdukChart"), kategoriProdukOptions);

targetPenjualanChart.render();
kategoriProdukChart.render();
</script>