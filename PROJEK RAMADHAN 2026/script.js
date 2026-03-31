document.addEventListener('DOMContentLoaded', function() {
    const statusElement = document.getElementById('status-warung');
    
    // Fungsi untuk cek jam operasional (07:00 - 15:00 sebagai asumsi "Sampai Habis")
    function updateStatus() {
        const sekarang = new Date();
        const jam = sekarang.getHours();

        // Misal warung buka jam 7 pagi sampai jam 3 sore (15)
        if (jam >= 7 && jam < 15) {
            statusElement.innerText = "🟢 WARUNG SEDANG BUKA";
            statusElement.classList.remove('tutup');
            statusElement.classList.add('buka');
        } else {
            statusElement.innerText = "🔴 WARUNG SUDAH TUTUP";
            statusElement.classList.remove('buka');
            statusElement.classList.add('tutup');
        }
    }

    updateStatus();
});

// Efek scroll halus untuk navigasi
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});