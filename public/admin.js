// **State Management Data Pengunjung**
let visitors = [];
let selectedVisitor = null;

// **Element DOM**
const searchInput = document.getElementById("searchInput");
const dateFilter = document.getElementById("dateFilter");
const exportButton = document.getElementById("exportButton");
const visitorTableBody = document.getElementById("visitorTableBody");
const editModal = document.getElementById("editModal");
const editForm = document.getElementById("editForm");
const cancelEdit = document.getElementById("cancelEdit");
const editNama = document.getElementById("editNama");
const editInstansi = document.getElementById("editInstansi");
const editTelepon = document.getElementById("editTelepon");
const editTujuan = document.getElementById("editTujuan");
const editDateTime = document.getElementById("editDateTime");
const printButton = document.getElementById("printButton");
const pdfButton = document.getElementById("pdfButton");
const printSettingsModal = document.getElementById("printSettingsModal");
const printSettingsForm = document.getElementById("printSettingsForm");
const cancelPrintBtn = document.getElementById("cancelPrint");
const dateRangeRadios = document.getElementsByName("dateRange");
const startDateInput = document.getElementById("startDate");
const endDateInput = document.getElementById("endDate");

// **Inisialisasi Data Saat Halaman Dimuat**
document.addEventListener("DOMContentLoaded", () => {
    loadVisitorsData();
    setupEventListeners();
    renderVisitorTable();
});

// **Memuat Data Pengunjung dari localStorage**
function loadVisitorsData() {
    try {
        const storedVisitors = localStorage.getItem("visitors");
        visitors = storedVisitors ? JSON.parse(storedVisitors) : [];
        // Mengurutkan data berdasarkan waktu terbaru
        visitors.sort((a, b) => new Date(b.datetime) - new Date(a.datetime));
    } catch (error) {
        console.error("Error loading visitors data:", error);
        visitors = [];
    }
}

// **Mengatur Event Listener**
// **Inisialisasi Event Listener Baru**
function setupEventListeners() {
    searchInput.addEventListener("input", renderVisitorTable);
    dateFilter.addEventListener("change", renderVisitorTable);
    exportButton.addEventListener("click", exportToCSV);

    // Event listener untuk tombol cetak rekapitulasi
    document
        .getElementById("printRekapButton")
        .addEventListener("click", generateRekapitulasiPDF);

    // Event listener untuk tombol cetak PDF lengkap
    document
        .getElementById("printPDFButton")
        .addEventListener("click", generateFullPDF);

    cancelEdit.addEventListener("click", closeEditModal);
    editForm.addEventListener("submit", handleSave);
}

// **Menyaring Data Pengunjung Berdasarkan Input dan Filter**
function getFilteredVisitors() {
    return visitors.filter((visitor) => {
        const searchTerm = searchInput.value.toLowerCase();
        const dateValue = dateFilter.value;

        const matchesSearch =
            visitor.nama.toLowerCase().includes(searchTerm) ||
            visitor.instansi.toLowerCase().includes(searchTerm) ||
            visitor.tujuan.toLowerCase().includes(searchTerm) ||
            visitor.telepon.includes(searchTerm);

        const matchesDate = !dateValue || visitor.datetime.includes(dateValue);
        return matchesSearch && matchesDate;
    });
}

