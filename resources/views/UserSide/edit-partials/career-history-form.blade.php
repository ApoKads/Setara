<div>
    <label for="job_title" class="block text-sm font-medium text-gray-700">Jabatan</label>
    <input type="text" name="job_title" :value="selectedHistory?.job_title"
        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required>
</div>
<div>
    <label for="company_name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
    <input type="text" name="company_name" :value="selectedHistory?.company_name"
        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
        <input type="date" name="start_date" :value="selectedHistory?.start_date"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>
    </div>
    <div>
        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai (opsional)</label>
        <input type="date" name="end_date" :value="selectedHistory?.end_date"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
</div>
<div>
    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
    <textarea name="description" rows="4"
        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        x-text="selectedHistory?.description"></textarea>
</div>