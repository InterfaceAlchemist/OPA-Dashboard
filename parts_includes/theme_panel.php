<!-- ══════════════════════════════════════
     THEME SETTINGS PANEL
══════════════════════════════════════ -->

<!-- Toggle Button (always visible on right side) -->
<div id="themeToggleBtn" onclick="toggleThemePanel()">
    <i class="bi bi-chevron-left" id="themeBtnIcon"></i>
</div>

<!-- Sliding Panel -->
<div id="themePanel">

    <!-- Header -->
    <h5 class="tp-title">Theme Settings</h5>

    <!-- Mode Toggle -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <span class="tp-label">Mode</span>
        <div class="d-flex align-items-center gap-2">
            <div id="modeToggle" onclick="toggleDarkMode()">
                <div id="modeToggleCircle"></div>
            </div>
            <span id="modeLabel" class="tp-label">Light</span>
        </div>
    </div>

    <!-- Color Theme -->
    <div class="mb-4">
        <p class="tp-section-label">Color Theme</p>
        <div class="d-flex gap-3">
            <!-- Theme 1: Default (Blue/Grey) -->
            <div class="color-theme-option" data-theme-swatch="default" onclick="setColorTheme('default')"
                style="background: linear-gradient(135deg, #1a4bbd 50%, #e0e0e0 50%);"></div>
            <!-- Theme 2: Agriculture (Green/Gold) -->
            <div class="color-theme-option" data-theme-swatch="agri" onclick="setColorTheme('agri')"
                style="background: linear-gradient(135deg, #1A6B3C 50%, #F0AD4E 50%);"></div>
            <!-- Theme 3: Ocean (Navy/Cyan) -->
            <div class="color-theme-option" data-theme-swatch="ocean" onclick="setColorTheme('ocean')"
                style="background: linear-gradient(135deg, #1A3C6E 50%, #48bde1 50%);"></div>
        </div>
    </div>

    <hr class="tp-divider">

    <!-- Font Size Settings -->
    <h5 class="tp-title">Font Size Settings</h5>

    <!-- All -->
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
            <span class="tp-font-label">All</span>
            <span id="allFontValue" class="tp-font-value">100%</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button onclick="adjustFont('all', -5)" class="btn btn-l btn-secondary tp-btn">-</button>
            <input type="range" id="allFontSlider" min="70" max="130" value="100" class="form-range flex-1"
                oninput="updateFont('all', this.value)">
            <button onclick="adjustFont('all', 5)" class="btn btn-l btn-secondary tp-btn">+</button>
        </div>
    </div>

    <!-- Button -->
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
            <span class="tp-font-label">Button</span>
            <span id="btnFontValue" class="tp-font-value">100%</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button onclick="adjustFont('btn', -5)" class="btn btn-l btn-secondary tp-btn">-</button>
            <input type="range" id="btnFontSlider" min="70" max="130" value="100" class="form-range flex-1"
                oninput="updateFont('btn', this.value)">
            <button onclick="adjustFont('btn', 5)" class="btn btn-l btn-secondary tp-btn">+</button>
        </div>
    </div>

    <!-- Input Fields -->
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
            <span class="tp-font-label">Input Fields</span>
            <span id="inputFontValue" class="tp-font-value">100%</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button onclick="adjustFont('input', -5)" class="btn btn-l btn-secondary tp-btn">-</button>
            <input type="range" id="inputFontSlider" min="70" max="130" value="100" class="form-range flex-1"
                oninput="updateFont('input', this.value)">
            <button onclick="adjustFont('input', 5)" class="btn btn-l btn-secondary tp-btn">+</button>
        </div>
    </div>

    <!-- Table -->
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
            <span class="tp-font-label">Table</span>
            <span id="tableFontValue" class="tp-font-value">100%</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button onclick="adjustFont('table', -5)" class="btn btn-l btn-secondary tp-btn">-</button>
            <input type="range" id="tableFontSlider" min="70" max="130" value="100" class="form-range flex-1"
                oninput="updateFont('table', this.value)">
            <button onclick="adjustFont('table', 5)" class="btn btn-l btn-secondary tp-btn">+</button>
        </div>
    </div>

    <!-- Reset All -->
    <button onclick="resetAll()" class="btn w-100 tp-reset-btn">Reset All</button>

</div>