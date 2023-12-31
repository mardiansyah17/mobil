<x-front-layout>


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Brand
                </th>
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($histories as $histori)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$histori->item->brand->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$histori->item->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$histori->created_at->format('d-m-Y')}}
                    </td>
                    <td class="px-6 py-4">
                        {{$histori->total_price}}
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

</x-front-layout>
