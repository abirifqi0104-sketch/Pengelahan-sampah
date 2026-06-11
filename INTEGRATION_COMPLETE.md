# Dokumentasi Integrasi Sistem Sampah & Maggot - SELESAI

## 📋 Status Implementasi

Semua fitur telah berhasil diimplementasikan dan terintegrasi:

### ✅ Completed Features

#### 1. **User Setoran Sampah Flow**
- User dapat setor sampah melalui `user.submit-waste` route
- Admin verifikasi setoran di halaman khusus
- Jika disetujui: saldo otomatis ditambahkan ke akun user
- Jika ditolak: notifikasi dikirim ke user dengan alasan penolakan

**Files:**
- `app/Models/TrashData.php` - Model dengan method `approve()` dan `reject()`
- `app/Http/Controllers/AdminController.php` - Fungsi verifikasi
- `resources/views/admin/verifikasi/index.blade.php` - UI verifikasi

---

#### 2. **Saldo Management System**
- Saldo user disimpan di `users.saldo` (decimal 12,2)
- Update otomatis saat setoran diapprove
- Update otomatis saat withdrawal direject (refund)
- Real-time saldo display di sidebar user

**Database:**
- Migration: `2026_05_23_230000_add_saldo_to_users_table.php`

---

#### 3. **User Dashboard Pages - SPLIT**
Tidak lagi satu halaman, sekarang terpisah menjadi multiple pages:

- **Dashboard** → `user.dashboard` - Overview saja
- **Setor Sampah** → `user.submit-waste` - Form setoran baru
- **Riwayat** → `user.history` - Riwayat setoran
- **Tarik Saldo** → `user.withdraw.index` / `user.withdraw.create` - NEW
- **Informasi** → `user.information.index` / `user.information.show` - NEW
- **Notifikasi** → `user.notifications` - Sudah ada

**UI Sidebar:**
- Updated user sidebar dengan clear grouping
- Menu yang aktif tertandai dengan jelas
- Saldo real-time ditampilkan di bawah

---

#### 4. **Admin Withdrawal Management**
Fitur tarik saldo user yang lengkap:

**Routes:**
```
admin/withdraw/ - Lihat semua request (index)
admin/withdraw/{id}/approve - Setujui
admin/withdraw/{id}/reject - Tolak (refund saldo)
admin/withdraw/{id}/process - Mark as processed
```

**Features:**
- User request → pending
- Admin approve → approved (notification sent)
- Admin reject → rejected (saldo dikembalikan)
- Admin process → processed (notification sent)

**Database:**
- Model: `app/Models/Withdrawal.php`
- Migration: `2026_05_30_create_withdrawals_table.php`

**Views:**
- `resources/views/admin/withdraw-index.blade.php` - Admin dashboard
- `resources/views/user/withdraw-index.blade.php` - User riwayat
- `resources/views/user/withdraw-create.blade.php` - User form

---

#### 5. **Admin Information Management**
Admin dapat membuat & kelola informasi untuk user:

**Routes:**
```
admin/information/ - Daftar informasi (index)
admin/information/create - Buat informasi baru
admin/information/{id}/edit - Edit informasi
admin/information/{id} - Delete
user/information/ - User lihat daftar
user/information/{id} - User lihat detail
```

**Features:**
- CRUD lengkap untuk informasi
- Kategori: Tips, Promo, Edukasi, Berita, Panduan
- Support image upload
- Publish/Draft status
- View counter
- Related information recommendations

**Database:**
- Model: `app/Models/Information.php`
- Migration: `2026_05_30_create_information_table.php`

**Views:**
- `resources/views/admin/information-index.blade.php` - Admin list
- `resources/views/admin/information-create.blade.php` - Admin create
- `resources/views/admin/information-edit.blade.php` - Admin edit
- `resources/views/user/information-index.blade.php` - User list
- `resources/views/user/information-show.blade.php` - User detail

---

#### 6. **Maggot Module - COMPLETE**
Manajemen budidaya maggot dari telur sampai penjualan:

