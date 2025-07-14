<h2 class="text-2xl font-bold mb-4">Perusahaan Menunggu Persetujuan</h2>

@if($pendaftarCompanies->isEmpty())
  <p>Tidak ada perusahaan yang menunggu persetujuan.</p>
@else
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead class="bg-gray-200 text-gray-700">
      <tr>
      <th class="py-3 px-4 text-left">Nama Perusahaan</th>
      <th class="py-3 px-4 text-left">Status</th>
      <th class="py-3 px-4 text-left">Tanggal Daftar</th>
      <th class="py-3 px-4 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendaftarCompanies as $companyStatus)
      <tr class="border-b border-gray-200 hover:bg-gray-100">
      <td class="py-3 px-4">{{ $companyStatus->company_name }}</td>
      <td class="py-3 px-4">{{ $companyStatus->status }}</td>
      <td class="py-3 px-4">{{ $companyStatus->created_at->format('d M Y H:i') }}</td>
      <td class="py-3 px-4 flex space-x-2">
      {{-- Form untuk Approve --}}
      <form action="{{ route('admin.approveCompany', $companyStatus->id) }}" method="POST">
      @csrf
      <button type="submit"
        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
        Approve
      </button>
      </form>

      {{-- Form untuk Reject --}}
      <form action="{{ route('admin.rejectCompany', $companyStatus->id) }}" method="POST">
      @csrf
      <button type="submit"
        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
        Reject
      </button>
      </form>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endif

<h2 class="text-2xl font-bold mt-8 mb-4">Riwayat Persetujuan</h2>

@if($historyCompanies->isEmpty())
  <p>Tidak ada riwayat persetujuan perusahaan.</p>
@else
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead class="bg-gray-200 text-gray-700">
      <tr>
      <th class="py-3 px-4 text-left">Nama Perusahaan</th>
      <th class="py-3 px-4 text-left">Status</th>
      <th class="py-3 px-4 text-left">Terakhir Diperbarui</th>
      </tr>
    </thead>
    <tbody>
      @foreach($historyCompanies as $companyStatus)
      <tr class="border-b border-gray-200 hover:bg-gray-100">
      <td class="py-3 px-4">{{ $companyStatus->company_name }}</td>
      <td class="py-3 px-4">
      <span class="px-2 py-1 rounded-full text-xs font-semibold
      @if($companyStatus->status === 'accepted') bg-green-100 text-green-800
      @elseif($companyStatus->status === 'rejected') bg-red-100 text-red-800
      @else bg-gray-100 text-gray-800
    @endif">
      {{ ucfirst($companyStatus->status) }}
      </span>
      </td>
      <td class="py-3 px-4">{{ $companyStatus->updated_at->format('d M Y H:i') }}</td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endif

{{-- Optional: Jika Anda ingin feedback setelah approve/reject tanpa refresh halaman --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[action$="/approve"], form[action$="/reject"]').forEach(form => {
      form.addEventListener('submit', async function (event) {
        event.preventDefault(); // Mencegah submit form standar

        const actionUrl = this.action;
        const csrfToken = this.querySelector('input[name="_token"]').value;

        try {
          const response = await fetch(actionUrl, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
          });

          const result = await response.json();

          if (response.ok) {
            alert(result.message); // Ganti dengan notifikasi yang lebih elegan
            window.location.reload(); // Refresh halaman untuk melihat perubahan
          } else {
            alert('Error: ' + (result.message || 'Terjadi kesalahan.'));
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Terjadi kesalahan jaringan atau server.');
        }
      });
    });
  });
</script>