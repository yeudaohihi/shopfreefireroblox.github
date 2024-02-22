<script>
    $(function() {
        $("img.lazyLoad").lazyload({
            effect: "fadeIn"
        });
    });

    function Toast(status, msg) {
        if (status == 'error') {
            var color = "linear-gradient(to right, #ff5f6d, #ffc371)";
        } else {
            var color = "linear-gradient(to right, #00b09b, #96c93d)";
        }
        Toastify({
            text: msg,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: color,
        }).showToast();
    }
</script>
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy;</p>
        </div>
        <div class="float-end">
            <p>Developed <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://xboxtech.vn">XBOXTECH.VN</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="/Cpanel/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/Cpanel/assets/js/bootstrap.bundle.min.js"></script>

<script src="/Cpanel/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/Cpanel/assets/js/pages/dashboard.php?<?= time() ?>"></script>

<!-- Include Choices JavaScript -->
<script src="/Cpanel/assets/vendors/choices.js/choices.min.js"></script>
<script src="/Cpanel/assets/js/pages/form-element-select.js"></script>
<script src="/Cpanel/assets/js/mazer.js"></script>
<script src="/Cpanel/assets/vendors/toastify/toastify.js"></script>
</body>

</html>