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
        Chart.defaults.color = c.tickColor;
        barChart.options.scales.x.grid.color = c.gridColor;
        barChart.options.scales.y.grid.color = c.gridColor;
        barChart.options.scales.x.ticks.color = c.tickColor;
        barChart.options.scales.y.ticks.color = c.tickColor;
        barChart.options.plugins.legend.labels.color = c.legendColor;
        barChart.update();
        pieChart.options.plugins.legend.labels.color = c.legendColor;
        pieChart.update();
        rightBarChart.options.scales.x.grid.color = c.gridColor;
        rightBarChart.options.scales.y.grid.color = c.gridColor;
        rightBarChart.options.scales.x.ticks.color = c.tickColor;
        rightBarChart.options.scales.y.ticks.color = c.tickColor;
        rightBarChart.options.plugins.legend.labels.color = c.legendColor;
        rightBarChart.update();
    }

    // ── BAR CHART (hidden, kept for data compatibility) ──────────────────
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Angeles City', 'City of San Fernando', 'Mabalacat City'],
            datasets: [
                { label: 'Farmers', data: [1, 2, 1], backgroundColor: '#5b9bd5', borderRadius: 4 },
                { label: 'Farms',   data: [2, 3, 2], backgroundColor: '#27ae60', borderRadius: 4 }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { color: '#666' } } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { color: '#666' } },
                x: { grid: { display: false }, ticks: { color: '#666' } }
            }
        }
    });

    // ── PIE / DONUT CHART ─────────────────────────
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Rice Farm'],
            datasets: [{ data: [100], backgroundColor: ['#5b9bd5'], borderWidth: 2 }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { color: '#666' } } },
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
                { label: 'Farmers', data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#5b9bd5', borderRadius: 4 },
                { label: 'Farms',   data: [0,0,0,0,0,0,0,0,0,0], backgroundColor: '#27ae60', borderRadius: 4 }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 }, color: '#666' } } },
            scales: {
                x: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { font: { size: 10 }, color: '#666' } },
                y: { ticks: { font: { size: 10 }, color: '#666' }, grid: { display: false } }
            }
        }
    });

    window.addEventListener('resize', function() {
        barChart.resize();
        pieChart.resize();
        rightBarChart.resize();
    });

    // ── HIMAWARI WEATHER SERVICE ──────────────────────────────────────────
    class HimawariWeatherService {
        constructor() {
            this.baseUrl = 'https://www.data.jma.go.jp/mscweb/data/himawari';
            this.updateInterval = 500;
            this.intervalId = null;
            this.currentFrameIndex = 0;
            this.availableUrls = [];
            this.isAnimating = false;
        }

        getAllUrls(type = 'b13') {
            const urls = [];
            for (let hour = 0; hour < 24; hour++) {
                for (let minute = 0; minute < 60; minute += 10) {
                    const timeStr = String(hour).padStart(2, '0') + String(minute).padStart(2, '0');
                    urls.push({ url: `${this.baseUrl}/img/se2/se2_${type}_${timeStr}.jpg`, time: timeStr, hour, minute });
                }
            }
            return urls;
        }

        async findAvailableUrls(type = 'b13', onProgress = null) {
            const allUrls = this.getAllUrls(type);
            const available = [];
            const timestamp = Date.now();
            const batchSize = 10;
            for (let i = 0; i < allUrls.length; i += batchSize) {
                const batch = allUrls.slice(i, i + batchSize);
                const results = await Promise.all(batch.map(async (item) => {
                    try {
                        const response = await fetch(item.url + '?t=' + timestamp, { method: 'HEAD', cache: 'no-cache' });
                        return response.ok ? item : null;
                    } catch { return null; }
                }));
                results.forEach(r => { if (r) available.push(r); });
                if (onProgress) onProgress(Math.min(i + batchSize, allUrls.length), allUrls.length, available.length);
            }
            available.sort((a, b) => (a.hour * 60 + a.minute) - (b.hour * 60 + b.minute));
            this.availableUrls = available;
            return available;
        }

        getImageBounds() { return [[105, 29.1],[140, 29.1],[140, 0],[105, 0]]; }
        getCurrentFrame() { return this.availableUrls.length === 0 ? null : this.availableUrls[this.currentFrameIndex]; }
        nextFrame() {
            if (this.availableUrls.length === 0) return null;
            this.currentFrameIndex = (this.currentFrameIndex + 1) % this.availableUrls.length;
            return this.getCurrentFrame();
        }
        startAnimation(callback) {
            if (this.intervalId) clearInterval(this.intervalId);
            this.isAnimating = true;
            this._lastCallback = callback;
            this.intervalId = setInterval(() => { if (this.isAnimating) callback(this.nextFrame()); }, this.updateInterval);
        }
        stopAnimation() {
            this.isAnimating = false;
            if (this.intervalId) { clearInterval(this.intervalId); this.intervalId = null; }
        }
    }

    // ── GIS MAP CLASS ─────────────────────────────────────────────────────
    class OpaGISMap {
        constructor() {
            this.map = null;
            this.polygonLayers = [];
            this.damagePolygonLayers = [];
            this.markers = [];
            this.currentPopup = null;
            this.showBoundaries = true;
            this.showDamage = true;
            this.showWeather = false;
            this.weatherType = 'b13';
            this.weatherOpacity = 0.7;
            this.weatherService = new HimawariWeatherService();
        }

        initialize() {
            this.map = new maplibregl.Map({
                container: 'map',   // POC uses id="map"
                style: {
                    version: 8,
                    sources: {
                        'satellite': {
                            type: 'raster',
                            tiles: ['https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'],
                            tileSize: 256,
                            attribution: '&copy; Esri'
                        },
                        'labels': {
                            type: 'raster',
                            tiles: ['https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}'],
                            tileSize: 256,
                            attribution: '&copy; Esri'
                        }
                    },
                    layers: [
                        { id: 'satellite', type: 'raster', source: 'satellite', minzoom: 0, maxzoom: 22 },
                        { id: 'labels',    type: 'raster', source: 'labels',    minzoom: 0, maxzoom: 22 }
                    ]
                },
                center: [120.7117, 15.4817],
                zoom: 9,
                maxZoom: 20,
                minZoom: 6
            });

            this.map.addControl(new maplibregl.NavigationControl(), 'top-right');
            this.map.addControl(new maplibregl.FullscreenControl(), 'top-right');

            this.map.on('load', async () => {
                await this.addWeatherLayer();
            });

            this.setupFilterControls();
        }

        async addWeatherLayer() {
            const bounds = this.weatherService.getImageBounds();
            const timestamp = Date.now();
            const placeholderUrl = `${this.weatherService.baseUrl}/img/se2/se2_${this.weatherType}_0000.jpg?t=${timestamp}`;
            this.map.addSource('weather-layer', { type: 'image', url: placeholderUrl, coordinates: bounds });
            this.map.addLayer({ id: 'weather-overlay', type: 'raster', source: 'weather-layer', paint: { 'raster-opacity': this.weatherOpacity }, layout: { visibility: 'none' } }, 'labels');
        }

        async startWeatherAnimation() {
            const statusEl = document.getElementById('weatherStatus');
            const timeDisplay = document.getElementById('weatherTimeDisplay');
            const bounds = this.weatherService.getImageBounds();
            if (statusEl) statusEl.textContent = '🔄 Scanning...';
            await this.weatherService.findAvailableUrls(this.weatherType, (current, total, found) => {
                if (statusEl) statusEl.textContent = `🔄 Scanning ${current}/${total} (${found} found)`;
            });
            const count = this.weatherService.availableUrls.length;
            if (count === 0) { if (statusEl) statusEl.textContent = '❌ No images available'; return; }
            if (statusEl) statusEl.textContent = `▶ Playing ${count} frames`;
            this.weatherService._lastCallback = (frame) => {
                if (!frame || !this.showWeather) return;
                const ts = Date.now();
                if (this.map.getSource('weather-layer')) {
                    this.map.getSource('weather-layer').updateImage({ url: frame.url + '?t=' + ts, coordinates: bounds });
                }
                if (timeDisplay) timeDisplay.textContent = `${String(frame.hour).padStart(2,'0')}:${String(frame.minute).padStart(2,'0')} UTC`;
                const fc = document.getElementById('weatherFrameCounter');
                if (fc) fc.textContent = `${this.weatherService.currentFrameIndex + 1}/${count}`;
            };
            this.weatherService.startAnimation(this.weatherService._lastCallback);
        }

        async toggleWeatherLayer(show) {
            this.showWeather = show;
            const statusEl = document.getElementById('weatherStatus');
            if (this.map.getLayer('weather-overlay')) {
                this.map.setLayoutProperty('weather-overlay', 'visibility', show ? 'visible' : 'none');
                if (show) {
                    await this.startWeatherAnimation();
                } else {
                    this.weatherService.stopAnimation();
                    if (statusEl) statusEl.textContent = '';
                    const td = document.getElementById('weatherTimeDisplay'); if (td) td.textContent = '--:-- UTC';
                    const fc = document.getElementById('weatherFrameCounter'); if (fc) fc.textContent = '-/-';
                }
            }
            const weatherOptions = document.getElementById('weatherOptions');
            if (weatherOptions) weatherOptions.style.display = show ? 'block' : 'none';
        }

        async setWeatherType(type) {
            this.weatherType = type;
            if (this.showWeather) {
                this.weatherService.stopAnimation();
                this.weatherService.availableUrls = [];
                this.weatherService.currentFrameIndex = 0;
                await this.startWeatherAnimation();
            }
        }

        setWeatherOpacity(opacity) {
            this.weatherOpacity = opacity;
            if (this.map.getLayer('weather-overlay')) {
                this.map.setPaintProperty('weather-overlay', 'raster-opacity', opacity);
            }
        }

        setupFilterControls() {
            const showBoundariesCb = document.getElementById('showBoundaries');
            const showDamageCb     = document.getElementById('showDamage');
            const showWeatherCb    = document.getElementById('showWeather');

            if (showBoundariesCb) showBoundariesCb.addEventListener('change', (e) => {
                this.showBoundaries = e.target.checked;
            });
            if (showDamageCb) showDamageCb.addEventListener('change', (e) => {
                this.showDamage = e.target.checked;
            });
            if (showWeatherCb) showWeatherCb.addEventListener('change', (e) => {
                this.toggleWeatherLayer(e.target.checked);
            });

            document.querySelectorAll('input[name="weatherType"]').forEach(r => {
                r.addEventListener('change', (e) => { if (e.target.checked) this.setWeatherType(e.target.value); });
            });

            const wOpacity = document.getElementById('weatherOpacity');
            const wOpacityVal = document.getElementById('weatherOpacityValue');
            if (wOpacity && wOpacityVal) wOpacity.addEventListener('input', (e) => {
                this.setWeatherOpacity(e.target.value / 100);
                wOpacityVal.textContent = e.target.value + '%';
            });

            const wSpeed = document.getElementById('weatherSpeed');
            const wSpeedVal = document.getElementById('weatherSpeedValue');
            if (wSpeed && wSpeedVal) wSpeed.addEventListener('input', (e) => {
                const speed = parseInt(e.target.value);
                wSpeedVal.textContent = speed + 'ms';
                this.weatherService.updateInterval = speed;
                if (this.showWeather && this.weatherService.isAnimating) {
                    this.weatherService.stopAnimation();
                    this.weatherService.startAnimation(this.weatherService._lastCallback);
                }
            });
        }
    }

    // ── MAP CONTROLS TOGGLE ───────────────────────
    var _mapControlsOpen = true;
    function opaToggleMapControls() {
        var content = document.getElementById('legendContent');
        var icon    = document.getElementById('toggleIcon');
        if (!content) return;
        _mapControlsOpen = !_mapControlsOpen;
        if (_mapControlsOpen) {
            content.style.maxHeight = '600px';
            content.style.opacity   = '1';
            if (icon) icon.style.transform = 'rotate(0deg)';
        } else {
            content.style.maxHeight = '0';
            content.style.opacity   = '0';
            if (icon) icon.style.transform = 'rotate(180deg)';
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
            toggle.style.background = '#3aabcf';
            circle.style.left = '25px';
            label.textContent = 'Dark';
        } else {
            toggle.style.background = '#ccc';
            circle.style.left = '3px';
            label.textContent = 'Light';
        }
        applyChartTheme();
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
        document.body.setAttribute('data-theme', theme);
        document.querySelectorAll('.color-theme-option').forEach(el => {
            el.style.boxShadow = '0 0 0 3px transparent';
        });
        document.querySelector(`[data-theme-swatch="${theme}"]`).style.boxShadow = '0 0 0 4px #6f42c1';
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
        const slider = document.getElementById(`${type}FontSlider`);
        const newVal = Math.min(130, Math.max(70, parseInt(slider.value) + change));
        updateFont(type, newVal);
    }

    // ── RESET ALL ─────────────────────────────────
    function resetAll() {
        ['all', 'btn', 'input', 'table'].forEach(type => updateFont(type, 100));
        if (document.body.classList.contains('dark-mode')) toggleDarkMode();
        setColorTheme('default');
    }

    // ── INITIALIZE ON PAGE LOAD ───────────────────
    document.addEventListener('DOMContentLoaded', function() {
        // Init slider fills
        ['all', 'btn', 'input', 'table'].forEach(type => {
            const slider  = document.getElementById(`${type}FontSlider`);
            const percent = ((slider.value - 70) / (130 - 70)) * 100;
            slider.style.background = `linear-gradient(to right, #48bde1 ${percent}%, #e0e0e0 ${percent}%)`;
        });
        // Set default theme swatch active
        const activeSwatch = document.querySelector('[data-theme-swatch="default"]');
        if (activeSwatch) activeSwatch.style.boxShadow = '0 0 0 4px #6f42c1';

        // Initialize GIS Map
        const gisMap = new OpaGISMap();
        gisMap.initialize();
    });
</script>
