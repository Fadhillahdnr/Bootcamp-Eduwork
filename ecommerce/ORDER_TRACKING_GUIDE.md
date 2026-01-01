# Fitur Riwayat Pesanan & Tracking Pesanan

## 📋 Ringkasan
Sistem riwayat pesanan memungkinkan user melihat semua pesanan mereka dan adminnya dapat memperbarui status pesanan secara real-time. User dapat melihat timeline status pesanan dengan visual yang menarik.

---

## 🎯 Fitur yang Ditambahkan

### 1. **User - Halaman Riwayat Pesanan**
- **Route**: `/orders` (route name: `user.orders`)
- **Controller**: `UserOrderController@history`
- **View**: `user/orderhistory.blade.php`
- **Fitur**:
  - Menampilkan daftar semua pesanan user yang login
  - Sortir berdasarkan tanggal terbaru
  - Status pesanan dengan color badge
  - Tombol "Detail" untuk melihat detail pesanan

### 2. **User - Halaman Detail Pesanan**
- **Route**: `/orders/{id}` (route name: `user.orders.detail`)
- **Controller**: `UserOrderController@detail`
- **View**: `user/orderdetail.blade.php`
- **Fitur**:
  - Tampilkan info pengiriman (nama, alamat, telepon)
  - Timeline status pesanan dengan visual menarik
  - Detail produk yang dipesan
  - Total pesanan
  - Info metode pembayaran
  - Tombol untuk lanjut belanja

### 3. **Admin - Update Status Pesanan**
- **Route**: `POST /admin/orders/{id}/status` (route name: `admin.orders.status`)
- **Controller**: `OrderController@updateStatus`
- **Status Tersedia**:
  - ⏳ Menunggu Pembayaran
  - ⚙️ Diproses
  - 🚚 Dikirim
  - ✅ Selesai
  - ❌ Dibatalkan

### 4. **Admin - Tampilan Order Management**
- **Daftar Pesanan** (`admin.orders`):
  - Pagination (15 per halaman)
  - Sorting berdasarkan tanggal terbaru
  - Filter status dengan color badge
  - Informasi pembeli dan email
  
- **Detail Pesanan** (`admin.orders.show`):
  - Info lengkap pembeli
  - Form update status dengan dropdown
  - Tabel detail produk
  - Total pesanan

---

## 🔄 Flow Pesanan

```
User Checkout
    ↓
Order Dibuat (Status: diproses/menunggu pembayaran)
    ↓
Admin Lihat Pesanan di Admin Dashboard
    ↓
Admin Update Status → Dikirim
    ↓
User Melihat Update di Halaman Riwayat
    ↓
Admin Update Status → Selesai
    ↓
Pesanan Selesai
```

---

## 🗂️ File yang Diubah/Dibuat

### Baru Dibuat:
- `app/Http/Controllers/UserOrderController.php` - Controller untuk user order
- `resources/views/user/orderdetail.blade.php` - Detail pesanan user

### Diubah:
- `routes/web.php` - Tambah routes untuk user order
- `app/Http/Controllers/Admin/OrderController.php` - Update dengan validasi status
- `resources/views/admin/orders/show.blade.php` - Improved UI
- `resources/views/admin/orders/index.blade.php` - Improved UI
- `resources/views/user/orderhistory.blade.php` - Buat halaman riwayat
- `resources/views/layouts/navbar.blade.php` - Tambah link riwayat pesanan
- `resources/views/user/dashboard.blade.php` - Tambah shortcut ke riwayat pesanan

---

## 🔐 Security

1. **User Authorization**:
   - User hanya bisa melihat pesanan mereka sendiri
   - Query menggunakan `where('user_id', Auth::id())`
   - Method `firstOrFail()` untuk validasi ownership

2. **Admin Only**:
   - Update status hanya bisa dilakukan oleh admin
   - Middleware `role:admin` melindungi route admin

