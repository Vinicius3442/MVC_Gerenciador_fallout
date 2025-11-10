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
    
    // --- LÓGICA DO INVENTÁRIO PIP-BOY (2 PAINÉIS) ---
    
    // Pega todos os botões de sub-nav e todas as listas
    const subNavItems = document.querySelectorAll('.sub-nav-item');
    const itemLists = document.querySelectorAll('.item-lists .item-list');
    
    // Pega os elementos do painel da direita (detalhes)
    const detailNome = document.getElementById('detail-nome');
    const detailPreco = document.getElementById('detail-preco');
    const detailCategoria = document.getElementById('detail-categoria');
    const detailEditBtn = document.getElementById('detail-edit');
    const detailDeleteBtn = document.getElementById('detail-delete');

    // 1. Lógica para trocar as abas de categoria (Lixo, Cura, etc)
    subNavItems.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault(); // Impede o link de pular a página
            
            // Pega o nome da categoria do atributo data-
            const category = tab.getAttribute('data-category');
            
            // Remove 'active' de todas as abas e listas
            subNavItems.forEach(item => item.classList.remove('active'));
            itemLists.forEach(list => list.classList.remove('active'));
            
            // Adiciona 'active' na aba clicada e na lista correspondente
            tab.classList.add('active');
            document.getElementById(`list-${category}`).classList.add('active');
        });
    });

    // 2. Lógica para mostrar detalhes do item ao clicar
    const allItems = document.querySelectorAll('.inventory-item');
    
    allItems.forEach(item => {
        item.addEventListener('click', () => {
            
            // Remove 'selected' de todos os itens
            allItems.forEach(i => i.classList.remove('selected'));
            // Adiciona 'selected' no item clicado
            item.classList.add('selected');
            
            // Pega os dados do item (guardados nos atributos data-)
            const id = item.getAttribute('data-id');
            const nome = item.getAttribute('data-nome');
            const preco = item.getAttribute('data-preco');
            const categoria = item.getAttribute('data-categoria');
            
            // Preenche o painel da direita com os dados
            detailNome.textContent = nome;
            detailPreco.textContent = preco;
            detailCategoria.textContent = categoria;
            
            // Atualiza os links de Editar/Excluir
            detailEditBtn.href = `index.php?acao=editar&id=${id}`;
            detailDeleteBtn.href = `index.php?acao=excluir&id=${id}`;
        });
    });
});