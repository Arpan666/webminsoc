document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = "MENGIRIM...";
            btn.disabled = true;

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value,
            };

            fetch('/contact/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // MODIFIKASI TEMA BERHASIL (COCOK DENGAN WEB)
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Terima kasih, pesan Anda sudah kami terima dan akan segera kami tinjau di panel admin.',
                        icon: 'success',
                        background: '#111827', // Latar gelap sesuai tema web
                        color: '#ffffff',       // Teks putih
                        iconColor: '#ffc107',   // Ikon centang kuning emas
                        confirmButtonColor: '#ffc107', // Tombol OK kuning
                        confirmButtonText: 'Selesai',
                        customClass: {
                            popup: 'border-gold' // Menambahkan border kuning (opsional)
                        }
                    });
                    contactForm.reset();
                }
            })
            .catch(error => {
                // MODIFIKASI TEMA ERROR
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Maaf, pesan gagal dikirim ke server.',
                    icon: 'error',
                    background: '#111827',
                    color: '#ffffff',
                    confirmButtonColor: '#ef4444' // Tombol merah untuk error
                });
            })
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        });
    }
});