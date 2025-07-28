<table id="reportPage" class="stripe hover w-full text-sm text-left uppercase">
    <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-bold">
        <tr>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>role</th>
            <th class="no-export">actionTab</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($dataBase ?? [] as $item)
            <tr>
                <td>{{ $item['name'] ?? 'No Data' }}</td>
                <td>{{ $item['email'] ?? 'No Data' }}</td>
                <td>{{ $item['phone'] ?? 'No Data' }}</td>
                <td>{{ $item['user_roles']['roles']['name'] ?? 'No Data' }}</td>
                <td class="flex space-x-3 justify-center items-center">
                    <!-- Edit -->
                    <button title="{{ ($item['active'] ?? null) == 1 ? 'Deactivate' : 'Activate' }} " id="user-deactive"
                        data-user-status="{{ ($item['active'] ?? null) == 1 ? 2 : 1 }}"
                        value="{{ Crypt::encryptString($item['id'] ?? null) }}" class="text-gray-600 hover:text-gray-800">
                        <!-- Deactivate icon -->
                        @if (($item['active'] ?? null) == 1)
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Outer capsule -->
                                <path d="M17 6H7a6 6 0 1 0 0 12h10a6 6 0 0 0 0-12Z" fill="#d1d5db" fill-opacity=".25"
                                    stroke="#9ca3af" stroke-width="1.8" stroke-miterlimit="10" />

                                <!-- Knob on the left (OFF) -->
                                <circle cx="7" cy="12" r="3.5" fill="#9ca3af" stroke="#6b7280"
                                    stroke-width="2" />
                            </svg>
                        @else
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Outer capsule -->
                                <path d="M17 6H7a6 6 0 1 0 0 12h10a6 6 0 0 0 0-12Z" fill="#4ade80" fill-opacity=".25"
                                    stroke="#22c55e" stroke-width="1.8" stroke-miterlimit="10" />

                                <!-- Bold inner knob (ON) -->
                                <circle cx="17" cy="12" r="3.5" fill="#22c55e" stroke="#166534"
                                    stroke-width="2" />
                            </svg>
                        @endif
                    </button>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
