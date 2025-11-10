document.addEventListener('DOMContentLoaded', (event) => {

    // 1. Pegar os elementos
    const vaultBoy = document.getElementById('loadingVaultBoy');
    const overlay = document.getElementById('loading-overlay');
    const container = document.querySelector('.container');
    
    // Pegar os elementos de áudio
    const blipSound = document.getElementById('uiBlipSound');
    const glitchSound = document.getElementById('crtGlitchSound');

    // Se os elementos não existirem, não faz nada
    if (!vaultBoy || !overlay || !container || !blipSound || !glitchSound) {
        console.error("Um ou mais elementos de loading/som não foram encontrados.");
        return;
    }

    // Tempo que o Vault Boy fica andando (em milissegundos)
    const loadingTime = 1500; // 1.5 segundos

    // Função para MOSTRAR o loading
    function showLoading() {
        overlay.classList.add('vb-show');
        container.classList.add('glitching');
        vaultBoy.classList.add('vb-show');
        
        // Toca APENAS o som de glitch (em loop)
        glitchSound.currentTime = 0;
        glitchSound.play();
    }
    
    // Função para TOCAR O BIP e navegar
    function playBlipAndNavigate(destinationUrl) {
        blipSound.currentTime = 0;
        blipSound.play();
        
        // Pequeno atraso para o bip não ser cortado
        setTimeout(() => {
            window.location.href = destinationUrl;
        }, 300); // 300ms
    }

    // Função para TOCAR O BIP e enviar formulário
    function playBlipAndSubmit(formElement) {
        blipSound.currentTime = 0;
        blipSound.play();
        
        // Pequeno atraso para o bip não ser cortado
        setTimeout(() => {
            formElement.submit();
        }, 450); // 300ms
    }

    // --- PROCESSAR LINKS ---
    const links = document.querySelectorAll('.header-menu a, .acoes a, .novo-produto a, .voltar a');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Previne a ação padrão
            const destination = this.href;

            // Lógica especial para o botão "Excluir"
            if (this.classList.contains('excluir')) {
                if (confirm('// ATENÇÃO: EXCLUIR ITEM DO INVENTÁRIO? //')) {
                    // 1. Mostra o loading (glitch + vault boy)
                    showLoading(); 
                    // 2. Espera 1.5s, DEPOIS toca o bip e navega
                    setTimeout(() => playBlipAndNavigate(destination), loadingTime);
                }
            } else {
                // Para todos os outros links
                // 1. Mostra o loading (glitch + vault boy)
                showLoading(); 
                // 2. Espera 1.5s, DEPOIS toca o bip e navega
                setTimeout(() => playBlipAndNavigate(destination), loadingTime);
            }
        });
    });

    // --- PROCESSAR FORMULÁRIOS ---
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Previne o envio
            
            // 1. Mostra o loading (glitch + vault boy)
            showLoading(); 
            
            // 2. Espera 1.5s, DEPOIS toca o bip e envia o form
            setTimeout(() => playBlipAndSubmit(form), loadingTime);
        });
    });

});