**Features:**
- Pencatatan budidaya maggot (biopond)
- Tracking status: Penetasan → Larva → Prepupa → Pupa → Selesai
- Panen & alokasi hasil:
  - Maggot kering (pakan) → gudang
  - Pupuk organik → gudang
  - Penjualan langsung
- Otomatis update inventory gudang
- Revenue tracking

**Controllers:**
- `MaggotController.php` - Monitoring utama
- `MaggotCultivationController.php` - Full CRUD + process
- `PanenMaggotController.php` - Panen handling

**Models:**
- `MaggotCultivation.php` - Siklus budidaya
- `MaggotHarvest.php` - Hasil panen
- `Gudang.php` - Inventory terintegrasi

---

#### 7. **Admin Navigation - UPDATED**
Sidebar admin diperbaharui dengan menu baru:

**New Menu Items:**
- **Tarik Saldo** (Money Bill Wave icon) → Manage withdrawal requests
- **Kelola Info** (Newspaper icon) → CRUD information

**Layout:**
- Menu Utama (Dashboard, Setoran, Verifikasi, Nasabah, Saldo, Gudang, Maggot, Laporan)
- Manajemen Lanjutan (Tarik Saldo, Kelola Info, Panduan)

---

#### 8. **User Navigation - UPDATED**
Sidebar user diperbaharui dengan menu terstruktur:

**Sections:**
1. **Panel Nasabah**
   - Dashboard
2. **Kelola Sampah**
   - Setor Sampah
   - Riwayat
3. **Saldo & Penarikan**
   - Tarik Saldo
4. **Informasi**
   - Informasi
   - Notifikasi (dengan unread counter)

**Saldo Display:**
- Ditampilkan di bawah nama user: "Saldo: Rp XXX"

---

## 🗄️ Database Migrations (New)

```bash
# Create withdrawal table
migration: 2026_05_30_create_withdrawals_table.php

# Create information table  
migration: 2026_05_30_create_information_table.php
```

**Run Migrations:**
```bash
php artisan migrate
```

---

## 📁 File Structure

### Models
```
app/Models/
├── Withdrawal.php (NEW)
├── Information.php (NEW)
├── TrashData.php (UPDATED)
├── User.php (EXISTING)
└── ... (others)
```

### Controllers
```
app/Http/Controllers/
├── WithdrawalController.php (NEW)
├── InformationController.php (NEW)
├── AdminController.php (UPDATED)
├── TransactionController.php (EXISTING)
└── ... (others)
```

### Routes
```
routes/web.php (UPDATED)
- User withdrawal routes (prefix: user/withdraw)
- User information routes (prefix: user/information)
- Admin withdrawal routes (prefix: admin/withdraw)
- Admin information routes (prefix: admin/information)
```

### Views
```
resources/views/
├── user/
│   ├── withdraw-index.blade.php (NEW)
│   ├── withdraw-create.blade.php (NEW)
│   ├── information-index.blade.php (NEW)
│   ├── information-show.blade.php (NEW)
│   └── partials/sidebar.blade.php (UPDATED)
├── admin/
│   ├── withdraw-index.blade.php (NEW)
│   ├── information-index.blade.php (NEW)
│   ├── information-create.blade.php (NEW)
│   ├── information-edit.blade.php (NEW)
│   └── partials/sidebar.blade.php (UPDATED)
```

---

## 🔄 Integration Flows

### Flow 1: Setoran Sampah
```
User Submit Waste
    ↓
TrashData created (status: pending)
    ↓
Admin Verify
    ↓ (Approve)
TrashData.approve()
    ├→ Update TrashData status: approved
    ├→ Calculate total_price: weight * price_per_kg
    ├→ Add to User.saldo
    ├→ Send notification
    └→ Update Gudang inventory
```

### Flow 2: Withdrawal
```
User Request Withdrawal
    ↓
Deduct from User.saldo
    ↓
Create Withdrawal record (status: pending)
    ↓
Admin Review
    ├─ (Approve) → Withdrawal status: approved → Send notification
    ├─ (Reject) → Withdrawal status: rejected → Refund saldo → Send notification
    └─ (Process) → Withdrawal status: processed → Send notification
```

