<div class="space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">🏫 Allocated School Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="post" class="block text-sm font-medium text-gray-700 mb-1">Post</label>
            <input type="text" id="post" name="post" placeholder="Post"
                value="{{ $allocatedData->post ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="replcedPersion" class="block text-sm font-medium text-gray-700 mb-1">Replced
                Persion</label>
            <input type="text" id="replcedPersion" name="replcedPersion" placeholder="Replced Persion"
                value="{{ $allocatedData->replcedPersion ?? null }}" readonly
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

    </div>
</div>
