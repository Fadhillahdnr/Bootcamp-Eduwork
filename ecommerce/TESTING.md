# Panduan Testing - Persistent Cart System

## Setup Awal
1. Pastikan server sudah berjalan: `php artisan serve`
2. Akses aplikasi: http://127.0.0.1:8000

## Test Case 1: Cart Persistence Saat Logout
**Tujuan**: Verifikasi cart tidak hilang setelah logout dan login kembali

Steps:
1. Buka aplikasi dan login dengan email/password
2. Pergi ke halaman Produk
3. Tambahkan 2-3 produk ke cart
4. Catat jumlah produk di cart
5. Click tombol "Logout"
6. Login kembali dengan akun yang sama
7. Pergi ke halaman Cart
8. **EXPECTED**: Produk yang ditambahkan sebelumnya masih ada dengan qty yang sama ✅

## Test Case 2: Modify Cart Items
**Tujuan**: Verifikasi dapat mengubah qty dan menghapus items

Steps:
1. Login ke aplikasi
2. Pergi ke Cart
3. Click tombol + untuk increase qty
4. Verifikasi total harga berubah
5. Click tombol - untuk decrease qty
6. Click tombol "Hapus" untuk remove item
7. **EXPECTED**: Semua operasi berhasil tanpa error ✅

## Test Case 3: Checkout Process
**Tujuan**: Verifikasi checkout berhasil dan cart cleared (items dihapus, bukan cart)

Steps:
1. Pastikan ada items di cart (minimal 1 produk)
2. Click tombol "Checkout"
3. Isi form data pembeli:
   - Nama: (akan pre-fill dari user yang login)
   - Alamat: Jl. Test 123
   - No HP: 08123456789
   - Metode: Pilih "COD (Bayar di Tempat)" atau "Transfer Bank"
4. Click "Lanjutkan Checkout"
5. Verifikasi berhasil dengan message "Pesanan berhasil dibuat"
6. Redirect ke dashboard
7. Pergi ke halaman Cart
8. **EXPECTED**: Cart kosong (items hilang, bukan cart-nya) ✅

## Test Case 4: Checkout Dengan Cart Kosong
**Tujuan**: Verifikasi error handling untuk cart kosong

Steps:
1. Clear semua items dari cart
2. Coba akses halaman checkout
3. **EXPECTED**: Di-redirect ke halaman cart dengan message error ✅

## Test Case 5: Add Product After Checkout
**Tujuan**: Verifikasi dapat belanja lagi setelah checkout

Steps:
1. Setelah checkout berhasil
2. Pergi ke halaman Produk
3. Tambahkan produk ke cart
4. Pergi ke halaman Cart
5. **EXPECTED**: Produk baru ada di cart ✅

## Test Case 6: Form Validation
**Tujuan**: Verifikasi form validation di checkout

Steps:
1. Pergi ke checkout dengan items di cart
2. Coba submit form tanpa mengisi field:
   - Kosongkan "Nama"
   - Kosongkan "Alamat"
   - Kosongkan "No HP"
   - Jangan pilih Metode Pembayaran
3. Click "Lanjutkan Checkout"
4. **EXPECTED**: Form menampilkan error messages untuk field yang kosong ✅

## Test Case 7: Security - Invalid Cart Access
**Tujuan**: Verifikasi user tidak bisa access/modify cart user lain

Steps:
1. Catat Cart ID dan CartItem ID dari 1 user
2. Login dengan user yang berbeda
3. Coba akses URL: `/cart/increase/{cartitem_id_dari_user_lain}`
4. **EXPECTED**: Error message "Tidak diizinkan" ✅

## Error Messages yang Mungkin Muncul (NORMAL)
- "Keranjang masih kosong" - Ketika checkout dengan cart kosong
- "Produk ditambahkan ke keranjang" - Ketika produk berhasil ditambahkan
- "Jumlah produk ditambahkan" - Ketika menambah qty produk yang sudah ada
- "Jumlah ditambah" - Ketika klik tombol +
- "Jumlah dikurangi" - Ketika klik tombol -
- "Produk dihapus dari keranjang" - Ketika klik hapus
- "Pesanan berhasil dibuat" - Ketika checkout berhasil
- "Terjadi kesalahan" - Ketika ada error server

## Database Queries untuk Debug (jika diperlukan)

Lihat semua cart user:
```
SELECT * FROM carts;
```

Lihat semua cart items user:
```
SELECT ci.*, p.name, p.price FROM cart_items ci
JOIN products p ON ci.product_id = p.id
WHERE ci.cart_id = 1; // ganti 1 dengan cart_id
```

Lihat semua orders user:
```
SELECT * FROM orders WHERE user_id = 1; // ganti 1 dengan user_id
```

Lihat order items:
```
SELECT * FROM order_items WHERE order_id = 1; // ganti 1 dengan order_id
```

## Success Criteria
✅ Cart tidak hilang saat logout/login kembali
✅ Cart items dapat diubah (qty increase/decrease/remove)
✅ Checkout berhasil dan order tersimpan
✅ Cart items di-clear setelah checkout (cart itself persist)
✅ Dapat belanja lagi setelah checkout
✅ Validasi form working correctly
✅ Error messages muncul di halaman
✅ Security check working (user tidak bisa access cart user lain)
