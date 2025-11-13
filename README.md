# RobCo Industries - SISTEMA PESSOAL DE INFORMAÇÃO PORTÁTIL - VERSÃO WEB
![Banner Fallout 4](./img/banner.png)

<div align="center">

![Status: Concluído](https://img.shields.io/badge/status-Operacional-brightgreen?style=for-the-badge)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)


</div>

---

## Sobre o Projeto

Este projeto é uma recriação interativa e fiel da interface do **Pip-Boy 3000**, o icônico computador de pulso da franquia **Fallout**. Desenvolvido como uma **Single Page Application (SPA)**, o sistema simula a experiência de navegação do jogo diretamente no navegador, sem necessidade de backend.

O foco principal foi a **imersão visual e sonora**, utilizando efeitos de CRT (Tubo de Raios Catódicos), distorção de tela, scanlines e sons originais da interface, tudo construído com tecnologias web modernas.

---

## Funcionalidades do Sistema

O RobCo OS Web Edition inclui os seguintes módulos operacionais:

### 1. Módulo de Inventário (INV)
- **Listagem de Itens:** Exibição de itens categorizados (Armas, Trajes, Cura, Lixo, etc.).
- **Simulação CRUD:** Interface para simular adição, edição e remoção de itens (persisistência em memória durante a sessão).
- **Visualização 3D:** Exibição de GIFs animados do Vault Boy correspondentes às ações.

### 2. Módulo de Status (STAT)
- **Monitoramento Biométrico:** Diagrama do corpo humano com status de saúde.
- **S.P.E.C.I.A.L:** Aba detalhada com os atributos do personagem.
- **Perks:** Integração com iframe externo para visualização da árvore de habilidades.
- **Contadores:** Monitoramento automático de Stimpaks e RadAways disponíveis no inventário.

### 3. Módulo de Navegação (MAP)
- **Mapa Interativo:** Mapa da Commonwealth em alta resolução.
- **Controles:** Sistema de **Drag & Drop** (arrastar) e **Zoom** (scroll) feito com JavaScript puro (Vanilla JS).
- **Filtros Visuais:** Tratamento de imagem para manter a estética monocromática verde/fósforo.

### 4. Módulo de Rádio & Dados (RADIO / DATA)
- **Sintonizador:** Player de áudio funcional conectado a streams de rádio reais (SomaFM).
- **Clima em Tempo Real:** Integração com a **Open-Meteo API** para exibir temperatura e vento baseados na geolocalização do usuário.
- **Estatísticas:** Gráficos gerados com `Chart.js` mostrando a distribuição de itens do inventário.

---

## Tecnologias Utilizadas

<div align="center">

| Categoria | Tecnologias |
| :--- | :--- |
| **Estrutura & Layout** | HTML5 Semântico, CSS3 (Grid/Flexbox) |
| **Estilização Avançada** | CSS Keyframes (Glitch/CRT effects), Fontes 'VT323' |
| **Lógica & Interatividade** | Vanilla JavaScript (ES6+), SPA Routing |
| **Bibliotecas Externas** | `Chart.js` (Gráficos), `FontAwesome` (Ícones) |
| **APIs** | Geolocation API (Navegador), Open-Meteo (Clima) |

</div>

---

## Notas de Operação (Problemas Conhecidos)

> **Diário do Sobrevivente:** O sistema opera com estabilidade de 99%, mas existem limitações impostas pelos navegadores modernos (que a RobCo não previu em 2077).

### Política de Autoplay (Áudio)
Navegadores modernos (Chrome, Firefox, Edge) bloqueiam a reprodução automática de áudio.
* **Sintoma:** A rádio ou sons de interface não tocam imediatamente ao abrir a página.
* **Solução:** É necessária uma interação do usuário (clique em qualquer lugar da página) para "destravar" o contexto de áudio.

### Performance do Mapa
Em dispositivos móveis muito antigos, o filtro CSS de `hue-rotate` e `contrast` aplicado ao mapa de alta resolução pode causar leves quedas de FPS durante o zoom.

---

## Como Executar o Protocolo

Siga este guia para inicializar o Pip-Boy no seu terminal local.

### 1. Pré-requisitos
* Qualquer navegador web moderno.
* Git (opcional, para clonagem).

### 2. Instalação

```bash
# 1. Clone o repositório da Vault-Tec
git clone [https://github.com/SEU-USUARIO/NOME-DO-REPO.git](https://github.com/SEU-USUARIO/NOME-DO-REPO.git)

# 2. Acesse o diretório
cd NOME-DO-REPO

# 3. Inicialize o sistema
# Basta abrir o arquivo 'index.html' no seu navegador.
# Recomenda-se usar uma extensão como "Live Server" no VS Code para melhor experiência.
```

<div align="center">

**Desenvolvido por Vinicius** RobCo Industries © 2077 - America's #1 Choice for Computer Terminals

</div>
