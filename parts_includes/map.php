<!-- ══════════════════════════════════════
     FULL-WIDTH MAP HERO WITH OVERLAID STATS
══════════════════════════════════════ -->
<div class="mb-3" style="position:relative; width:100%; height:820px; border-radius:15px; overflow:hidden; box-shadow:0 5px 6px rgba(0,0,0,0.07)">

    <!-- Full-width background map -->
    <div id="map" style="position:absolute; inset:0; width:100%; height:100%;"></div>

    <!-- TOP-RIGHT: Active Farmers glassmorphism + Map Controls -->
    <div style="position:absolute; top:16px; right:16px; z-index:3; display:flex; flex-direction:column; align-items:flex-end; gap:10px;">
        <div style="display:flex; align-items:flex-start; gap:10px;">

            <!-- Active Farmers glassmorphism box -->
            <div style="background:rgba(30,30,30,0.45); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,0.2); color:#fff; padding:14px 18px; border-radius:10px; display:flex; align-items:center; gap:28px; white-space:nowrap;">
                <div>
                    <p style="font-size:13px; color:rgba(255,255,255,0.8); margin-bottom:4px; font-weight:600;">Active Farmers</p>
                    <h4 style="font-size:28px; font-weight:700; margin-bottom:3px; color:#fff;">3</h4>
                    <small style="font-size:12px; color:#4ade80;">&#8593; 0.0% from last month</small>
                </div>
                <button class="btn btn-sm" style="background:rgba(255,255,255,0.18); color:#fff; border:1px solid rgba(255,255,255,0.3); padding:7px 16px; border-radius:7px;">
                    View Details
                </button>
            </div>

            <!-- Map Controls Panel -->
            <div class="map-controls-panel" style="position:static;">
                <div class="controls-title" style="cursor:pointer; user-select:none;" onclick="opaToggleMapControls();">
                    MAP CONTROLS
                    <i class="bi bi-chevron-up" id="toggleIcon" style="font-size:11px; transition:transform 0.3s ease; display:inline-block;"></i>
                </div>
                <div id="legendContent" style="overflow:hidden; transition:max-height 0.3s ease, opacity 0.3s ease; max-height:600px; opacity:1;">
                    <p class="text-muted mb-1" style="font-size:11px;">View Options</p>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox" id="showBoundaries" checked>
                        <label class="form-check-label" for="showBoundaries">Show Boundaries</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox" id="showDamage" checked>
                        <label class="form-check-label" for="showDamage">Show Damage Areas</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox" id="showWeather">
                        <label class="form-check-label" for="showWeather">Show Weather Satellite</label>
                    </div>
                    <!-- Weather options (hidden until checkbox checked) -->
                    <div id="weatherOptions" style="display:none; margin-left:4px; margin-bottom:8px;">
                        <p class="text-muted mb-1" style="font-size:11px;">Himawari-8 Satellite</p>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="weatherType" id="weatherInfrared" value="b13" checked>
                            <label class="form-check-label" for="weatherInfrared" style="font-size:11px;">Infrared (B13)</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="weatherType" id="weatherVisible" value="b03">
                            <label class="form-check-label" for="weatherVisible" style="font-size:11px;">Visible (B03)</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="weatherType" id="weatherWaterVapor" value="b08">
                            <label class="form-check-label" for="weatherWaterVapor" style="font-size:11px;">Water Vapor (B08)</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="weatherType" id="weatherAirmass" value="arm">
                            <label class="form-check-label" for="weatherAirmass" style="font-size:11px;">Airmass RGB</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="weatherType" id="weatherTrueColor" value="tre">
                            <label class="form-check-label" for="weatherTrueColor" style="font-size:11px;">True Color</label>
                        </div>
                        <!-- Weather status box -->
                        <div class="weather-status-box">
                            <div class="weather-time-box">
                                <div style="font-size:14px; font-weight:bold;">
                                    <i class="fas fa-clock"></i> <span id="weatherTimeDisplay">--:-- UTC</span>
                                </div>
                                <div class="text-muted" style="font-size:11px;">
                                    Frame: <span id="weatherFrameCounter">-/-</span>
                                </div>
                            </div>
                            <div class="mb-1">
                                <strong style="font-size:11px;">Opacity:</strong>
                                <span id="weatherOpacityValue" style="font-size:11px;">70%</span>
                                <input type="range" id="weatherOpacity" min="0" max="100" value="70"
                                    style="width:100%; height:4px; accent-color:#48bde1;">
                            </div>
                            <div class="mb-1">
                                <strong style="font-size:11px;">Speed:</strong>
                                <span id="weatherSpeedValue" style="font-size:11px;">500ms</span>
                                <input type="range" id="weatherSpeed" min="100" max="2000" value="500" step="100"
                                    style="width:100%; height:4px; accent-color:#48bde1;">
                            </div>
                            <div class="weather-footer">
                                <i class="fas fa-satellite"></i> Himawari-8 Animation<br>
                                <span id="weatherStatus" style="color:#00a65a; font-weight:600;"></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mb-1" style="font-size:11px;">Farm Types</p>
                    <div class="mb-2">
                        <span class="legend-dot" style="background:#27ae60;"></span>
                        <span style="font-size:11px;">Farm Areas (Healthy)</span>
                    </div>
                    <p class="text-muted mb-1" style="font-size:11px;">Status Classification (all_statuses)</p>
                    <div><span class="legend-square" style="background:#222;"></span><span style="font-size:11px;">Critical (76-100%)</span></div>
                    <div><span class="legend-square" style="background:#e74c3c;"></span><span style="font-size:11px;">High (51-75%)</span></div>
                    <div><span class="legend-square" style="background:#e67e22;"></span><span style="font-size:11px;">Medium (26-50%)</span></div>
                    <div><span class="legend-square" style="background:#f1c40f;"></span><span style="font-size:11px;">Low (1-25%)</span></div>
                    <div><span class="legend-square" style="background:#27ae60;"></span><span style="font-size:11px;">No Damage (0%)</span></div>
                </div>
            </div>
            <!-- END Map Controls Panel -->

        </div>
    </div>
    <!-- END top-right -->

    <!-- STATS OVERLAY — top-left -->
    <div style="position:absolute; top:16px; left:16px; z-index:2; display:flex; flex-direction:column; gap:10px; width:560px;">

        <!-- 4 stat cards 2x2 -->
        <div class="row g-2">
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:16px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Active Farms</h6>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">9,936</h3>
                        <small>&#8593; 0.0% from last month</small>
                    </div>
                    <div class="stat-icon" style="background:#5cb85c; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-seedling text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:16px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Active Farmers</h6>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">9,938</h3>
                        <small>&#8593; 0.0% from last month</small>
                    </div>
                    <div class="stat-icon" style="background:#f28b7d; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-person text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:16px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Agriculture</h6>
                        <span class="text-muted-sm d-block">Total Farm</span>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">9,936</h3>
                        <span class="text-muted-sm">Total Area (ha) 10.33</span>
                    </div>
                    <div class="stat-icon" style="background:#f0ad4e; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-tractor text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:16px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Fishery</h6>
                        <span class="text-muted-sm d-block">Fisheries</span>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">1</h3>
                        <span class="text-muted-sm">Water Area (ha) 21.00</span>
                    </div>
                    <div class="stat-icon" style="background:#428bca; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-fish text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Bar Chart -->
        <div class="section-card">
            <div class="section-body" style="padding:12px 14px;">
                <div style="height:280px;">
                    <canvas id="rightBarChart"></canvas>
                </div>
                <p class="fw-bold fs-4 mb-0 mt-1">3</p>
            </div>
        </div>

        <!-- Organizations + Livestock -->
        <div class="row g-2">
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:16px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Organizations</h6>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">22</h3>
                        <span class="text-muted-sm">16 Members</span>
                    </div>
                    <div class="stat-icon" style="background:#9b59b6; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-people-group text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card" style="min-height:130px !important; padding:20px 20px !important;">
                    <div class="stat-info">
                        <h6 style="font-size:0.875rem !important; margin-bottom:2px;">Livestock</h6>
                        <span class="text-muted-sm d-block">Facilities</span>
                        <h3 style="font-size:1.5rem !important; margin-bottom:2px;">1</h3>
                        <span class="text-muted-sm">Inventory (heads) 0</span>
                    </div>
                    <div class="stat-icon" style="background:#5bc0de; width:48px; height:48px; font-size:20px;">
                        <i class="fa-solid fa-cow text-white"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Stats overlay -->

</div>
<!-- END FULL-WIDTH MAP HERO -->
