<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Events - CRUD Management</title>
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

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .content-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .btn {
            padding: 0.75rem 1.5rem;
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

        .btn-success {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #fa709a, #fee140);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        thead th {
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        tbody td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
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

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            color: #667eea;
            border: 1px solid #667eea;
        }

        .pagination .active {
            background: #667eea;
            color: white;
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

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
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
                text-align: center;
            }

            .actions {
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
                <a href="{{ route('crud.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
                <h1><i class="fas fa-calendar-alt"></i> Manajemen Events</h1>
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

            <div class="content-card">
                <div class="content-header">
                    <h2 class="content-title">Daftar Events</h2>
                    <a href="{{ route('crud.events.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Event Baru
                    </a>
                </div>

                @if($events->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ $event->name }}</strong>
                                        @if($event->description)
                                        <div style="font-size: 0.8rem; color: #666; margin-top: 0.25rem;">
                                            {{ Str::limit($event->description, 50) }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $event->date->format('d/m/Y') }}</td>
                                <td>
                                    {{ $event->start_time->format('H:i') }}
                                    @if($event->end_time)
                                    - {{ $event->end_time->format('H:i') }}
                                    @endif
                                </td>
                                <td>{{ $event->location ?? '-' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $event->status }}">
                                        {{ $event->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('crud.events.edit', $event) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('crud.events.destroy', $event) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
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
                <div class="pagination">
                    {{ $events->links() }}
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Belum ada event</h3>
                    <p>Mulai dengan menambahkan event pertama Anda</p>
                    <a href="{{ route('crud.events.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="fas fa-plus"></i> Tambah Event Baru
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>