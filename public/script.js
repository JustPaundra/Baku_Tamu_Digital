window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    if (window.scrollY > 50) {
        header.classList.add("shrink");
    } else {
        header.classList.remove("shrink");
    }
});

// Datetime Utilities
// Datetime Utilities
function updateDateTime() {
    const datetimeField = document.getElementById("datetime");
    const now = new Date();
    datetimeField.value = now.toISOString();
}

// SignaturePad Class
class SignaturePad {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext("2d");
        this.isDrawing = false;
        this.points = [];

        // Set canvas size with high resolution
        const rect = canvas.getBoundingClientRect();
        this.canvas.width = rect.width * 2;
        this.canvas.height = rect.height * 2;
        this.ctx.scale(2, 2);

        // Set drawing style
        this.ctx.strokeStyle = "#000000";
        this.ctx.lineWidth = 2;
        this.ctx.lineCap = "round";
        this.ctx.lineJoin = "round";

        this.bindEvents();
    }

    bindEvents() {
        // Mouse events
        this.canvas.addEventListener("mousedown", (e) => {
            this.startDrawing(e.clientX, e.clientY);
        });

        this.canvas.addEventListener("mousemove", (e) => {
            if (this.isDrawing) {
                this.draw(e.clientX, e.clientY);
            }
        });

        document.addEventListener("mouseup", () => {
            this.stopDrawing();
        });

        // Touch events
        this.canvas.addEventListener("touchstart", (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            this.startDrawing(touch.clientX, touch.clientY);
        });

        this.canvas.addEventListener("touchmove", (e) => {
            e.preventDefault();
            if (this.isDrawing) {
                const touch = e.touches[0];
                this.draw(touch.clientX, touch.clientY);
            }
        });

        this.canvas.addEventListener("touchend", (e) => {
            e.preventDefault();
            this.stopDrawing();
        });
    }

    startDrawing(clientX, clientY) {
        const rect = this.canvas.getBoundingClientRect();
        const x = clientX - rect.left;
        const y = clientY - rect.top;

        this.isDrawing = true;
        this.ctx.beginPath();
        this.ctx.moveTo(x, y);
        this.points = [{ x, y }];
    }

    draw(clientX, clientY) {
        const rect = this.canvas.getBoundingClientRect();
        const x = clientX - rect.left;
        const y = clientY - rect.top;

        this.points.push({ x, y });

        if (this.points.length > 2) {
            const lastTwoPoints = this.points.slice(-2);
            const controlPoint = lastTwoPoints[0];
            const endPoint = {
                x: (lastTwoPoints[0].x + lastTwoPoints[1].x) / 2,
                y: (lastTwoPoints[0].y + lastTwoPoints[1].y) / 2,
            };

            this.ctx.quadraticCurveTo(
                controlPoint.x,
                controlPoint.y,
                endPoint.x,
                endPoint.y
            );
            this.ctx.stroke();

            this.ctx.beginPath();
            this.ctx.moveTo(endPoint.x, endPoint.y);
        }
    }

    stopDrawing() {
        this.isDrawing = false;
        this.points = [];
    }

    clear() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }

    getData() {
        return this.canvas.toDataURL("image/png");
    }

    isEmpty() {
        const blankCanvas = document.createElement("canvas");
        blankCanvas.width = this.canvas.width;
        blankCanvas.height = this.canvas.height;
        return this.canvas.toDataURL() === blankCanvas.toDataURL();
    }
}

// Camera Class
class Camera {
    constructor(videoElement, canvasElement) {
        this.video = videoElement;
        this.canvas = canvasElement;
        this.ctx = this.canvas.getContext("2d");
        this.stream = null;
    }

    async start() {
        try {
            this.stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    width: 640,
                    height: 480,
                    facingMode: "user",
                },
            });
            this.video.srcObject = this.stream;
            return true;
        } catch (err) {
            console.error("Error accessing camera:", err);
            alert(
                "Error: Pastikan kamera tersedia dan izin kamera telah diberikan."
            );
            return false;
        }
    }

    stop() {
        if (this.stream) {
            this.stream.getTracks().forEach((track) => track.stop());
            this.video.srcObject = null;
        }
    }

    takePhoto() {
        this.canvas.width = this.video.videoWidth;
        this.canvas.height = this.video.videoHeight;
        this.ctx.drawImage(this.video, 0, 0);
        return this.canvas.toDataURL("image/jpeg", 0.8);
    }
}

// Form Utilities
function validateForm(formData, photoTaken, signaturePad) {
    if (!formData.nama.trim()) {
        alert("Nama tidak boleh kosong");
        return false;
    }
    if (!formData.instansi.trim()) {
        alert("Instansi tidak boleh kosong");
        return false;
    }
    if (!formData.telepon.trim()) {
        alert("Nomor telepon tidak boleh kosong");
        return false;
    }
    if (!formData.tujuan.trim()) {
        alert("Tujuan kunjungan tidak boleh kosong");
        return false;
    }
    if (!photoTaken) {
        alert("Silakan ambil foto terlebih dahulu");
        return false;
    }
    if (signaturePad.isEmpty()) {
        alert("Silakan tambahkan tanda tangan");
        return false;
    }
    return true;
}

