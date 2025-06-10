<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Departemen - CRUD Management</title>
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
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .required {
            color: #e74c3c;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            resize: vertical;
            min-height: 100px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e1e8ed;
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

        .form-help {
            font-size: 0.875rem;
            color: #666;
            margin-top: 0.25rem;
        }

        /* Status indicator */
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-active .status-dot {
            background: #22c55e;
        }

        .status-inactive .status-dot {
            background: #ef4444;
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

            .main-content {
                padding: 0 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <a href="{{ route('crud.departments.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Departemen
                </a>
                <h1><i class="fas fa-building"></i> Tambah Departemen Baru</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 0.5rem 0 0 1rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-title">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Departemen Baru
                </div>

                <form action="{{ route('crud.departments.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Departemen -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            Nama Departemen <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-input @error('name') border-red-500 @enderror" 
                            value="{{ old('name') }}" 
                            required
                            placeholder="Masukkan nama departemen"
                        >
                        @error('name')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Contoh: Departemen IT, Departemen Keuangan, Departemen SDM
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            Deskripsi
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            class="form-textarea @error('description') border-red-500 @enderror" 
                            placeholder="Masukkan deskripsi departemen (opsional)"
                        >{{ old('description') }}</textarea>
                        @error('description')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Jelaskan tugas dan tanggung jawab departemen ini
                        </div>
                    </div>

                    <!-- Kepala Departemen -->
                    <div class="form-group">
                        <label for="head_of_department" class="form-label">
                            Kepala Departemen
                        </label>
                        <input 
                            type="text" 
                            id="head_of_department" 
                            name="head_of_department" 
                            class="form-input @error('head_of_department') border-red-500 @enderror" 
                            value="{{ old('head_of_department') }}" 
                            placeholder="Masukkan nama kepala departemen (opsional)"
                        >
                        @error('head_of_department')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Nama pejabat yang memimpin departemen ini
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status" class="form-label">
                            Status <span class="required">*</span>
                        </label>
                        <select 
                            id="status" 
                            name="status" 
                            class="form-select @error('status') border-red-500 @enderror" 
                            required
                        >
                            <option value="">Pilih Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                <span class="status-indicator status-active">
                                    <span class="status-dot"></span>
                                    Aktif
                                </span>
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                <span class="status-indicator status-inactive">
                                    <span class="status-dot"></span>
                                    Tidak Aktif
                                </span>
                            </option>
                        </select>
                        @error('status')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                        <div class="form-help">
                            Status aktif berarti departemen ini dapat digunakan dalam sistem
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('crud.departments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Departemen
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
            const nameInput = document.getElementById('name');
            const statusSelect = document.getElementById('status');

            // Real-time validation
            nameInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });

            statusSelect.addEventListener('change', function() {
                if (this.value === '') {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const icon = submitBtn.querySelector('i');
                
                // Show loading state
                if (icon) {
                    icon.className = 'fas fa-spinner fa-spin';
                }
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
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
        });
    </script>
</body>
</html>