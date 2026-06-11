<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $produk = \App\Models\ProdukOlahan::create([
        'nama_produk' => 'Maggot Kering Premium Test',
        'harga' => 50000,
        'stok' => 10.5,
        'foto' => 'test.jpg',
        'deskripsi' => 'Maggot berkualitas tinggi dari panen terbaru'
    ]);
    echo "✅ Produk berhasil dibuat!\n";
    echo "ID: " . $produk->id . "\n";
    echo "Nama: " . $produk->nama_produk . "\n";
    echo "Harga: Rp " . number_format($produk->harga, 0, ',', '.') . "\n";
    echo "Stok: " . $produk->stok . " Kg\n";
    echo "Deskripsi: " . $produk->deskripsi . "\n";
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
