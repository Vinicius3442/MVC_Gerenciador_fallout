// js/script.js


document.addEventListener('DOMContentLoaded', () => {
    
    // === 2. BOOT SEQUENCE ===
    const bootScreen = document.getElementById('boot-screen');
    const mainInterface = document.getElementById('main-interface');
    const txt1 = document.getElementById('boot-text-1');
    const txt2 = document.getElementById('boot-text-2');
    const txt3 = document.getElementById('boot-text-3');

    setTimeout(() => { if(txt1) txt1.style.opacity = 1; }, 500);
    setTimeout(() => { if(txt2) txt2.style.opacity = 1; }, 1500);
    setTimeout(() => { if(txt3) txt3.style.opacity = 1; }, 2500);
    setTimeout(() => {
        if(bootScreen) {
            bootScreen.style.opacity = 0;
            setTimeout(() => {
                bootScreen.style.display = 'none';
                mainInterface.style.display = 'block';
                switchView('listar'); // Inicia no inventário
            }, 500);
        }
    }, 3500);

    // === 3. EFEITOS (Loading / Glitch) ===
    const overlay = document.getElementById('loading-overlay');
    const vaultBoyLoading = document.getElementById('loadingVaultBoy');
    const glitchSound = document.getElementById('crtGlitchSound');
    const blipSound = document.getElementById('uiBlipSound');
    const container = document.getElementById('main-interface');

    function showLoadingEffect(callback) {
        overlay.classList.add('vb-show');
        vaultBoyLoading.classList.add('vb-show');
        container.classList.add('glitching');
        
        glitchSound.currentTime = 0;
        glitchSound.play().catch(()=>{});

        setTimeout(() => {
            overlay.classList.remove('vb-show');
            vaultBoyLoading.classList.remove('vb-show');
            container.classList.remove('glitching');
            glitchSound.pause();
            
            if (callback) callback();
        }, 800);
    }

    function playBlip() {
        blipSound.currentTime = 0;
        blipSound.play().catch(() => {});
    }

    // === 4. NAVEGAÇÃO PRINCIPAL (ROUTING) ===
    const views = document.querySelectorAll('.view-section');

    function switchView(targetId) {
        // Remove active de tudo
        views.forEach(v => v.classList.remove('active'));
        document.querySelectorAll('.header-menu a').forEach(l => l.classList.remove('active'));

        // Ativa view alvo
        const targetView = document.getElementById(`view-${targetId}`);
        if (targetView) targetView.classList.add('active');

        const menuLink = document.querySelector(`.header-menu a[data-target="${targetId}"]`);
        if (menuLink) menuLink.classList.add('active');

        // Lógica específica das páginas
        if (targetId === 'listar') renderInventory();
        if (targetId === 'dados') renderDataView();
        if (targetId === 'stats') updateStatsCounts();
        
        // AQUI ESTAVA O PROBLEMA: Agora a chamada está no lugar certo!
        if (targetId === 'mapa') resetMapPosition();
    }

    // Click no menu principal
    document.querySelectorAll('.header-menu a, .voltar').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.getAttribute('data-target');
            if(target) {
                playBlip();
                showLoadingEffect(() => switchView(target));
            }
        });
    });
