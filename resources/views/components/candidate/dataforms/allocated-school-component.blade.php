<div class="space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">🏫 Allocated School Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="schoolCode" class="block text-sm font-medium text-gray-700 mb-1">School Code</label>
            <input type="text" id="schoolCode" name="schoolCode" placeholder="School Code"
                value="{{ $allocateSchool->schoolCode ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="schoolName" class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
            <input type="text" id="schoolName" name="schoolName" placeholder="School Name"
                value="{{ $allocateSchool->schoolName ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Post Name</label>
            <input type="text" id="name" name="name" placeholder="Post Name"
                value="{{ $allocateSchool->allPost->name ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
            <input type="text" id="district" name="district" placeholder="District"
                value="{{ $allocateSchool->district ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
            <input type="text" id="medium" name="medium" placeholder="Medium"
                value="{{ $allocateSchool->medium ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="vacencyCategory" class="block text-sm font-medium text-gray-700 mb-1">Vacency
                category</label>
            <input type="text" id="vacencyCategory" name="vacencyCategory" placeholder="School Code"
                value="{{ $allocateSchool->vacencyCategory ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

    </div>
</div>