3. **Validation**:
   - Status hanya bisa diubah ke status yang valid
   - Validasi: `'in:menunggu pembayaran,diproses,dikirim,selesai,dibatalkan'`

---

## 📊 Status Pesanan

| Status | Icon | Warna | Keterangan |
|--------|------|-------|-----------|
| Menunggu Pembayaran | ⏳ | Danger | Espera pembayaran dari customer |
| Diproses | ⚙️ | Warning | Admin sedang menyiapkan |
| Dikirim | 🚚 | Info | Dalam perjalanan |
| Selesai | ✅ | Success | Pesanan diterima |
| Dibatalkan | ❌ | Secondary | Pesanan dibatalkan |

---

## 📱 User Interface

### Halaman Riwayat Pesanan
```
┌─────────────────────────────────────────────────────┐
│ 📦 Riwayat Pesanan Saya                      [← Kembali]│
├─────────────────────────────────────────────────────┤
│ Tabel dengan kolom:                                  │
│ - ID Pesanan                                         │
│ - Tanggal                                            │
│ - Total                                              │
│ - Metode Pembayaran                                  │
│ - Status (dengan badge warna)                        │
│ - Tombol Detail                                      │
└─────────────────────────────────────────────────────┘
```

### Halaman Detail Pesanan
```
┌──────────────────────────────────────────────────────┐
│ 📋 Detail Pesanan #123              [← Kembali ke Riwayat]│
├──────────────┬──────────────────────────────────────┤
│ Informasi    │ Status Pesanan                       │
│ Pengiriman   │ [Timeline dengan progress]           │
├──────────────┴──────────────────────────────────────┤
│ Detail Produk (Tabel)                                │
├──────────────────────────────────────────────────────┤
│ [Lanjut Belanja] [Lihat Semua Pesanan]              │
└──────────────────────────────────────────────────────┘
```

---

## 🚀 Testing Checklist

### User Testing:
- [ ] Login dan pergi ke halaman Riwayat Pesanan
- [ ] Verifikasi daftar pesanan user ditampilkan
- [ ] Klik Detail pesanan
- [ ] Verifikasi timeline status ditampilkan
- [ ] Verifikasi info pengiriman lengkap
- [ ] Verifikasi detail produk sesuai
- [ ] Logout dan login user lain - verifikasi pesanan berbeda

### Admin Testing:
- [ ] Login sebagai admin
- [ ] Pergi ke Admin Dashboard → Orders
- [ ] Verifikasi daftar semua pesanan ditampilkan
- [ ] Klik Detail pesanan
- [ ] Ubah status pesanan
- [ ] Verifikasi pesan success muncul
- [ ] Logout dan login sebagai user - verifikasi status terupdate

### Edge Cases:
- [ ] User tanpa pesanan - verifikasi pesan "Belum ada pesanan"
- [ ] Admin mencoba akses order user lain - verifikasi access granted
- [ ] Invalid order ID - verifikasi error 404

---

## 🔧 Database Queries

### Melihat semua pesanan user:
```sql
SELECT * FROM orders WHERE user_id = 1 ORDER BY created_at DESC;
```

### Melihat detail pesanan:
```sql
SELECT * FROM orders o
JOIN order_items oi ON o.id = oi.order_id
WHERE o.id = 1 AND o.user_id = 1;
```

### Update status pesanan:
```sql
UPDATE orders SET status = 'dikirim' WHERE id = 1;
```

---

## 💡 Tips

1. **Untuk customer notification**: Bisa ditambahkan email notification saat status berubah
2. **Untuk tracking**: Bisa ditambahkan nomor resi/tracking number
3. **Untuk review**: Bisa ditambahkan fitur review produk setelah pesanan selesai
4. **Untuk pembayaran**: Bisa ditambahkan payment gateway integration

---

## 📞 Support

Untuk pertanyaan atau masalah, hubungi admin atau cek logs di `storage/logs/laravel.log`
