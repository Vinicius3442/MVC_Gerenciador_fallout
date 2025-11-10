<div class="sub-nav stats-sub-nav">
    <a href="#" class="sub-nav-item active" data-tab="status-page">STATUS</a>
    <a href="#" class="sub-nav-item" data-tab="special-page">S.P.E.C.I.A.L</a>
    <a href="#" class="sub-nav-item" data-tab="perks-page">PERKS</a> 
</div>

<div class="stat-page-wrapper">

    <div id="status-page" class="stat-main-content active">
        <div class="status-dual-panel">
            
            <div class="status-panel-left stats-monitor">
                <div class="reticle-line v-line v-left"></div>
                <div class="reticle-line v-line v-right"></div>
                <div class="reticle-line h-line h-top"></div>
                <div class="reticle-line h-line h-bottom"></div>
                
                <img src="img/loading.gif" alt="Vault Boy" class="stats-vault-boy" />
                
                <div class="status-icons">
                    <div class="stat-icon"><span>🔫</span> 18</div>
                    <div class="stat-icon"><span>⛑️</span> 10</div>
                    <div class="stat-icon"><span>⚡</span> 20</div>
                    <div class="stat-icon"><span>☢️</span> 10</div>
                </div>
            </div>
            
            <div class="status-panel-right">
                <div class="body-diagram-container">
                    <div class="body-part body-head"><div class="bar"></div></div>
                    <div class="body-part body-torso"><div class="bar"></div></div>
                    <div class="body-part body-arm-left"><div class="bar"></div></div>
                    <div class="body-part body-arm-right"><div class="bar"></div></div>
                    <div class="body-part body-leg-left"><div class="bar"></div></div>
                    <div class="body-part body-leg-right"><div class="bar"></div></div>
                </div>
            </div>
            
        </div>
    </div>
    
    <div id="special-page" class="stat-main-content">
        <ul class="special-list-detailed">
            <li>
                <span class="special-letter">S</span>
                <div class="special-info">
                    STRENGTH
                    <p>Força é a medida da sua força física.</p>
                </div>
                <span class="special-value">5</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">P</span>
                <div class="special-info">
                    PERCEPTION
                    <p>Percepção é a sua consciência ambiental.</p>
                </div>
                <span class="special-value">7</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">E</span>
                <div class="special-info">
                    ENDURANCE
                    <p>Resistência define sua aptidão física geral.</p>
                </div>
                <span class="special-value">4</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">C</span>
                <div class="special-info">
                    CHARISMA
                    <p>Carisma é sua habilidade de encantar e convencer.</p>
                </div>
                <span class="special-value">6</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">I</span>
                <div class="special-info">
                    INTELLIGENCE
                    <p>Inteligência é a sua aptidão mental geral.</p>
                </div>
                <span class="special-value">8</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">A</span>
                <div class="special-info">
                    AGILITY
                    <p>Agilidade é seus reflexos e coordenação.</p>
                </div>
                <span class="special-value">5</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
            <li>
                <span class="special-letter">L</span>
                <div class="special-info">
                    LUCK
                    <p>Sorte é o efeito da probabilidade no seu destino.</p>
                </div>
                <span class="special-value">5</span>
                <div class="special-controls"><div class="level-btn">+</div></div>
            </li>
        </ul>
    </div>
    
    <div id="perks-page" class="stat-main-content">
        <div class="perks-iframe-wrapper">
            <iframe src="https://mmartinx.github.io/fo4/#eyJzIjpbIjEiLCIxIiwiMSIsIjEiLCIxIiwiMSIsIjEiXSwiciI6W119"
                    class="perks-iframe">
            </iframe>
        </div>
    </div>
    
    
    <div class="stats-footer">
        <div class="bar-group hp-bar">
            <div class="stat-bar-label">HP</div>
            <div class="stat-bar">
                <div class="bar-fill" style="width: 100%;"></div>
                <div class="bar-text">115 / 115</div>
            </div>
        </div>
        
        <div class="quick-items">
            STIMPAK (<?= $stimpakCount ?>) | RADAWAY (<?= $radawayCount ?>)
        </div>
        
        <div class="bar-group level-bar">
            <div class="stat-bar-label">LEVEL 6</div>
            <div class="stat-bar">
                <div class="bar-fill" style="width: 30%;"></div>
            </div>
        </div>
        
        <div class="bar-group ap-bar">
            <div class="stat-bar-label">AP</div>
            <div class="stat-bar">
                <div class="bar-fill" style="width: 100%;"></div>
                <div class="bar-text">90 / 90</div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Lógica das Abas Principais (STAT, SPECIAL, PERKS) ---
        const mainTabs = document.querySelectorAll('.stats-sub-nav .sub-nav-item');
        const mainContents = document.querySelectorAll('.stat-main-content');

        mainTabs.forEach(tab => {
            if (tab.classList.contains('disabled')) return;

            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = tab.getAttribute('data-tab'); // Ex: "status-page"
                
                mainTabs.forEach(t => t.classList.remove('active'));
                mainContents.forEach(c => c.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(targetId).classList.add('active');
            });
        });

        // (O script das sub-abas de status foi removido pois não é mais necessário)
    });
</script>