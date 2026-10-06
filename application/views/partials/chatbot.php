<!-- ==========================================================
     WIDGET CHATBOT SKANDA (FAQ otomatis untuk tamu website)
     Murni HTML/CSS/JS di sisi klien - tidak memerlukan koneksi
     ke server pihak ketiga.
     ========================================================== -->
<style>
    .sk-chat-btn {
        position: fixed;
        bottom: 22px;
        right: 22px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--sk-gold), var(--sk-gold-terang));
        color: var(--sk-hitam);
        border: none;
        box-shadow: 0 6px 18px rgba(0,0,0,.3);
        font-size: 1.6rem;
        z-index: 1055;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform .15s ease-in-out;
    }
    .sk-chat-btn:hover { transform: scale(1.06); }

    .sk-chat-box {
        position: fixed;
        bottom: 96px;
        right: 22px;
        width: 340px;
        max-width: calc(100vw - 32px);
        height: 460px;
        max-height: calc(100vh - 130px);
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,.25);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1055;
    }
    .sk-chat-box.sk-open { display: flex; }

    .sk-chat-header {
        background: linear-gradient(90deg, var(--sk-hitam) 0%, var(--sk-biru-tua) 100%);
        color: #fff;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 3px solid var(--sk-gold);
    }
    .sk-chat-header .sk-title { display:flex; align-items:center; gap:8px; }
    .sk-chat-header .sk-title strong { color: var(--sk-gold); font-size: .95rem; }
    .sk-chat-header .sk-title small { display:block; color:#cfcfcf; font-size:.68rem; }
    .sk-chat-close { background:none; border:none; color:#fff; font-size:1.2rem; cursor:pointer; line-height:1; }

    .sk-chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 14px;
        background: #f8f6ef;
    }
    .sk-msg { margin-bottom: 10px; display: flex; }
    .sk-msg.bot { justify-content: flex-start; }
    .sk-msg.user { justify-content: flex-end; }
    .sk-bubble {
        max-width: 82%;
        padding: 9px 13px;
        border-radius: 14px;
        font-size: .85rem;
        line-height: 1.4;
    }
    .sk-msg.bot .sk-bubble { background:#fff; color:#222; border:1px solid #e6e2d6; border-bottom-left-radius:4px; }
    .sk-msg.user .sk-bubble { background: var(--sk-biru); color:#fff; border-bottom-right-radius:4px; }
    .sk-bubble a { color: inherit; font-weight:600; text-decoration: underline; }
    .sk-msg.bot .sk-bubble a { color: var(--sk-biru); }

    .sk-quick-wrap { padding: 0 14px 10px; display:flex; flex-wrap:wrap; gap:6px; background:#f8f6ef; }
    .sk-quick-btn {
        border: 1px solid var(--sk-biru);
        color: var(--sk-biru);
        background: #fff;
        font-size: .72rem;
        padding: 5px 10px;
        border-radius: 20px;
        cursor: pointer;
        transition: all .15s ease-in-out;
    }
    .sk-quick-btn:hover { background: var(--sk-biru); color:#fff; }

    .sk-chat-footer {
        display: flex;
        border-top: 1px solid #e6e2d6;
        padding: 8px;
        gap: 6px;
        background:#fff;
    }
    .sk-chat-footer input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 8px 14px;
        font-size: .85rem;
        outline: none;
    }
    .sk-chat-footer input:focus { border-color: var(--sk-gold); }
    .sk-chat-footer button {
        background: var(--sk-gold);
        color: var(--sk-hitam);
        border: none;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        cursor: pointer;
    }

    @media (max-width: 420px) {
        .sk-chat-box { right: 16px; left: 16px; width: auto; }
        .sk-chat-btn { right: 16px; }
    }
</style>

<button class="sk-chat-btn" id="skChatToggle" title="Ada yang bisa dibantu?">
    <i class="bi bi-chat-dots-fill"></i>
</button>

<div class="sk-chat-box" id="skChatBox">
    <div class="sk-chat-header">
        <div class="sk-title">
            <i class="bi bi-mortarboard-fill" style="color:var(--sk-gold); font-size:1.3rem;"></i>
            <div>
                <strong>Asisten SKANDA</strong>
                <small>Biasanya balas seketika</small>
            </div>
        </div>
        <button class="sk-chat-close" id="skChatClose">&times;</button>
    </div>

    <div class="sk-chat-body" id="skChatBody"></div>

    <div class="sk-quick-wrap" id="skQuickWrap"></div>

    <div class="sk-chat-footer">
        <input type="text" id="skChatInput" placeholder="Tulis pertanyaan Anda...">
        <button id="skChatSend"><i class="bi bi-send-fill"></i></button>
    </div>
</div>

<script>
(function () {
    var urlBeranda   = "<?= base_url('website') ?>";
    var urlProfil    = "<?= base_url('website/profil') ?>";
    var urlJurusan   = "<?= base_url('jurusan') ?>";
    var urlLulusan   = "<?= base_url('website/lulusan') ?>";
    var urlLowongan  = "<?= base_url('website/lowongan') ?>";
    var urlProduk    = "<?= base_url('website/produk') ?>";
    var urlMitra     = "<?= base_url('website/mitra') ?>";
    var urlDaftar    = "<?= base_url('pendaftaran') ?>";
    var urlCekStatus = "<?= base_url('pendaftaran/cek_status') ?>";

    // Basis pengetahuan sederhana: kata kunci -> balasan (mendukung tautan HTML)
    var knowledge = [
        {
            kw: ['halo', 'hai', 'hi', 'hello', 'pagi', 'siang', 'sore', 'malam'],
            reply: 'Halo! Selamat datang di website SKANDA - SMK Negeri 2 Karanganyar. Ada yang bisa saya bantu? Silakan pilih topik di bawah atau ketik pertanyaan Anda.'
        },
        {
            kw: ['daftar', 'pendaftaran', 'ppdb', 'cara masuk', 'cara daftar'],
            reply: 'Untuk mendaftar sebagai siswa baru, silakan isi formulir pendaftaran online kami. Setelah mengisi, Anda akan mendapatkan kode pendaftaran unik. <br><a href="' + urlDaftar + '">Buka Formulir Pendaftaran &rarr;</a>'
        },
        {
            kw: ['syarat', 'persyaratan', 'berkas', 'dokumen'],
            reply: 'Data yang perlu disiapkan saat mendaftar antara lain: nama lengkap, NIS, tempat & tanggal lahir, asal sekolah, alamat, nomor HP siswa dan orang tua/wali. Semua diisi langsung pada formulir pendaftaran online. <br><a href="' + urlDaftar + '">Buka Formulir Pendaftaran &rarr;</a>'
        },
        {
            kw: ['status', 'cek status', 'kode ppdb', 'no pendaftaran', 'nomor pendaftaran', 'diterima', 'ditolak'],
            reply: 'Anda bisa mengecek status pendaftaran menggunakan kode/nomor pendaftaran yang didapat setelah mendaftar. <br><a href="' + urlCekStatus + '">Cek Status Pendaftaran &rarr;</a>'
        },
        {
            kw: ['jurusan', 'prodi', 'kompetensi keahlian', 'jurusan apa saja'],
            reply: 'SKANDA memiliki beberapa program keahlian/jurusan. Lihat daftar lengkap beserta deskripsinya di sini. <br><a href="' + urlJurusan + '">Lihat Semua Jurusan &rarr;</a>'
        },
        {
            kw: ['lulusan', 'alumni', 'lulusan terbaik'],
            reply: 'Kami bangga dengan lulusan-lulusan terbaik SKANDA. Lihat profil dan pencapaian mereka di sini. <br><a href="' + urlLulusan + '">Lihat Lulusan Terbaik &rarr;</a>'
        },
        {
            kw: ['lowongan', 'loker', 'kerja', 'pekerjaan', 'rekrutmen'],
            reply: 'Info lowongan kerja dari mitra industri kami dapat dilihat di halaman berikut. <br><a href="' + urlLowongan + '">Lihat Lowongan Pekerjaan &rarr;</a>'
        },
        {
            kw: ['produk', 'karya siswa', 'hasil karya'],
            reply: 'Produk khas hasil karya siswa-siswi SKANDA bisa Anda lihat di sini. <br><a href="' + urlProduk + '">Lihat Produk Khas Sekolah &rarr;</a>'
        },
        {
            kw: ['mitra', 'kerjasama', 'perusahaan', 'industri', 'dudi'],
            reply: 'SKANDA menjalin kerjasama dengan berbagai perusahaan/industri. Lihat daftar mitra kami di sini. <br><a href="' + urlMitra + '">Lihat Mitra Kerjasama &rarr;</a>'
        },
        {
            kw: ['profil', 'sejarah', 'visi', 'misi', 'kepala sekolah', 'tentang sekolah'],
            reply: 'Anda bisa membaca profil lengkap sekolah, termasuk sambutan kepala sekolah, visi, dan misi di halaman berikut. <br><a href="' + urlProfil + '">Lihat Profil Sekolah &rarr;</a>'
        },
        {
            kw: ['kontak', 'alamat', 'lokasi', 'telepon', 'hubungi', 'email', 'wa', 'whatsapp'],
            reply: 'Anda dapat menghubungi kami melalui:<br>&#128205; Karanganyar, Jawa Tengah<br>&#9993; info@skanda.sch.id<br>&#9742; (0271) 000-0000'
        },
        {
            kw: ['terima kasih', 'makasih', 'thanks'],
            reply: 'Sama-sama! Senang bisa membantu. Jika ada pertanyaan lain seputar SKANDA, jangan ragu untuk bertanya lagi ya. \u{1F60A}'
        },
        {
            kw: ['admin', 'manusia', 'operator', 'cs'],
            reply: 'Untuk pertanyaan yang lebih spesifik, silakan hubungi kami langsung di &#9742; (0271) 000-0000 atau &#9993; info@skanda.sch.id, tim kami akan membantu lebih lanjut.'
        }
    ];

    var fallback = 'Maaf, saya belum memahami pertanyaan itu. Coba pilih salah satu topik berikut, atau hubungi kami di &#9742; (0271) 000-0000 untuk info lebih lanjut.';

    var quickReplies = [
        'Cara Pendaftaran',
        'Cek Status PPDB',
        'Jurusan yang Tersedia',
        'Lulusan Terbaik',
        'Lowongan Pekerjaan',
        'Produk Sekolah',
        'Mitra Kerjasama',
        'Kontak Sekolah'
    ];

    var chatBox   = document.getElementById('skChatBox');
    var chatBody  = document.getElementById('skChatBody');
    var quickWrap = document.getElementById('skQuickWrap');
    var input     = document.getElementById('skChatInput');

    function addMessage(text, from) {
        var wrap = document.createElement('div');
        wrap.className = 'sk-msg ' + from;
        var bubble = document.createElement('div');
        bubble.className = 'sk-bubble';
        bubble.innerHTML = text;
        wrap.appendChild(bubble);
        chatBody.appendChild(wrap);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function findReply(text) {
        var lower = text.toLowerCase();
        for (var i = 0; i < knowledge.length; i++) {
            for (var j = 0; j < knowledge[i].kw.length; j++) {
                if (lower.indexOf(knowledge[i].kw[j]) !== -1) {
                    return knowledge[i].reply;
                }
            }
        }
        return fallback;
    }

    function sendMessage(text) {
        if (!text || !text.trim()) return;
        addMessage(text.replace(/</g, '&lt;'), 'user');
        setTimeout(function () {
            addMessage(findReply(text), 'bot');
        }, 350);
    }

    function renderQuickReplies() {
        quickWrap.innerHTML = '';
        quickReplies.forEach(function (q) {
            var btn = document.createElement('button');
            btn.className = 'sk-quick-btn';
            btn.type = 'button';
            btn.textContent = q;
            btn.addEventListener('click', function () { sendMessage(q); });
            quickWrap.appendChild(btn);
        });
    }

    var started = false;
    function openChat() {
        chatBox.classList.add('sk-open');
        if (!started) {
            started = true;
            addMessage('Halo! \u{1F44B} Saya asisten virtual SKANDA. Ada yang bisa saya bantu seputar pendaftaran, jurusan, lulusan, lowongan kerja, produk sekolah, atau mitra kerjasama?', 'bot');
            renderQuickReplies();
        }
    }

    document.getElementById('skChatToggle').addEventListener('click', function () {
        if (chatBox.classList.contains('sk-open')) {
            chatBox.classList.remove('sk-open');
        } else {
            openChat();
        }
    });

    document.getElementById('skChatClose').addEventListener('click', function () {
        chatBox.classList.remove('sk-open');
    });

    document.getElementById('skChatSend').addEventListener('click', function () {
        sendMessage(input.value);
        input.value = '';
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            sendMessage(input.value);
            input.value = '';
        }
    });
})();
</script>
