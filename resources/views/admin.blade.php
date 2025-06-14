<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Buku Tamu Digital</title>
    <link rel="icon" href="{{ asset('asset/logo2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- PDF Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Improved CRUD Management Button Styles */
        .crud-management-section {
            margin-bottom: 24px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        /* Alternative color schemes - choose one */
        .crud-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            /* Option 3: Warm complement to red */
            background: linear-gradient(135deg, #FF7043 0%, #FF5722 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }

        .crud-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
            background: linear-gradient(135deg, #1565C0 0%, #0D47A1 100%);
            color: white;
            text-decoration: none;
        }

        .crud-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .crud-btn i {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .crud-management-section {
                justify-content: center;
                margin-bottom: 20px;
            }
            
            .crud-btn {
                padding: 12px 20px;
                font-size: 15px;
            }
        }

        /* Integration with existing search-filter styles */
        .search-filter-container {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .search-filter-grid {
            display: grid;
            grid-template-columns: 1fr 200px auto;
            gap: 16px;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .search-filter-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .button-group {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                justify-content: center;
            }
        }

        /* Ensure consistent button styling */
        .export-btn, .print-btn {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <a href="{{ route('index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>               
                <h1>Admin Buku Tamu Digital</h1>
            </div>
        </div>

        <div class="main-content">
            <!-- CRUD Management Section - Improved -->
            <div class="crud-management-section">
                <a href="{{ route('crud.index') }}" class="crud-btn">
                    <i class="fas fa-database"></i>
                    Kelola Data Master
                </a>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-filter-container">
                <div class="search-filter-grid">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari nama atau instansi...">
                    </div>
                    <div class="date-filter">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="dateFilter">
                    </div>
                    <div class="button-group">
                        <button id="exportButton" class="export-btn">
                            <i class="fas fa-download"></i>
                            Unduh CSV
                        </button>
                        <button id="printRekapButton" class="print-btn">
                            <i class="fas fa-print"></i>
                            Cetak Rekapitulasi
                        </button>
                        <button id="printPDFButton" class="print-btn">
                            <i class="fas fa-print"></i>
                            Cetak PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Input Acara, Nama, Pangkat, dan NIP -->
            <div id="signatureModal" class="modal">
                <div class="modal-content">
                    <h2>Masukkan Informasi Tanda Tangan</h2>
                    <form id="signatureForm">
                        <div class="form-group">
                            <label for="acara">Acara:</label>
                            <input type="text" id="acara" placeholder="Kegiatan Acara Diskominfo" required>
                        </div>
                        <div class="form-group">
                            <label for="pejabat">Mengetahui, an. :</label>
                            <input type="text" id="pejabat" placeholder="Kepala Dinas Komunikasi & Informatika Kabupaten Malang" required>
                        </div>
                        <div class="form-group">
                            <label for="bidang">Bidang:</label>
                            <input type="text" id="bidang" placeholder="Sekretariat" required>
                        </div>
                        <div class="form-group">
                            <label for="namaPejabat">Nama Pejabat:</label>
                            <input type="text" id="namaPejabat" placeholder="Dra. RINI NURHAYATI, M.M." required>
                        </div>
                        <div class="form-group">
                            <label for="pangkatPejabat">Pangkat:</label>
                            <input type="text" id="pangkatPejabat" placeholder="Pembina Tingkat I " required>
                        </div>
                        <div class="form-group">
                            <label for="nipPejabat">NIP:</label>
                            <input type="text" id="nipPejabat" placeholder="" required>
                        </div>
                        <div class="modal-buttons">
                            <button type="button" id="cancelSignature" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Modal untuk memilih rentang tanggal -->
            <div id="datePickerModal" class="modal">
                <div class="modal-content">
                    <h2>Pilih Rentang Tanggal</h2>
                    <form id="datePickerForm">
                        <div class="form-group">
                            <label for="modalStartDate">Tanggal Mulai:</label>
                            <input type="date" id="modalStartDate" required>
                        </div>
                        <div class="form-group">
                            <label for="modalEndDate">Tanggal Akhir:</label>
                            <input type="date" id="modalEndDate" required>
                        </div>
                        <div class="modal-buttons">
                            <button type="button" id="cancelDatePicker" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="printSettingsModal" class="modal">
                <div class="modal-content">
                    <h2 id="printTitle" class="modal-title">Cetak Laporan</h2>
                    <form id="printSettingsForm">
                        <div class="form-group">
                            <label>
                                <input type="radio" name="dateRange" value="all" checked>
                                Semua Data
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="radio" name="dateRange" value="custom">
                                Pilih Tanggal
                            </label>
                        </div>
                        <div class="date-range">
                            <div class="form-group">
                                <label for="startDate">Tanggal Mulai:</label>
                                <input type="date" id="startDate" disabled>
                            </div>
                            <div class="form-group">
                                <label for="endDate">Tanggal Akhir:</label>
                                <input type="date" id="endDate" disabled>
                            </div>
                        </div>
                        <div class="modal-buttons">
                            <button type="button" id="cancelPrint" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Visitor Table -->
            <div class="visitor-table-container">
                <table id="visitorTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Telepon</th>
                            <th>Tujuan</th>
                            <th>TTD</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="visitorTableBody">
                        <!-- Table content will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <h2>Ubah Data Tamu</h2>
                <form id="editForm">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="editNama" required>
                    </div>
                    <div class="form-group">
                        <label>Instansi</label>
                        <input type="text" id="editInstansi" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" id="editTelepon" required>
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <textarea id="editTujuan" required rows="3"></textarea>
                    </div>
                    <input type="hidden" id="editDateTime">
                    <div class="modal-buttons">
                        <button type="button" id="cancelEdit" class="cancel-btn">
                            <i class="fas fa-times-circle"></i>
                            Batal
                        </button>
                        <button type="submit" class="save-btn">
                            <i class="fas fa-check-circle"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image Preview Modal -->
        <div id="imagePreviewModal" class="modal">
            <div class="modal-content">
                <img id="previewImage" src="" alt="Preview">
                <button type="button" class="close-preview-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Notification Container -->
        <div id="notificationContainer" class="notification-container"></div>
    </div>

    <script src="{{ asset('admin.js') }}"></script>
</body>
</html>