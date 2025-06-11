<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaturan - CRUD Management</title>
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
            color: #333;
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-bottom: 30px;
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
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
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
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-title i {
            color: #667eea;
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
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
        }

        .btn-outline:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .data-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .data-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .data-title i {
            color: #667eea;
        }

        .data-content {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .data-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .data-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .data-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eaeaea;
        }

        .data-item-title {
            font-weight: 600;
            color: #5a67d8;
            font-size: 1.1rem;
        }

        .data-item-values {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .data-value {
            background: white;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .data-value span {
            font-weight: 500;
            color: #667eea;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        /* Scrollbar styling */
        .data-content::-webkit-scrollbar {
            width: 8px;
        }

        .data-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .data-content::-webkit-scrollbar-thumb {
            background: #c2c8f0;
            border-radius: 10px;
        }

        .data-content::-webkit-scrollbar-thumb:hover {
            background: #667eea;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <a href="#" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1>Lazevet CRUD Management</h1>
        </div>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-cog"></i> Edit Pengaturan
            </h2>
            
            <div class="form-group">
                <label for="settingName" class="form-label">Nama Pengaturan</label>
                <input type="text" id="settingName" class="form-control" value="Parameter Optimasi Model" placeholder="Masukkan nama pengaturan">
            </div>
            
            <div class="form-group">
                <label for="settingKey" class="form-label">Kunci Pengaturan</label>
                <input type="text" id="settingKey" class="form-control" value="model_optimization_params" placeholder="Masukkan kunci pengaturan">
            </div>
            
            <div class="form-group">
                <label for="settingValue" class="form-label">Nilai Pengaturan</label>
                <textarea id="settingValue" class="form-control" rows="4" placeholder="Masukkan nilai pengaturan">{"learning_rate": 0.001, "epochs": 100, "batch_size": 32}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Status</label>
                <div style="display: flex; gap: 20px;">
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="radio" name="status" checked> Aktif
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px;">
                        <input type="radio" name="status"> Nonaktif
                    </label>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </div>
        
        <div class="data-container">
            <h2 class="data-title">
                <i class="fas fa-database"></i> Data Parameter
            </h2>
            
            <div class="data-content" id="dataContent">
                <!-- Data akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Lazevet CRUD Management &copy; 2025 - All rights reserved</p>
    </div>

    <script>
        // Data yang diberikan
        const data = [
            { id: 1, values: [0.5, 0.4, 0.6] },
            { id: 2, values: [0.8, 0.9] },
            { id: 3, values: [0.10, 0.11] },
            { id: 4, values: [0.12, 0.13] },
            { id: 5, values: [0.14, 0.15] },
            { id: 6, values: [0.16, 0.17] },
            { id: 7, values: [0.18, 0.19] },
            { id: 8, values: [0.20, 0.21] },
            { id: 9, values: [0.22, 0.23] },
            { id: 10, values: [0.24, 0.25] },
            { id: 11, values: [0.26, 0.27] },
            { id: 12, values: [0.28, 0.29] },
            { id: 13, values: [0.30, 0.31] },
            { id: 14, values: [0.32, 0.33] },
            { id: 15, values: [0.34, 0.35] },
            { id: 16, values: [0.36, 0.37] },
            { id: 17, values: [0.38, 0.39] },
            { id: 18, values: [0.40, 0.41] },
            { id: 19, values: [0.41, 0.42] },
            { id: 20, values: [0.43, 0.44] },
            { id: 21, values: [0.44, 0.45] },
            { id: 22, values: [0.46, 0.47] },
            { id: 23, values: [0.48, 0.49] },
            { id: 24, values: [0.50, 0.51] },
            { id: 25, values: [0.52, 0.53] },
            { id: 26, values: [0.54, 0.55] },
            { id: 27, values: [0.56, 0.57] },
            { id: 28, values: [0.58, 0.59] },
            { id: 29, values: [0.60, 0.61] },
            { id: 30, values: [0.62, 0.63] },
            { id: 31, values: [0.64, 0.64] },
            { id: 32, values: [0.65, 0.65] },
            { id: 33, values: [0.66, 0.67] },
            { id: 34, values: [0.68, 0.69] },
            { id: 35, values: [0.70, 0.71] },
            { id: 36, values: [0.72, 0.73] },
            { id: 37, values: [0.74, 0.75] },
            { id: 38, values: [0.76, 0.77] },
            { id: 39, values: [0.78, 0.78] },
            { id: 40, values: [0.79, 0.79] },
            { id: 41, values: [0.80, 0.81] },
            { id: 42, values: [0.81, 0.82] },
            { id: 43, values: [0.82, 0.83] },
            { id: 44, values: [0.84, 0.84] },
            { id: 45, values: [0.85, 0.86] },
            { id: 46, values: [0.86, 0.87] },
            { id: 47, values: [0.88, 0.88] },
            { id: 48, values: [0.89, 0.90] },
            { id: 49, values: [0.90, 0.91] },
            { id: 50, values: [0.92, 0.93] },
            { id: 51, values: [0.94, 0.95] },
            { id: 52, values: [0.96, 0.97] },
            { id: 53, values: [0.98, 0.99] },
            { id: 54, values: [0.100, 0.101] },
            { id: 55, values: [0.102, 0.102] },
            { id: 56, values: [0.103, 0.103] },
            { id: 57, values: [0.104, 0.104] },
            { id: 58, values: [0.105, 0.106] },
            { id: 59, values: [0.106, 0.107] },
            { id: 60, values: [0.108, 0.109] },
            { id: 61, values: [0.110, 0.111] },
            { id: 62, values: [0.112, 0.113] },
            { id: 63, values: [0.114, 0.114] },
            { id: 64, values: [0.115, 0.116] },
            { id: 65, values: [0.116, 0.117] },
            { id: 66, values: [0.118, 0.119] },
            { id: 67, values: [0.120, 0.121] },
            { id: 68, values: [0.122, 0.122] },
            { id: 69, values: [0.123, 0.123] },
            { id: 70, values: [0.124, 0.124] },
            { id: 71, values: [0.125, 0.125] },
            { id: 72, values: [0.126, 0.127] },
            { id: 73, values: [0.128, 0.129] },
            { id: 74, values: [0.130, 0.131] },
            { id: 75, values: [0.132, 0.133] },
            { id: 76, values: [0.134, 0.135] },
            { id: 77, values: [0.136, 0.137] },
            { id: 78, values: [0.138, 0.139] },
            { id: 79, values: [0.140, 0.141] },
            { id: 80, values: [0.142, 0.143] },
            { id: 81, values: [0.144, 0.144] },
            { id: 82, values: [0.145, 0.146] },
            { id: 83, values: [0.146, 0.147] },
            { id: 84, values: [0.148, 0.149] },
            { id: 85, values: [0.150, 0.151] },
            { id: 86, values: [0.152, 0.153] },
            { id: 87, values: [0.154, 0.155] },
            { id: 88, values: [0.156, 0.158] },
            { id: 89, values: [0.159, 0.160] },
            { id: 90, values: [0.161, 0.162] },
            { id: 91, values: [0.163, 0.164] },
            { id: 92, values: [0.165, 0.166] },
            { id: 93, values: [0.166, 0.167] },
            { id: 94, values: [0.168, 0.169] },
            { id: 95, values: [0.170, 0.171] },
            { id: 96, values: [0.172, 0.173] },
            { id: 97, values: [0.174, 0.175] },
            { id: 98, values: [0.176, 0.178] },
            { id: 99, values: [0.177, 0.179] },
            { id: 100, values: [0.180, 0.181] },
            { id: 101, values: [0.182, 0.183] },
            { id: 102, values: [0.184] },
            { id: 103, values: [0.186, 0.185] },
            { id: 104, values: [0.188, 0.189] },
            { id: 105, values: [0.190, 0.191] },
            { id: 106, values: [0.192, 0.193] },
            { id: 107, values: [0.194, 0.195] },
            { id: 108, values: [0.196, 0.196] },
            { id: 109, values: [0.198, 0.199] },
            { id: 110, values: [0.192, 0.193] },
            { id: 111, values: [0.193, 0.194] },
            { id: 112, values: [0.194, 0.195] },
            { id: 113, values: [0.195] },
            { id: 114, values: [0.196, 0.197] },
            { id: 115, values: [0.198, 0.198] },
            { id: 116, values: [0.198, 0.199] },
            { id: 117, values: [0.198, 0.200] },
            { id: 118, values: [0.201, 0.202] }
        ];

        // Fungsi untuk menampilkan data
        function renderData() {
            const container = document.getElementById('dataContent');
            container.innerHTML = '';
            
            data.forEach(item => {
                const dataItem = document.createElement('div');
                dataItem.className = 'data-item';
                
                let valuesHTML = '';
                item.values.forEach((val, idx) => {
                    valuesHTML += `<div class="data-value">Data ${idx+1}: <span>${val}</span></div>`;
                });
                
                dataItem.innerHTML = `
                    <div class="data-item-header">
                        <div class="data-item-title">Parameter Set #${item.id}</div>
                        <div><i class="fas fa-hashtag"></i> ${item.values.length} values</div>
                    </div>
                    <div class="data-item-values">
                        ${valuesHTML}
                    </div>
                `;
                
                container.appendChild(dataItem);
            });
        }

        // Panggil fungsi render saat halaman dimuat
        document.addEventListener('DOMContentLoaded', renderData);
    </script>
</body>
</html>