<!-- Bootstrap v5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Chart color helpers ──────────────────────
    function getChartColors() {
        const isDark = document.body.classList.contains('dark-mode');
        return {
            gridColor:   isDark ? '#3a4556' : '#f0f0f0',
            tickColor:   isDark ? '#a0aec0' : '#666',
            legendColor: isDark ? '#c0cdd8' : '#666',
            bgColor:     isDark ? '#252d3a' : '#fff',
        };
    }

    function applyChartTheme() {
        const c = getChartColors();

        // Shared defaults
        Chart.defaults.color = c.tickColor;

        // Bar Chart
        barChart.options.scales.x.grid.color = c.gridColor;
        barChart.options.scales.y.grid.color = c.gridColor;
        barChart.options.scales.x.ticks.color = c.tickColor;
        barChart.options.scales.y.ticks.color = c.tickColor;
        barChart.options.plugins.legend.labels.color = c.legendColor;
        barChart.update();

        // Pie Chart
        pieChart.options.plugins.legend.labels.color = c.legendColor;
        pieChart.update();

        // Right Bar Chart
        rightBarChart.options.scales.x.grid.color = c.gridColor;
        rightBarChart.options.scales.y.grid.color = c.gridColor;
        rightBarChart.options.scales.x.ticks.color = c.tickColor;
        rightBarChart.options.scales.y.ticks.color = c.tickColor;
        rightBarChart.options.plugins.legend.labels.color = c.legendColor;
        rightBarChart.update();
    }

    // ── BAR CHART ────────────────────────────────
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Angeles City', 'City of San Fernando', 'Mabalacat City'],
            datasets: [
                {
                    label: 'Farmers',
                    data: [1, 2, 1],
                    backgroundColor: '#5b9bd5',
                    borderRadius: 4,
                },
                {
                    label: 'Farms',
                    data: [2, 3, 2],
                    backgroundColor: '#27ae60',
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { color: '#666' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0f0f0' },
                    ticks: { color: '#666' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#666' }
                }
            }
        }
    });

    // ── PIE / DONUT CHART ─────────────────────────
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Rice Farm'],
            datasets: [{
                data: [100],
                backgroundColor: ['#5b9bd5'],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#666' }
                }
            },
            cutout: '60%'
        }
    });

    // ── RIGHT SIDEBAR BAR CHART ───────────────────
    const rightBarCtx = document.getElementById('rightBarChart').getContext('2d');
    const rightBarChart = new Chart(rightBarCtx, {
        type: 'bar',
        data: {
            labels: ['Arayat', 'Lubao', 'Mabalacat City', 'Angeles', 'Macabebe', 'Guagua', 'San Luis', 'Bacolor', 'Minalin', 'Sta Rita'],
            datasets: [
                { label: '3000', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#6f42c1' },
                { label: '2500', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#e74c3c' },
                { label: '2000', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#17a2b8' },
                { label: '1500', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#f39c12' },
                { label: '1000', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#3498db' },
                { label: '500',  data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#27ae60' },
                { label: '0',    data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#8e44ad' },
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, font: { size: 10 }, color: '#666' }
                }
            },
            scales: {
                x: {
                    max: 100,
                    grid: { color: '#f0f0f0' },
                    ticks: { font: { size: 10 }, color: '#666' }
                },
                y: {
                    ticks: { font: { size: 10 }, color: '#666' },
                    grid: { display: false }
                }
            }
        }
    });

    // ── MAPLIBRE MAP ──────────────────────────────
    const map = new maplibregl.Map({
        container: 'map',
        style: {
            version: 8,
            sources: {
                esri: {
                    type: 'raster',
                    tiles: ['https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'],
                    tileSize: 256,
                    attribution: '© Esri | MapLibre',
                },
                osm: {
                    type: 'raster',
                    tiles: ['https://tile.openstreetmap.org/{z}/{x}/{y}.png'],
                    tileSize: 256,
                }
            },
            layers: [
                {
                    id: 'esri-tiles',
                    type: 'raster',
                    source: 'esri',
                    minzoom: 0,
                    maxzoom: 19,
                },
                {
                    id: 'osm-labels',
                    type: 'raster',
                    source: 'osm',
                    paint: { 'raster-opacity': 0.6 }
                }
            ]
        },
        center: [120.57, 15.18],
        zoom: 8,
    });

    map.addControl(new maplibregl.NavigationControl(), 'top-left');

    // ── AUTO RESIZE CHARTS ON WINDOW RESIZE ──────
    window.addEventListener('resize', function() {
        barChart.resize();
        pieChart.resize();
        rightBarChart.resize();
    });

    // ── MAP CONTROLS TOGGLE ───────────────────────
    function toggleMapControls() {
        const body = document.getElementById('mapControlsBody');
        const icon = document.getElementById('mapControlsIcon');

        if (body.classList.contains('collapsed')) {
            body.classList.remove('collapsed');
            icon.className = 'bi bi-chevron-up';
        } else {
            body.classList.add('collapsed');
            icon.className = 'bi bi-chevron-down';
        }
    }

    // ── THEME PANEL TOGGLE ────────────────────────
    function toggleThemePanel() {
        const panel = document.getElementById('themePanel');
        const icon  = document.getElementById('themeBtnIcon');
        const btn   = document.getElementById('themeToggleBtn');

        if (panel.style.right === '0px') {
            panel.style.right = '-320px';
            icon.className = 'bi bi-chevron-left';
            btn.style.right = '0';
        } else {
            panel.style.right = '0px';
            icon.className = 'bi bi-chevron-right';
            btn.style.right = '320px';
        }
    }

    // ── DARK / LIGHT MODE ─────────────────────────
    function toggleDarkMode() {
        const body   = document.body;
        const toggle = document.getElementById('modeToggle');
        const circle = document.getElementById('modeToggleCircle');
        const label  = document.getElementById('modeLabel');

        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            // Switch to dark
            toggle.style.background = '#3aabcf';
            circle.style.left = '25px';
            label.textContent = 'Dark';
        } else {
            // Switch to light
            toggle.style.background = '#ccc';
            circle.style.left = '3px';
            label.textContent = 'Light';
        }

        // Update all charts to match the new theme
        applyChartTheme();

        // Re-apply slider fills (they use inline style, need refresh)
        ['all', 'btn', 'input', 'table'].forEach(type => {
            const slider = document.getElementById(`${type}FontSlider`);
            const percent = ((slider.value - 70) / (130 - 70)) * 100;
            const trackRight = document.body.classList.contains('dark-mode') ? '#3a4556' : '#e0e0e0';
            slider.style.background = `linear-gradient(to right, #48bde1 ${percent}%, ${trackRight} ${percent}%)`;
        });
    }

    // ── COLOR THEME ───────────────────────────────
    const themeChartAccents = {
        'default': { bar1: '#5b9bd5', bar2: '#27ae60' },
        'agri':    { bar1: '#ae2795', bar2: '#2686f3' },
        'ocean':   { bar1: '#204f8d', bar2: '#f6fdff' },
    };

    function setColorTheme(theme) {
        // Apply theme variables via data-theme on body
        document.body.setAttribute('data-theme', theme);

        // Update active ring on swatch circles
        document.querySelectorAll('.color-theme-option').forEach(el => {
            el.style.boxShadow = '0 0 0 3px transparent';
        });
        document.querySelector(`[data-theme-swatch="${theme}"]`).style.boxShadow = '0 0 0 4px #6f42c1';

        // Update bar chart dataset colors to match theme
        const accent = themeChartAccents[theme];
        barChart.data.datasets[0].backgroundColor = accent.bar1;
        barChart.data.datasets[1].backgroundColor = accent.bar2;
        barChart.update();
    }

    // ── FONT SIZE ─────────────────────────────────
    function updateFont(type, value) {
        value = parseInt(value);
        document.getElementById(`${type}FontValue`).textContent = value + '%';
        document.getElementById(`${type}FontSlider`).value = value;

        const percent = ((value - 70) / (130 - 70)) * 100;
        const trackRight = document.body.classList.contains('dark-mode') ? '#3a4556' : '#e0e0e0';
        document.getElementById(`${type}FontSlider`).style.background =
            `linear-gradient(to right, #48bde1 ${percent}%, ${trackRight} ${percent}%)`;

        // At 100% (default), REMOVE the inline style entirely so the browser/Bootstrap
        // base sizing takes over cleanly — avoids layout jump on Reset All
        const isDefault = (value === 100);
        const size = value / 100;

        if (type === 'all') {
            if (isDefault) document.body.style.removeProperty('font-size');
            else document.body.style.fontSize = size + 'rem';
        }
        if (type === 'btn') {
            document.querySelectorAll('.btn').forEach(el => {
                if (isDefault) el.style.removeProperty('font-size');
                else el.style.fontSize = (0.875 * size) + 'rem';
            });
        }
        if (type === 'input') {
            document.querySelectorAll('input, select, textarea').forEach(el => {
                if (isDefault) el.style.removeProperty('font-size');
                else el.style.fontSize = (0.875 * size) + 'rem';
            });
        }
        if (type === 'table') {
            document.querySelectorAll('.table td, .table th').forEach(el => {
                if (isDefault) el.style.removeProperty('font-size');
                else el.style.fontSize = (0.875 * size) + 'rem';
            });
        }
    }

    function adjustFont(type, change) {
        const slider  = document.getElementById(`${type}FontSlider`);
        const newVal  = Math.min(130, Math.max(70, parseInt(slider.value) + change));
        updateFont(type, newVal);
    }

    // ── RESET ALL ─────────────────────────────────
    function resetAll() {
        ['all', 'btn', 'input', 'table'].forEach(type => updateFont(type, 100));

        // Reset mode to light if currently dark
        if (document.body.classList.contains('dark-mode')) {
            toggleDarkMode();
        }

        // Reset color theme to default
        setColorTheme('default');
    }

    // ── INITIALIZE SLIDER FILLS ON PAGE LOAD ──────
    document.addEventListener('DOMContentLoaded', function() {
        // Init slider fills
        ['all', 'btn', 'input', 'table'].forEach(type => {
            const slider  = document.getElementById(`${type}FontSlider`);
            const percent = ((slider.value - 70) / (130 - 70)) * 100;
            slider.style.background = `linear-gradient(to right, #48bde1 ${percent}%, #e0e0e0 ${percent}%)`;
        });
        // Set default theme swatch as active on page load
        const activeSwatch = document.querySelector('[data-theme-swatch="default"]');
        if (activeSwatch) activeSwatch.style.boxShadow = '0 0 0 4px #6f42c1';
    });
</script>