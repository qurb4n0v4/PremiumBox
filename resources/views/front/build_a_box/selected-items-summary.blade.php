<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="selectionsSummary" class="selected-items-summary"">
    @if(Session::has('selected_box'))
        @php $box = Session::get('selected_box'); @endphp
        <div class="selected-box">
            <div class="item-details">
                <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                <img src="{{ asset('storage/' .  $box['box_image']) }}" alt="Box Image" class="item-image">
            </div>
        </div>
    @endif

    @if(Session::has('selected_item'))
        @php $items = Session::get('selected_item'); @endphp
        <div class="selected-items">
            @foreach($items as $index => $item)
                <div class="item-details">
                    <button class="remove-btn" onclick="removeSelection('item', {{ $index }})">&times;</button>
                    <img src="{{ asset('storage/' . $item['item_image']) }}" alt="Item Image" class="item-image">
                </div>
            @endforeach
        </div>
    @endif

    @if(Session::has('selected_card'))
        @php $card = Session::get('selected_card'); @endphp
        <div class="selected-card">
            <div class="item-details">
                <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                <img src="{{ asset('storage/' . $card['card_image']) }}" alt="Card Image" class="item-image">
            </div>
        </div>
    @endif

    <div class="total-price">
        @php
            $totalPrice = 0.0;
            $selected_box = Session::get('selected_box');
            $selected_items = Session::get('selected_item');
            $selected_card = Session::get('selected_card');

            if ($selected_box) {
                $totalPrice += is_numeric($selected_box['box_price'])
                    ? floatval(str_replace(',', '.', $selected_box['box_price']))
                    : 0;
            }

            if ($selected_items) {
                foreach ($selected_items as $item) {
                    $itemPrice = 0;

                    // Base item price
                    if (isset($item['item_price'])) {
                        $itemPrice += is_numeric($item['item_price'])
                            ? floatval(str_replace(',', '.', $item['item_price']))
                            : 0;
                    }

                    // Custom product price
                    if (isset($item['custom_product_price'])) {
                        $itemPrice += is_numeric($item['custom_product_price'])
                            ? floatval(str_replace(',', '.', $item['custom_product_price']))
                            : 0;
                    }

                    // Variant price
                    if (isset($item['selected_variant_price'])) {
                        $itemPrice += is_numeric($item['selected_variant_price'])
                            ? floatval(str_replace(',', '.', $item['selected_variant_price']))
                            : 0;
                    }

                    $totalPrice += $itemPrice;
                }
            }

            if ($selected_card) {
                $totalPrice += is_numeric($selected_card['card_price'])
                    ? floatval(str_replace(',', '.', $selected_card['card_price']))
                    : 0;
            }
        @endphp
        <div class="total-price">
            <h4 style="font-size: 14px">Ümumi Məbləğ:</h4>
            <span>₼{{ number_format($totalPrice, 2) }}</span>
        </div>
    </div>
    @if(Route::currentRouteName() == 'choose.items')
        <a href="{{ route('choose.card') }}" class="btn btn-primary">Növbəti</a>
        @endif
        </div>

        <style>
            .selected-items-summary {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: flex-start;
                align-items: center;
                padding: 15px;
                background: #fff;
                border-radius: 8px;
                width: 70%;
                max-width: 1200px;
                border: 1px solid #898989;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                position: fixed;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1000;
            }

            .item-details {
                position: relative;
                display: inline-block;
                margin-right: 10px;
                flex: 1;
            }

            .item-image {
                width: 60px;  /* Kiçik ölçüdə şəkillər */
                height: 60px;
                object-fit: cover;
                border-radius: 6px;
            }

            .remove-btn {
                position: absolute;
                top: 0;
                right: 0;
                background: none;
                border: none;
                font-size: 18px;
                color: #ffffff;
                cursor: pointer;
                padding: 0 5px;
                font-weight: bold;
            }

            .remove-btn:hover {
                color: #dc3545;
            }

            .total-price {
                color: #a3907a;
                font-size: 16px;
                font-weight: bold;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                margin-left: auto;
            }

            .total-price h4 {
                margin: 0;
            }

            @media (max-width: 768px) {
                .selected-items-summary {
                    width: 100%; /* Kiçik ekranlarda tam genişlik */
                    left: 0;
                    transform: none; /* Tam genişlikdə mərkəzləşdirməyə ehtiyac yoxdur */
                    padding: 10px; /* Kiçik ekranlarda padding daha az olsun */
                }

                .item-details {
                    flex: 1 0 48%; /* Hər bir itemın yan yana düzülməsi üçün daha geniş sahə */
                    margin-right: 10px;
                }

                .item-image {
                    width: 50px;  /* Kiçik ekranlarda şəkil ölçüsünü daha da kiçilt */
                    height: 50px;
                }

                .total-price {
                    font-size: 14px;
                    align-items: flex-start; /* Ekran kiçik olduqda, qiymət bölməsini yuxarıya çəkir */
                    margin-left: 0;
                }
            }

            @media (max-width: 480px) {
                .item-image {
                    width: 40px;  /* Daha da kiçik ekranlar üçün şəkil ölçüsünü azaldır */
                    height: 40px;
                }

                .total-price {
                    font-size: 12px; /* Daha kiçik ekranlarda font ölçüsünü azaldır */
                }
            }

            .btn-primary {
                background-color: #a3907a;
                color: white;
                border: none;
                padding: 8px 20px;
                border-radius: 5px;
                text-decoration: none;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #8c7f6e;
            }

            @media (max-width: 768px) {
                .total-price {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 10px;
                }

                .btn-primary {
                    width: 100%;
                    text-align: center;
                }
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
                            const selectionsSummaryElement = document.getElementById('selectionsSummary');

                            // Clear previous content
                            selectionsSummaryElement.innerHTML = '';

                            // Box selection
                            if (selections.box) {
                                const boxElement = document.createElement('div');
                                boxElement.className = 'selected-box';
                                boxElement.innerHTML = `
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                            <img src="${selections.box.box_image}" alt="Box Image" class="item-image">
                        </div>
                    `;
                                selectionsSummaryElement.appendChild(boxElement);
                            }

                            // Item selections
                            if (selections.item && selections.item.length > 0) {
                                const selectedItemsElement = document.createElement('div');
                                selectedItemsElement.className = 'selected-items';

                                selections.item.forEach((item, index) => {
                                    const itemElement = document.createElement('div');
                                    itemElement.className = 'item-details';
                                    itemElement.innerHTML = `
                            <button class="remove-btn" onclick="removeSelection('item', ${index})">&times;</button>
                            <img src="${item.item_image}" alt="Item Image" class="item-image">
                        `;
                                    selectedItemsElement.appendChild(itemElement);
                                });

                                selectionsSummaryElement.appendChild(selectedItemsElement);
                            }

                            // Card selection
                            if (selections.card) {
                                const cardElement = document.createElement('div');
                                cardElement.className = 'selected-card';
                                cardElement.innerHTML = `
                        <div class="item-details">
                            <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                            <img src="${selections.card.card_image}" alt="Card Image" class="item-image">
                        </div>
                    `;
                                selectionsSummaryElement.appendChild(cardElement);
                            }

                            // Total Price
                            const totalPriceElement = document.createElement('div');
                            totalPriceElement.className = 'total-price';
                            totalPriceElement.innerHTML = `
                    <h4 style="font-size: 14px">Ümumi Məbləğ:</h4>
                    <span>₼${selections.total_price.toFixed(2)}</span>
                `;
                            selectionsSummaryElement.appendChild(totalPriceElement);

                            // Next button for specific route
                            if (window.location.pathname === '/choose-items') {
                                const nextButton = document.createElement('a');
                                nextButton.href = '/choose-card';
                                nextButton.className = 'btn btn-primary';
                                nextButton.textContent = 'Növbəti';
                                selectionsSummaryElement.appendChild(nextButton);
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
            document.addEventListener('DOMContentLoaded', updateSelectionsSummary);
        </script>

</head>
