@extends('layouts.dashboard')

@section('title', 'Admin Dashboard - ElitePC')

@section('content')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Premium Dashboard Cards matching H-care UI */
    .stat-card-clean {
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.06);
        border-radius: 20px;
        padding: 1.75rem 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card-clean:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.08);
        border-color: rgba(99, 102, 241, 0.2);
    }
    .icon-container-pill {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .chart-card {
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.06);
        border-radius: 24px;
        padding: 2.2rem;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);
    }

    /* Popular table list matching division box */
    .division-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 0;
        border-bottom: 1px solid rgba(15, 23, 42, 0.05);
    }
    .division-row:last-child {
        border-bottom: none;
    }

    /* Custom Responsive Grid Layouts */
    .dashboard-row-2 {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2.5rem;
        margin-bottom: 2.5rem;
    }
    .dashboard-row-3 {
        display: grid;
        grid-template-columns: 1.8fr 1fr 1fr;
        gap: 2.5rem;
        margin-bottom: 2.5rem;
    }

    @media (max-width: 1200px) {
        .dashboard-row-2 {
            grid-template-columns: 1fr;
        }
        .dashboard-row-3 {
            grid-template-columns: 1.2fr 1fr;
        }
        .dashboard-row-3 > *:last-child {
            grid-column: span 2;
        }
    }
    @media (max-width: 768px) {
        .dashboard-row-3 {
            grid-template-columns: 1fr;
        }
        .dashboard-row-3 > *:last-child {
            grid-column: span 1;
        }
    }
</style>

