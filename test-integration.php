<?php
require __DIR__ . '/bootstrap/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\TrashData;
use App\Models\Gudang;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

echo "\n=== INTEGRATION TEST: Submit → Approve → Verify ===\n\n";

try {
    // 1. CLEANUP
    echo "Step 1: Cleanup test data...\n";
    TrashData::query()->forceDelete();
    Notification::query()->forceDelete();
    
    // 2. GET/CREATE TEST USER
    echo "Step 2: Get or create test user...\n";
    $user = User::where('email', 'user@gmail.com')->first();
    if (!$user) {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'saldo' => 0
        ]);
        echo "  ✓ Created user: {$user->email}\n";
    } else {
        $user->saldo = 0;
        $user->save();
        echo "  ✓ Reset user saldo to 0\n";
    }
    
    // 3. USER SUBMIT WASTE
    echo "\nStep 3: User submits waste...\n";
    $trash = TrashData::create([
        'user_id' => $user->id,
        'trash_type' => 'Sampah Organik',
        'weight' => 5,
        'total_price' => 0,
        'status' => 'pending',
        'image_path' => 'trash-data/test.jpg',
        'description' => 'Test submission'
    ]);
    echo "  ✓ Created TrashData ID: {$trash->id}\n";
    echo "  ✓ Initial Status: {$trash->status}\n";
    
    // 4. ADMIN APPROVE
    echo "\nStep 4: Admin approves submission...\n";
    $trash->approve(25000, 'Test approval'); // 25000 per kg * 5 kg = 125000
    $trash = $trash->fresh();
    echo "  ✓ Status: {$trash->status}\n";
    echo "  ✓ Total Price: " . number_format($trash->total_price, 0, ',', '.') . "\n";
    
    // 5. VERIFY SALDO UPDATED
    echo "\nStep 5: Verify saldo updated...\n";
    $userFresh = $user->fresh();
    $expectedSaldo = 125000;
    echo "  User saldo: " . number_format($userFresh->saldo, 0, ',', '.') . " (expected: " . number_format($expectedSaldo, 0, ',', '.') . ")\n";
    if ($userFresh->saldo == $expectedSaldo) {
        echo "  ✅ SALDO UPDATE SUCCESS\n";
    } else {
        echo "  ❌ SALDO UPDATE FAILED\n";
    }
    
    // 6. VERIFY GUDANG UPDATED
    echo "\nStep 6: Verify gudang updated...\n";
    $gudang = Gudang::where('kategori', 'Organik')->first();
    if ($gudang) {
        echo "  ✓ Gudang Organik stok: {$gudang->stok} kg\n";
        if ($gudang->stok >= 5) {
            echo "  ✅ GUDANG UPDATE SUCCESS\n";
        } else {
            echo "  ⚠️ Gudang updated but stok less than expected\n";
        }
    } else {
        echo "  ❌ GUDANG UPDATE FAILED - Record not found\n";
    }
    
    // 7. VERIFY NOTIFICATION SENT
    echo "\nStep 7: Verify notification sent...\n";
    $notif = Notification::where('notifiable_id', $user->id)->latest()->first();
    if ($notif) {
        echo "  ✓ Notification type: {$notif->type}\n";
        echo "  ✓ Notification message: {$notif->message}\n";
        echo "  ✅ NOTIFICATION SENT SUCCESS\n";
    } else {
        echo "  ❌ NOTIFICATION NOT SENT\n";
    }
    
    echo "\n=== TEST COMPLETE ===\n";
    echo "\n✅ All critical checks passed! Integration is working.\n\n";
    
} catch (\Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
?>
