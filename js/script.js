document.addEventListener('DOMContentLoaded', (event) => {

    // 1. Pegar os elementos
    const vaultBoy = document.getElementById('loadingVaultBoy');
    const overlay = document.getElementById('loading-overlay');
    const container = document.querySelector('.container');
    
    // *** NOVO: Pegar os elementos de áudio ***
    const blipSound = document.getElementById('uiBlipSound');
    const glitchSound = document.getElementById('crtGlitchSound');

    // Se os elementos não existirem, não faz nada
    if (!vaultBoy || !overlay || !container || !blipSound || !glitchSound) {
        console.error("Um ou mais elementos de loading/som não foram encontrados.");
        return;
    }

    const loadingTime = 1500; // 1.5 segundos

    // Função para MOSTRAR tudo
    function showLoading() {
        overlay.classList.add('vb-show');
        container.classList.add('glitching');
        vaultBoy.classList.add('vb-show');
        
        // *** NOVO: Tocar os sons ***
        // Garante que o som do blip toque do início
        blipSound.currentTime = 0;
        blipSound.play();
        
        // Garante que o som de glitch toque do início e em loop
        glitchSound.currentTime = 0;
        glitchSound.play();
    }

    // Processar todos os links
    const links = document.querySelectorAll('.header-menu a, .acoes a, .novo-produto a, .voltar a');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); 
            const destination = this.href;

            if (this.classList.contains('excluir')) {
                if (confirm('// ATENÇÃO: EXCLUIR ITEM DO INVENTÁRIO? //')) {
                    showLoading(); 
                    setTimeout(() => {
                        window.location.href = destination;
                    }, loadingTime);
                }
            } else {
                showLoading(); 
                setTimeout(() => {
                    window.location.href = destination;
                }, loadingTime);
            }
        });
    });

    // Processar formulários
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            showLoading(); 
            setTimeout(() => {
                form.submit();
            }, loadingTime);
        });
    });

});