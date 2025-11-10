<h1>[ SINTONIZADOR DE RÁDIO ]</h1>

<div class="radio-player">
    
    <div class="tuning-box">
        <label for="station-url">SINAL DA ESTAÇÃO (URL):</label>
        <input type="text" id="station-url">
        <button id="tune-btn">[ SINTONIZAR ]</button>
    </div>

    <p id="radio-status" class="radio-placeholder">// SILÊNCIO... AGUARDANDO SINAL //</p>
    
    <audio id="radio-stream" src="" preload="none"></audio>
    
    <div class="radio-controls">
        <button id="play-btn">[ LIGAR ]</button>
        <button id="stop-btn">[ DESLIGAR ]</button>
    </div>
    
    <div class="volume-control">
        <label for="volume-slider">VOLUME:</label>
        <input type="range" id="volume-slider" min="0" max="1" step="0.1" value="0.5">
    </div>
</div>

<script>
    // Este script SÓ roda nesta página
    document.addEventListener('DOMContentLoaded', () => {
        const radio = document.getElementById('radio-stream');
        const playBtn = document.getElementById('play-btn');
        const stopBtn = document.getElementById('stop-btn');
        const volumeSlider = document.getElementById('volume-slider');
        const statusText = document.getElementById('radio-status');
        
        // NOVO: Pegando os novos elementos
        const tuneBtn = document.getElementById('tune-btn');
        const stationInput = document.getElementById('station-url');

        // NOVO: Ação do botão Sintonizar
        tuneBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Previne o glitch da página
            const newStreamUrl = stationInput.value;
            
            if (newStreamUrl) {
                radio.src = newStreamUrl;
                radio.load(); // Carrega o novo áudio
                radio.play().catch(e => {
                    statusText.innerHTML = "// ERRO AO SINTONIZAR SINAL //";
                });
            } else {
                statusText.innerHTML = "// URL DE SINAL VAZIA //";
            }
        });

        // Ação do botão Ligar (agora só dá play)
        playBtn.addEventListener('click', (e) => {
            e.stopPropagation(); 
            if (radio.src) {
                radio.play().catch(e => {
                    statusText.innerHTML = "// ERRO AO SINTONIZAR SINAL //";
                });
            } else {
                statusText.innerHTML = "// SINTONIZE UMA ESTAÇÃO PRIMEIRO //";
            }
        });
    
        stopBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            radio.pause();
            statusText.innerHTML = "// SINAL DESLIGADO //";
        });
    
        volumeSlider.addEventListener('input', (e) => {
            radio.volume = e.target.value;
        });

        // Atualiza o status do Pip-Boy
        radio.onplaying = () => { statusText.innerHTML = "// SINAL RECEBIDO... TOCANDO //"; };
        radio.onpause = () => { if(radio.currentTime > 0) statusText.innerHTML = "// SINAL EM PAUSA //"; };
        radio.onerror = () => { statusText.innerHTML = "// PERDA DE SINAL - ESTAÇÃO OFFLINE //"; };
        radio.onloadstart = () => { statusText.innerHTML = "// SINTONIZANDO... AGUARDE //"; };
    });
</script>