<!-- TOPBAR COMPONENT FOR CAREERPATH -->
<div class="topbar-v3">

    <!-- Kolom Pencarian Dinamis -->
    <div class="search-v3">
        <i class="fa-solid fa-magnifying-glass search-icon-inside"></i>
        <input 
            type="text" 
            id="global-search-input"
            placeholder="Cari lowongan, perusahaan, atau skill..."
            onkeypress="handleGlobalSearch(event)">
    </div>

    <!-- Area Notifikasi Lonceng dengan Dropdown Hover -->
    <div class="notification-wrapper-v3">
        <div class="notification-v3">
            <i class="fa-regular fa-bell"></i>
            <span class="notification-badge-v3">3</span>
        </div>
        
        <!-- Dropdown Menu Notifikasi (Akan muncul saat hover) -->
        <div class="notification-dropdown-v3">
            <div class="dropdown-header-v3">
                <h3>Notifikasi Terbaru</h3>
                <a href="#" onclick="alert('Semua notifikasi ditandai telah dibaca.');">Tandai dibaca</a>
            </div>
            <ul class="dropdown-list-v3">
                <li class="unread">
                    <div class="noti-icon-v3 purple"><i class="fa-solid fa-comments"></i></div>
                    <div class="noti-text-v3">
                        <p>Undangan <strong>Wawancara Virtual</strong> dari Gojek Indonesia telah diterbitkan.</p>
                        <small>Baru saja</small>
                    </div>
                </li>
                <li class="unread">
                    <div class="noti-icon-v3 green"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="noti-text-v3">
                        <p>Lamaran Anda di <strong>Tokopedia</strong> sukses beralih ke tahap Review HRD.</p>
                        <small>2 jam yang lalu</small>
                    </div>
                </li>
                <li>
                    <div class="noti-icon-v3 blue"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="noti-text-v3">
                        <p>Ada 5 lowongan magang baru yang sesuai dengan keahlian <strong>UI/UX Design</strong> Anda.</p>
                        <small>Kemarin</small>
                    </div>
                </li>
            </ul>
            <div class="dropdown-footer-v3">
                <a href="applications.php">Lihat Semua Aktivitas Lamaran</a>
            </div>
        </div>
    </div>

</div>

<!-- CSS MODEREN KHUSUS UNTUK TOPBAR -->
<style>
    :root {
        --primary: #2563EB;
        --dark-slate: #0F172A;
        --charcoal: #1E293B;
        --text-muted: #64748B;
        --white: #FFFFFF;
        --border-soft: #E2E8F0;
    }

    /* TOPBAR CONTAINER BASE Layout */
    .topbar-v3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--white);
        padding: 14px 24px;
        border-radius: 16px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
        margin-bottom: 24px;
        width: 100%;
    }

    /* SEARCH BAR FIELD RE-DESIGN */
    .search-v3 {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 400px;
    }
    .search-icon-inside {
        position: absolute;
        left: 14px;
        color: var(--text-muted);
        font-size: 14px;
        pointer-events: none;
    }
    .search-v3 input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        background-color: #F8FAFC;
        font-size: 13px;
        color: var(--dark-slate);
        transition: all 0.2s ease;
    }
    .search-v3 input:focus {
        outline: none;
        border-color: var(--primary);
        background-color: var(--white);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* NOTIFICATION BUTTON & BADGE WRAPPER */
    .notification-wrapper-v3 {
        position: relative;
    }
    .notification-v3 {
        position: relative;
        background-color: #F8FAFC;
        border: 1px solid var(--border-soft);
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .notification-v3 i {
        font-size: 18px;
        color: var(--charcoal);
    }
    .notification-v3:hover {
        background-color: #F1F5F9;
        border-color: #CBD5E1;
    }
    .notification-badge-v3 {
        position: absolute;
        top: -6px;
        right: -6px;
        background-color: #EF4444;
        color: var(--white);
        font-size: 10.5px;
        font-weight: 700;
        min-width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--white);
        padding: 0 2px;
    }

    /* DROPDOWN MENU INTERAKTIF HANYA VIA CSS HOVER */
    .notification-dropdown-v3 {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 340px;
        background-color: var(--white);
        border: 1px solid var(--border-soft);
        border-radius: 14px;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.05);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 999;
    }
    .notification-wrapper-v3:hover .notification-dropdown-v3 {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* DROPDOWN SUB-COMPONENTS */
    .dropdown-header-v3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-bottom: 1px solid #F1F5F9;
    }
    .dropdown-header-v3 h3 {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--dark-slate);
        margin: 0;
    }
    .dropdown-header-v3 a {
        font-size: 11.5px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    .dropdown-header-v3 a:hover { text-decoration: underline; }

    .dropdown-list-v3 {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 280px;
        overflow-y: auto;
    }
    .dropdown-list-v3 li {
        display: flex;
        gap: 12px;
        padding: 14px 16px;
        border-bottom: 1px solid #F8FAFC;
        transition: background-color 0.15s ease;
    }
    .dropdown-list-v3 li:hover { background-color: #F8FAFC; }
    .dropdown-list-v3 li.unread { background-color: #EFF6FF; }
    .dropdown-list-v3 li.unread:hover { background-color: #DBEAFE; }

    .noti-icon-v3 {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 13px;
    }
    .noti-icon-v3.purple { background-color: #F3E8FF; color: #9333EA; }
    .noti-icon-v3.green { background-color: #ECFDF5; color: #059669; }
    .noti-icon-v3.blue { background-color: #E0F2FE; color: #0284C7; }

    .noti-text-v3 p {
        font-size: 12.5px;
        color: var(--charcoal);
        margin: 0 0 4px 0;
        line-height: 1.4;
    }
    .noti-text-v3 small {
        font-size: 11px;
        color: var(--text-muted);
        display: block;
    }

    .dropdown-footer-v3 {
        padding: 12px;
        text-align: center;
        border-top: 1px solid #F1F5F9;
        background-color: #F8FAFC;
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }
    .dropdown-footer-v3 a {
        font-size: 12px;
        color: var(--charcoal);
        text-decoration: none;
        font-weight: 600;
        display: block;
    }
    .dropdown-footer-v3 a:hover { color: var(--primary); }
</style>

<!-- SCRIPT PENGHURUNG INTEGRASI SEARCH PENGGUNA -->
<script>
    function handleGlobalSearch(event) {
        // Jika pengguna menekan tombol 'Enter' pada kolom pencarian
        if (event.key === 'Enter') {
            let query = document.getElementById('global-search-input').value.trim();
            if (query !== '') {
                // Mengalihkan pengguna langsung ke halaman jobs.php dengan membawa parameter pencarian
                window.location.href = 'jobs.php?search=' + encodeURIComponent(query);
            }
        }
    }
</script>