// Main Application
document.addEventListener("DOMContentLoaded", () => {
    // Initialize datetime
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Initialize signature pad
    const signaturePad = new SignaturePad(
        document.getElementById("signature-pad")
    );

    // Initialize camera
    const camera = new Camera(
        document.getElementById("camera"),
        document.getElementById("photo-canvas")
    );

    // Camera controls
    const takePhotoBtn = document.getElementById("take-photo");
    const retakePhotoBtn = document.getElementById("retake-photo");
    let photoTaken = false;

    camera.start();

    takePhotoBtn.addEventListener("click", () => {
        const photoData = camera.takePhoto();
        document.getElementById("camera").style.display = "none";
        document.getElementById("photo-canvas").style.display = "block";
        takePhotoBtn.style.display = "none";
        retakePhotoBtn.style.display = "block";
        photoTaken = true;
    });

    retakePhotoBtn.addEventListener("click", () => {
        document.getElementById("camera").style.display = "block";
        document.getElementById("photo-canvas").style.display = "none";
        takePhotoBtn.style.display = "block";
        retakePhotoBtn.style.display = "none";
        photoTaken = false;
        camera.start();
    });

    // Clear signature button
    document.getElementById("clear-signature").addEventListener("click", () => {
        signaturePad.clear();
    });

    // Phone number formatting
    const phoneInput = document.getElementById("telepon");
    phoneInput.addEventListener("input", (e) => {
        let value = e.target.value.replace(/\D/g, "");

        if (value.length >= 2 && !value.startsWith("08")) {
            value = "08" + value.slice(2);
        }

        if (value.length > 4) {
            value = value.slice(0, 4) + "-" + value.slice(4);
        }
        if (value.length > 9) {
            value = value.slice(0, 9) + "-" + value.slice(9);
        }

        e.target.value = value;
    });

    // Form submission
    const guestForm = document.getElementById("guest-form");
    guestForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = {
            datetime: new Date().toISOString(),
            nama: document.getElementById("nama").value,
            instansi: document.getElementById("instansi").value,
            telepon: document.getElementById("telepon").value,
            tujuan: document.getElementById("tujuan").value,
        };

        if (!validateForm(formData, photoTaken, signaturePad)) {
            return;
        }

        // Get photo and signature data
        formData.photo = document
            .getElementById("photo-canvas")
            .toDataURL("image/jpeg", 0.8);
        formData.signature = signaturePad.getData();

        // Add to visitor list
        addVisitorToList(formData);
        saveToLocalStorage(formData);

        // Reset form
        guestForm.reset();
        signaturePad.clear();
        document.getElementById("camera").style.display = "block";
        document.getElementById("photo-canvas").style.display = "none";
        takePhotoBtn.style.display = "block";
        retakePhotoBtn.style.display = "none";
        photoTaken = false;
        camera.start();

        // alert('Data berhasil disimpan!');
        showNotification("Data tersimpan! Cek daftar kunjungan di bawah.");
    });

    // Visitor list functions
    // TAMPILAN DAFTAR KUNJUNGAN
    function addVisitorToList(visitorData) {
        const visitorList = document.getElementById("visitor-list");
        let noVisitsMessage = document.getElementById("no-visits-message");

        // Buat pesan "Tidak ada kunjungan hari ini" jika belum ada
        if (!noVisitsMessage) {
            noVisitsMessage = document.createElement("p");
            noVisitsMessage.id = "no-visits-message";
            noVisitsMessage.textContent = "Belum ada kunjungan hari ini.";
            noVisitsMessage.style.textAlign = "center";
            noVisitsMessage.style.fontStyle = "italic";
            noVisitsMessage.style.color = "#888";
            visitorList.appendChild(noVisitsMessage);
        }

        // Format waktu dan tanggal kunjungan
        const visitTime = new Date(visitorData.datetime);
        const today = new Date();

        // Cek apakah kunjungan dilakukan pada hari ini
        if (
            visitTime.getFullYear() === today.getFullYear() &&
            visitTime.getMonth() === today.getMonth() &&
            visitTime.getDate() === today.getDate()
        ) {
            const timeString = visitTime.toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
                hour12: true,
            });
            const dateString = visitTime.toLocaleDateString("id-ID", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            });

            // Buat item kunjungan
            const visitorItem = document.createElement("div");
            visitorItem.className = "visitor-item";
            visitorItem.innerHTML = `
            <strong>${visitorData.nama}</strong>
            <img src="${visitorData.photo}" alt="Foto ${visitorData.nama}">
            <div class="text-content">
                <span>${visitorData.instansi}</span>
                <span>${dateString}</span>
                <span>${timeString}</span>
            </div>
        `;

            visitorList.appendChild(visitorItem);

            // Sembunyikan pesan jika ada kunjungan
            noVisitsMessage.style.display = "none";
        } else {
            // Jika tidak ada kunjungan, tampilkan pesan
            const existingVisitors =
                visitorList.getElementsByClassName("visitor-item");
            if (existingVisitors.length === 0) {
                noVisitsMessage.style.display = "block";
            }
        }
    }

    // Fungsi auto-scroll
    function startAutoScroll() {
        const visitorList = document.getElementById("visitor-list");

        let scrollAmount = 0;
        const scrollStep = 2; // Kecepatan scroll (px)
        const scrollDelay = 50; // Interval waktu antar scroll (ms)

        function scroll() {
            scrollAmount += scrollStep;
            visitorList.scrollLeft += scrollStep;

            // Reset scroll ke awal jika sudah mencapai akhir
            if (
                scrollAmount >=
                visitorList.scrollWidth - visitorList.clientWidth
            ) {
                scrollAmount = 0;
                visitorList.scrollLeft = 0;
            }

            // Panggil lagi fungsi scroll secara berkala
            setTimeout(scroll, scrollDelay);
        }

        scroll();
    }

    // Panggil fungsi auto-scroll setelah halaman dimuat
    window.addEventListener("load", startAutoScroll);

    // Local storage functions
    function saveToLocalStorage(visitorData) {
        const visitors = getVisitorsFromLocalStorage();
        visitors.unshift(visitorData);
        localStorage.setItem("visitors", JSON.stringify(visitors));
    }

    function getVisitorsFromLocalStorage() {
        const visitors = localStorage.getItem("visitors");
        return visitors ? JSON.parse(visitors) : [];
    }

    // Load existing visitors
    const visitors = getVisitorsFromLocalStorage();
    visitors.forEach((visitor) => addVisitorToList(visitor));

    // Handle window resize
    window.addEventListener("resize", () => {
        const canvas = document.getElementById("signature-pad");
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    });

    // Handle offline/online status
    window.addEventListener("online", () => {
        document.body.classList.remove("offline");
        alert("Koneksi internet tersedia kembali");
    });

    window.addEventListener("offline", () => {
        document.body.classList.add("offline");
        alert("Koneksi internet terputus. Data akan disimpan secara lokal.");
    });
});

