</div> </div> </div> <footer class="footer mt-auto py-4" style="background-color: #ffffff; border-top: 1px solid #edf2f7;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-left">
                <span class="text-muted small">
                    &copy; 2026 <strong style="color: #0d6871;">Mitra Sejahtera</strong>. Seluruh Hak Cipta Dilindungi.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-right d-none d-md-block">
                <span class="badge badge-pill px-3 py-2" style="background-color: rgba(0, 184, 148, 0.1); color: #00b894; font-size: 0.75rem;">
                    <i class="fas fa-shield-alt mr-1"></i> Sistem Terverifikasi Aman
                </span>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Menandai menu navigasi atas yang sedang aktif secara otomatis
        var url = window.location.href;
        $('.nav-link-custom').filter(function() {
            return this.href == url;
        }).addClass('active');

        // Mengatur agar footer tetap di bawah jika konten sedikit
        var docHeight = $(window).height();
        var footerHeight = $('footer').height();
        var footerTop = $('footer').position().top + footerHeight;
        if (footerTop < docHeight) {
            $('footer').css('margin-top', (docHeight - footerTop) + 'px');
        }
    });
</script>

</body>
</html>