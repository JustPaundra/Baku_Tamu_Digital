<!-- resources/views/crud-management/officials/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pejabat - CRUD Management</title>
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
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .content-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
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

        .btn-success {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #fa709a, #fee140);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e1e5e9;
        }

        .table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        .table tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
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

        .actions {
            display: flex;
            gap: 0.5rem;
        }

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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .pagination .current {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .pagination a:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #e1e5e9;
            margin-bottom: 1rem;
        }

        .search-box {
            margin-bottom: 1.5rem;
        }

        .search-box input {
            width: 100%;
            max-width: 400px;
            padding: 0.75rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

            .content-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .table-container {
                padding: 1rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .actions {
                flex-direction: column;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .modal-header {
            margin-bottom: 1rem;
        }

        .modal-header h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <a href="{{ route('crud.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke CRUD Management
                </a>
                <h1><i class="fas fa-user-tie"></i> Manajemen Pejabat</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- Content Header -->
            <div class="content-header">
                <h2 class="content-title">Daftar Pejabat</h2>
                <a href="{{ route('crud.officials.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Pejabat Baru
                </a>
            </div>

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

            <!-- Table Container -->
            <div class="table-container">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari pejabat..." onkeyup="searchTable()">
                </div>

                @if($officials->count() > 0)
                <table class="table" id="officialsTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pangkat</th>
                            <th>NIP</th>
                            <th>Departemen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($officials as $index => $official)
                        <tr>
                            <td>{{ $officials->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $official->name }}</strong>
                            </td>
                            <td>{{ $official->position }}</td>
                            <td>{{ $official->rank ?? '-' }}</td>
                            <td>{{ $official->nip ?? '-' }}</td>
                            <td>
                                <span class="badge" style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem;">
                                    {{ $official->department }}
                                </span>
                            </td>
                          <td>
    <span class="status-badge {{ $official->status === 'active' ? 'status-active' : 'status-inactive' }}">
        {{ ucfirst($official->status) }}
    </span>
</td>
<td class="actions">
    <a href="{{ route('crud.officials.edit', $official->id) }}" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="{{ route('crud.officials.destroy', $official->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus pejabat ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </form>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $officials->links() }}
                </div>

                @else
                <div class="empty-state">
                    <i class="fas fa-user-tie"></i>
                    <h3>Belum Ada Data Pejabat</h3>
                    <p>Silakan tambahkan pejabat pertama dengan mengklik tombol "Tambah Pejabat Baru"</p>
                    <a href="{{ route('crud.officials.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="fas fa-plus"></i>
                        Tambah Pejabat Baru
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Hapus</h3>
                <p>Apakah Anda yakin ingin menghapus pejabat <strong id="officialName"></strong>?</p>
                <p style="color: #ef4444; font-size: 0.875rem;">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('officialsTable');
            
            if (!table) return;
            
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let txtValue = '';
                
                // Combine text from name, position, and department columns
                if (td[1] && td[2] && td[5]) {
                    txtValue = (td[1].textContent || td[1].innerText) + ' ' + 
                              (td[2].textContent || td[2].innerText) + ' ' + 
                              (td[5].textContent || td[5].innerText);
                }
                
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }

        // Delete confirmation modal
        function confirmDelete(id, name) {
            document.getElementById('officialName').textContent = name;
            document.getElementById('deleteForm').action = `/crud-management/officials/${id}`;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>