<?php
// --- Prepara os dados do PHP para o JavaScript ---
$labels = [];
$dataValues = [];
foreach ($categorias as $cat) {
    $labels[] = htmlspecialchars($cat['categoria'] ?: 'N/A');
    $dataValues[] = $cat['total'];
}
$jsLabels = json_encode($labels);
$jsDataValues = json_encode($dataValues);

// --- Prepara os dados das Stats ---
$stats = $data['stats']; // Pega os dados das stats vindos do controller
?>

<h1>[ STATUS GERAL DO SISTEMA ]</h1>

<div class="stat-card-container">
    <div class="stat-card">
        <h3>TOTAL DE ITENS</h3>
        <p><?= $stats['total_itens'] ?></p>
    </div>
    <div class="stat-card">
        <h3>VALOR TOTAL (CAPS)</h3>
        <p><?= number_format($stats['valor_total'], 0, ',', '.') ?></p>
    </div>
    <div class="stat-card">
        <h3>ITEM MAIS CARO</h3>
        <p style="font-size:24px;"><?= htmlspecialchars($stats['item_caro']['nome']) ?></p>
        <span>(<?= number_format($stats['item_caro']['preco'], 0, ',', '.') ?> CAPS)</span>
    </div>
</div>

<hr class="pipboy-hr">

<?php if (empty($categorias)): ?>
    
    <p class="radio-placeholder" style="text-align: left;">// SEM DADOS DE CATEGORIA PARA EXIBIR //</p>

<?php else: ?>

    <div class="chart-container">
        <canvas id="categoryChart"></canvas>
    </div>

    <script>
        // Define as fontes padrão do Chart.js para o tema Pip-Boy
        Chart.defaults.font.family = "'VT323', monospace";
        Chart.defaults.font.size = 18;
        Chart.defaults.color = '#32FF32';

        const labels = <?php echo $jsLabels; ?>;
        const dataValues = <?php echo $jsDataValues; ?>;
        const pipBoyColors = ['#32FF32', '#64FF64', '#00CC00', '#009900', '#2E8B57', '#007700', '#32CD32'];

        const data = {
            labels: labels,
            datasets: [{
                label: ' Quantidade',
                data: dataValues,
                backgroundColor: pipBoyColors,
                borderColor: '#000',
                borderWidth: 2,
                hoverOffset: 10
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false, // <-- Importante
                plugins: {
                    legend: { position: 'right', labels: { padding: 20 } },
                    tooltip: {
                        backgroundColor: '#000',
                        borderColor: '#32FF32',
                        borderWidth: 1,
                        padding: 10,
                        titleFont: { size: 20 },
                        bodyFont: { size: 18 }
                    }
                },
                cutout: '60%' 
            }
        };

        new Chart( document.getElementById('categoryChart'), config );
    </script>

<?php endif; ?>

<hr class="pipboy-hr">

<div class="weather-module">
    
    <h3 id="weather-title">STATUS EXTERIOR (BOSTON)</h3>
    
    <div id="weather-content">
        <p>//... SINTONIZANDO SINAL DE CLIMA ...//</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    // Selecionamos os dois elementos que queremos atualizar
    const weatherTitle = document.getElementById('weather-title');
    const weatherContent = document.getElementById('weather-content');

    // Função principal: Pede a localização
    function findLocationAndWeather() {
        if (!navigator.geolocation || !weatherContent || !weatherTitle) {
            console.error("Elementos do DOM não encontrados.");
            if (weatherContent) {
                weatherContent.innerHTML = '<p>// ERRO DE INICIALIZAÇÃO DO MÓDULO //</p>';
            }
            return;
        }

        // 1. Pede a localização
        weatherContent.innerHTML = '<p>//... AGUARDANDO PERMISSÃO DE LOCALIZAÇÃO ...//</p>';
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    // 2. SUCESSO: O usuário permitiu
    async function successCallback(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        
        weatherContent.innerHTML = '<p>//... SINAL DE LOCALIZAÇÃO OBTIDO. BUSCANDO CLIMA ...//</p>';
        await getWeather(lat, lon);
    }

    // 3. ERRO: O usuário negou ou deu erro
    function errorCallback(error) {
        let message = '// FALHA AO OBTER SINAL DE LOCALIZAÇÃO //';
        if (error.code === error.PERMISSION_DENIED) {
            message = '// PERMISSÃO DE LOCALIZAÇÃO NEGADA PELO USUÁRIO //';
        }
        weatherTitle.innerHTML = 'STATUS EXTERIOR (FALHA)'; // Atualiza o título
        weatherContent.innerHTML = `<p>${message}</p>`;     // Atualiza o conteúdo
    }

    // 4. Função que busca o clima (agora recebe lat/lon)
    async function getWeather(lat, lon) {
        const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`;

        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Sinal perdido');
            
            const data = await response.json();
            const temp = data.current_weather.temperature;
            const wind = data.current_weather.windspeed;
            const radLevel = (temp > 20) ? 'ALTO' : (temp > 10 ? 'MÉDIO' : 'BAIXO');
            
            // Atualiza o título e o conteúdo separadamente
            weatherTitle.innerHTML = 'STATUS EXTERIOR (LOCAL)'; // Atualiza o H3
            
            weatherContent.innerHTML = `
                <p>TEMPERATURA ATUAL: ${temp}°C</p>
                <p>VEL. VENTO: ${wind} km/h</p>
                <p>NÍVEL DE RADIAÇÃO (EST.): ${radLevel}</p>
            `;

        } catch (error) {
            console.error("Erro na API de clima:", error);
            weatherTitle.innerHTML = 'STATUS EXTERIOR (ERRO)'; // Atualiza o H3
            weatherContent.innerHTML = '<p>// FALHA AO RASTREAR SINAL DE CLIMA //</p>';
        }
    }
    
    // Inicia todo o processo
    findLocationAndWeather();
});
</script>