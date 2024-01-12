<x-app-layout>
    <div class="p-3">
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="w-full">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                           for="grid-last-name">
                        Total Kas Keluar
                    </label>
                    <div class="w-full mb-10">
                        <label class="p-10 font-bold ps-10"
                               style="font-size:50px">Rp. {{number_format(($kasMasuk->sum("total") + $denda->sum('denda') )-$kasKeluar->sum("total"))}}</label>
                    </div>

                    <div class="flex flex-wrap mb-2 -mx-3 overflow-hidden">

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
                                   style="font-size:50px">Rp. {{number_format($kasMasuk->sum("total") + $denda->sum('denda'))}}</label>
                            <div class="font-bold">{{$kasMasuk->count() + $denda->count()}} transaksi</div>

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
                                   style="font-size:50px">Rp. {{number_format($kasKeluar->sum("total"))}}</label>
                            <div class="font-bold">{{$kasKeluar->count()}} transaksi</div>
                        </div>

                        <div class="flex flex-wrap mb-2 -mx-3 overflow-hidden">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
