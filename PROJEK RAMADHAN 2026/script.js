document.addEventListener('DOMContentLoaded', function() {
    
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Melakukan scroll halus ke elemen tujuan
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

  
    console.log("Website Warung Bismillah siap digunakan dengan sistem PHP Dinamis.");
});
