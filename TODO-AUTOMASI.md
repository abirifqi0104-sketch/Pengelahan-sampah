# TODO-AUTOMASI.md

## Tujuan
Membuat alur besar sistem otomatis & terintegrasi end-to-end:
User: daftar/login, setor sampah (+upload foto), lihat status verifikasi, saldo, riwayat, edukasi
Admin: verifikasi setoran (+harga), kelola gudang, kelola budidaya maggot, panen, penjualan, laporan otomatis

## Langkah Implementasi
1. Audit & sinkronisasi model/data source
   - Tentukan sumber kebenaran transaksi/saldo: `trash_data` vs `transaksis`.
   - Samakan relasi user/admin untuk riwayat & saldo.

2. Foto bukti otomatis
   - Tambahkan processing upload `photo` di `TransactionController@store`.
   - Pastikan kolom tujuan ada (atau buat migrasi/kolom yang sesuai).

3. Status verifikasi yang konsisten
   - Pastikan alur status: `pending` -> `selesai` (approve) / `rejected` (reject).
   - Update view user untuk menampilkan status real.

4. Otomatis saldo & riwayat saat approve
   - Saat admin approve/reject pada `AdminController`, otomatis:
     - menghitung `total_price` jika belum
     - update saldo user
     - simpan riwayat transaksi/saldo (gunakan tabel yang ditetapkan)

5. Integrasi gudang & maggot
   - Setelah verifikasi selesai, update gudang setoran (sesuai tipe sampah organik/plastik/kertas dll).
   - Saat panen maggot, update stok/gudang maggot terkait.

6. Penjualan + dampak saldo + laporan
   - Buat pencatatan transaksi penjualan.
   - Saat penjualan selesai, update saldo dan stok gudang.

7. Laporan otomatis (hapus dummy)
   - Perbarui `LaporanController@index` agar memakai query real data.
   - Sediakan filter tanggal & jenis laporan.

8. Pengujian end-to-end
   - Daftar user -> submit waste (+foto) -> admin approve -> user lihat status/saldo/riwayat
   - Admin panen & penjualan -> laporan ter-update

## Catatan
- Semua perubahan harus menjaga konsistensi penamaan route: `user.*`, `admin.*`.
- Jika ada konflik penamaan model (`Transaction` vs `Transaksi`), lakukan refactor minimal agar alur benar.

