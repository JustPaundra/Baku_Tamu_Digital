<!-- resources/views/crud-management/officials/edit.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pejabat - CRUD Management</title>
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

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e1e5e9;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: none;
            font-weight: 500;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .required {
            color: #ef4444;
        }

        .status-toggle {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .status-toggle input[type="radio"] {
            width: auto;
            margin-right: 0.5rem;
        }

        .status-toggle label {
            margin-bottom: 0;
            cursor: pointer;
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

            .form-container {
                padding: 1.5rem;
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
                <a href="{{ route('crud.officials.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Pejabat
                </a>
                <h1><i class="fas fa-user-edit"></i> Edit Pejabat</h1>
            </div>
        </div>

        <div class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h2>Edit Data Pejabat</h2>
                    <p>Perbarui informasi pejabat dengan mengisi form di bawah ini</p>
                </div>

                <!-- Error Messages -->
                @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Terjadi kesalahan!</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('crud.officials.update', $official) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $official->name) }}" required>
                            @error('name')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip', $official->nip) }}" placeholder="Nomor Induk Pegawai">
                            @error('nip')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="position">Jabatan <span class="required">*</span></label>
                            <input type="text" id="position" name="position" value="{{ old('position', $official->position) }}" required>
                            @error('position')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rank">Pangkat/Golongan</label>
                            <input type="text" id="rank" name="rank" value="{{ old('rank', $official->rank) }}" placeholder="Contoh: IV/a">
                            @error('rank')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="department">Departemen/Unit Kerja <span class="required">*</span></label>
                        <input type="text" id="department" name="department" value="{{ old('department', $official->department) }}" required>
                        @error('department')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $official->email) }}" placeholder="contoh@email.com">
                            @error('email')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $official->phone) }}" placeholder="08xxxxxxxxxx">
                            @error('phone')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" placeholder="Alamat lengkap">{{ old('address', $official->address) }}</textarea>
                        @error('address')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status <span class="required">*</span></label>
                        <div class="status-toggle">
                            <label>
                                <input type="radio" name="status" value="active" {{ old('status', $official->status) == 'active' ? 'checked' : '' }} required>
                                Aktif
                            </label>
                            <label>
                                <input type="radio" name="status" value="inactive" {{ old('status', $official->status) == 'inactive' ? 'checked' : '' }} required>
                                Tidak Aktif
                            </label>
                        </div>
                        @error('status')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('crud.officials.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
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

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = document.querySelectorAll('input[required], select[required]');
            let isValid = true;

            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                } else {
                    field.style.borderColor = '#e1e5e9';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
            }
        });
    </script>
</body>
</html>