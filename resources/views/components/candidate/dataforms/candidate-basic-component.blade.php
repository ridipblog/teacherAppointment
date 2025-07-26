<div class="space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">🏫 Candidate Basic</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="rollNumber" class="block text-sm font-medium text-gray-700 mb-1">Roll Number</label>
            <input type="text" id="rollNumber" name="rollNumber" placeholder="Candidate Roll Number "
                value="{{ $candData->rollNumber ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="post" class="block text-sm font-medium text-gray-700 mb-1">Post Name</label>
            <input type="text" id="post" name="post" placeholder="Post Name" readonly
                value="{{ $candData->allPost->name ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="fatherName" class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
            <input type="text" id="fatherName" name="fatherName" placeholder="Father Name" readonly
                value="{{ $candData->fatherName ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Subject" readonly
                value="{{ $candData->subject ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" readonly
                value="{{ $candData->address ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="pinCode" class="block text-sm font-medium text-gray-700 mb-1">Pin Code</label>
            <input type="text" id="pinCode" name="pinCode" placeholder="Pin Code" readonly
                value="{{ $candData->pinCode ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
            <input type="text" id="medium" name="medium" placeholder="Medium" readonly
                value="{{ $candData->medium ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="category" class="block text-sm font-category text-gray-700 mb-1">Category</label>
            <input type="text" id="category" name="category" placeholder="Category" readonly
                value="{{ $candData->category ?? null }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

    </div>
</div>
