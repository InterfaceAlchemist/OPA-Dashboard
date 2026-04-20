<!-- ══════════════════════════════════════
     GIS MAP
══════════════════════════════════════ -->
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="section-card">
            <div class="section-header">
                GIS Mapping with Damage Assessment & Weather
            </div>
            <div class="section-body p-2">

                <!-- Map wrapper — position relative so overlays work -->
                <div style="position:relative; height:420px; border-radius:8px; overflow:hidden;">

                    <!-- Real MapLibre Map -->
                    <div id="map" style="width:100%; height:100%;"></div>

                    <!-- Map Controls Panel (overlays on top of map) -->
                    <div class="map-controls-panel">
                        <!-- Clickable title to toggle collapse -->
                        <div class="controls-title" onclick="toggleMapControls()" style="cursor:pointer;">
                            MAP CONTROLS
                            <i class="bi bi-chevron-up" id="mapControlsIcon" style="font-size:11px;"></i>
                        </div>
                        <!-- Collapsible body -->
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
                        <!-- END Collapsible body -->
                    </div>

                    <!-- Bottom overlay info + View Details button -->
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
                <!-- END Map wrapper -->

            </div>
        </div>
    </div>
</div>