// **Menampilkan Data Pengunjung ke Tabel**
function renderVisitorTable() {
    const filteredVisitors = getFilteredVisitors();
    visitorTableBody.innerHTML = "";

    if (filteredVisitors.length === 0) {
        const emptyRow = document.createElement("tr");
        emptyRow.innerHTML = `
            <td colspan="11" class="text-center py-4">Tidak ada data pengunjung yang ditemukan</td>
        `;
        visitorTableBody.appendChild(emptyRow);
        return;
    }

    const groupedVisitors = {};
    filteredVisitors.forEach((visitor) => {
        const date = new Date(visitor.datetime);
        const year = date.getFullYear();
        const month = date.getMonth();

        if (!groupedVisitors[year]) groupedVisitors[year] = {};
        if (!groupedVisitors[year][month]) groupedVisitors[year][month] = [];
        groupedVisitors[year][month].push(visitor);
    });

    for (const year of Object.keys(groupedVisitors).sort()) {
        for (const month of Object.keys(groupedVisitors[year]).sort(
            (a, b) => a - b
        )) {
            const monthRow = document.createElement("tr");
            monthRow.classList.add("month-header");

            const monthCell = document.createElement("td");
            monthCell.colSpan = 11;
            monthCell.classList.add("month-title");

            const monthContent = document.createElement("div");
            monthContent.classList.add("month-content");

            const monthName = new Date(year, month).toLocaleString("id-ID", {
                month: "long",
            });
            const monthText = document.createElement("span");
            monthText.textContent = `${monthName} ${year}`;

            const toggleIcon = document.createElement("span");
            toggleIcon.classList.add("toggle-icon");
            toggleIcon.textContent = "➖";
            toggleIcon.style.cursor = "pointer";

            toggleIcon.addEventListener("click", () => {
                const monthRows = document.querySelectorAll(
                    `.month-${year}-${month}`
                );
                monthRows.forEach((row) => row.classList.toggle("hidden-rows"));

                // Ubah ikon dan warna
                if (toggleIcon.textContent === "➕") {
                    toggleIcon.textContent = "➖";
                    toggleIcon.style.color = "#dc2626"; // Merah saat terbuka
                } else {
                    toggleIcon.textContent = "➕";
                    toggleIcon.style.color = "#000"; // Hitam saat tertutup
                }
            });

            monthContent.appendChild(monthText);
            monthContent.appendChild(toggleIcon);
            monthCell.appendChild(monthContent);
            monthRow.appendChild(monthCell);
            visitorTableBody.appendChild(monthRow);

            groupedVisitors[year][month].forEach((visitor, index) => {
                const row = document.createElement("tr");
                row.classList.add(`month-${year}-${month}`);

                const dateTime = new Date(visitor.datetime);
                const formattedDate = dateTime.toLocaleDateString("id-ID", {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                });
                const formattedTime = dateTime.toLocaleTimeString("en-US", {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: true, // Mengaktifkan format 12 jam
                });

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${formattedDate}</td>
                    <td>${formattedTime}</td>
                    <td><img src="${
                        visitor.photo || "placeholder.png"
                    }" alt="Foto pengunjung" class="visitor-photo" onclick="showImagePreview(this.src)"></td>
                    <td>${escapeHtml(visitor.nama)}</td>
                    <td>${escapeHtml(visitor.instansi)}</td>
                    <td>${escapeHtml(visitor.telepon)}</td>
                    <td>${escapeHtml(visitor.tujuan)}</td>
                    <td><img src="${
                        visitor.signature || "placeholder-signature.png"
                    }" alt="Tanda tangan" class="visitor-signature" onclick="showImagePreview(this.src)"></td>
                    <td>
                        <button onclick="handleEdit('${
                            visitor.datetime
                        }')" class="edit-btn" title="Ubah"><i class="fas fa-edit"></i></button>
                        <button onclick="handleDelete('${
                            visitor.datetime
                        }')" class="delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                `;
                visitorTableBody.appendChild(row);
            });
        }
    }
}

// **Fungsi Validasi Tanggal**
function isValidDate(date) {
    return date instanceof Date && !isNaN(date);
}

// **Menangani Edit Data Pengunjung**
function handleEdit(datetime) {
    selectedVisitor = visitors.find((v) => v.datetime === datetime);
    if (selectedVisitor) {
        editNama.value = selectedVisitor.nama;
        editInstansi.value = selectedVisitor.instansi;
        editTelepon.value = selectedVisitor.telepon;
        editTujuan.value = selectedVisitor.tujuan;
        editDateTime.value = selectedVisitor.datetime.substring(0, 16);
        editModal.classList.add("active");
    }
}

