// Kutu ve ürün boyutlarını yönetecek sınıf
class BoxSizeManager {
    constructor() {
        this.selectedBox = null;
        this.selectedItems = [];
    }

    // Seçilen kutuyu ayarla
    setBox(width, height, length) {
        this.selectedBox = {
            width: parseFloat(width),
            height: parseFloat(height),
            length: parseFloat(length),
            volume: parseFloat(width) * parseFloat(height) * parseFloat(length)
        };
        localStorage.setItem('selectedBox', JSON.stringify(this.selectedBox));
    }

    // Ürün ekle ve kontrol et
    addItem(item) {
        const itemVolume = item.width * item.height * item.length;
        const currentTotalVolume = this.getCurrentTotalVolume();

        if (this.selectedBox && (currentTotalVolume + itemVolume) > this.selectedBox.volume) {
            return {
                success: false,
                message: 'Bu ürün kutuya sığmayacak! Lütfen daha küçük bir ürün seçin veya başka bir kutu seçin.',
                remainingVolume: this.selectedBox.volume - currentTotalVolume
            };
        }

        this.selectedItems.push(item);
        localStorage.setItem('selectedItems', JSON.stringify(this.selectedItems));

        return {
            success: true,
            remainingVolume: this.selectedBox.volume - (currentTotalVolume + itemVolume)
        };
    }

    // Mevcut toplam hacmi hesapla
    getCurrentTotalVolume() {
        return this.selectedItems.reduce((total, item) => {
            return total + (item.width * item.height * item.length);
        }, 0);
    }

    // Kullanılan alan yüzdesini hesapla
    getUsedSpacePercentage() {
        if (!this.selectedBox) return 0;
        return (this.getCurrentTotalVolume() / this.selectedBox.volume) * 100;
    }
}

// BoxSizeManager'ı başlat
const boxManager = new BoxSizeManager();

// Kutu seçildiğinde çalışacak fonksiyon
function handleBoxSelection(boxId) {
    fetch(`/api/boxes/${boxId}`)
        .then(response => response.json())
        .then(box => {
            boxManager.setBox(box.width, box.height, box.length);
            updateUI();
        });
}

// Ürün eklendiğinde çalışacak fonksiyon
function handleItemAddition(itemId) {
    fetch(`/api/items/${itemId}`)
        .then(response => response.json())
        .then(item => {
            const result = boxManager.addItem({
                id: item.id,
                width: item.width,
                height: item.height,
                length: item.length,
                name: item.name
            });

            if (!result.success) {
                showError(result.message);
                return false;
            }

            updateUI();
            return true;
        });
}

// UI'ı güncelle
function updateUI() {
    const percentage = boxManager.getUsedSpacePercentage();

    // Progress bar'ı güncelle
    const progressBar = document.querySelector('.box-space-progress');
    if (progressBar) {
        progressBar.style.width = `${percentage}%`;
        progressBar.style.backgroundColor = percentage > 90 ? '#dc3545' : '#28a745';
    }

    // Kalan alan bilgisini güncelle
    const remainingSpace = document.querySelector('.remaining-space');
    if (remainingSpace) {
        const remaining = boxManager.selectedBox.volume - boxManager.getCurrentTotalVolume();
        remainingSpace.textContent = `Kalan Alan: ${remaining.toFixed(2)} cm³`;
    }
}

// Hata göster
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger alert-dismissible fade show';
    errorDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    document.querySelector('.choose-boxes-header').appendChild(errorDiv);

    // 5 saniye sonra uyarıyı kaldır
    setTimeout(() => {
        errorDiv.remove();
    }, 5000);
}
