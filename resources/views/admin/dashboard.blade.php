<x-app-layout>
    <div class="p-3 w-4/5 mx-auto">
        <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mb-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Kas masuk dan keluar</p>
                </div>

            </div>
            <div id="kas"></div>
        </div>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kota
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total harga
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach($pemasukan as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->city }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->total_price }}
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <x-slot name="script">
        <script>


            const dataKasMasuk = @json($kasMasuk);
            const dataKasKeluar = @json($kasKeluar);
            // nama bulan misa januari, februari, dst
            const monts = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ]

            // Inisialisasi array hasil dengan nilai awal 0 untuk setiap bulan
            const kasKeluar = monts.map(month => ({x: month, y: 0}));

            // Mengisi nilai yang sesuai dari data kas
            dataKasKeluar.forEach(entry => {
                const monthIndex = entry.month - 1; // Index dimulai dari 0
                kasKeluar[monthIndex].y = entry.count;
            });

            const kasMasuk = monts.map(month => ({x: month, y: 0}));

            // Mengisi nilai yang sesuai dari data kas
            dataKasMasuk.forEach(entry => {
                const monthIndex = entry.month - 1; // Index dimulai dari 0
                kasMasuk[monthIndex].y = entry.count;
            });


            window.addEventListener("load", function () {
                const options = {
                    colors: ["#1A56DB", "#f7a56c"],
                    series: [
                        {
                            name: "Kas masuk",
                            color: "#1A56DB",
                            data: kasMasuk
                        },
                        {
                            name: "Kas keluar",
                            color: "#f7a56c",
                            data: kasKeluar
                        },
                    ],
                    chart: {
                        sparkline: {
                            enabled: false,
                        },
                        type: "bar",
                        height: "500px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: "100%",
                            barHeight: "30px",
                            borderRadiusApplication: "end",
                            borderRadius: 6,
                            dataLabels: {
                                position: 'bottom',
                                maxItems: Infinity, // Menampilkan semua data labels
                                hideOverflowingLabels: false
                            }
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,

                        formatter: function (val) {
                            return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1,
                            },

                        },
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"],
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function (val) {
                            return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    xaxis: {
                        floating: false,
                        labels: {
                            show: true,
                            formatter: function (val) {
                                // Format nilai dalam format mata uang Rupiah
                                return 'Rp ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: true,
                        labels: {}
                    },

                    fill: {
                        opacity: 1,
                    },
                }

                if (document.getElementById("kas") && typeof ApexCharts !== 'undefined'
                ) {
                    const chart = new ApexCharts(document.getElementById("kas"), options);
                    chart.render();
                }

            })

        </script>
    </x-slot>
</x-app-layout>
