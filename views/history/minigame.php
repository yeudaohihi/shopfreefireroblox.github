<?php 
    require_once(realpath($_SERVER[ "DOCUMENT_ROOT"]) . '/views/header.php'); 
    require_once(realpath($_SERVER[ "DOCUMENT_ROOT"]) . '/views/navbar.php'); 
    if(!@$user){
        new Redirect(DOMAIN);
    exit;
}
?>
<style>
    .tw-fullscreen {
        min-height: auto;
    }
</style>

</div>

<div class="tw-bg-gray-100" style="min-height: 50vh; !important;">
    <div class="tw-py-6 tw-max-w-6xl tw-mx-auto tw-grid tw-grid-cols-10 tw-gap-2 tw-px-2 tw-relative">
        <?php require_once(realpath($_SERVER[ "DOCUMENT_ROOT"]) . '/views/profile/menu.php'); ?>
        <div class="tw-col-span-12 md:tw-col-span-8">
            <div class="tw-mt-4 tw-bg-white tw-rounded tw-w-full">
                <div class="tw-border-b tw-border-gray-200 tw-pb-2 tw-text-gray-800 tw-p-3 md:tw-py-3 md:tw-px-5">
                    <h2 class="tw-text-lg tw-font-semibold">Lịch Sử Chơi Game</h2>
                </div>
                <div class="tw-p-2 md:tw-p-4">
                    <div class="history_minigame"></div>
                        <script>
                            page = 1;
                            function load_his() {
                                $(".history_minigame").hide();
                                $("#loading").show();
                                $.post("/Table/History_Minigame", {
                                        page: page
                                    })
                                    .done(function(data) {
                                        $(".history_minigame").html('');
                                        $('.history_minigame').empty().append(data);
                                        $("#loading").hide();
                                        $(".history_minigame").show();
                                    });
                            }
                            load_his();
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php 
    require_once(realpath($_SERVER[ "DOCUMENT_ROOT"]) . '/views/profile/menumobile.php'); 
    require_once(realpath($_SERVER[ "DOCUMENT_ROOT"]) . '/views/footer.php'); 
?>