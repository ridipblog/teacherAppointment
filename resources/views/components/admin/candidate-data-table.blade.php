<table id="reportPage" class="stripe hover w-full text-sm text-left uppercase">
    <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
        <tr>
            <th class="">ROLL NUMBER</th>
            <th class="">CANDIDATE NAME</th>
            <th class="">POST NAME</th>
            <th class="">IS ALLOCATED</th>
            <th class="no-export">ACTION TAB</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBase ?? [] as $item)
            <tr>
                <td class="">{{ $item['rollNumber'] ?? 'No Data' }}</td>
                <td class="">{{ $item['name'] ?? 'No Data' }}</td>
                <td class="">{{ $item['allPost']['name'] ?? 'No Data' }}</td>
                <td class="">{{ ($item['isAllocated'] ?? 2) == 1 ? 'Allocated' : 'Not Allocated' }}</td>
                <td class="flex space-x-3 justify-center items-center">
                    <!-- View -->
                    <a href="" title="View" class="text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    @if (($item['isAllocated'] ?? 2) == 1)
                        <!-- Revert -->
                        <button type="button" id="revert-candidate" value="{{ Crypt::encryptString($item['id'] ?? null) }}" title="Revert"
                            class="text-yellow-600 hover:text-yellow-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h11a4 4 0 110 8h-1M3 10l4-4M3 10l4 4" />
                            </svg>
                        </button>
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
