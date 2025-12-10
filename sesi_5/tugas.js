 let cart = [];

function tambahKeKeranjang(index) {
  cart.push(products[index]);
  document.getElementById("cartCount").innerText = cart.length;
  alert("Produk ditambahkan ke keranjang ✅");
}

function toggleCart() {
  const modal = new bootstrap.Modal(document.getElementById("cartModal"));
  tampilkanKeranjang();
  modal.show();
}

function tampilkanKeranjang() {
  const cartItems = document.getElementById("cartItems");
  const cartTotal = document.getElementById("cartTotal");

  cartItems.innerHTML = "";
  let total = 0;

  cart.forEach((item, index) => {
    total += item.harga;
    cartItems.innerHTML += `
      <li class="list-group-item d-flex justify-content-between align-items-center">
        ${item.nama}
        <button class="btn btn-sm btn-danger" onclick="hapusItem(${index})">Hapus</button>
      </li>
    `;
  });

  cartTotal.innerText = "Rp " + total.toLocaleString();
}

function hapusItem(index) {
  cart.splice(index, 1);
  document.getElementById("cartCount").innerText = cart.length;
  tampilkanKeranjang();
}
 // ✅ ARRAY DATA PRODUK
  const products = [
  // ✅ SKINCARE
  {
    nama: "Sunscreen Wardah UV Shield Airy Smooth Sunscreen Serum (SPF 50) 40ml",
    harga: 47000,
    deskripsi: " Cocok untuk semua jenis kulit Sunscreen dengan hasil akhir powdery smooth matte, mudah meresap, nyaman dan ringan digunakan Diformulasikan dengan SkinboostDNA(TM) melindungi dan memperbaiki skin barrier hingga level DNA dari kerusakan yang timbul akibat sinar matahari seperti kulit terbakar, kusam, bintik hitam, radang, hingga penuaan dini Mengandung Centella dan Bera Mineral, kulit menjadi cerah dan halus Expiry Date 09/28 ",
    kategori: "Skincare",
    gambar: "img/wardahairy.png"
  },
  {
    nama: "Serum Wardah Symradiance 399 10% Niacinamide Bright & Barrier Repair Serum 30ml",
    harga: 67000,
    deskripsi: "Cocok untuk semua jenis kulit Diformulasikan dengan aktif CELL POWER bekerja hingga sel target untuk memperbaiki Hiperpigmentasi & Bekas Jerawat Symradiance 399: Generasi terbaru dari Symwhite377, 2x lebih efektif untuk mencerahkan kulit 10% Niacinamide: 2x lebih efektif menargetkan sel untuk menyamarkan bekas jerawat dan meratakan warna kulit Expiry Date 02/28",
    kategori: "Skincare",
    gambar: "img/wardahserum.png"
  },
  {
    nama: "Moisturizer Wardah Tranexamic ɑ-Arbutin + 5% Niacinamide Dark Spot Corrector Gel Moisturizer 30g",
    harga: 86000,
    deskripsi: "Cocok untuk semua jenis kulit Pelembap gel ringan dengan Tranexamic* ɑ-Arbutin yang secara tepat menargetkan dan menyamarkan intensitas dark spots Dengan tekstur ringan, kulit lembab, transparan, & cerah merata sebening kristal Tranexamic* ɑ-Arbutin: Combination of Tranexamic* & ɑ-Arbutin to conceal dark spots 5% Niacinamide: Synergizes with Tranexamic* & ɑ-Arbutin to help brighten hyperpigmentation 2% Silver Vine: Reduces dullness & boosts skin translucency Bisabolol: Soothes & evens out discoloration Expiry Date 03/27",
    kategori: "Skincare",
    gambar: "img/moistwardah.png"
  },

  // ✅ MAKE UP
  {
    nama: "Lipstik Matte",
    harga: 45000,
    deskripsi: "Warna tahan lama dan tidak luntur",
    kategori: "Make Up",
    gambar: "https://nihonmart.id/pub/media/catalog/product/cache/11ac1d1f1c987b7e84b3f488d403431e/s/a/satin_silky_lipstick_-_var-min.png"
  },
  {
    nama: "Bedak Wardah",
    harga: 55000,
    deskripsi: "Hasil halus dan natural",
    kategori: "Make Up",
    gambar: "https://nihonmart.id/pub/media/catalog/product/cache/11ac1d1f1c987b7e84b3f488d403431e/l/i/light_skin_filter_cushion_-_var-min.png"
  },
  {
    nama: "Maskara",
    harga: 50000,
    deskripsi: "Membuat bulu mata lebih lentik",
    kategori: "Make Up",
    gambar: "https://nihonmart.id/pub/media/catalog/product/cache/11ac1d1f1c987b7e84b3f488d403431e/i/n/instant_oversize_volume_mascara_30g-min.png"
  },

  // ✅ PARFUM
  {
    nama: "Parfum Kahf",
    harga: 78000,
    deskripsi: "Waterfall: Merupakan parfum dengan paduan aroma Aquatic dan Floral yang memberikan kesegaran nuansa air terjun. Dilengkapi dengan aroma Citrus dan Aromatik membawa kita ke dalam atmosfir yang penuh semangat selayaknya air memberikan energi pada setiap kehidupan.\n\n Forest: Merupakan parfum dengan kesatuan aroma dedaunan Cypress dan Cedarwood sehingga menyajikan kita suasana seperti saat menjelajah luasnya hutan. Sentuhan floral dan aromatiknya memberikan kesejukan untuk selalu mensyukuri indahnya ciptaan Tuhan.\n\n True Brotherhood: Merupakan parfum yang menghadirkan kehangatan aroma rempah Cinammon dan Tonka Beans bagaikan persaudaraan yang menemani perjalanan hidup. Dengan paduan kompleks Lavender, Citrus, serta Incense yang menyenangkan temani kita mereflekasikan arti penting kebersamaan.\n\n Revered Oud: Merupakan parfum yang menghadirkan aroma Oud dan Amber yang lekat dengan warisan tradisi budaya. Hint Gourmand dan Vanilla membawa kembali manisnya memori terdahulu. Sentuhan awal Rose membuat kita semakin cinta pada tempat kita bermula",
    kategori: "Parfum",
    gambar: "https://nihonmart.id/pub/media/catalog/product/cache/11ac1d1f1c987b7e84b3f488d403431e/e/d/edt_-_var-min.png"
  },
  {
    nama: "Parfum CAVE Summer Crush Extrait de Parfum - 50ml",
    harga: 250000,
    deskripsi: "Lightness, Versatile, and Enjoyable The warmth of summer is always a reason for men to find freshness amidst the touch of the sun. The richness of citrus makes this perfume the right choice to celebrate the euphoria of freshness itself. No need to feel overpowering, Summer Crush infuses it with geranium and lavender, making anyone who smells this aroma feel more calm down. To leave a trace in memory, vanilla is present as a soft base. All this combination brings a feeling of lightness, warmth and enjoying the moment",
    kategori: "Parfum",
    gambar: "https://d2kchovjbwl1tk.cloudfront.net/vendor/9962/product/Summer_Crush_1753769671506_resized2048-png.webp"
  },
  {
    nama: "CAVE Freezy Forest Extrait de Parfum - 50ml",
    harga: 250000,
    deskripsi: "Greeny, Musky, and Calming There's nothing more calming than a freshly rained forest with citrus drops. The combination of the scent of wet green leaves and damp tree branches brings a natural freshness. It ignites a man's instinct to explore his charismatic side. Through the greeny aroma and wrapped with musky as the finishing touch, it emphasizes the mysterious character of men.",
    kategori: "Parfum",
    gambar: "https://d2kchovjbwl1tk.cloudfront.net/vendor/9962/product/Freezy_Forest_1753770049262_resized2048-png.webp"
  }
];

  const productList = document.getElementById("productList");
  const filterKategori = document.getElementById("filterKategori");
  const sortHarga = document.getElementById("sortHarga");
  const searchProduk = document.getElementById("searchProduk");

  // ✅ FUNCTION TAMPILKAN PRODUK
  function tampilkanProduk(data) {
    productList.innerHTML = "";

    data.forEach((product, index) => {
    productList.innerHTML += `
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="${product.gambar}" class="card-img-top" alt="${product.nama}">
          <div class="card-body">
            <h5 class="card-title">${product.nama}</h5>
            <p class="card-text deskripsi" data-full="${product.deskripsi}">
              ${product.deskripsi.substring(0, 120)}...
              <span class="baca-selengkapnya">Baca selengkapnya</span>
            </p>
            <p class="fw-bold text-success">
              Rp ${product.harga.toLocaleString()}
            </p>
            <span class="badge bg-primary">${product.kategori}</span>
            <button class="btn btn-danger mt-3 w-100" onclick="tambahKeKeranjang(${index})">
              🛒 Beli
            </button>
          </div>
        </div>
      </div>
    `;
  });
}
  tampilkanProduk(products);

  // ✅ FILTER + SORT + SEARCH
  function prosesFilter() {
    let hasil = [...products];

    // Filter Kategori
    const kategori = filterKategori.value;
    if (kategori !== "all") {
      hasil = hasil.filter(p => p.kategori === kategori);
    }

    // Search Produk
    const keyword = searchProduk.value.toLowerCase();
    hasil = hasil.filter(p => p.nama.toLowerCase().includes(keyword));

    // Sort Harga
    const sort = sortHarga.value;
    if (sort === "asc") {
      hasil.sort((a, b) => a.harga - b.harga);
    } else if (sort === "desc") {
      hasil.sort((a, b) => b.harga - a.harga);
    }

    tampilkanProduk(hasil);
  }

    document.addEventListener("click", function (e) {
    if (e.target.classList.contains("baca-selengkapnya")) {
      const parent = e.target.parentElement;
      const fullText = parent.getAttribute("data-full");

      if (e.target.innerText === "Baca selengkapnya") {
        parent.innerHTML = `${fullText} <span class="baca-selengkapnya">Tutup</span>`;
      } else {
        parent.innerHTML = `${fullText.substring(0, 120)}... <span class="baca-selengkapnya">Baca selengkapnya</span>`;
      }
    }
  });


  filterKategori.addEventListener("change", prosesFilter);
  sortHarga.addEventListener("change", prosesFilter);
  searchProduk.addEventListener("keyup", prosesFilter);