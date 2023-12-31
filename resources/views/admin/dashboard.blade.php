<x-app-layout>
    <div class="flex justify-center space-x-4 mt-4">
        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Kas masuk</p>
                </div>

            </div>
            <div id="kasMasuk"></div>
        </div>

        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between">
                <div>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Kas keluar</p>
                </div>

            </div>
            <div id="kasKeluar"></div>
        </div>


    </div>
    <x-slot name="script">
        <script>
            // ApexCharts options and config
            window.addEventListener("load", function () {
                let optionsKasMasuk = {
                    chart: {
                        height: "100%",
                        maxWidth: "100%",
                        type: "area",
                        fontFamily: "Inter, sans-serif",
                        dropShadow: {
                            enabled: false,
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false,
                        },
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#1C64F2",
                            gradientToColors: ["#1C64F2"],
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: 0
                        },
                    },
                    series: [
                        {
                            name: "Kas masuk",
                            data: [6500, 6418, 6456, 6526, 6356, 6456, 6356, 6456, 6356, 6456, 6356, 6456],
                            color: "#1A56DB",
                        },
                    ],
                    xaxis: {
                        categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                            "September", "Oktober", "November", "Desember"],
                        labels: {
                            show: false,
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
                }


                let optionsKasKeluar = {
                    chart: {
                        height: "100%",
                        maxWidth: "100%",
                        type: "area",
                        fontFamily: "Inter, sans-serif",
                        dropShadow: {
                            enabled: false,
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false,
                        },
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#1C64F2",
                            gradientToColors: ["#1C64F2"],
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: 0
                        },
                    },
                    series: [
                        {
                            name: "Kas masuk",
                            data: [6500, 6418, 6456, 6526, 6356, 6456, 6356, 6456, 6356, 6456, 6356, 6456],
                            color: "#1A56DB",
                        },
                    ],
                    xaxis: {
                        categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                            "September", "Oktober", "November", "Desember"],
                        labels: {
                            show: false,
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
                }

                if (document.getElementById("kasKeluar") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("kasKeluar"), optionsKasKeluar);
                    chart.render();
                }

                if (document.getElementById("kasMasuk") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("kasMasuk"), optionsKasMasuk);
                    chart.render();
                }
            });
        </script>
    </x-slot>
</x-app-layout>
