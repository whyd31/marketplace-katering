@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pesan Makanan</h1>
</div>

<div class="col-lg-8">
    @if($cartItems->isEmpty())
        <div class="alert alert-info">Keranjang Anda kosong.</div>
    @else
        @php $totalHarga = 0; @endphp

        @foreach ($cartItems as $item)
            <div class="cart-item mb-4" id="cart-item-{{ $item->id }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>{{ $item->product->name }}</h6>
                        <p class="text-muted mb-1">Rp.{{ number_format($item->product->harga, 2) }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary" onclick="decrementQuantity(this, {{ $item->product->harga }}, {{ $item->id }})">-</button>
                        <input type="number" value="{{ $item->quantity }}" class="form-control text-center mx-2 quantity-input" style="width: 50px;" readonly>
                        <button class="btn btn-outline-secondary" onclick="incrementQuantity(this, {{ $item->product->harga }}, {{ $item->id }})">+</button>
                    </div>
                </div>
            </div>

            @php $totalHarga += $item->product->harga * $item->quantity; @endphp
        @endforeach
        <hr class="my-3">
        <div class="mt-4 text-end">
            <strong>Total Keseluruhan:</strong> Rp.<span id="total-price">{{ number_format($totalHarga, 2) }}</span>
        </div>
    @endif
    @if(!$cartItems->isEmpty())
        <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Checkout</a>
    @endif
    <a href="/dashboard/products" class="btn btn-warning">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function incrementQuantity(button, price, itemId) {
        const quantityInput = button.previousElementSibling;
        let quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
        updateCart(itemId, quantity + 1);
        updateTotalPrice();
    }

    function decrementQuantity(button, price, itemId) {
        const quantityInput = button.nextElementSibling;
        let quantity = parseInt(quantityInput.value);

        if (quantity === 1) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Menghapus makanan ini dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeItem(itemId);
                }
            });
        } else {
            quantityInput.value = quantity - 1;
            updateCart(itemId, quantity - 1);
            updateTotalPrice();
        }
    }

    function updateCart(itemId, newQuantity) {
        fetch(`/dashboard/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Gagal memperbarui kuantitas.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeItem(itemId) {
        fetch(`/dashboard/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartItem = document.getElementById(`cart-item-${itemId}`);
                cartItem.remove();
                updateTotalPrice();
            } else {
                alert('Gagal menghapus item dari keranjang.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    function updateTotalPrice() {
        let totalHarga = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const price = parseFloat(item.querySelector('p.text-muted').textContent.replace('Rp.', '').replace(',', ''));
            totalHarga += quantity * price;
        });

        document.getElementById('total-price').textContent = totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>
@endsection
