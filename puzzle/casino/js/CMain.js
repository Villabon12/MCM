function CMain(oData) {
    var _bUpdate;
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    var _oData;

    var _oPreloader;
    var _oMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function () {

        s_oCanvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(s_oCanvas);
        createjs.Touch.enable(s_oStage);

        s_bMobile = jQuery.browser.mobile;
        if (s_bMobile === false) {
            s_oStage.enableMouseOver(20);
            $('body').on('contextmenu', '#canvas', function (e) { return false; });
        }

        s_iPrevTime = new Date().getTime();

        createjs.Ticker.addEventListener("tick", this._update);
        createjs.Ticker.framerate = FPS;

        if (navigator.userAgent.match(/Windows Phone/i)) {
            DISABLE_SOUND_MOBILE = true;
        }

        s_oSpriteLibrary = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();

    };

    this.preloaderReady = function () {
        this._loadImages();
        if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
            this._initSounds();
        }

        _bUpdate = true;
    };

    this.soundLoaded = function () {
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource / RESOURCE_TO_LOAD * 100);
        _oPreloader.refreshLoader(iPerc);

    };

    this._initSounds = function () {
        Howler.mute(!s_bAudioActive);

        s_aSoundsInfo = new Array();
        s_aSoundsInfo.push({ path: '../../puzzle/casino/sounds/', filename: 'press_button', loop: false, volume: 1, ingamename: 'click' });
        s_aSoundsInfo.push({ path: '../../puzzle/casino/sounds/', filename: 'game_over', loop: false, volume: 1, ingamename: 'game_over' });
        s_aSoundsInfo.push({ path: '../../puzzle/casino/sounds/', filename: 'reel', loop: true, volume: 1, ingamename: 'reel' });
        s_aSoundsInfo.push({ path: '../../puzzle/casino/sounds/', filename: 'start_reel', loop: false, volume: 1, ingamename: 'start_reel' });
        s_aSoundsInfo.push({ path: '../../puzzle/casino/sounds/', filename: 'win', loop: false, volume: 1, ingamename: 'win' });

        RESOURCE_TO_LOAD += s_aSoundsInfo.length;

        s_aSounds = new Array();
        for (var i = 0; i < s_aSoundsInfo.length; i++) {
            this.tryToLoadSound(s_aSoundsInfo[i], false);
        }
    };

    this.tryToLoadSound = function (oSoundInfo, bDelay) {
        setTimeout(function () {
            s_aSounds[oSoundInfo.ingamename] = new Howl({
                src: [oSoundInfo.path + oSoundInfo.filename + '.mp3'],
                autoplay: false,
                preload: true,
                loop: oSoundInfo.loop,
                volume: oSoundInfo.volume,
                onload: s_oMain.soundLoaded,
                onloaderror: function (szId, szMsg) {
                    for (var i = 0; i < s_aSoundsInfo.length; i++) {
                        if (szId === s_aSounds[s_aSoundsInfo[i].ingamename]._sounds[0]._id) {
                            s_oMain.tryToLoadSound(s_aSoundsInfo[i], true);
                            break;
                        }
                    }
                },
                onplayerror: function (szId) {
                    for (var i = 0; i < s_aSoundsInfo.length; i++) {
                        if (szId === s_aSounds[s_aSoundsInfo[i].ingamename]._sounds[0]._id) {
                            s_aSounds[s_aSoundsInfo[i].ingamename].once('unlock', function () {
                                s_aSounds[s_aSoundsInfo[i].ingamename].play();
                                if (s_aSoundsInfo[i].ingamename === "soundtrack" && s_oGame !== null) {
                                    setVolume("soundtrack", SOUNDTRACK_VOLUME_IN_GAME);
                                }

                            });
                            break;
                        }
                    }

                }
            });


        }, (bDelay ? 200 : 0));
    };

    this._loadImages = function () {
        s_oSpriteLibrary.init(this._onImagesLoaded, this._onAllImagesLoaded, this);

        s_oSpriteLibrary.addSprite("but_play", "../../puzzle/casino/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("msg_box", "../../puzzle/casino/sprites/msg_box.png");

        s_oSpriteLibrary.addSprite("bg_menu", "../../puzzle/casino/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("bg_game", "../../puzzle/casino/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("ctl_logo", "../../puzzle/casino/sprites/ctl_logo.png");
        s_oSpriteLibrary.addSprite("credits_panel", "../../puzzle/casino/sprites/credits_panel.png");
        s_oSpriteLibrary.addSprite("swipe_hand", "../../puzzle/casino/sprites/swipe_hand.png");

        s_oSpriteLibrary.addSprite("logo_game", "../../puzzle/casino/sprites/logo_game.png");
        s_oSpriteLibrary.addSprite("gui_panel", "../../puzzle/casino/sprites/gui_panel.png");
        s_oSpriteLibrary.addSprite("but_credits", "../../puzzle/casino/sprites/but_credits.png");
        s_oSpriteLibrary.addSprite("but_fullscreen", "../../puzzle/casino/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("but_exit", "../../puzzle/casino/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon", "../../puzzle/casino/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("but_yes", "../../puzzle/casino/sprites/but_yes.png");
        s_oSpriteLibrary.addSprite("but_no", "../../puzzle/casino/sprites/but_no.png");
        s_oSpriteLibrary.addSprite("but_spin", "../../puzzle/casino/sprites/but_spin.png");
        s_oSpriteLibrary.addSprite("but_plus", "../../puzzle/casino/sprites/but_plus.png");
        s_oSpriteLibrary.addSprite("bet_panel", "../../puzzle/casino/sprites/bet_panel.png");
        s_oSpriteLibrary.addSprite("credits_money_panel", "../../puzzle/casino/sprites/credits_money_panel.png");
        s_oSpriteLibrary.addSprite("win_panel", "../../puzzle/casino/sprites/win_panel.png");
        s_oSpriteLibrary.addSprite("leds", "../../puzzle/casino/sprites/leds.png");

        s_oSpriteLibrary.addSprite("but_long_text", "../../puzzle/casino/sprites/but_long_text.png");
        s_oSpriteLibrary.addSprite("arrow", "../../puzzle/casino/sprites/arrow.png");
        s_oSpriteLibrary.addSprite("wheel_shadow", "../../puzzle/casino/sprites/wheel_shadow.png");
        s_oSpriteLibrary.addSprite("wheel_back", "../../puzzle/casino/sprites/wheel_back.png");
        for (var i = 0; i < NUM_MONEY_BACKGROUNDS; i++) {
            s_oSpriteLibrary.addSprite("bg_" + i, "../../puzzle/casino/sprites/money_prize_images/bg_" + i + ".png");
        }

        s_oSpriteLibrary.addSprite("borderframe", "../../puzzle/casino/sprites/borderframe.png");

        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();
        s_oSpriteLibrary.loadSprites();
    };

    this._onImagesLoaded = function () {
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource / RESOURCE_TO_LOAD * 100);
        _oPreloader.refreshLoader(iPerc);
    };

    this._onRemovePreloader = function () {
        _oPreloader.unload();
        this.gotoMenu();

        new CWheel();
    };

    this._onAllImagesLoaded = function () {

    };

    this.gotoModeMenu = function () {
        _oMenu = new CModeMenu();
        _iState = STATE_MENU;
    };

    this.gotoMenu = function () {
        _oMenu = new CMenu();
        _iState = STATE_MENU;
    };

    this.gotoLoadingWheel = function () {
        _iState = STATE_LOADING_WHEEL;

        s_oLoadingPanel = new CLoadingPanel();
    };

    this.gotoGame = function () {
        _iState = STATE_GAME;

        _oGame = new CGame(_oData);

        $(s_oMain).trigger("game_start");
    };

    this.gotoHelp = function () {
        _oHelp = new CHelp();
        _iState = STATE_HELP;
    };

    this.stopUpdate = function () {
        _bUpdate = false;
        createjs.Ticker.paused = true;
        $("#block_game").css("display", "block");

        if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
            Howler.mute(true);
        }

    };

    this.startUpdate = function () {
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display", "none");

        if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
            if (s_bAudioActive) {
                Howler.mute(false);
            }
        }
    };

    this._update = function (event) {
        if (_bUpdate === false) {
            return;
        }
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;

        if (s_iCntTime >= 1000) {
            s_iCurFps = s_iCntFps;
            s_iCntTime -= 1000;
            s_iCntFps = 0;
        }

        switch (_iState) {
            case STATE_GAME: {
                _oGame.update();
                break;
            }
            case STATE_LOADING_WHEEL: {
                if (s_oLoadingPanel) {
                    s_oLoadingPanel.update();
                }
                break;
            }
        }

        if (s_oWheel !== null && !s_oWheel.isLoaded()) {
            s_oWheel.loading();
        }

        s_oStage.update(event);
    };

    s_oMain = this;

    _oData = oData;
    ENABLE_CREDITS = oData.show_credits;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    ENABLE_FULLSCREEN = oData.fullscreen;
    MAX_MULTIPLIER = oData.max_multiplier;
    MONEY_WHEEL_SETTINGS = oData.money_wheel_settings;
    INSTANT_WHEEL_SETTINGS = oData.instant_win_wheel_settings;

    NUM_MONEY_BACKGROUNDS = oData.total_money_backgrounds_in_folder;
    NUM_IMAGES_BACKGROUNDS = oData.total_images_backgrounds_in_folder;

    WHEEL_SPIN_TIME = oData.wheel_spin_time;

    s_bAudioActive = oData.audio_enable_on_startup;

    this.initContainer();
}
var s_bMobile;
var s_bEasyMode;
var s_bAudioActive = false;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;

var s_oDrawLayer;
var s_oStage;
var s_oMain;
var s_oSpriteLibrary;
var s_oCanvas;
var s_bFullscreen = false;
var s_oLoadingPanel = null;
var s_aSounds;
var s_aSoundsInfo;