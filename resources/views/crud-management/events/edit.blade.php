<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - CRUD Management</title>
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
            max-width: 800px;
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

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #666;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-label.required::after {
            content: ' *';
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #ef4444;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-secondary {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
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
                <a href="{{ route('crud.events.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Events
                </a>
                <h1><i class="fas fa-edit"></i> Edit Event</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="form-card">
                <div class="form-header">
                    <h2 class="form-title">Edit Event: {{ $event->name }}</h2>
                    <p class="form-subtitle">Perbarui informasi event</p>
                </div>

                <form action="{{ route('crud.events.update', $event) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name" class="form-label required">Nama Event</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') error @enderror" 
                               value="{{ old('name', $event->name) }}" placeholder="Masukkan nama event">
                        @error('name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control @error('description') error @enderror" 
                                  rows="4" placeholder="Masukkan deskripsi event (opsional)">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date" class="form-label required">Tanggal Event</label>
                        <input type="date" id="date" name="date" class="form-control @error('date') error @enderror" 
                               value="{{ old('date', $event->date->format('Y-m-d')) }}">
                        @error('date')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_time" class="form-label required">Waktu Mulai</label>
                            <input type="time" id="start_time" name="start_time" class="form-control @error('start_time') error @enderror" 
                                   value="{{ old('start_time', $event->start_time->format('H:i')) }}">
                            @error('start_time')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_time" class="form-label">Waktu Selesai</label>
                            <input type="time" id="end_time" name="end_time" class="form-control @error('end_time') error @enderror" 
                                   value="{{ old('end_time', $event->end_time ? $event->end_time->format('H:i') : '') }}">
                            @error('end_time')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" id="location" name="location" class="form-control @error('location') error @enderror" 
                               value="{{ old('location', $event->location) }}" placeholder="Masukkan lokasi event (opsional)">
                        @error('location')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label required">Status</label>
                        <select id="status" name="status" class="form-control @error('status') error @enderror">
                            <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $event->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('crud.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus pada field pertama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const firstInput = document.querySelector('input[name="name"]');
            if (firstInput) {
                firstInput.focus();
            }
        });

        // Validasi waktu selesai harus setelah waktu mulai
        document.getElementById('start_time').addEventListener('change', validateTimes);
        document.getElementById('end_time').addEventListener('change', validateTimes);

        function validateTimes() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            
            if (startTime && endTime && endTime <= startTime) {
                document.getElementById('end_time').setCustomValidity('Waktu selesai harus setelah waktu mulai');
            } else {
                document.getElementById('end_time').setCustomValidity('');
            }
        }

        // Auto-resize textarea
        const textarea = document.getElementById('description');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
        let formChanged = false;
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('change', () => {
                formChanged = true;
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        form.addEventListener('submit', function() {
            formChanged = false;
        });
    </script>
</body>
</html>