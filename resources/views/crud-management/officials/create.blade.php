<!-- resources/views/crud-management/officials/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pejabat - CRUD Management</title>
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
            font-size: 1.8rem;
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
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .required {
            color: #e74c3c;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
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

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-left: 4px solid #ef4444;
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
                <h1><i class="fas fa-user-plus"></i> Tambah Pejabat Baru</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h2>Formulir Pejabat Baru</h2>
                    <p>Lengkapi informasi pejabat yang akan ditambahkan ke sistem</p>
                </div>

                <form action="{{ route('crud.officials.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position">Jabatan <span class="required">*</span></label>
                        <input type="text" id="position" name="position" value="{{ old('position') }}" 
                               placeholder="Contoh: Kepala Bagian Administrasi" required>
                        @error('position')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rank">Pangkat/Golongan</label>
                        <input type="text" id="rank" name="rank" value="{{ old('rank') }}" 
                               placeholder="Contoh: Pembina Tk. I / IV.b">
                        @error('rank')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP (Nomor Induk Pegawai)</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip') }}" 
                               placeholder="Contoh: 196801011990031001">
                        @error('nip')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="department">Departemen <span class="required">*</span></label>
                        <select id="department" name="department" required>
                            <option value="">Pilih Departemen</option>
                            @if(isset($departments) && $departments->count() > 0)
                                @foreach($departments as $dept)
                                <option value="{{ $dept->name }}" {{ old('department') == $dept->name ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                                @endforeach
                            @else
                                <option value="Umum" {{ old('department') == 'Umum' ? 'selected' : '' }}>Umum</option>
                                <option value="Administrasi" {{ old('department') == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                                <option value="Keuangan" {{ old('department') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="SDM" {{ old('department') == 'SDM' ? 'selected' : '' }}>SDM</option>
                                <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                            @endif
                        </select>
                        @error('department')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="required">*</span></label>
                        <select id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('crud.officials.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Pejabat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.querySelector('form');
            const requiredFields = form.querySelectorAll('[required]');

            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#e74c3c';
                    } else {
                        field.style.borderColor = '#e1e5e9';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi!');
                }
            });

            // Real-time validation
            requiredFields.forEach(field => {
                field.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.style.borderColor = '#e74c3c';
                    } else {
                        this.style.borderColor = '#22c55e';
                    }
                });
            });

            // NIP format validation
            const nipField = document.getElementById('nip');
            if (nipField) {
                nipField.addEventListener('input', function() {
                    // Remove non-numeric characters
                    this.value = this.value.replace(/\D/g, '');
                    
                    // Limit to 18 digits (standard NIP length)
                    if (this.value.length > 18) {
                        this.value = this.value.slice(0, 18);
                    }
                });
            }
        });
    </script>
</body>
</html>