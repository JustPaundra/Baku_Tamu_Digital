<!-- resources/views/crud-management/officials/show.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pejabat - CRUD Management</title>
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
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .detail-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .detail-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e1e5e9;
        }

        .detail-header h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .detail-header .position {
            color: #667eea;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 1rem;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .detail-section {
            background: rgba(248, 250, 252, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid #667eea;
        }

        .detail-section h3 {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .detail-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #333;
            font-size: 1rem;
            font-weight: 400;
            word-wrap: break-word;
        }

        .detail-value.empty {
            color: #999;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e1e5e9;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border-left: 4px solid #22c55e;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
        }

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

            .detail-container {
                padding: 1.5rem;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <a href="{{ route('crud.officials.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Pejabat
                </a>
                <h1><i class="fas fa-user"></i> Detail Pejabat</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="detail-container">
                <!-- Success Message -->
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                <!-- Profile Header -->
                <div class="detail-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($official->name, 0, 1)) }}
                    </div>
                    <h2>{{ $official->name }}</h2>
                    <div class="position">{{ $official->position }}</div>
                    <div class="status-badge {{ $official->status == 'active' ? 'status-active' : 'status-inactive' }}">
                        <i class="fas fa-circle"></i>
                        {{ $official->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                    </div>
                </div>

                <!-- Detail Sections -->
                <div class="detail-grid">
                    <!-- Basic Information -->
                    <div class="detail-section">
                        <h3>
                            <i class="fas fa-user-tie"></i>
                            Informasi Dasar
                        </h3>
                        
                        <div class="detail-item">
                            <div class="detail-label">Nama Lengkap</div>
                            <div class="detail-value">{{ $official->name }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">NIP</div>
                            <div class="detail-value {{ $official->nip ? '' : 'empty' }}">
                                {{ $official->nip ?: 'Tidak ada NIP' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Jabatan</div>
                            <div class="detail-value">{{ $official->position }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Pangkat/Golongan</div>
                            <div class="detail-value {{ $official->rank ? '' : 'empty' }}">
                                {{ $official->rank ?: 'Tidak ada pangkat' }}
                            </div>
                        </div>
                    </div>

                    <!-- Organization Information -->
                    <div class="detail-section">
                        <h3>
                            <i class="fas fa-building"></i>
                            Organisasi
                        </h3>
                        
                        <div class="detail-item">
                            <div class="detail-label">Departemen/Unit Kerja</div>
                            <div class="detail-value">{{ $official->department }}</div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                <span class="status-badge {{ $official->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                    <i class="fas fa-circle"></i>
                                    {{ $official->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="detail-section">
                        <h3>
                            <i class="fas fa-address-book"></i>
                            Informasi Kontak
                        </h3>
                        
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value {{ $official->email ? '' : 'empty' }}">
                                @if($official->email)
                                    <a href="mailto:{{ $official->email }}" style="color: #667eea; text-decoration: none;">
                                        {{ $official->email }}
                                    </a>
                                @else
                                    Tidak ada email
                                @endif
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Nomor Telepon</div>
                            <div class="detail-value {{ $official->phone ? '' : 'empty' }}">
                                @if($official->phone)
                                    <a href="tel:{{ $official->phone }}" style="color: #667eea; text-decoration: none;">
                                        {{ $official->phone }}
                                    </a>
                                @else
                                    Tidak ada nomor telepon
                                @endif
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Alamat</div>
                            <div class="detail-value {{ $official->address ? '' : 'empty' }}">
                                {{ $official->address ?: 'Tidak ada alamat' }}
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Information -->
                    <div class="detail-section">
                        <h3>
                            <i class="fas fa-clock"></i>
                            Informasi Waktu
                        </h3>
                        
                        <div class="detail-item">
                            <div class="detail-label">Dibuat Pada</div>
                            <div class="detail-value">
                                {{ $official->created_at->format('d M Y, H:i') }} WIB
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Terakhir Diperbarui</div>
                            <div class="detail-value">
                                {{ $official->updated_at->format('d M Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('crud.officials.edit', $official) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit Data
                    </a>
                    
                    <a href="{{ route('crud.officials.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i>
                        Daftar Pejabat
                    </a>

                    <form action="{{ route('crud.officials.destroy', $official) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pejabat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        // Smooth scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const detailSections = document.querySelectorAll('.detail-section');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            detailSections.forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });
        });

        // Print functionality
        function printProfile() {
            window.print();
        }

        // Add print styles
        const printStyles = `
            @media print {
                body { background: white !important; }
                .header, .action-buttons { display: none !important; }
                .detail-container { box-shadow: none !important; }
                .detail-section { break-inside: avoid; }
            }
        `;
        
        const styleSheet = document.createElement("style");
        styleSheet.innerText = printStyles;
        document.head.appendChild(styleSheet);
    </script>
</body>
</html>