// === 5. LÓGICA DO MAPA (FIT TO SCREEN) ===
    const mapWindow = document.getElementById('map-window');
    const mapContent = document.getElementById('map-content');
    let isDragging = false;
    let startX, startY;
    let translateX = 0, translateY = 0;
    let scale = 1;

    function resetMapPosition() {
        if (!mapContent) return;
        const img = mapContent.querySelector('img');
        
        if (img) {
            const centerMap = () => {
                // Pega tamanhos originais
                const mapWidth = img.naturalWidth || img.width;
                const mapHeight = img.naturalHeight || img.height;
                const windowWidth = mapWindow.clientWidth;
                const windowHeight = mapWindow.clientHeight;

                if (mapWidth === 0 || mapHeight === 0) return;

                // LÓGICA NOVA: "Contain" (Caber tudo na tela)
                // Calcula qual escala faz a imagem caber inteira na largura E altura
                const scaleX = windowWidth / mapWidth;
                const scaleY = windowHeight / mapHeight;
                
                // Usa o MENOR valor. Isso garante que o mapa inteiro apareça sem cortes.
                // Se quiser que corte um pouco para preencher, mude Math.min para Math.max
                scale = Math.min(scaleX, scaleY) * 0.9; // 0.9 deixa uma margemzinha de respiro

                // Reseta a posição para o centro (0,0 no transform com flexbox centraliza)
                translateX = 0;
                translateY = 0;
                
                updateMapTransform();
            };

            if (img.complete) centerMap();
            else img.onload = centerMap;
        }
    }

    function updateMapTransform() {
        if(mapContent) {
            // Usa translate3d para melhor performance
            mapContent.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
        }
    }

    if (mapWindow) {
        // Zoom (Roda do Mouse)
        mapWindow.addEventListener('wheel', (e) => {
            e.preventDefault();
            const zoomFactor = 0.1; // Velocidade do zoom
            
            if (e.deltaY < 0) {
                scale += zoomFactor; // Zoom In
            } else {
                scale -= zoomFactor; // Zoom Out
            }

            // Limites: Não deixa ficar menor que 0.1x nem maior que 5x
            scale = Math.min(Math.max(0.1, scale), 5); 

            updateMapTransform();
        });

        // Arrastar (Mouse Down)
        mapWindow.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            mapWindow.style.cursor = 'grabbing';
        });

        // Parar Arrasto
        window.addEventListener('mouseup', () => {
            if(isDragging) {
                isDragging = false;
                mapWindow.style.cursor = 'grab';
            }
        });

        // Mover (Mouse Move)
        mapWindow.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            updateMapTransform();
        });
    }

    // === 6. OUTRAS FUNÇÕES (STATS, INVENTÁRIO, ETC) ===
    
    // Stats Tabs
    const statTabs = document.querySelectorAll('.stats-sub-nav .sub-nav-item');
    const statContents = document.querySelectorAll('.stat-main-content');

    statTabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            playBlip();
            statTabs.forEach(t => t.classList.remove('active'));
            statContents.forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            const targetId = tab.getAttribute('data-subtab');
            if(document.getElementById(targetId)) document.getElementById(targetId).classList.add('active');
        });
    });

    function updateStatsCounts() {
        const stimpaks = dbProdutos.filter(p => p.nome.toLowerCase().includes('stimpak')).length;
        const radaways = dbProdutos.filter(p => p.nome.toLowerCase().includes('radaway')).length;
        const elS = document.getElementById('stat-stimpak-count');
        const elR = document.getElementById('stat-radaway-count');
        if(elS) elS.textContent = stimpaks;
        if(elR) elR.textContent = radaways;
    }

    function renderInventory() {
        const categoriesContainer = document.getElementById('inv-categories');
        const listsContainer = document.getElementById('inv-lists-container');
        if(!categoriesContainer || !listsContainer) return;

        const grouped = {};
        dbProdutos.forEach(item => {
            const cat = item.categoria || 'OUTROS';
            if (!grouped[cat]) grouped[cat] = [];
            grouped[cat].push(item);
        });

        categoriesContainer.innerHTML = '';
        listsContainer.innerHTML = '';
        let isFirst = true;

        Object.keys(grouped).sort().forEach(category => {
            const items = grouped[category];
            const tab = document.createElement('a');
            tab.href = '#';
            tab.className = `sub-nav-item ${isFirst ? 'active' : ''}`;
            tab.textContent = `${category} (${items.length})`;
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelectorAll('#inv-categories .sub-nav-item').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.item-list').forEach(l => l.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(`list-${category}`).classList.add('active');
            });
            categoriesContainer.appendChild(tab);

            const ul = document.createElement('ul');
            ul.className = `item-list ${isFirst ? 'active' : ''}`;
            ul.id = `list-${category}`;

            items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'inventory-item';
                li.innerHTML = `<span class="item-name">${item.nome}</span><span class="item-value">${item.preco}</span>`;
                li.addEventListener('click', () => {
                    document.querySelectorAll('.inventory-item').forEach(i => i.classList.remove('selected'));
                    li.classList.add('selected');
                    document.getElementById('detail-nome').textContent = item.nome;
                    document.getElementById('detail-preco').textContent = item.preco;
                    document.getElementById('detail-categoria').textContent = item.categoria;
                    
                    const btnEdit = document.getElementById('btn-ir-editar');
                    if(btnEdit) btnEdit.onclick = (e) => {
                        e.preventDefault();
                        playBlip();
                        prepararEdicao(item.id);
                    };
                    const btnDel = document.getElementById('btn-ir-excluir');
                    if(btnDel) btnDel.onclick = (e) => {
                        e.preventDefault();
                        if(confirm('// DELETAR ITEM? //')) {
                            showLoadingEffect(() => {
                                dbProdutos = dbProdutos.filter(p => p.id !== item.id);
                                renderInventory();
                            });
                        }
                    };
                });
                ul.appendChild(li);
            });
            listsContainer.appendChild(ul);
            isFirst = false;
        });
    }

    const formAdicionar = document.getElementById('form-adicionar');
    if(formAdicionar) formAdicionar.addEventListener('submit', (e) => {
        e.preventDefault();
        const novo = {
            id: Date.now(),
            nome: document.getElementById('add-nome').value,
            preco: document.getElementById('add-preco').value,
            categoria: document.getElementById('add-categoria').value
        };
        showLoadingEffect(() => {
            dbProdutos.push(novo);
            alert('// ITEM REGISTRADO //');
            formAdicionar.reset();
            switchView('listar');
        });
    });

    function prepararEdicao(id) {
        const item = dbProdutos.find(p => p.id == id);
        if(item) {
            document.getElementById('edit-id').value = item.id;
            document.getElementById('edit-nome').value = item.nome;
            document.getElementById('edit-preco').value = item.preco;
            document.getElementById('edit-categoria').value = item.categoria;
            switchView('editar');
        }
    }

    const formEditar = document.getElementById('form-editar');
    if(formEditar) formEditar.addEventListener('submit', (e) => {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        showLoadingEffect(() => {
            const index = dbProdutos.findIndex(p => p.id == id);
            if(index !== -1) {
                dbProdutos[index].nome = document.getElementById('edit-nome').value;
                dbProdutos[index].preco = document.getElementById('edit-preco').value;
                dbProdutos[index].categoria = document.getElementById('edit-categoria').value;
                alert('// ITEM ATUALIZADO //');
                switchView('listar');
            }
        });
    });

    // === DADOS E RÁDIO ===
    let chartInstance = null;
    function renderDataView() {
        const total = dbProdutos.length;
        const valor = dbProdutos.reduce((acc, i) => acc + Number(i.preco), 0);
        
        const cards = document.getElementById('data-cards');
        if(cards) cards.innerHTML = `
            <div class="stat-card"><h3>TOTAL</h3><p>${total}</p></div>
            <div class="stat-card"><h3>CAPS TOTAL</h3><p>${valor}</p></div>
        `;

        const counts = {};
        dbProdutos.forEach(p => counts[p.categoria] = (counts[p.categoria] || 0) + 1);
        
        const ctx = document.getElementById('categoryChart');
        if(ctx) {
            if(chartInstance) chartInstance.destroy();
            Chart.defaults.color = '#32FF32';
            Chart.defaults.font.family = "'VT323'";
            
            chartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(counts),
                    datasets: [{
                        data: Object.values(counts),
                        backgroundColor: ['#32FF32', '#2E8B57', '#006400', '#90EE90', '#00FF00'],
                        borderColor: '#000'
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }
        initWeather();
    }

    function initWeather() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (pos) => {
                try {
                    const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${pos.coords.latitude}&longitude=${pos.coords.longitude}&current_weather=true`);
                    const data = await res.json();
                    const content = document.getElementById('weather-content');
                    if(content) content.innerHTML = `<p>${data.current_weather.temperature}°C | VENTO: ${data.current_weather.windspeed}km/h</p>`;
                } catch { 
                    const content = document.getElementById('weather-content');
                    if(content) content.textContent = "// ERRO SINAL //"; 
                }
            });
        }
    }
    
    const radio = document.getElementById('radio-stream');
    const tuneBtn = document.getElementById('tune-btn');
    if(tuneBtn && radio) tuneBtn.addEventListener('click', () => {
        radio.src = document.getElementById('station-url').value;
        radio.play().catch(()=>{});
        document.getElementById('radio-status').textContent = "// TOCANDO... //";
    });
    const playBtn = document.getElementById('play-btn');
    if(playBtn && radio) playBtn.addEventListener('click', () => radio.play());
    
    const stopBtn = document.getElementById('stop-btn');
    if(stopBtn && radio) stopBtn.addEventListener('click', () => radio.pause());
    
    const volSlider = document.getElementById('volume-slider');
    if(volSlider && radio) volSlider.addEventListener('input', (e) => radio.volume = e.target.value);
});