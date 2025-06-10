<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Departemen - CRUD Management</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
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

        .add-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .add-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .main-content {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-icon.total { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-icon.active { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-icon.inactive { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid #e1e8ed;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-container {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 0.75rem 1rem;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            min-width: 150px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e1e8ed;
            white-space: nowrap;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #e1e8ed;
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 2rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: #f8fafc;
            color: #374151;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .current {
            background: #667eea;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .department-info {
            max-width: 300px;
        }

        .department-name {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.25rem;
        }

        .department-description {
            font-size: 0.875rem;
            color: #666;
            line-height: 1.4;
        }

        .department-head {
            font-size: 0.875rem;
            color: #374151;
            font-weight: 500;
        }

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

            .header-left {
                flex-direction: column;
                align-items: center;
            }

            .main-content {
                padding: 0 1rem;
            }

            .search-container {
                flex-direction: column;
            }

            .search-input {
                min-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="header-left">
                    <a href="{{ route('crud.index') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Dashboard
                    </a>
                    <h1><i class="fas fa-building"></i> Manajemen Departemen</h1>
                </div>
                <a href="{{ route('crud.departments.create') }}" class="add-button">
                    <i class="fas fa-plus"></i>
                    Tambah Departemen
                </a>
            </div>
        </div>

        <div class="main-content">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number">{{ $departments->total() }}</div>
                    <div class="stat-label">Total Departemen</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon active">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $departments->where('status', 'active')->count() }}</div>
                    <div class="stat-label">Departemen Aktif</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon inactive">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-number">{{ $departments->where('status', 'inactive')->count() }}</div>
                    <div class="stat-label">Departemen Tidak Aktif</div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="content-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-list"></i>
                        Daftar Departemen
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="search-container">
                        <input 
                            type="text" 
                            class="search-input" 
                            placeholder="Cari departemen berdasarkan nama atau kepala departemen..."
                            id="searchInput"
                        >
                        <select class="filter-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                @if($departments->count() > 0)
                <div class="table-container">
                    <table class="data-table" id="departmentsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Departemen</th>
                                <th>Kepala Departemen</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $index => $department)
                            <tr>
                                <td>{{ $departments->firstItem() + $index }}</td>
                                <td>
                                    <div class="department-info">
                                        <div class="department-name">{{ $department->name }}</div>
                                        @if($department->description)
                                        <div class="department-description">
                                            {{ Str::limit($department->description, 80) }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($department->head_of_department)
                                    <div class="department-head">{{ $department->head_of_department }}</div>
                                    @else
                                    <span style="color: #9ca3af; font-style: italic;">Belum ditentukan</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $department->status }}">
                                        <span class="status-dot"></span>
                                        {{ $department->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 0.875rem;">
                                        {{ $department->created_at->format('d/m/Y') }}<br>
                                        <span style="color: #666;">{{ $department->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('crud.departments.edit', $department) }}" class="btn btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('crud.departments.destroy', $department) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete('{{ $department->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($departments->hasPages())
                <div class="pagination">
                    {{ $departments->links() }}
                </div>
                @endif

                @else
                <div class="empty-state">
                    <i class="fas fa-building"></i>
                    <h3>Belum Ada Departemen</h3>
                    <p>Mulai dengan menambahkan departemen baru untuk organisasi Anda.</p>
                    <a href="{{ route('crud.departments.create') }}" class="add-button" style="margin-top: 1rem;">
                        <i class="fas fa-plus"></i>
                        Tambah Departemen Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            filterTable(searchTerm, statusFilter);
        });

        // Status filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = this.value;
            filterTable(searchTerm, statusFilter);
        });

        function filterTable(searchTerm, statusFilter) {
            const table = document.getElementById('departmentsTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const departmentName = row.cells[1].textContent.toLowerCase();
                const headOfDepartment = row.cells[2].textContent.toLowerCase();
                const status = row.cells[3].textContent.toLowerCase();

                const matchesSearch = departmentName.includes(searchTerm) || headOfDepartment.includes(searchTerm);
                const matchesStatus = statusFilter === '' || status.includes(statusFilter === 'active' ? 'aktif' : 'tidak aktif');

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Delete confirmation
        function confirmDelete(departmentName) {
            return confirm(`Apakah Anda yakin ingin menghapus departemen "${departmentName}"?\n\nTindakan ini tidak dapat dibatalkan!`);
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>