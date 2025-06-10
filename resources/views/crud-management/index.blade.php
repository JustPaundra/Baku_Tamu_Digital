<!-- resources/views/crud-management/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Management - Buku Tamu Digital</title>
    <link rel="icon" href="{{ asset('asset/logo2.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .header h1 {
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .events-icon { background: linear-gradient(135deg, #667eea, #764ba2); }
        .officials-icon { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .departments-icon { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .categories-icon { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .settings-icon { background: linear-gradient(135deg, #fa709a, #fee140); }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .card-count {
            font-size: 2.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .card-description {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-secondary {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 1px solid #667eea;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Statistics Overview */
        .stats-overview {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stats-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            border-radius: 10px;
            background: rgba(102, 126, 234, 0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Quick Actions */
        .quick-actions {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .quick-actions h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .action-events { background: linear-gradient(135deg, #667eea, #764ba2); }
        .action-officials { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .action-departments { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .action-categories { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .action-settings { background: linear-gradient(135deg, #fa709a, #fee140); }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .main-content {
                padding: 0 1rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stats-grid, .actions-grid {
                grid-template-columns: 1fr;
            }

            .card-actions {
                flex-direction: column;
            }
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(67, 233, 123, 0.1);
            color: #22c55e;
            border-left: 4px solid #22c55e;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <a href="{{ route('admin') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Admin
                </a>
                <h1><i class="fas fa-cogs"></i> CRUD Management System</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
            @endif

            <!-- Statistics Overview -->
            <div class="stats-overview">
                <h2 class="stats-title">
                    <i class="fas fa-chart-bar"></i>
                    Ringkasan Data
                </h2>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['events'] }}</div>
                        <div class="stat-label">Total Events</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['officials'] }}</div>
                        <div class="stat-label">Total Pejabat</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['departments'] }}</div>
                        <div class="stat-label">Total Departemen</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['guest_categories'] }}</div>
                        <div class="stat-label">Kategori Tamu</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $stats['settings'] }}</div>
                        <div class="stat-label">Pengaturan</div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-grid">
                <!-- Events Management -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon events-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="card-title">Manajemen Events</div>
                    </div>
                    <div class="card-count">{{ $stats['events'] }}</div>
                    <div class="card-description">
                        Kelola daftar acara dan kegiatan yang tersedia untuk buku tamu digital.
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('crud.events.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua
                        </a>
                        <a href="{{ route('crud.events.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>

                <!-- Officials Management -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon officials-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-title">Manajemen Pejabat</div>
                    </div>
                    <div class="card-count">{{ $stats['officials'] }}</div>
                    <div class="card-description">
                        Kelola data pejabat penandatangan untuk dokumen dan laporan.
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('crud.officials.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua
                        </a>
                        <a href="{{ route('crud.officials.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>

                <!-- Departments Management -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon departments-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="card-title">Manajemen Departemen</div>
                    </div>
                    <div class="card-count">{{ $stats['departments'] }}</div>
                    <div class="card-description">
                        Kelola daftar departemen dan bidang dalam organisasi.
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('crud.departments.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua
                        </a>
                        <a href="{{ route('crud.departments.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>

                <!-- Guest Categories Management -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon categories-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="card-title">Kategori Tamu</div>
                    </div>
                    <div class="card-count">{{ $stats['guest_categories'] }}</div>
                    <div class="card-description">
                        Kelola kategori dan klasifikasi untuk pengunjung buku tamu.
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('crud.guest-categories.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua
                        </a>
                        <a href="{{ route('crud.guest-categories.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>

                <!-- Settings Management -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon settings-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="card-title">Pengaturan Sistem</div>
                    </div>
                    <div class="card-count">{{ $stats['settings'] }}</div>
                    <div class="card-description">
                        Kelola konfigurasi dan pengaturan sistem buku tamu digital.
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('crud.settings.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua
                        </a>
                        <a href="{{ route('crud.settings.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>
                    <i class="fas fa-bolt"></i>
                    Aksi Cepat
                </h2>
                <div class="actions-grid">
                    <a href="{{ route('crud.events.create') }}" class="action-btn action-events">
                        <i class="fas fa-calendar-plus"></i>
                        Tambah Event Baru
                    </a>
                    <a href="{{ route('crud.officials.create') }}" class="action-btn action-officials">
                        <i class="fas fa-user-plus"></i>
                        Tambah Pejabat Baru
                    </a>
                    <a href="{{ route('crud.departments.create') }}" class="action-btn action-departments">
                        <i class="fas fa-plus-square"></i>
                        Tambah Departemen
                    </a>
                    <a href="{{ route('crud.guest-categories.create') }}" class="action-btn action-categories">
                        <i class="fas fa-tag"></i>
                        Tambah Kategori
                    </a>
                    <a href="{{ route('crud.settings.create') }}" class="action-btn action-settings">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Pengaturan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation to buttons when clicked
            const buttons = document.querySelectorAll('.btn, .action-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.className = 'fas fa-spinner fa-spin';
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });

            // Add hover effect to cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>