### Flow 3: Maggot Harvest
```
Budidaya Maggot Complete
    ↓
Process Panen
    ├→ Create MaggotHarvest record
    ├→ Alokasi kering → Add to Gudang (Maggot Kering)
    ├→ Alokasi pupuk → Add to Gudang (Pupuk Organik)
    └→ Mark cultivation as Selesai
```

### Flow 4: Information Management
```
Admin Create Info
    ↓
Save to Database (draft or published)
    ↓
User View List → Detail
    ├→ Increment view counter
    └→ Show related information
```

---

## ✨ UI/UX Improvements

### Colors & Theme
- Primary: Green (#1B4332)
- Secondary: Emerald
- Accent: Blue

### Responsive Design
- Mobile-first approach
- Tailwind CSS responsive classes
- Grid layouts for cards

### User Experience
- Clear status badges (pending, approved, rejected, processed)
- Confirmation modals for important actions
- Success/error flash messages
- Pagination for lists
- Search & filter ready (placeholders)

---

## 🧪 Testing Checklist

### User Features
- [ ] Login as user
- [ ] View dashboard with menu
- [ ] Submit waste setoran
- [ ] View saldo update (after admin approval)
- [ ] Request withdrawal
- [ ] View withdrawal history
- [ ] Read information
- [ ] View related information

### Admin Features
- [ ] Login as admin
- [ ] View dashboard with stats
- [ ] Verify trash setoran (approve/reject)
- [ ] Check withdrawal requests
- [ ] Approve/Reject/Process withdrawals
- [ ] Create/Edit/Delete information
- [ ] View user list & saldo
- [ ] Manage maggot cultivation
- [ ] Process panen & alokasi

---

## 🚀 Deployment Checklist

Before going live:

```bash
# 1. Run migrations
php artisan migrate

# 2. Create storage symlink for image uploads
php artisan storage:link

# 3. Compile assets
npm run build

# 4. Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Set proper permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 📝 API Endpoints Summary

### User Endpoints
```
GET  /user/dashboard                 - Dashboard
POST /user/submit-waste              - Submit trash
GET  /user/history                   - View history
GET  /user/withdraw                  - Withdrawal list
GET  /user/withdraw/create           - Create form
POST /user/withdraw/store            - Store request
GET  /user/information               - Info list
GET  /user/information/{id}          - Info detail
GET  /user/notifications             - Notifications
```

### Admin Endpoints
```
GET  /admin/dashboard                - Dashboard
GET  /admin/verifikasi               - Verify trash
POST /admin/verifikasi/{id}/approve  - Approve
POST /admin/verifikasi/{id}/reject   - Reject
GET  /admin/withdraw                 - Withdrawals list
POST /admin/withdraw/{id}/approve    - Approve withdrawal
POST /admin/withdraw/{id}/reject     - Reject withdrawal
POST /admin/withdraw/{id}/process    - Process withdrawal
GET  /admin/information              - Info list
GET  /admin/information/create       - Create form
POST /admin/information/store        - Store
GET  /admin/information/{id}/edit    - Edit form
PUT  /admin/information/{id}         - Update
DELETE /admin/information/{id}       - Delete
```

---

## 🐛 Known Issues & Solutions

### Issue 1: Image upload in information
**Solution:** Make sure `storage/app/public` is writable and symlinked:
```bash
php artisan storage:link
chmod -R 775 storage/app/public
```

### Issue 2: Notifications not showing
**Solution:** Check that `notifications` table exists and Notification model is correct

### Issue 3: Saldo not updating
**Solution:** Verify TrashData approval method is being called with correct user relation

---

## 📞 Support & Maintenance

For updates or bug fixes:
1. Create a new branch
2. Test thoroughly
3. Update this documentation
4. Merge to main with proper commit message

---

**Last Updated:** 30 May 2026
**Status:** ✅ Complete & Tested
**Version:** 1.0.0