// **Menyimpan Data yang Diedit**
function handleSave(event) {
    event.preventDefault();
    if (!selectedVisitor) return;

    if (
        !editNama.value ||
        !editInstansi.value ||
        !editTelepon.value ||
        !editTujuan.value
    ) {
        alert("Semua field harus diisi");
        return;
    }

    const updatedVisitor = {
        ...selectedVisitor,
        nama: editNama.value.trim(),
        instansi: editInstansi.value.trim(),
        telepon: editTelepon.value.trim(),
        tujuan: editTujuan.value.trim(),
    };

    const index = visitors.findIndex(
        (v) => v.datetime === selectedVisitor.datetime
    );
    if (index !== -1) {
        visitors[index] = updatedVisitor;
        saveVisitors();
        renderVisitorTable();
        closeEditModal();
        showNotification("Data berhasil diperbarui");
    }
}

// **Menangani Penghapusan Data**
function handleDelete(datetime) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        visitors = visitors.filter((v) => v.datetime !== datetime);
        saveVisitors();
        renderVisitorTable();
        showNotification("Data berhasil dihapus");
    }
}

// **Menyimpan Data ke localStorage**
function saveVisitors() {
    try {
        localStorage.setItem("visitors", JSON.stringify(visitors));
    } catch (error) {
        console.error("Error saving visitors data:", error);
        alert("Terjadi kesalahan saat menyimpan data");
    }
}

// **Menutup Modal Edit**
function closeEditModal() {
    editModal.classList.remove("active");
    selectedVisitor = null;
    editForm.reset();
}

