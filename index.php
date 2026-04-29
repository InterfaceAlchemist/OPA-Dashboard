<?php include 'parts_includes/head.php'; ?>
<?php include 'parts_includes/navbar.php'; ?>
<?php include 'parts_includes/header.php'; ?>

<div class="container-fluid px-3 pb-4">

    <!-- ── FULL-WIDTH MAP HERO ── -->
    <?php include 'parts_includes/map.php'; ?>

    <!-- ── DAMAGE ASSESSMENT TABLE ── -->
    <?php include 'parts_includes/table.php'; ?>

    <!-- ── BOTTOM ROW: Farm Types + Recent Registrations + Recent Interventions ── -->
    <div class="row g-3 mb-3">

        <!-- Farm Types Donut Chart -->
        <div class="col-lg-3">
            <div class="section-card h-100">
                <div class="section-header">Farm Types</div>
                <div class="section-body">
                    <div style="height:330px;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="col-lg-5">
            <div class="section-card h-100">
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

        <!-- Recent Interventions -->
        <div class="col-lg-4">
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

    </div>
    <!-- END BOTTOM ROW -->

</div>

<!-- Hidden barChart canvas for JS compatibility -->
<canvas id="barChart" style="display:none;"></canvas>

<?php include 'parts_includes/theme_panel.php'; ?>
<?php include 'parts_includes/footer.php'; ?>
<?php include 'parts_includes/scripts.php'; ?>
