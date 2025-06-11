<!-- resources/views/crud-management/guest-categories/edit.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Tamu - CRUD Management</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="90" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .form-container {
            padding: 40px;
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }
        
        .breadcrumb a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .breadcrumb a:hover {
            color: #4f46e5;
        }
        
        .breadcrumb .separator {
            color: #94a3b8;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-control.error {
            border-color: #ef4444;
            background: #fef2f2;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .success-message {
            background: #f0fdf4;
            border: 2px solid #10b981;
            color: #047857;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f1f5f9;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        
        .btn-secondary {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
            color: #475569;
        }
        
        .form-info {
            background: #eff6ff;
            border: 2px solid #3b82f6;
            color: #1e40af;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
        }
        
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #6366f1;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="loading" id="loading">
        <div class="loading-spinner"></div>
    </div>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-edit"></i> Edit Kategori Tamu</h1>
            <p>Ubah informasi kategori tamu yang sudah ada</p>
        </div>

        <div class="form-container">
            <div class="breadcrumb">
                <a href="{{ route('admin') }}"><i class="fas fa-home"></i> Admin Dashboard</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('crud.index') }}">CRUD Management</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('crud.guest-categories.index') }}">Kategori Tamu</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span>Edit</span>
            </div>

            @if(session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-info">
                <i class="fas fa-info-circle"></i>
                Pastikan semua informasi yang dimasukkan sudah benar sebelum menyimpan perubahan.
            </div>

            <form action="{{ route('crud.guest-categories.update', $guestCategory->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-tag"></i> Nama Kategori
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') error @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $guestCategory->name) }}" 
                        placeholder="Masukkan nama kategori tamu"
                        required
                    >
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Keterangan
                    </label>
                    <textarea 
                        class="form-control @error('description') error @enderror" 
                        id="description" 
                        name="description" 
                        rows="4" 
                        placeholder="Masukkan keterangan kategori tamu (opsional)"
                    >{{ old('description', $guestCategory->description) }}</textarea>
                    @error('description')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color">
                        <i class="fas fa-palette"></i> Warna Kategori
                    </label>
                    <input 
                        type="color" 
                        class="form-control @error('color') error @enderror" 
                        id="color" 
                        name="color" 
                        value="{{ old('color', $guestCategory->color ?? '#6366f1') }}"
                        style="height: 60px;"
                    >
                    @error('color')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="fas fa-toggle-on"></i> Status
                    </label>
                    <select class="form-control @error('status') error @enderror" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="active" {{ old('status', $guestCategory->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $guestCategory->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="button-group">
                    <a href="{{ route('crud.guest-categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editForm');
            const loading = document.getElementById('loading');
            
            // Form submission with loading
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                loading.style.display = 'flex';
            });
            
            // Form validation
            const inputs = form.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('error')) {
                        validateField(this);
                    }
                });
            });
            
            function validateField(field) {
                const value = field.value.trim();
                const fieldName = field.getAttribute('name');
                
                // Remove previous error state
                field.classList.remove('error');
                const existingError = field.parentNode.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }
                
                // Validate required fields
                if (field.hasAttribute('required') && !value) {
                    showFieldError(field, 'Field ini wajib diisi');
                    return false;
                }
                
                // Specific validation
                if (fieldName === 'name' && value) {
                    if (value.length < 2) {
                        showFieldError(field, 'Nama kategori minimal 2 karakter');
                        return false;
                    }
                    if (value.length > 100) {
                        showFieldError(field, 'Nama kategori maksimal 100 karakter');
                        return false;
                    }
                }
                
                if (fieldName === 'description' && value && value.length > 500) {
                    showFieldError(field, 'Keterangan maksimal 500 karakter');
                    return false;
                }
                
                return true;
            }
            
            function showFieldError(field, message) {
                field.classList.add('error');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                field.parentNode.appendChild(errorDiv);
            }
            
            // Auto-resize textarea
            const textarea = document.getElementById('description');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
                
                // Initial resize
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }
            
            // Character counter for description
            if (textarea) {
                const counterDiv = document.createElement('div');
                counterDiv.style.textAlign = 'right';
                counterDiv.style.fontSize = '0.875rem';
                counterDiv.style.color = '#6b7280';
                counterDiv.style.marginTop = '5px';
                textarea.parentNode.appendChild(counterDiv);
                
                function updateCounter() {
                    const current = textarea.value.length;
                    const max = 500;
                    counterDiv.textContent = `${current}/${max} karakter`;
                    
                    if (current > max * 0.9) {
                        counterDiv.style.color = '#ef4444';
                    } else if (current > max * 0.7) {
                        counterDiv.style.color = '#f59e0b';
                    } else {
                        counterDiv.style.color = '#6b7280';
                    }
                }
                
                textarea.addEventListener('input', updateCounter);
                updateCounter(); // Initial count
            }
        });
    </script>
</body>
</html>