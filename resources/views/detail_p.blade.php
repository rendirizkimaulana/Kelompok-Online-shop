@extends('layouts.app')

@section('content')

  <section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{ asset('assets/') }}/{{ $data_baju->gambar }}" />
          </div>
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
              {{ $data_baju->nama }}
            </h4>
            <div class="mb-3">
              <span class="h1" id="harga"></span>
              <span class="text-muted">/per box</span><br>
              <label class="mt-2 fw-bold">Stok</label>
              <span id="stok"></span>
            </div>

            <p>
             {{ $data_baju->deskripsi }}
            </p>

            {{-- <div class="row">
              <dt class="col-3">Type:</dt>
              <dd class="col-9">Regular</dd>

              <dt class="col-3">Color</dt>
              <dd class="col-9">Brown</dd>

              <dt class="col-3">Material</dt>
              <dd class="col-9">Cotton, Jeans</dd>

              <dt class="col-3">Brand</dt>
              <dd class="col-9">Reebook</dd>
            </div> --}}

            <hr />

            <div class="row mb-4">
                <div class="col-md-4 col-6">
                  <label class="mb-2">Size</label>
                  <select id="sizeSelect" class="form-select border border-secondary" style="height: 35px;">
                    @foreach ($size as $ukuran)
                      <option data-harga="{{ $ukuran->harga }}" data-stok="{{ $ukuran->stok }}" value="{{ $ukuran->size }}">{{ $ukuran->size }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 col-6">
                </div>
              </div>

              @guest
                <a href="{{ route('login') }}" class="btn btn-success shadow-0"><i class="bi bi-cart-check-fill mx-2"></i> Masuk untuk Beli</a>
              @else
                <a id="checkoutLink" class="btn btn-success shadow-0">
                  <i class="bi bi-cart-check-fill mx-2"></i> Beli Sekarang
                </a>
              @endguest

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const sizeSelect = document.getElementById('sizeSelect');
                  const checkoutLink = document.getElementById('checkoutLink');

                  sizeSelect.addEventListener('change', function() {
                    const selectedSize = sizeSelect.value;
                    const baseUrl = "{{ url('') }}/{{ encrypt($data_baju->id) }}";
                    checkoutLink.href = `${baseUrl}/${selectedSize}/{{ encrypt($data_baju->id) }}/checkout`;
                  });

                  sizeSelect.dispatchEvent(new Event('change'));
                });
              </script>
          </div>
        </main>
      </div>
    </div>
  </section>
  <script>
    function formatRupiah(angka) {
        var number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp' + rupiah;
    }

    document.getElementById('sizeSelect').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        var harga = selectedOption.getAttribute('data-harga');
        var stok = selectedOption.getAttribute('data-stok');

        // Update nilai span harga dan stok
        document.getElementById('harga').textContent = formatRupiah(harga);
        document.getElementById('stok').textContent = stok;
    });

    document.getElementById('sizeSelect').dispatchEvent(new Event('change'));
</script>
@endsection
