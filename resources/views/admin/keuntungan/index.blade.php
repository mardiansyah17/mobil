<x-app-layout>
    <div class="p-3">

        <div class="">

            <div class="grid grid-cols-2 gap-6 mt-4-mx-3">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div>
                            <div
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Cetak Laporan
                            </div>

                            <div date-rangepicker class="flex items-center mb-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="startDate" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date start">
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="endDate" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date end">
                                </div>
                            </div>


                            <div class="flex flex-wrap mb-2 -mx-3">
                                <div class="w-full px-3 text-right">
                                    <a href="{{route('admin.keuntungan.cetak-pdf')}}"
                                       class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700">
                                        Download Pdf
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                   for="grid-last-name">
                                Total Keuntungan
                            </label>
                            <div class="w-full mb-10">
                                <label id="keuntungan" class="p-10 font-bold ps-10"
                                       style="font-size:50px">
                                    Rp {{number_format($kasMasukPrice -$kasKeluarPrice,0,",",".")}}</label>
                            </div>


                        </div>
                    </div>
                </div>

            </div>


        </div>


        <div class="flex gap-5 mt-5">
            <div class="overflow-hidden shadow sm:rounded-md w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                               for="grid-last-name">
                            Total Kas masuk
                        </label>
                        <div class="w-full mb-10">
                            <label class="p-10 font-bold ps-10"
                                   style="font-size:50px"
                                   id="kasMasuk">Rp {{number_format($kasMasukPrice,0,",",".")}}</label>
                            <div class="font-bold" id="kasMasukCount">{{$kasMasukCount}} transaksi</div>

                        </div>

                        <div class="flex flex-wrap mb-2 -mx-3 overflow-hidden">

                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden shadow sm:rounded-md w-full">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                               for="grid-last-name">
                            Total Kas Keluar
                        </label>
                        <div class="w-full mb-10">
                            <label class="p-10 font-bold ps-10"
                                   style="font-size:50px"
                                   id="kasKeluar">Rp {{number_format($kasKeluarPrice,0,",",".")}}</label>
                            <div class="font-bold" id="kasKeluarCount">{{$kasKeluarCount}} transaksi</div>
                        </div>

                        <div class="flex flex-wrap mb-2 -mx-3 overflow-hidden">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            $(document).ready(function () {

                async function getKeuntungan() {
                    let startDate = $('input[name=startDate]').val()
                    let endDate = $('input[name=endDate]').val()
                    let data = {
                        startDate: startDate,
                        endDate: endDate
                    }
                    let response = await $.ajax({
                        url: "{{route('admin.keuntungan.index')}}",
                        method: "get",
                        data: data,
                        dataType: "JSON"
                    })
                    $('#keuntungan').html(`Rp ${parseInt(response.kasMasukPrice) - parseInt(response.kasKeluarPrice)}`)
                    $('#kasMasuk').html(`Rp ${response.kasMasukPrice}`)
                    $('#kasKeluar').html(`Rp ${response.kasKeluarPrice}`)
                    $('#kasMasukCount').html(`${response.kasMasukCount} transaksi`)
                    $('#kasKeluarCount').html(`${response.kasKeluarCount} transaksi`)
                }

                $('input[name=startDate]').on("changeDate", async function () {
                    await getKeuntungan()
                });

                $('input[name=endDate]').on("changeDate", async function () {
                    await getKeuntungan()
                });
            });
        </script>
    </x-slot>
</x-app-layout>