<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Dashboard Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Platform <span class="text-gradient">Overview</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Real-time diagnostics of user metrics, network nodes, and components sales.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            ROOT ACCESS LEVEL: GRANTED
        </div>
    </div>
    
    <!-- Row 1: Mockup Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        
        <!-- Total Users (Healthcare: Total Patients) -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(99, 102, 241, 0.08); color: #6366f1;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ number_format($stats['users'] ?? 0) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Total Users</div>
            </div>
        </div>

        <!-- Active Stores (Healthcare: Available Staff) -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(6, 182, 212, 0.08); color: #06b6d4;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line><line x1="15" y1="3" x2="15" y2="21"></line><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ number_format($stats['stores'] ?? 0) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Active Stores</div>
            </div>
        </div>

        <!-- System Products (Healthcare: Avg Treatment Cost) -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(249, 115, 22, 0.08); color: #f97316;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ number_format($stats['products'] ?? 0) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Active Products</div>
            </div>
        </div>

        <!-- Catalog Categories (Healthcare: Available Cars) -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(236, 72, 153, 0.08); color: #ec4899;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 3h18v18H3zM9 3v18M15 3v18M3 9h18M3 15h18"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ number_format($stats['categories'] ?? 0) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Asset Categories</div>
            </div>
        </div>

        <!-- Pending Payouts -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(249, 115, 22, 0.08); color: #f97316;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: #f97316; line-height: 1.1;">
                    ${{ number_format($stats['pending_payouts'] ?? 0, 2) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Pending Payouts</div>
            </div>
        </div>

        <!-- Settled Payouts -->
        <div class="stat-card-clean">
            <div class="icon-container-pill" style="background: rgba(139, 92, 246, 0.08); color: #7c3aed;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: #7c3aed; line-height: 1.1;">
                    ${{ number_format($stats['settled_payouts'] ?? 0, 2) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Settled Payouts</div>
            </div>
        </div>

    </div>

    <!-- Row 2: Large Trend Charts (Pre-built Rigs vs. Custom Loop Sales & Platform Categories Breakdown) -->
    <div class="dashboard-row-2">
        <!-- Main Trend Chart Card -->
        <div class="chart-card" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <div>
                    <h3 style="font-family: 'Outfit'; font-weight: 900; font-size: 1.25rem; color: var(--text);">Pre-built Rigs vs. Custom Loop Sales</h3>
                    <p style="font-size: 0.85rem; color: var(--text-dim); margin-top: 0.2rem;">Comparison between Standard PCs and boutique Liquid Cooled Loops.</p>
                </div>
                <div style="font-size: 0.85rem; color: var(--text-dim); font-weight: 700;">Show by months &or;</div>
            </div>
            
            <div style="display: grid; grid-template-columns: 2.5fr 1fr; gap: 2rem; align-items: center; flex: 1;">
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="salesTrendChart"></canvas>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; border-left: 1px solid rgba(15,23,42,0.05); padding-left: 1.5rem;">
                    <!-- Custom SVG Radial Chart for Liquid Loops -->
                    <div style="position: relative; width: 110px; height: 110px; margin-bottom: 1.2rem;">
                        <svg viewBox="0 0 36 36" style="width: 100%; height: 100%;">
                            <path stroke="rgba(99, 102, 241, 0.08)" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path stroke="url(#gradientLiquid)" stroke-width="3.5" stroke-dasharray="28, 100" stroke-linecap="round" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <defs>
                                <linearGradient id="gradientLiquid" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#6366f1" />
                                    <stop offset="100%" stop-color="#06b6d4" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-family: 'Outfit'; font-weight: 900; font-size: 1.2rem; color: var(--text);">28%</div>
                    </div>
                    <div style="font-weight: 800; font-size: 0.9rem; color: var(--text);">Custom Liquid Loops</div>
                    <p style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.3rem;">Boutique loop systems built this quarter.</p>
                </div>
            </div>
        </div>

        <!-- Sales Categories Donut Card -->
        <div class="chart-card" style="display: flex; flex-direction: column;">
            <div style="margin-bottom: 2rem;">
                <h3 style="font-family: 'Outfit'; font-weight: 900; font-size: 1.25rem; color: var(--text);">Sales by Platform Category</h3>
                <p style="font-size: 0.85rem; color: var(--text-dim); margin-top: 0.2rem;">Inventory categories performance.</p>
            </div>
            
            <div style="position: relative; height: 200px; width: 100%; margin-bottom: 1.5rem; flex: 1;">
                <canvas id="categoryDonutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 3: Hourly Traffic, Table Breakdown & Purple Gradient Card -->
    <div class="dashboard-row-3">
        <!-- Hourly Traffic Line Graph -->
        <div class="chart-card" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                <div>
                    <h3 style="font-family: 'Outfit'; font-weight: 900; font-size: 1.25rem; color: var(--text);">Store Traffic (Hourly)</h3>
                    <p style="font-size: 0.85rem; color: var(--text-dim); margin-top: 0.2rem;">User operative load throughout the nodes.</p>
                </div>
                <div style="font-size: 0.85rem; color: var(--text-dim); font-weight: 700;">Today &or;</div>
            </div>
            
            <div style="position: relative; height: 180px; width: 100%; flex: 1;">
                <canvas id="hourlyTrafficChart"></canvas>
            </div>
        </div>

        <!-- Popular category listings (Healthcare: Patients by division) -->
        <div class="chart-card" style="display: flex; flex-direction: column;">
            <div style="margin-bottom: 2rem;">
                <h3 style="font-family: 'Outfit'; font-weight: 900; font-size: 1.25rem; color: var(--text);">Popular Sectors</h3>
                <p style="font-size: 0.85rem; color: var(--text-dim); margin-top: 0.2rem;">Popular asset classes of systems.</p>
            </div>
            
            <div style="display: flex; flex-direction: column; flex: 1; justify-content: center;">
                <div class="division-row">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 8px; height: 8px; background: #6366f1; border-radius: 50%;"></div>
                        <span style="font-size: 0.9rem; font-weight: 700; color: var(--text);">Laptops</span>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 800; color: var(--text);">247 Units</span>
                </div>
                
                <div class="division-row">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 8px; height: 8px; background: #ec4899; border-radius: 50%;"></div>
                        <span style="font-size: 0.9rem; font-weight: 700; color: var(--text);">Desktops</span>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 800; color: var(--text);">164 Units</span>
                </div>
                
                <div class="division-row">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 8px; height: 8px; background: #06b6d4; border-radius: 50%;"></div>
                        <span style="font-size: 0.9rem; font-weight: 700; color: var(--text);">Custom Loops</span>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 800; color: var(--text);">86 Units</span>
                </div>
            </div>
        </div>

        <!-- Premium Purple Highlights Card with Inline SVG Line -->
        <div style="background: linear-gradient(135deg, #7c3aed, #4f46e5); border-radius: 24px; padding: 2.2rem; display: flex; flex-direction: column; color: #ffffff; box-shadow: 0 15px 35px -10px rgba(124, 58, 237, 0.4); position: relative; overflow: hidden; height: 100%;">
            <!-- Decorative light orbs -->
            <div style="position: absolute; top: -10%; right: -10%; width: 120px; height: 120px; background: rgba(255,255,255,0.15); border-radius: 50%; filter: blur(25px); pointer-events: none;"></div>
            
            <div style="margin-bottom: 2rem; position: relative; z-index: 2;">
                <div style="font-size: 2.2rem; font-weight: 900; font-family: 'Outfit'; line-height: 1.1;">$32,400</div>
                <div style="font-size: 0.85rem; font-weight: 700; color: rgba(255,255,255,0.7); margin-top: 0.4rem; text-transform: uppercase; letter-spacing: 0.5px;">Gross Revenue (Mo)</div>
            </div>
            
            <p style="font-size: 0.82rem; line-height: 1.5; color: rgba(255,255,255,0.75); margin-bottom: 1.5rem; position: relative; z-index: 2;">Peak performance revenue generation across all localized stores and digital endpoints.</p>
            
            <!-- Glowing Inline SVG Graph -->
            <svg viewBox="0 0 100 30" width="100%" height="80" style="margin-top: auto; filter: drop-shadow(0 4px 10px rgba(255,255,255,0.35)); position: relative; z-index: 2;">
                <defs>
                    <linearGradient id="glow" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#ffffff" stop-opacity="0.3"/>
                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M0,25 Q15,10 30,20 T60,10 T90,22 L100,18 L100,30 L0,30 Z" fill="url(#glow)"/>
                <path d="M0,25 Q15,10 30,20 T60,10 T90,22 L100,18" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round"/>
                <circle cx="90" cy="22" r="3.5" fill="#ffffff" stroke="#7c3aed" stroke-width="1.5"/>
            </svg>
        </div>
    </div>
    
    <!-- Platform Management Network Grid -->
    <div class="glass-card" style="padding: 3rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); margin-top: 3.5rem;">
        <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.4rem; margin-bottom: 2rem; color: var(--text);">Core Platform Management Nodes</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem;">
            <a href="{{ route('admin.stores') }}" class="glass" style="padding: 1.5rem; border-radius: 18px; text-decoration: none; transition: 0.3s; border-color: rgba(15, 23, 42, 0.06); display: block;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='rgba(15, 23, 42, 0.06)'">
                <div style="font-weight: 800; font-size: 1rem; color: var(--text); margin-bottom: 0.4rem;">Store Network</div>
                <p style="font-size: 0.8rem; color: var(--text-dim); line-height: 1.4;">Manage architectural nodes and merchant authorization.</p>
            </a>
            <a href="{{ route('admin.users') }}" class="glass" style="padding: 1.5rem; border-radius: 18px; text-decoration: none; transition: 0.3s; border-color: rgba(15, 23, 42, 0.06); display: block;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='rgba(15, 23, 42, 0.06)'">
                <div style="font-weight: 800; font-size: 1rem; color: var(--text); margin-bottom: 0.4rem;">User Ecosystem</div>
                <p style="font-size: 0.8rem; color: var(--text-dim); line-height: 1.4;">Monitor security protocols and user authorization controls.</p>
            </a>
            <a href="{{ route('admin.categories') }}" class="glass" style="padding: 1.5rem; border-radius: 18px; text-decoration: none; transition: 0.3s; border-color: rgba(15, 23, 42, 0.06); display: block;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='rgba(15, 23, 42, 0.06)'">
                <div style="font-weight: 800; font-size: 1rem; color: var(--text); margin-bottom: 0.4rem;">Catalog Logic</div>
                <p style="font-size: 0.8rem; color: var(--text-dim); line-height: 1.4;">Define hardware taxonomies and product hierarchies.</p>
            </a>
            <a href="{{ route('admin.payment_accounts') }}" class="glass" style="padding: 1.5rem; border-radius: 18px; text-decoration: none; transition: 0.3s; border-color: rgba(15, 23, 42, 0.06); display: block;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='rgba(15, 23, 42, 0.06)'">
                <div style="font-weight: 800; font-size: 1rem; color: var(--text); margin-bottom: 0.4rem;">Financial Nodes</div>
                <p style="font-size: 0.8rem; color: var(--text-dim); line-height: 1.4;">Configure payment endpoints and vendor transaction hubs.</p>
            </a>
        </div>
    </div>
</section>

<!-- Chart Init Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sales Trend Chart (Dual Bar Chart)
        const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(salesTrendCtx, {
            type: 'bar',
            data: {
                labels: ['Oct 2025', 'Nov 2025', 'Dec 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026'],
                datasets: [
                    {
                        label: 'Pre-built Rigs',
                        data: [3100, 3500, 4200, 3700, 3400, 3900],
                        backgroundColor: '#6366f1',
                        borderRadius: 6,
                        barThickness: 10,
                    },
                    {
                        label: 'Custom Loops',
                        data: [1500, 2400, 950, 1400, 1800, 1100],
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        barThickness: 10,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: 'Inter', size: 11, weight: '600' },
                            padding: 15,
                            boxWidth: 8,
                            usePointStyle: true,
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { drawBorder: false, color: 'rgba(15,23,42,0.04)' },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    }
                }
            }
        });

        // Category Donut Chart
        const categoryCtx = document.getElementById('categoryDonutChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laptops', 'Desktops', 'Components'],
                datasets: [{
                    data: [45, 30, 25],
                    backgroundColor: ['#f97316', '#6366f1', '#06b6d4'],
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: 'Inter', size: 11, weight: '600' },
                            padding: 15,
                            boxWidth: 8,
                            usePointStyle: true,
                        }
                    }
                }
            }
        });

        // Hourly Traffic Chart (Line graph with fill)
        const trafficCtx = document.getElementById('hourlyTrafficChart').getContext('2d');
        const trafficGrad = trafficCtx.createLinearGradient(0, 0, 0, 180);
        trafficGrad.addColorStop(0, 'rgba(249, 115, 22, 0.22)');
        trafficGrad.addColorStop(1, 'rgba(249, 115, 22, 0)');

        new Chart(trafficCtx, {
            type: 'line',
            data: {
                labels: ['07 am', '08 am', '09 am', '10 am', '11 am', '12 pm'],
                datasets: [{
                    label: 'Active Load',
                    data: [50, 95, 70, 90, 60, 85],
                    borderColor: '#f97316',
                    borderWidth: 3,
                    fill: true,
                    backgroundColor: trafficGrad,
                    tension: 0.45,
                    pointRadius: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#f97316',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        grid: { drawBorder: false, color: 'rgba(15,23,42,0.04)' },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    }
                }
            }
        });
    });
</script>
@endsection
