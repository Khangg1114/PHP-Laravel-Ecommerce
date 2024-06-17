<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cart
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Giỏ hàng của bạn</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (count($cartItems) > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên sản phẩm
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Giá
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Số lượng
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cartItems as $taskId => $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ $item['price'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <button onclick="decreaseQuantity({{ $taskId }})" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                                                -
                                            </button>
                                            <span style="margin-right: 8px;margin-left: 8px;">{{ $item['quantity'] }}</span>
                                            <button onclick="increaseQuantity({{ $taskId }})" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                                                +
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <button onclick="removeItem({{ $taskId }})" class="text-sm text-red-500 hover:text-red-700 focus:outline-none">
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    <h2 class="text-lg font-semibold mb-2">Tổng giá trị: ${{ $totalPrice }}</h2>
                    <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
                            Thanh toán
                        </button>
                    </form>
                @else
                    <p>Giỏ hàng trống.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function decreaseQuantity(taskId) {
        axios.post(`/cart/decrease/${taskId}`)
            .then(function (response) {
                // Xử lý thành công
                window.location.reload(); // Tải lại trang sau khi xử lý thành công
            })
            .catch(function (error) {
                console.error('Lỗi khi giảm số lượng:', error);
            });
    }

    function increaseQuantity(taskId) {
        axios.post(`/cart/increase/${taskId}`)
            .then(function (response) {
                // Xử lý thành công
                window.location.reload(); // Tải lại trang sau khi xử lý thành công
            })
            .catch(function (error) {
                console.error('Lỗi khi tăng số lượng:', error);
            });
    }

    function removeItem(taskId) {
        axios.post(`/cart/remove/${taskId}`)
            .then(function (response) {
                // Xử lý thành công
                window.location.reload(); // Tải lại trang sau khi xử lý thành công
            })
            .catch(function (error) {
                console.error('Lỗi khi xóa mục trong giỏ hàng:', error);
            });
    }
    function updateCart() {
    axios.get('/cart/total')
        .then(function (response) {
            const totalPrice = response.data.totalPrice;
            const totalPriceElement = document.getElementById('totalPrice');
            totalPriceElement.textContent = `$${totalPrice}`;
        })
        .catch(function (error) {
            console.error('Lỗi khi cập nhật tổng giá trị giỏ hàng:', error);
        });
}

    // Xử lý sự kiện submit form thanh toán
    document.getElementById('checkoutForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn chuyển hướng form mặc định
        axios.post(this.action, new FormData(this))
            .then(function (response) {
                alert('Thanh toán thành công!');
                window.location.reload(); // Tải lại trang sau khi thanh toán thành công
            })
            .catch(function (error) {
                console.error('Lỗi khi thanh toán:', error);
            });
    });
</script>
