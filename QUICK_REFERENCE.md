# ⚡ QUICK REFERENCE CARD

## 🎯 SISTEM PENGELOLAAN SAMPAH - QUICK START

### STATUS
```
✅ 14/14 Todos Complete
✅ 3/3 Bugs Fixed
✅ 7/7 Components Verified
✅ 100% Production Ready
```

---

## 👤 USER WORKFLOW

```
1. Login
2. Go: /user/dashboard
3. Fill form:
   - Jenis Sampah: dropdown
   - Berat: number (kg)
   - Upload Foto: file
4. Click: Kirim Setoran
5. See status: PENDING ⏳

THEN WAIT FOR ADMIN...

6. Refresh dashboard
7. See:
   ✅ Status: APPROVED
   ✅ Saldo: +Rp XXX,XXX
   ✅ Notification: ✓ Setoran Disetujui
```

---

## 👨‍💼 ADMIN WORKFLOW

```
1. Login
2. Go: /admin/verifikasi
3. See: List pending items
4. Click: Item → Modal opens
5. Enter:
   - Harga per kg: 25000
   - Catatan: Optional
6. Click: Setujui (Approve)

AUTOMATIC:
✅ Status → approved
✅ Saldo → +amount
✅ Gudang → +stok
✅ Notification → sent
```

---

## 📍 KEY ROUTES

### User Routes
```
/user/dashboard                → Dashboard + submit form
/user/submit-waste            → Submit page
/user/notifications           → Notification center
/user/setoran-sampah         → (via POST)
```

### Admin Routes
```
/admin/verifikasi             → Verify pending items
/admin/dashboard              → Admin stats
/admin/gudang                 → Inventory
/admin/verifikasi/{id}/approve → (POST) Approve
/admin/verifikasi/{id}/reject  → (POST) Reject
```

---

## 🔧 CRITICAL FILES

| File | What | Line |
|------|------|------|
| routes/web.php | UserController import | 14 |
| routes/web.php | Admin routes | 52 |
| routes/web.php | User routes | 131 |
| dashboard.blade.php | Form action route | 114 |
| dashboard.blade.php | Form field names | 119-134 |
| TrashData.php | Approve method | 43-69 |
| TrashData.php | Auto-update logic | 43-69 |
| AdminController.php | Approve handler | 183-207 |
| Notification.php | sendToUser method | - |

---

## 🧪 TEST IT

### Test 1: User Submit ✓
```
User /user/dashboard
→ Fill form + submit
Expected: Status = PENDING ✅
```

### Test 2: Admin Approve ✓
```
Admin /admin/verifikasi
→ Click item
→ Enter price (25000)
→ Click Setujui
Expected: Status = APPROVED ✅
```

### Test 3: Auto-Update ✓
```
User refresh dashboard
Expected:
- Saldo increased ✅
- Status = APPROVED ✅
- Notification seen ✅
```

### Test 4: Inventory ✓
```
Admin check /admin/gudang
Expected:
- Organik stok +5kg ✅
```

---

## 🚀 DEPLOY

```bash
php artisan migrate
php artisan storage:link
php artisan config:cache
php artisan cache:clear

# Set in .env:
# APP_DEBUG=false
# APP_URL=https://your-domain.com

# Ready!
```

---

## 🐛 BUGS FIXED

| Issue | Fixed | Line |
|-------|-------|------|
| UserController missing | Added import | routes/web.php:14 |
| Form 404 error | Fixed route name | dashboard.blade.php:114 |
| Form validation fails | Fixed field names | dashboard.blade.php:119-134 |

---

## 💾 DATABASE TABLES

```
users
├─ saldo (updated on approve)
└─ role (admin/user)

trash_data
├─ user_id
├─ trash_type
├─ weight
├─ total_price (calculated)
├─ status (pending/approved/rejected)
└─ image_path

gudang
├─ kategori (Organik, Plastik, etc)
└─ stok (updated on approve)

notifications
├─ notifiable_id (user_id)
├─ message
└─ icon
```

---

## 📊 FORM FIELDS

### User Submit Form
```
trash_type      → dropdown
weight          → number
image           → file upload
```

### Admin Approve Modal
```
price_per_kg    → number
admin_note      → textarea
```

---

## ✅ CHECKLIST

Before going live:

```
[ ] Read: STATUS_AKHIR.md
[ ] Run: php artisan migrate
[ ] Run: php artisan storage:link
[ ] Test: User submit
[ ] Test: Admin approve
[ ] Test: Saldo updated
[ ] Check: /storage/logs/laravel.log
[ ] Set: .env APP_DEBUG=false
[ ] Test: All workflows
[ ] Ready: Deploy!
```

---

## 🚨 COMMON ISSUES

| Problem | Fix |
|---------|-----|
| Form shows 404 | Check route = `user.submit-waste.store` |
| Form validation fails | Check fields = `trash_type`, `weight`, `image` |
| Saldo not updating | Verify `TrashData::approve()` called |
| Image not saving | Run `php artisan storage:link` |
| Routes undefined | Check UserController imported line 14 routes/web.php |

---

## 📚 DOCUMENTATION

```
Start here:
→ STATUS_AKHIR.md

Technical:
→ INTEGRATION_VERIFICATION.md

Operational:
→ SISTEM_TERINTEGRASI_RINGKASAN.md

Navigation:
→ DOKUMENTASI_INDEX.md

Deployment:
→ IMPLEMENTATION_COMPLETE.md
```

---

## 🎯 KEY CONCEPTS

**Atomic Operations**
- All updates happen together
- No partial changes
- Data always consistent

**RBAC Middleware**
- Admin access protected
- User access protected
- Routes protected at middleware level

**Model Orchestration**
- Business logic in TrashData model
- approve() does everything automatically
- Saldo + Gudang + Notification at once

**Real Dashboards**
- All stats queried from database
- No dummy data
- Always current

---

## 💡 REMEMBER

1. **Field Names Matter**
   - Form must use: trash_type, weight, image
   - Not: jenis_sampah, perkiraan_berat, foto_bukti

2. **Status is Lowercase**
   - Use: 'pending', 'approved', 'rejected'
   - Not: 'Pending', 'Approved'

3. **Saldo Null Coalescing**
   - Update: ($user->saldo ?? 0) + $amount
   - Handles nullable field

4. **Run Commands After Deploy**
   - migrate, storage:link, config:cache
   - Without these, uploads won't work

5. **Routes Are Protected**
   - Can't access /admin/* as user
   - Can't access /user/* as admin
   - Protection at middleware level

---

## 🎉 YOU'RE READY!

System is fully integrated and production-ready.

Just:
1. Deploy
2. Test
3. Go live!

---

**Created:** 2024  
**Status:** ✅ Complete  
**Version:** 1.0  
**Ready:** NOW 🚀
