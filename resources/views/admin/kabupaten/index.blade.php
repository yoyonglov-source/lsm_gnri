<x-app-layout>
    <div class="p-6">
        <!-- Header Judul (Warna Teks Diperbaiki agar Kelihatan Jelas) -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Data Sekretariat Kabupaten / DPD</h1>
                <p class="text-sm text-slate-600">Atur email dan alamat sekretariat yang akan muncul di KTA Anggota.</p>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 rounded-xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Kabupaten -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-lg">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-800 text-slate-200 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Nama Kabupaten / Kota</th>
                        <th class="px-6 py-4">Email Sekretariat</th>
                        <th class="px-6 py-4">Alamat Sekretariat</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($kabupatens as $kab)
                        <tr class="hover:bg-slate-800/50 transition">
                            <td class="px-6 py-4 font-bold text-white">{{ $kab->nama_kabupaten ?? $kab->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $kab->email_sekretariat ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-300 max-w-xs truncate">{{ $kab->alamat_sekretariat ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openModalEdit({{ $kab }})" class="px-3 py-1.5 bg-yellow-500 text-black hover:bg-yellow-400 font-bold rounded-lg text-xs transition shadow">
                                    Edit Info
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data kabupaten.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Sekretariat -->
    <div id="modalEdit" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl w-full max-w-lg shadow-2xl">
            <h3 class="text-lg font-bold text-white mb-4" id="modalTitle">Edit Sekretariat</h3>
            
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Email Sekretariat</label>
                        <input type="email" name="email_sekretariat" id="inputEmail" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-yellow-400" placeholder="contoh: dpd.pekanbaru@gnri.or.id" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1">Alamat Lengkap Sekretariat</label>
                        <textarea name="alamat_sekretariat" id="inputAlamat" rows="3" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-yellow-400 uppercase" placeholder="JL. YOS SUDARSO..." required></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold rounded-xl text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-400 text-black font-bold rounded-xl text-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalEdit(data) {
            var nama = data.nama_kabupaten || data.name || '';
            document.getElementById('modalTitle').innerText = 'Edit Sekretariat: ' + nama;
            document.getElementById('inputEmail').value = data.email_sekretariat || '';
            document.getElementById('inputAlamat').value = data.alamat_sekretariat || '';
            document.getElementById('formEdit').action = '/admin/kabupaten/' + data.id;
            document.getElementById('modalEdit').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalEdit').classList.add('hidden');
        }
    </script>
</x-app-layout>