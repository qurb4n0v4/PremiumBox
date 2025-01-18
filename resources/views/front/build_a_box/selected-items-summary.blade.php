
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div id="selectionsSummary" class="selected-items-summary">
            @if(Session::has('selected_box'))
                @php $box = Session::get('selected_box'); @endphp
                <div class="selected-box">
                    <h4>Seçilmiş Qutu</h4>
                    <div class="item-details">
                        <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                        <img src="{{ asset('storage/' .  $box['box_image']) }}" alt="Box Image" style="width: 40px; height: 40px">
                        <div class="details">
                            <h5>{{ $box['box_name'] }}</h5>
                            <p>Fərdiləşdirmə: {{ $box['customization_text'] }}</p>
                            <p>Qiymət: ₼{{ $box['box_price'] }}</p>
                        </div>
                    </div>
                </div>
            @endif

                @if(Session::has('selected_item'))
                    @php $items = Session::get('selected_item'); @endphp
                    <div class="selected-item">
                        <h4>Seçilmiş Əşyalar</h4>
                        @if(is_array($items) && count($items) > 0)
                            @foreach($items as $index => $item)
                                <div class="item-details">
                                    <button class="remove-btn" onclick="removeSelection('item', {{ $index }})">&times;</button>
                                    <img src="{{ asset('storage/' . $item['item_image']) }}" alt="Item Image" class="main-item-image">
                                    <div class="details">
                                        <h5>{{ $item['item_name'] }}</h5>

                                        {{-- Show selected variant if exists --}}
                                        @if(isset($item['selected_variant']) && $item['selected_variant'])
                                            <p class="variant-info">
                                                <span class="info-label">Variant:</span>
                                                {{ $item['selected_variant'] }}
                                            </p>
                                        @endif

                                        {{-- Show custom text if exists --}}
                                        @if(isset($item['user_text']) && $item['user_text'])
                                            <p class="text-info">
                                                <span class="info-label">Mətn:</span>
                                                {{ $item['user_text'] }}
                                            </p>
                                        @endif

                                        {{-- Show uploaded images if exist --}}
                                        @if(isset($item['uploaded_images']) && !empty($item['uploaded_images']))
                                            <div class="uploaded-images">
                                                <p class="info-label">Yüklənmiş şəkillər:</p>
                                                <div class="image-thumbnails">
                                                    @foreach($item['uploaded_images'] as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Uploaded image" class="thumbnail">
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <p class="price">Qiymət: ₼{{ number_format($item['item_price'], 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Heç bir əşya seçilməyib.</p>
                        @endif
                    </div>

                    <style>
                        .selected-item {
                            padding: 15px;
                            background: #fff;
                            border-radius: 8px;
                            margin-top: 20px;
                        }

                        .item-details {
                            position: relative;
                            display: flex;
                            align-items: start;
                            padding: 15px;
                            border: 1px solid #eee;
                            border-radius: 8px;
                            margin-bottom: 10px;
                        }

                        .main-item-image {
                            width: 100px;
                            height: 100px;
                            object-fit: cover;
                            border-radius: 6px;
                            margin-right: 15px;
                        }

                        .details {
                            flex-grow: 1;
                        }

                        .info-label {
                            font-weight: 600;
                            color: #666;
                            margin-right: 5px;
                        }

                        .uploaded-images {
                            margin-top: 10px;
                        }

                        .image-thumbnails {
                            display: flex;
                            gap: 10px;
                            margin-top: 5px;
                            flex-wrap: wrap;
                        }

                        .thumbnail {
                            width: 50px;
                            height: 50px;
                            object-fit: cover;
                            border-radius: 4px;
                            border: 1px solid #eee;
                        }

                        .remove-btn {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            background: none;
                            border: none;
                            font-size: 20px;
                            color: #666;
                            cursor: pointer;
                            padding: 0 5px;
                        }

                        .remove-btn:hover {
                            color: #dc3545;
                        }

                        .variant-info, .text-info, .price {
                            margin: 5px 0;
                            font-size: 14px;
                        }

                        h5 {
                            margin: 0 0 10px 0;
                            color: #333;
                        }
                    </style>
                @endif

            @if(Session::has('selected_card'))
                @php $card = Session::get('selected_card'); @endphp
                <div class="selected-card">
                    <h4>Seçilmiş Kart</h4>
                    <div class="item-details">
                        <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                        <img src="{{ asset('storage/' . $card['card_image']) }}" alt="Card Image" style="width: 50px; height: 60px">
                        <div class="details">
                            <h5>{{ $card['card_name'] }}</h5>
                            <p>Kimə: {{ $card['recipient_name'] }}</p>
                            <p>Kimdən: {{ $card['sender_name'] }}</p>
                            <p>Mesaj: {{ $card['card_message'] }}</p>
                            <p>Qiymət: ₼{{ $card['card_price'] }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="total-price">
                @php
                    $totalPrice = 0;
                    if(Session::has('selected_box')) {
                        $totalPrice += Session::get('selected_box')['box_price'];
                    }
                    if(Session::has('selected_item')) {
                        $items = Session::get('selected_item');
                        foreach($items as $item) {
                            $totalPrice += $item['item_price'];
                        }
                    }
                    if(Session::has('selected_card')) {
                        $totalPrice += Session::get('selected_card')['card_price'];
                    }
                @endphp
                <h4>Ümumi Məbləğ: ₼{{ number_format($totalPrice, 2) }}</h4>
            </div>
        </div>

    <style>
        .item-details {
            position: relative;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 24px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        .remove-btn:hover {
            background: #cc0000;
        }
    </style>

    <script>
        function removeSelection(type, index = null) {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!token) {
                console.error('CSRF token not found');
                return;
            }

            const buttonElement = event.target;
            const itemElement = buttonElement.closest('.item-details');
            if (itemElement) {
                itemElement.style.opacity = '0.5';
            }

            const url = `${window.location.origin}/remove-selection`;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    type: type,
                    index: index
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        if (type === 'box') {
                            // Box silindikdə xəbərdarlıq göstər və choose_a_box səhifəsinə yönləndir
                            alert('Qutu seçimi məcburidir! Zəhmət olmasa yeni qutu seçin.');
                            window.location.href = '/choose_a_box';
                        } else {
                            // Digər elementlər silindikdə sadəcə səhifəni yenilə
                            window.location.reload();
                        }
                    } else {
                        console.error('Server error:', data.message);
                        if (itemElement) {
                            itemElement.style.opacity = '1';
                        }
                        alert('Server xətası: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (itemElement) {
                        itemElement.style.opacity = '1';
                    }
                    alert('Xəta baş verdi. Yenidən cəhd edin.');
                });
        }

        function updateSelectionsSummary() {
            fetch('/get-selections')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const selections = data.data;
                        let html = '';

                        // Box
                        if (selections.box) {
                            html += `
                    <div class="selected-box">
                        <h4>Seçilmiş Qutu</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                            <img src="${selections.box.box_image}" alt="Box Image">
                            <div class="details">
                                <h5>${selections.box.box_name}</h5>
                                <p>Fərdiləşdirmə: ${selections.box.customization_text}</p>
                                <p>Qiymət: ₼${selections.box.box_price}</p>
                            </div>
                        </div>
                    </div>
                `;
                        }

                        // Items
                        if (selections.item && selections.item.length > 0) {
                            html += '<div class="selected-item"><h4>Seçilmiş Əşyalar</h4>';
                            selections.item.forEach((item, index) => {
                                html += `
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('item', ${index})">&times;</button>
                            <img src="${item.item_image}" alt="Item Image">
                            <div class="details">
                                <h5>${item.item_name}</h5>
                                ${item.selected_variants ? `<p>Variantlar: ${item.selected_variants}</p>` : ''}
                                ${item.user_text ? `<p>Mətn: ${item.user_text}</p>` : ''}
                                <p>Qiymət: ₼${item.item_price}</p>
                            </div>
                        </div>
                    `;
                            });
                            html += '</div>';
                        }

                        // Card
                        if (selections.card) {
                            html += `
                    <div class="selected-card">
                        <h4>Seçilmiş Kart</h4>
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                            <img src="${selections.card.card_image}" alt="Card Image">
                            <div class="details">
                                <h5>${selections.card.card_name}</h5>
                                <p>Kimə: ${selections.card.recipient_name}</p>
                                <p>Kimdən: ${selections.card.sender_name}</p>
                                <p>Qiymət: ₼${selections.card.card_price}</p>
                            </div>
                        </div>
                    </div>
                `;
                        }

                        // Total Price
                        html += `
                <div class="total-price">
                    <h4>Ümumi Məbləğ: ₼${selections.total_price.toFixed(2)}</h4>
                </div>
            `;

                        document.getElementById('selectionsSummary').innerHTML = html;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', updateSelectionsSummary);
    </script>

</head>
