function CMain(oData){
    var _bUpdate;
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    var _oData;
    
    var _oPreloader;
    var _oMenu;
    var _oGame;

    this.initContainer = function(){
        s_oCanvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(s_oCanvas);
        createjs.Touch.enable(s_oStage, true);
        s_oStage.preventSelection = false;
		
	s_bMobile = isMobile();
        if(s_bMobile === false){
            s_oStage.enableMouseOver(20);  
        }
		
        s_iPrevTime = new Date().getTime();

	createjs.Ticker.addEventListener("tick", this._update);
        createjs.Ticker.framerate = FPS;
        createjs.Ticker.timingMode = createjs.Ticker.RAF_SYNCHED;

        
        if(navigator.userAgent.match(/Windows Phone/i)){
                DISABLE_SOUND_MOBILE = true;
        }
        
        s_oSpriteLibrary  = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();
        
    };
    
    this.preloaderReady = function(){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
        
        this._loadImages();
        _bUpdate = true;
    };
    
    this.soundLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);
        _oPreloader.refreshLoader(iPerc);
    };
    
    this._initSounds = function(){
        Howler.mute(!s_bAudioActive);
        
        s_aSoundsInfo = new Array();
        s_aSoundsInfo.push({path: '../puzzle/piedra-papel/sounds/',filename:'throw',loop:false,volume:1, ingamename: 'throw'});
        s_aSoundsInfo.push({path: '../puzzle/piedra-papel/sounds/',filename:'click',loop:false,volume:1, ingamename: 'click'});
        s_aSoundsInfo.push({path: '../puzzle/piedra-papel/sounds/',filename:'round_won',loop:false,volume:1, ingamename: 'round_won'});
        s_aSoundsInfo.push({path: '../puzzle/piedra-papel/sounds/',filename:'round_lost',loop:false,volume:1, ingamename: 'round_lost'});
        s_aSoundsInfo.push({path: '../puzzle/piedra-papel/sounds/',filename:'soundtrack',loop:true,volume:1, ingamename: 'soundtrack'});
        
        RESOURCE_TO_LOAD += s_aSoundsInfo.length;

        s_aSounds = new Array();
        for(var i=0; i<s_aSoundsInfo.length; i++){
            this.tryToLoadSound(s_aSoundsInfo[i], false);
        }
    };

    this.tryToLoadSound = function(oSoundInfo, bDelay){
        
        setTimeout(function(){        
            s_aSounds[oSoundInfo.ingamename] = new Howl({ 
                                                            src: [oSoundInfo.path+oSoundInfo.filename+'.mp3'],
                                                            autoplay: false,
                                                            preload: true,
                                                            loop: oSoundInfo.loop, 
                                                            volume: oSoundInfo.volume,
                                                            onload: s_oMain.soundLoaded,
                                                            onloaderror: function(szId,szMsg){
                                                                                for(var i=0; i < s_aSoundsInfo.length; i++){
                                                                                     if ( szId === s_aSounds[s_aSoundsInfo[i].ingamename]._sounds[0]._id){
                                                                                         s_oMain.tryToLoadSound(s_aSoundsInfo[i], true);
                                                                                         break;
                                                                                     }
                                                                                }
                                                                        },
                                                            onplayerror: function(szId) {
                                                                for(var i=0; i < s_aSoundsInfo.length; i++){
                                                                                     if ( szId === s_aSounds[s_aSoundsInfo[i].ingamename]._sounds[0]._id){
                                                                                          s_aSounds[s_aSoundsInfo[i].ingamename].once('unlock', function() {
                                                                                            s_aSounds[s_aSoundsInfo[i].ingamename].play();
                                                                                            if(s_aSoundsInfo[i].ingamename === "soundtrack" && s_oGame !== null){
                                                                                                setVolume("soundtrack",SOUNDTRACK_VOLUME_IN_GAME);
                                                                                            }

                                                                                          });
                                                                                         break;
                                                                                     }
                                                                                 }
                                                                       
                                                            } 
                                                        });

            
        }, (bDelay ? 200 : 0) );
    };

    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

        s_oSpriteLibrary.addSprite("bg_menu", "../puzzle/piedra-papel/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("bg_game", "../puzzle/piedra-papel/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("but_exit", "../puzzle/piedra-papel/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon", "../puzzle/piedra-papel/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("but_play", "../puzzle/piedra-papel/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("but_home", "../puzzle/piedra-papel/sprites/but_home.png");
        s_oSpriteLibrary.addSprite("msg_box", "../puzzle/piedra-papel/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("but_credits", "../puzzle/piedra-papel/sprites/but_credits.png");
        s_oSpriteLibrary.addSprite("logo_ctl", "../puzzle/piedra-papel/sprites/logo_ctl.png");
        s_oSpriteLibrary.addSprite("but_fullscreen", "../puzzle/piedra-papel/sprites/but_fullscreen.png");
        s_oSpriteLibrary.addSprite("but_solo", "../puzzle/piedra-papel/sprites/but_solo.png");
        s_oSpriteLibrary.addSprite("but_multi", "../puzzle/piedra-papel/sprites/but_multi.png");
        s_oSpriteLibrary.addSprite("but_yes", "../puzzle/piedra-papel/sprites/but_yes.png");
        s_oSpriteLibrary.addSprite("but_left", "../puzzle/piedra-papel/sprites/arrow_left.png");
        s_oSpriteLibrary.addSprite("but_right", "../puzzle/piedra-papel/sprites/arrow_right.png");
        s_oSpriteLibrary.addSprite("but_no", "../puzzle/piedra-papel/sprites/but_no.png");
        s_oSpriteLibrary.addSprite("but_skip", "../puzzle/piedra-papel/sprites/but_nextgame.png");

        s_oSpriteLibrary.addSprite("box_p1", "../puzzle/piedra-papel/sprites/player1-box.png");
        s_oSpriteLibrary.addSprite("box_p2", "../puzzle/piedra-papel/sprites/player2-box.png");
        s_oSpriteLibrary.addSprite("box_record", "../puzzle/piedra-papel/sprites/record-box.png");
        s_oSpriteLibrary.addSprite("history_empty", "../puzzle/piedra-papel/sprites/match-count.png");
        s_oSpriteLibrary.addSprite("history_win", "../puzzle/piedra-papel/sprites/victory-count.png");
        s_oSpriteLibrary.addSprite("game_section", "../puzzle/piedra-papel/sprites/game-section.png");
        s_oSpriteLibrary.addSprite("help_panel", "../puzzle/piedra-papel/sprites/bg_help.png");
        s_oSpriteLibrary.addSprite("help_content", "../puzzle/piedra-papel/sprites/bg_help_content.png");
        
        s_oSpriteLibrary.addSprite("p1_0", "../puzzle/piedra-papel/sprites/p1-rock.png");
        s_oSpriteLibrary.addSprite("p1_1", "../puzzle/piedra-papel/sprites/p1-paper.png");
        s_oSpriteLibrary.addSprite("p1_2", "../puzzle/piedra-papel/sprites/p1-scissors.png");
        
        s_oSpriteLibrary.addSprite("p2_0", "../puzzle/piedra-papel/sprites/p2-rock.png");
        s_oSpriteLibrary.addSprite("p2_1", "../puzzle/piedra-papel/sprites/p2-paper.png");
        s_oSpriteLibrary.addSprite("p2_2", "../puzzle/piedra-papel/sprites/p2-scissors.png");
        
        s_oSpriteLibrary.addSprite("throw_0", "../puzzle/piedra-papel/sprites/rock-throw.png");
        s_oSpriteLibrary.addSprite("throw_1", "../puzzle/piedra-papel/sprites/paper-throw.png");
        s_oSpriteLibrary.addSprite("throw_2", "../puzzle/piedra-papel/sprites/scissors-throw.png");
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();
        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);
        //console.log("PERC: "+iPerc);
        _oPreloader.refreshLoader(iPerc);

    };
    
    this._onRemovePreloader = function(){
        try{
            saveItem("ls_available","ok");
        }catch(evt){
            // localStorage not defined
            s_bStorageAvailable = false;
        }

        _oPreloader.unload();

        s_oSoundTrack = playSound("soundtrack", 1,true);

        this.gotoMenu();
    };
    
    this._onAllImagesLoaded = function(){
        
    };
    
    this.onAllPreloaderImagesLoaded = function(){
        this._loadImages();
    };
    
    
    this.gotoMenu = function(){
        _oMenu = new CMenu();
        _iState = STATE_MENU;
    }; 
    
    this.gotoGame = function(){
        _oGame = new CGame(_oData);   						
        _iState = STATE_GAME;
    };

    this.stopUpdateNoBlock = function(){
        _bUpdate = false;
        createjs.Ticker.paused = true;
    };

    this.startUpdateNoBlock = function(){
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false; 
    };

    this.stopUpdate = function(){
        _bUpdate = false;
        createjs.Ticker.paused = true;
        $("#block_game").css("display","block");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            Howler.mute(true);
        }
        
    };

    this.startUpdate = function(){
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display","none");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            if(s_bAudioActive){
                Howler.mute(false);
            }
        }
        
    };
    
    this._update = function(event){
        if(_bUpdate === false){
                return;
        }
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;

        if ( s_iCntTime >= 1000 ){
            s_iCurFps = s_iCntFps;
            s_iCntTime-=1000;
            s_iCntFps = 0;
        }

        
        if(_iState === STATE_GAME){
            _oGame.update();
        }

        s_oStage.update(event);
       
    };
    
    s_oMain = this;
    
    _oData = oData;
    ENABLE_FULLSCREEN = oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    
    s_bAudioActive = oData.audio_enable_on_startup;
    
    this.initContainer();
}
var s_bMobile;
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
var s_oSoundTrack = null;
var s_oCanvas;
var s_bFullscreen = false;
var s_aSounds;
var s_aSoundsInfo;
var s_bStorageAvailable = true;
var s_iBestScore = 0;
