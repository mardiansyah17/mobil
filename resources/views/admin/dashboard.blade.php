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
                    colors: ["#1A56DB", "#FDBA8C"],
                    series: [
                        {
                            name: "Kas masuk",
                            color: "#1A56DB",
                            data: kasMasuk
                        },
                        {
                            name: "Kas keluar",
                            color: "#FDBA8C",
                            data: kasKeluar
                        },
                    ],
                    chart: {
                        type: "bar",
                        height: "320px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
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
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },

                    xaxis: {
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
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
                        show: false,
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
