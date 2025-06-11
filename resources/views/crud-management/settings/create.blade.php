<!-- resources/views/crud-management/settings/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaturan - CRUD Management</title>
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

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e5e9;
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
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: 1px solid #667eea;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .type-description {
            font-size: 0.875rem;
            color: #666;
            margin-top: 0.25rem;
            font-style: italic;
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
                <a href="{{ route('crud.settings.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar
                </a>
                <h1><i class="fas fa-plus-circle"></i> Tambah Pengaturan Baru</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Container -->
            <div class="form-container">
                <h2 class="form-title">
                    <i class="fas fa-cog"></i>
                    Form Tambah Pengaturan
                </h2>

                <form action="{{ route('crud.settings.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="key" class="form-label">Key Pengaturan *</label>
                        <input type="text" 
                               id="key" 
                               name="key" 
                               class="form-control @error('key') error @enderror"
                               value="{{ old('key') }}"
                               placeholder="Masukkan key pengaturan (contoh: app_name, max_upload_size)"
                               required>
                        @error('key')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Tipe Data *</label>
                        <select id="type" 
                                name="type" 
                                class="form-control @error('type') error @enderror"
                                required>
                            <option value="">Pilih tipe data</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="number" {{ old('type') == 'number' ? 'selected' : '' }}>Number</option>
                            <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>Boolean</option>
                            <option value="json" {{ old('type') == 'json' ? 'selected' : '' }}>JSON</option>
                        </select>
                        <div class="type-description">
                            Pilih tipe data sesuai dengan jenis nilai yang akan disimpan
                        </div>
                        @error('type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="value" class="form-label">Nilai</label>
                        <textarea id="value" 
                                  name="value" 
                                  class="form-control @error('value') error @enderror"
                                  rows="3"
                                  placeholder="Masukkan nilai pengaturan">{{ old('value') }}</textarea>
                        <div class="type-description">
                            Kosongkan jika belum ada nilai default
                        </div>
                        @error('value')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="form-control @error('description') error @enderror"
                                  rows="3"
                                  placeholder="Masukkan deskripsi pengaturan">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Pengaturan
                        </button>
                        <a href="{{ route('crud.settings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const valueInput = document.getElementById('value');
            
            typeSelect.addEventListener('change', function() {
                const type = this.value;
                
                // Update placeholder based on type
                switch(type) {
                    case 'text':
                        valueInput.placeholder = 'Masukkan teks (contoh: Nama Aplikasi)';
                        break;
                    case 'number':
                        valueInput.placeholder = 'Masukkan angka (contoh: 100)';
                        break;
                    case 'boolean':
                        valueInput.placeholder = 'Masukkan true atau false';
                        break;
                    case 'json':
                        valueInput.placeholder = 'Masukkan JSON (contoh: {"key": "value"})';
                        break;
                    default:
                        valueInput.placeholder = 'Masukkan nilai pengaturan';
                }
            });

            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const key = document.getElementById('key').value.trim();
                const type = document.getElementById('type').value;
                
                if (!key) {
                    e.preventDefault();
                    alert('Key pengaturan harus diisi!');
                    return;
                }
                
                if (!type) {
                    e.preventDefault();
                    alert('Tipe data harus dipilih!');
                    return;
                }
            });
        });
    </script>
</body>
</html>