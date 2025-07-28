<table id="reportPage" class="stripe hover w-full text-sm text-left uppercase">
    <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
        <tr>
            @foreach ($dataHeader ?? [] as $header)
                <th class="{{ $header == 'actionTab' ? 'no-export' : '' }}">
                    {{ ucwords(str_replace('_', ' ', $header ?? 'No Header')) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBase ?? [] as $item)
            <tr>
                @foreach ($dataHeader ?? [] as $header)
                    @if ($header == 'actionTab')
                        <td class="flex space-x-3 justify-center items-center">
                            <!-- Edit -->
                            <a href="{{ Route('admin.addSchoolVacency', ['form' => 'update', 'schoolCode' => Crypt::encryptString($item['id'] ?? '')]) }}"
                                title="Edit" class="text-green-600 hover:text-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5h2M6 19l1.5-1.5M16.5 3.5a2.121 2.121 0 113 3L8.414 17.586a2 2 0 01-1.414.586H5v-2a2 2 0 01.586-1.414L16.5 3.5z" />
                                </svg>
                            </a>
                        </td>
                    @else
                        <td>{{ $item[$header] ?? 'No Data' }}</td>
                    @endif
                @endforeach

            </tr>
        @endforeach
    </tbody>
</table>