function navigateToAdmin() {
    window.location.href = "admin.html"; // Ganti dengan halaman admin yang sudah kamu buat
}

// Function to format datetime
function formatDateTime(isoString) {
    const date = new Date(isoString);
    const options = {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    return date.toLocaleDateString("id-ID", options);
}

// Modified visitor list functions
// function addVisitorToList(visitorData) {
//     const visitorList = document.getElementById('visitor-list');

//     // Limit to show only the first 4 visitors
//     if (visitorList.children.length >= 4) {
//         if (visitorList.lastChild) {
//             visitorList.removeChild(visitorList.lastChild);
//         }
//     }

//     const visitorCard = document.createElement('div');
//     visitorCard.className = 'visitor-card';

//     visitorCard.innerHTML = `
//         <img src="${visitorData.photo}" alt="Foto ${visitorData.nama}" class="visitor-photo">
//         <h3>${visitorData.nama}</h3>
//         <p><strong>Waktu:</strong> ${formatDateTime(visitorData.datetime)}</p>
//         <p><strong>Instansi:</strong> ${visitorData.instansi}</p>
//         <p><strong>Tujuan:</strong> ${visitorData.tujuan}</p>
//         <img src="${visitorData.signature}" alt="Tanda tangan ${visitorData.nama}" class="visitor-signature">
//     `;

//     visitorList.insertBefore(visitorCard, visitorList.firstChild);
// }

// Clock functionality
function updateClock() {
    const clockContainer = document.querySelector(".clock-container");

    function formatDate(date) {
        const options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        };
        return date.toLocaleDateString("id-ID", options);
    }

    function formatTime(date) {
        return date.toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: true, // Mengaktifkan format 12 jam dengan AM/PM
        });
    }

    function updateDisplay() {
        const now = new Date();
        clockContainer.innerHTML = `
            <div class="clock-display">
                <div class="clock-time">${formatTime(now)}</div>
                <div class="clock-date">${formatDate(now)}</div>
            </div>
        `;
    }

    // Initial update
    updateDisplay();

    // Update every second
    setInterval(updateDisplay, 1000);
}

// Add this to your existing DOMContentLoaded event listener
document.addEventListener("DOMContentLoaded", () => {
    // Initialize clock
    updateClock();

    // Your existing code...
});

const styles = document.createElement("style");
styles.textContent = `
    .clock-container {
        margin: 1rem auto;
        max-width: 400px;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(styles);

// NOTIFIKASI
function showNotification(message) {
    // Buat elemen overlay dan notifikasi
    const overlay = document.createElement("div");
    overlay.className = "notification-overlay";

    const notification = document.createElement("div");
    notification.className = "notification";
    notification.innerHTML = `
        <p>${message}</p>
        <button id="ok-button">OK</button>
    `;

    overlay.appendChild(notification);
    document.body.appendChild(overlay);

    // Event listener untuk tombol "OK"
    document.getElementById("ok-button").addEventListener("click", () => {
        overlay.remove();
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const scrollTopBtn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add("show");
        } else {
            scrollTopBtn.classList.remove("show");
        }
    });

    scrollTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
});