// **Menampilkan Notifikasi**
function showNotification(message) {
    const notification = document.createElement("div");
    notification.className = "notification";
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

// **Meng-escape HTML untuk Mencegah XSS**
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// **Menampilkan Pratinjau Gambar**
function showImagePreview(src) {
    const imagePreviewModal = document.getElementById("imagePreviewModal");
    const previewImage = document.getElementById("previewImage");
    const closePreviewBtn = document.querySelector(".close-preview-btn");

    previewImage.src = src;
    imagePreviewModal.classList.add("active");

    closePreviewBtn.addEventListener("click", () =>
        imagePreviewModal.classList.remove("active")
    );
}

// **Ekspor Data ke CSV**
function exportToCSV() {
    const filteredVisitors = getFilteredVisitors();
    if (filteredVisitors.length === 0) {
        alert("Tidak ada data untuk diekspor");
        return;
    }

    const header = ["No", "Waktu", "Nama", "Instansi", "Telepon", "Tujuan"];
    const csvContent = [
        header.join(","),
        ...filteredVisitors.map((visitor, index) =>
            [
                index + 1,
                visitor.datetime,
                `"${visitor.nama.replace(/"/g, '""')}"`,
                `"${visitor.instansi.replace(/"/g, '""')}"`,
                `"${visitor.telepon.replace(/"/g, '""')}"`,
                `"${visitor.tujuan.replace(/"/g, '""')}"`,
            ].join(",")
        ),
    ].join("\n");

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute(
        "download",
        `daftar-tamu-${new Date().toISOString().slice(0, 10)}.csv`
    );
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// **Menangani Submit Pengaturan Cetak**
function handlePrintSettingsSubmit(event) {
    event.preventDefault();

    const selectedRange = document.querySelector(
        'input[name="dateRange"]:checked'
    ).value;
    let filteredVisitors = [...visitors];

    if (selectedRange === "custom") {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        endDate.setHours(23, 59, 59);

        if (!startDate || !endDate || startDate > endDate) {
            alert("Mohon masukkan rentang tanggal yang valid");
            return;
        }

        filteredVisitors = visitors.filter((visitor) => {
            const visitDate = new Date(visitor.datetime);
            return visitDate >= startDate && visitDate <= endDate;
        });
    }

    if (filteredVisitors.length === 0) {
        alert("Tidak ada data untuk dicetak pada rentang waktu yang dipilih");
        return;
    }

    printSettingsModal.classList.remove("active");
    generatePDFWithData(filteredVisitors);
}

function filterVisitorsByDate(visitors, startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    end.setHours(23, 59, 59);

    return visitors.filter((visitor) => {
        const visitDate = new Date(visitor.datetime);
        return visitDate >= start && visitDate <= end;
    });
}

async function promptDateRange() {
    // Menampilkan modal dan menunggu input dari user
    return new Promise((resolve) => {
        const modal = document.getElementById("datePickerModal");
        const form = document.getElementById("datePickerForm");
        const startDateInput = document.getElementById("modalStartDate");
        const endDateInput = document.getElementById("modalEndDate");
        const cancelBtn = document.getElementById("cancelDatePicker");

        // Reset form dan tampilkan modal
        form.reset();
        modal.classList.add("active");

        // Event listener untuk membatalkan pemilihan tanggal
        cancelBtn.addEventListener(
            "click",
            () => {
                modal.classList.remove("active");
                resolve(null);
            },
            { once: true }
        );

        // Event listener untuk submit form
        form.addEventListener(
            "submit",
            (e) => {
                e.preventDefault();

                const startDate = startDateInput.value;
                const endDate = endDateInput.value;

                if (new Date(startDate) > new Date(endDate)) {
                    alert(
                        "Tanggal mulai tidak boleh lebih besar dari tanggal akhir."
                    );
                    return;
                }

                modal.classList.remove("active");
                resolve({ startDate, endDate });
            },
            { once: true }
        );
    });
}

async function generateRekapitulasiPDF() {
    const dateRange = await promptDateRange();
    if (!dateRange) return;

    const filteredVisitors = filterVisitorsByDate(
        visitors,
        dateRange.startDate,
        dateRange.endDate
    );
    if (filteredVisitors.length === 0) {
        alert("Tidak ada data untuk dicetak pada rentang waktu yang dipilih.");
        return;
    }

    const signatureData = await promptSignatureData();
    if (!signatureData) return;

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF("p", "mm", "a4");

    // URL Logo
    const logoURL = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Logo_Kabupaten_Malang_-_Seal_of_Malang_Regency.svg/1120px-Logo_Kabupaten_Malang_-_Seal_of_Malang_Regency.svg.png";

    // Fungsi untuk mengonversi gambar URL menjadi base64
    function getBase64ImageFromURL(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.setAttribute("crossOrigin", "anonymous");
            img.onload = () => {
                const canvas = document.createElement("canvas");
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);
                const dataURL = canvas.toDataURL("image/png");
                resolve(dataURL);
            };
            img.onerror = (error) => {
                reject(error);
            };
            img.src = url;
        });
    }

    // Konversi gambar dan lanjutkan pembuatan PDF
    const logoImage = await getBase64ImageFromURL(logoURL);

    // Tambahkan Logo di Kiri
    const logoWidth = 25; // Lebar logo dalam mm
    const logoHeight = 25; // Tinggi logo dalam mm
    doc.addImage(logoImage, "PNG", 15, 10, logoWidth, logoHeight);

    // Kop Surat
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text("PEMERINTAH KABUPATEN MALANG", 105, 15, { align: "center" });
    doc.setFontSize(14);
    doc.text("DINAS KOMUNIKASI DAN INFORMATIKA", 105, 22, { align: "center" });
    doc.setFontSize(10);
    doc.text(
        "Jalan K.H. Agus Salim No. 7 Gedung J Lt. 3, Malang Telp./Fax: (0341) 408788",
        105,
        29,
        { align: "center" }
    );
    doc.text(
        "Website: www.kominfo.malangkab.go.id Email: kominfo@malangkab.go.id",
        105,
        36,
        { align: "center" }
    );
    doc.setFontSize(12);
    doc.text("MALANG 65119", 105, 43, { align: "center" });
    doc.line(15, 47, 195, 47); // Garis diposisikan sesuai jarak baru

    // Judul Laporan
    doc.setFont("helvetica", "normal");
    doc.setFontSize(12);
    const startDateFormatted = new Date(dateRange.startDate).toLocaleDateString(
        "id-ID"
    );
    const endDateFormatted = new Date(dateRange.endDate).toLocaleDateString(
        "id-ID"
    );

    const labelWidth = 40; // Lebar label agar titik dua sejajar
    const valueX = 15 + labelWidth; // Posisi nilai setelah titik dua

    // Fungsi untuk format tanggal menjadi Kamis/ 13 Februari 2025
    function formatTanggalIndonesia(tanggal) {
        const hari = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];
        const bulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        const dateObj = new Date(tanggal);
        const namaHari = hari[dateObj.getDay()];
        const tanggalHari = dateObj.getDate();
        const namaBulan = bulan[dateObj.getMonth()];
        const tahun = dateObj.getFullYear();

        return `${namaHari}/ ${tanggalHari} ${namaBulan} ${tahun}`;
    }

    // Formatkan hanya tanggal awal
    const formattedStartDate = formatTanggalIndonesia(dateRange.startDate);

    // Tambahkan ke PDF
    // Garis Horizontal
    doc.line(15, 47, 195, 47); // Tetap di Y = 47

    // Posisi Y setelah garis (disesuaikan)
    let posY = 55; // Memulai teks di bawah garis dengan jarak

    doc.text("Hari / Tanggal", 15, posY);
    doc.text(":", valueX - 5, posY);
    doc.text(`${formattedStartDate}`, valueX, posY); // Hanya tampilkan start date

    posY += 7; // Memberi jarak antar baris
    doc.text("Tempat", 15, posY);
    doc.text(":", valueX - 5, posY);
    doc.text("R.R. Diskominfo", valueX, posY);

    posY += 7; // Memberi jarak lagi
    // Ambil nilai acara dari input
    const acaraInput = document.getElementById("acara").value;

    // Validasi input
    if (!acaraInput) {
        alert("Silakan masukkan nama Acara terlebih dahulu.");
        return;
    }

    // Tambahkan ke PDF
    doc.text("Acara", 15, posY);
    doc.text(":", valueX - 5, posY);
    doc.text(acaraInput, valueX, posY);

    await doc.autoTable({
        head: [["No", "Tanggal", "Nama", "Instansi", "Telepon", "Tujuan", "TTD"]],
        body: filteredVisitors.map((visitor, index) => [
            (index + 1).toString(),
            new Date(visitor.datetime).toLocaleDateString("id-ID"),
            visitor.nama,
            visitor.instansi,
            visitor.telepon,
            visitor.tujuan,
            visitor.signature ? "" : "", // Kolom TTD
        ]),
        startY: posY + 15,
        theme: "plain",
        showHead: "firstPage",
        styles: {
            fontSize: 9,
            cellPadding: 5,
            valign: "middle",
            halign: "center",
            lineWidth: 0.1,
            lineColor: [200, 200, 200],
        },
        headStyles: {
            fillColor: [255, 255, 255],
            textColor: [0, 0, 0],
            fontStyle: "bold",
            lineWidth: 0.5,
        },
        columnStyles: { 6: { fontStyle: "bold" } },
        margin: { top: 10, bottom: 20, left: 15, right: 15 },
        didDrawCell: async (data) => {
            if (data.section === "body" && data.column.index === 6) { // Kolom TTD di tabel kedua
                const visitor = filteredVisitors[data.row.index];
                if (visitor && visitor.signature) {
                    try {
                        const cellWidth = data.cell.width;
                        const cellHeight = data.cell.height;
                        const imgWidth = Math.min(30, cellWidth - 6);
                        const imgHeight = Math.min(20, cellHeight - 6);
                        const xPos = data.cell.x + (cellWidth - imgWidth) / 2;
                        const yPos = data.cell.y + (cellHeight - imgHeight) / 2;
                        doc.addImage(visitor.signature, "PNG", xPos, yPos, imgWidth, imgHeight);
                    } catch (error) {
                        console.error("Error adding signature image:", error);
                    }
                }
            }
        }
    });   
    

    // Tambahkan bagian tanda tangan
    const finalTableY = doc.autoTable.previous.finalY + 30;
    const pageWidth = doc.internal.pageSize.width;
    const signatureX = pageWidth - 65;

    doc.setFont("helvetica", "normal");
    doc.setFontSize(12);
    doc.text("Mengetahui,", signatureX, finalTableY, { align: "center" });

    // Ambil data pejabat dan bidang dari form
    const pejabat = document.getElementById("pejabat").value;
    const bidang = document.getElementById("bidang").value;

    // Tampilkan data pejabat dan bidang secara manual di PDF
    doc.text(` ${pejabat}`, signatureX, finalTableY + 7, {
        align: "center",
    });
    doc.text(`${bidang}`, signatureX, finalTableY + 14, { align: "center" }); // Ditempatkan tepat di bawah pejabat

    doc.text("", signatureX, finalTableY + 50, { align: "center" });

    doc.setFont("helvetica", "bold");
    doc.setFontSize(12);
    doc.text(signatureData.nama.toUpperCase(), signatureX, finalTableY + 70, {
        align: "center",
    });
    doc.line(
        signatureX - 35,
        finalTableY + 72,
        signatureX + 35,
        finalTableY + 72
    );

    doc.setFont("helvetica", "normal");
    doc.setFontSize(12);
    doc.text(signatureData.pangkat, signatureX, finalTableY + 80, {
        align: "center",
    });

    const nipText = `NIP. ${signatureData.nip}`;
    doc.text(nipText, signatureX, finalTableY + 88, { align: "center" });

    doc.save(
        `rekapitulasi-buku-tamu-${dateRange.startDate}-${dateRange.endDate}.pdf`
    );
}

