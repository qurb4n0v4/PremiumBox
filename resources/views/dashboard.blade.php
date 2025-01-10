<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Hoş Geldiniz, {{ Auth::user()->name }}!</h1>

                <!-- Kullanıcı Bilgileri -->
                <div class="bg-gray-100 p-4 rounded shadow mb-6">
                    <h2 class="text-lg font-bold mb-2">Kullanıcı Bilgileri</h2>
                    <p><strong>Ad:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>E-posta:</strong> {{ Auth::user()->email }}</p>
                </div>

                <!-- Sepet (Cart) -->
                <div class="bg-gray-100 p-4 rounded shadow mb-6">
                    <h2 class="text-lg font-bold mb-2">Sepet</h2>
                    <ul>
{{--                        @foreach ($cartItems as $item)--}}
{{--                            <li>{{ $item->name }} - {{ $item->quantity }} x {{ $item->price }} ₺</li>--}}
{{--                        @endforeach--}}
                    </ul>
{{--                    <p class="mt-2"><strong>Toplam:</strong> {{ $cartTotal }} ₺</p>--}}
                </div>

                <!-- Sipariş Geçmişi -->
                <div class="bg-gray-100 p-4 rounded shadow mb-6">
                    <h2 class="text-lg font-bold mb-2">Sipariş Geçmişi</h2>
                    <ul>
{{--                        @foreach ($orders as $order)--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('order.details', $order->id) }}" class="text-blue-500">--}}
{{--                                    Sipariş #{{ $order->id }} - {{ $order->created_at->format('d-m-Y') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
                    </ul>
                </div>

                <!-- Sipariş Detayları -->
{{--                @isset($orderDetails)--}}
{{--                    <div class="bg-gray-100 p-4 rounded shadow">--}}
{{--                        <h2 class="text-lg font-bold mb-2">Sipariş Detayları</h2>--}}
{{--                        <p><strong>Sipariş ID:</strong> {{ $orderDetails->id }}</p>--}}
{{--                        <p><strong>Tarih:</strong> {{ $orderDetails->created_at->format('d-m-Y H:i') }}</p>--}}
{{--                        <p><strong>Ürünler:</strong></p>--}}
{{--                        <ul>--}}
{{--                            @foreach ($orderDetails->items as $item)--}}
{{--                                <li>{{ $item->name }} - {{ $item->quantity }} x {{ $item->price }} ₺</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <p class="mt-2"><strong>Toplam:</strong> {{ $orderDetails->total }} ₺</p>--}}
{{--                    </div>--}}
{{--                @endisset--}}
            </div>
        </div>
    </div>
</x-app-layout>
