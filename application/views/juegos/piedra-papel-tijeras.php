<!DOCTYPE html>
<html>
    <head>
        <title>ROCK PAPER SCISSORS</title>
        <link rel="stylesheet" href="<?=base_url()?>puzzle/piedra-papel/css/reset.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>puzzle/piedra-papel/css/main.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>puzzle/piedra-papel/css/orientation_utils.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>puzzle/piedra-papel/css/ios_fullscreen.css" type="text/css">
        <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <meta name="msapplication-tap-highlight" content="no"/>
        <script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/platform.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/ios_fullscreen.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/createjs.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/screenfull.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/howler.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CTweenController.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/sprite_lib.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/settings.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CLang.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CPreloader.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/ctl_utils.js"></script>
        
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CMain.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CCTLText.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CHistoryPanel.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CPlayer.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CSelectPlayers.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CGameSection.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CMatchCount.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CCpuPlayer.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CSelectThrow.js"></script>
        <!-- <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CRecordPanel.js"></script> -->

        
        <!-- <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CAreYouSurePanel.js"></script> -->

        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CInterface.js"></script>

        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CToggle.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CGfxButton.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CMenu.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CGame.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CCreditsPanel.js"></script>
        <script type="text/javascript" src="<?=base_url()?>puzzle/piedra-papel/js/CHelpPanel.js"></script>
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
        <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
        <script>
		
            $(document).ready(function () {
                var oMain = new CMain({
                    audio_enable_on_startup:false, //ENABLE/DISABLE AUDIO WHEN GAME STARTS
                    fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                    check_orientation: true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                    victoryOccurences: 10           //0-100 possibility of the player to win
                });
                

                $(oMain).on("start_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartSession();
                    }
                });

                $(oMain).on("end_session", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndSession();
                    }
                });

                $(oMain).on("show_interlevel_ad", function (evt) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShowInterlevelAD();
                    }
                });

                

                if (isIOS()) {
                    setTimeout(function () {
                        sizeHandler();
                    }, 200);
                } else {
                    sizeHandler();
                }
            });

        </script>

        <div class="check-fonts">
            <p class="check-font-1">1</p>
        </div> 

		<canvas id="canvas" class='ani_hack' width="1200" height="600"> </canvas>
        <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Por favor gira tu dispositivo</p></div>
        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>

    </body>
</html>