function promptSignatureData() {
    return new Promise((resolve) => {
        const modal = document.getElementById("signatureModal");
        const form = document.getElementById("signatureForm");
        const namaInput = document.getElementById("namaPejabat");
        const pangkatInput = document.getElementById("pangkatPejabat");
        const nipInput = document.getElementById("nipPejabat");
        const cancelBtn = document.getElementById("cancelSignature");

        form.reset();
        modal.classList.add("active");

        cancelBtn.addEventListener(
            "click",
            () => {
                modal.classList.remove("active");
                resolve(null);
            },
            { once: true }
        );

        form.addEventListener(
            "submit",
            (e) => {
                e.preventDefault();
                const nama = namaInput.value;
                const pangkat = pangkatInput.value;
                const nip = nipInput.value;

                modal.classList.remove("active");
                resolve({ nama, pangkat, nip });
            },
            { once: true }
        );
    });
}

async function generateFullPDF() {
    // Menampilkan modal untuk memilih rentang tanggal
    const dateRange = await promptDateRange();
    if (!dateRange) return;

    // Menyaring data pengunjung berdasarkan rentang tanggal
    const filteredVisitors = filterVisitorsByDate(
        visitors,
        dateRange.startDate,
        dateRange.endDate
    );
    if (filteredVisitors.length === 0) {
        alert("Tidak ada data untuk dicetak pada rentang waktu yang dipilih.");
        return;
    }

    // Inisialisasi dokumen PDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF("l", "mm", "a4");

    // Header dokumen
    // Format tanggal menjadi DD/MM/YYYY
    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, "0");
        const month = String(d.getMonth() + 1).padStart(2, "0"); // Bulan dimulai dari 0
        const year = d.getFullYear();
        return `${day}/${month}/${year}`;
    };

    // Header dokumen
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text("Laporan Buku Tamu Digital Diskominfo Kabupaten Malang", 15, 15);

    doc.setFontSize(12);
    doc.text(
        `Periode: ${formatDate(dateRange.startDate)} - ${formatDate(
            dateRange.endDate
        )}`,
        15,
        25
    );

    // Mengelompokkan data pengunjung berdasarkan tahun dan bulan
    const groupedVisitors = filteredVisitors.reduce((acc, visitor) => {
        const date = new Date(visitor.datetime);
        const year = date.getFullYear();
        const month = date.getMonth();

        if (!acc[year]) acc[year] = {};
        if (!acc[year][month]) acc[year][month] = [];
        acc[year][month].push(visitor);

        return acc;
    }, {});

    // Fungsi untuk mendapatkan URL gambar
    const getImageUrl = (base64String) =>
        base64String && !base64String.includes("placeholder")
            ? base64String
            : null;

    let startY = 30;

    // Iterasi data yang dikelompokkan berdasarkan tahun dan bulan
    for (const year of Object.keys(groupedVisitors).sort()) {
        for (const month of Object.keys(groupedVisitors[year]).sort(
            (a, b) => a - b
        )) {
            // Menambahkan halaman baru jika ruang di halaman tidak cukup
            if (startY > doc.internal.pageSize.height - 40) {
                doc.addPage();
                startY = 20;
            }

            // Menambahkan judul bulan dan tahun
            doc.setFont("helvetica", "bold");
            doc.setFontSize(11);
            const monthName = new Date(year, month).toLocaleString("id-ID", {
                month: "long",
            });
            doc.text(`${monthName} ${year}`, 15, startY);
            startY += 10;

            // Menambahkan tabel pengunjung
            await doc.autoTable({
                head: [
                    ["No", "Tanggal", "Waktu", "Foto", "TTD", "Nama", "Instansi", "Telepon", "Tujuan"]
                ],
                body: await Promise.all(
                    groupedVisitors[year][month].map(async (visitor, index) => {
                        const dateTime = new Date(visitor.datetime);
                        return [
                            (index + 1).toString(),
                            dateTime.toLocaleDateString("id-ID", {
                                day: "2-digit",
                                month: "2-digit",
                                year: "numeric"
                            }),
                            dateTime.toLocaleTimeString("id-ID", {
                                hour: "2-digit",
                                minute: "2-digit"
                            }),
                            visitor.photo ? "" : "",
                            visitor.signature ? "" : "  ",
                            visitor.nama,
                            visitor.instansi,
                            visitor.telepon,
                            visitor.tujuan
                        ];
                    })
                ),
                startY: startY,
                theme: "grid",
                showHead: "firstPage", // Header hanya di halaman pertama
                styles: {
                    fontSize: 8, // Ukuran font lebih kecil agar teks tidak turun
                    cellPadding: 4, // Padding lebih kecil agar teks rapi
                    halign: "center",
                    valign: "middle",
                },
                headStyles: {
                    fillColor: false, // Warna merah lebih lembut (Salmon)
                    textColor: [0, 0, 0], // Warna teks hitam
                    fontStyle: "bold",
                    halign: "center",
                    lineWidth: 0.3,
                },
                bodyStyles: {
                    halign: "center",
                    valign: "middle",
                },
                columnStyles: {
                    0: { cellWidth: 15 },  // No
                    1: { cellWidth: 25 },  // Tanggal
                    2: { cellWidth: 20 },  // Waktu
                    3: { cellWidth: 30 },  // Foto
                    4: { cellWidth: 30 },  // TTD
                    5: { cellWidth: 30 },  // Nama
                    6: { cellWidth: 40 },  // Instansi
                    7: { cellWidth: 30 },  // Telepon
                    8: { cellWidth: 50 },  // Tujuan
                },
                didDrawCell: async (data) => {
                    if (data.section === "body") {
                        const visitor = groupedVisitors[year][month][data.row.index];
                        if (!visitor) return;
            
                        const cellSize = 10; // Ukuran gambar dalam tabel lebih kecil
                        const cellWidth = data.cell.width;
                        const cellHeight = data.cell.height;
                        const centerX = data.cell.x + (cellWidth - cellSize) / 2;
                        const centerY = data.cell.y + (cellHeight - cellSize) / 2;
            
                        if (data.column.index === 3 && visitor.photo) {
                            const imageUrl = getImageUrl(visitor.photo);
                            if (imageUrl) {
                                try {
                                    doc.addImage(imageUrl, "JPEG", centerX, centerY, cellSize, cellSize);
                                } catch (error) {
                                    console.error("Error adding photo:", error);
                                }
                            }
                        }
            
                        if (data.column.index === 4 && visitor.signature) {
                            const signatureUrl = getImageUrl(visitor.signature);
                            if (signatureUrl) {
                                try {
                                    doc.addImage(signatureUrl, "PNG", centerX, centerY, cellSize, cellSize);
                                } catch (error) {
                                    console.error("Error adding signature:", error);
                                }
                            }
                        }
                    }
                },
            });
            

            // Menyesuaikan posisi Y untuk baris berikutnya
            startY = doc.lastAutoTable.finalY + 20;
        }
    }

    // Menyimpan dokumen PDF
    doc.save(`laporan-buku-tamu-${new Date().toISOString().slice(0, 10)}.pdf`);
}
