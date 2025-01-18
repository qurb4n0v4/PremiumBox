<div id="selectionsSummary" class="selected-items-summary">
    @if(Session::has('selected_box'))
        @php $box = Session::get('selected_box'); @endphp
        <div class="selected-box">
            <h4>Seçilmiş Qutu</h4>
            <div class="item-details">
                <button class="remove-btn" onclick="removeSelection('box')">&times;</button>
                <img src="{{ $box['box_image'] }}" alt="Box Image">
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
                        <img src="{{ $item['item_image'] }}" alt="Item Image">
                        <div class="details">
                            <h5>{{ $item['item_name'] }}</h5>
                            @if(isset($item['selected_variants']))
                                <p>Variantlar: {{ $item['selected_variants'] }}</p>
                            @endif
                            @if(isset($item['user_text']))
                                <p>Mətn: {{ $item['user_text'] }}</p>
                            @endif
                            <p>Qiymət: ₼{{ $item['item_price'] }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No items selected.</p>
            @endif
        </div>
    @endif

    @if(Session::has('selected_card'))
        @php $card = Session::get('selected_card'); @endphp
        <div class="selected-card">
            <h4>Seçilmiş Kart</h4>
            <div class="item-details">
                <button class="remove-btn" onclick="removeSelection('card')">&times;</button>
                <img src="{{ $card['card_image'] }}" alt="Card Image">
                <div class="details">
                    <h5>{{ $card['card_name'] }}</h5>
                    <p>Kimə: {{ $card['recipient_name'] }}</p>
                    <p>Kimdən: {{ $card['sender_name'] }}</p>
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
        fetch('/remove-selection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                type: type,
                index: index
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateSelectionsSummary();
                }
            })
            .catch(error => console.error('Error:', error));
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
