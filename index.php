<?php include 'parts_includes/head.php'; ?>
<?php include 'parts_includes/navbar.php'; ?>
<?php include 'parts_includes/header.php'; ?>

<div class="container-fluid px-4 pb-4">

    <!-- ── TOP 2-COLUMN LAYOUT ── -->
    <div class="row g-3 mb-3">

        <!-- LEFT SIDE (col-4) — Stats 2x2 + Sidebar Bar Chart + Orgs & Livestock -->
        <div class="col-lg-4 d-flex flex-column gap-3">

            <!-- Stats 2x2 Grid -->
            <div class="row g-3">
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Active Farms</h6>
                            <h3>9,936</h3>
                            <small>↑ 0.0% from last month</small>
                        </div>
                        <div class="stat-icon" style="background:#5cb85c;">
                            <i class="fa-solid fa-house-chimney text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Active Farmers</h6>
                            <h3>9,938</h3>
                            <small>↑ 0.0% from last month</small>
                        </div>
                        <div class="stat-icon" style="background:#f28b7d;">
                            <i class="fa-solid fa-person text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Agriculture</h6>
                            <span class="text-muted-sm d-block">Total Farm</span>
                            <h3>9,936</h3>
                            <span class="text-muted-sm">Total Area (ha) 10.33</span>
                        </div>
                        <div class="stat-icon" style="background:#f0ad4e;">
                            <i class="fa-solid fa-seedling text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Fishery</h6>
                            <span class="text-muted-sm d-block">Fisheries</span>
                            <h3>1</h3>
                            <span class="text-muted-sm">Water Area (ha) 21.00</span>
                        </div>
                        <div class="stat-icon" style="background:#428bca;">
                            <i class="fa-solid fa-fish text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Stats 2x2 -->

            <!-- Sidebar Bar Chart -->
            <div class="section-card flex-grow-1">
                <div class="section-body">
                    <div style="height: 320px;">
                        <canvas id="rightBarChart"></canvas>
                    </div>
                    <p class="fw-bold fs-4 mb-0 mt-2">3</p>
                </div>
            </div>
            <!-- END Sidebar Bar Chart -->

            <!-- Organizations + Livestock side by side -->
            <div class="row g-3">
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Organizations</h6>
                            <h3>22</h3>
                            <span class="text-muted-sm">16 Members</span>
                        </div>
                        <div class="stat-icon" style="background:#9b59b6;">
                            <i class="fa-solid fa-people-group text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h6>Livestock</h6>
                            <span class="text-muted-sm d-block">Facilities</span>
                            <h3>1</h3>
                            <span class="text-muted-sm">Inventory (heads) 0</span>
                        </div>
                        <div class="stat-icon" style="background:#5bc0de;">
                            <i class="fa-solid fa-cow text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Organizations + Livestock -->

        </div>
        <!-- END LEFT SIDE -->

        <!-- RIGHT SIDE (col-8) — Full Map -->
        <div class="col-lg-8">
            <div class="section-card h-100">
                <div class="section-header">
                    GIS Mapping with Damage Assessment & Weather
                </div>
                <div class="section-body p-2" style="height: calc(100% - 53px);">
                    <div style="position:relative; height:100%; min-height:500px; border-radius:8px; overflow:hidden;">

                        <!-- MapLibre Map -->
                        <div id="map" style="width:100%; height:100%;"></div>

                        <!-- Map Controls Panel -->
                        <div class="map-controls-panel">
                            <div class="controls-title" onclick="toggleMapControls()" style="cursor:pointer;">
                                MAP CONTROLS
                                <i class="bi bi-chevron-up" id="mapControlsIcon" style="font-size:11px;"></i>
                            </div>
                            <div id="mapControlsBody">
                                <p class="text-muted mb-1" style="font-size:11px;">View Options</p>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Show Boundaries</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Show Damage Areas</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Show Weather Satellite</label>
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

                        <!-- Bottom overlay -->
                        <div style="
                            position: absolute;
                            bottom: 16px;
                            left: 16px;
                            z-index: 2;
                            background: rgba(255,255,255,0.1);
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border: 1px solid rgba(255,255,255,0.2);
                            color: #fff;
                            padding: 14px 16px;
                            border-radius: 10px;
                            display: flex;
                            align-items: flex-start;
                            justify-content: space-between;
                            gap: 40px;
                            min-width: 320px;
                        ">
                            <div>
                                <p style="font-size:13px; color:white; margin-bottom:4px; font-weight:600;">Active Farmers</p>
                                <h4 style="font-size:28px; font-weight:700; margin-bottom:4px;">3</h4>
                                <small style="font-size:12px; color:#4ade80;">↑ 0.0% from last month</small>
                            </div>
                            <button class="btn btn-sm" style="background:rgba(255,255,255,0.2); color:#fff; border:none; padding:6px 14px; border-radius:6px;">
                                View Details
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END RIGHT SIDE -->

    </div>
    <!-- END TOP 2-COLUMN LAYOUT -->

    <!-- ── BOTTOM SECTION ── -->

    <!-- Row 1: Damage Assessment Table — full width -->
    <?php include 'parts_includes/table.php'; ?>

    <!-- Row 2: Bar Chart (col-8) + Pie Chart (col-4) -->
    <div class="row g-3 mb-3">
        <div class="col-lg-8">
            <div class="section-card">
                <div class="section-header d-flex justify-content-between align-items-center">
                    <span>Top Municipalities Bar Chart</span>
                    <select class="form-select form-select-sm w-auto">
                        <option>All Municipalities</option>
                        <option>Angeles City</option>
                        <option>Mabalacat City</option>
                        <option>San Fernando</option>
                    </select>
                </div>
                <div class="section-body">
                    <div style="height: 400px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="section-card h-100">
                <div class="section-header">Farm Types</div>
                <div class="section-body">
                    <div style="height: 350px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Recent Registrations (col-6) + Recent Interventions (col-6) -->
    <div class="row g-3 mb-3">

        <!-- Recent Registrations -->
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">Recent Registrations</div>
                <div class="section-body reg-scrollable">
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Andres Bonifacio</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-000034</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SANTA JOSE, MABALACAT CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Erika Santos</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00090</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SAN PABLO, ANGELES CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Juan Dela Cruz</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00092</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SANTA RITA, CITY OF SAN FERNANDO</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Pedro Reyes</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-000034</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SANTA JOSE, MABALACAT CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Maria Santos</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00090</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SAN PABLO, ANGELES CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Angel Dela Cruz</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00090</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SAN PABLO, ANGELES CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Kristine Reyes</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00090</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SAN PABLO, ANGELES CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Mark Gonzales</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00090</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SAN PABLO, ANGELES CITY</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                    <div class="reg-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="reg-name">Joseph Cruz</div>
                                <div class="reg-meta"><i class="bi bi-upc-scan"></i> 03-54-08-026-00092</div>
                                <div class="reg-meta"><i class="bi bi-geo-alt-fill" style="color:#e74c3c;"></i> SANTA RITA, CITY OF SAN FERNANDO</div>
                            </div>
                            <div class="reg-date">Jan 6, 2026</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Recent Registrations -->

        <!-- Recent Interventions -->
        <div class="col-lg-6">
            <div class="section-card h-100">
                <div class="section-header">Recent Interventions</div>
                <div class="section-body">
                    <div class="intervention-item">
                        <div class="d-flex gap-4">
                            <div style="width:32px;height:32px;background:#27ae60;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-gift-fill text-white" style="font-size:14px;"></i>
                            </div>
                            <div class="flex-1 w-100">
                                <div class="int-meta mb-1"><i class="bi bi-clock"></i> Jan 6, 2026</div>
                                <div class="int-name">Rice Seeds</div>
                                <div class="int-meta mb-1"><i class="bi bi-person-fill"></i> Juan Dela Cruz</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="int-detail">Qty: 21.00 | Cost: ₱21.00</div>
                                    <span class="badge-active">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Recent Interventions -->

    </div>
    <!-- END ROW 3 -->

</div>

<?php include 'parts_includes/theme_panel.php'; ?>
<?php include 'parts_includes/footer.php'; ?>
<?php include 'parts_includes/scripts.php'; ?>