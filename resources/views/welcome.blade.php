<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset(mix('css/app.css'))}}">
        <link rel="stylesheet" href="http://esotericsoftware.com/files/spine-player/3.8/spine-player.css">
        <script src="http://esotericsoftware.com/files/spine-player/3.8/spine-player.js"></script>
    </head>
    <body>

{{--    <div id="player-container" style="width: 640px; height: 480px;"></div>--}}
{{--    <script>--}}
{{--        new spine.SpinePlayer("player-container", {--}}
{{--            jsonUrl: "cgi/kyaru/106031.json",--}}
{{--            atlasUrl: "cgi/kyaru/106031.atlas",--}}
{{--        });--}}
{{--    </script>--}}
      <div id="app">
          <example-component></example-component>
      </div>
    </body>

    <script src="{{asset(mix('js/app.js'))}}"></script>



{{--    <script src="js/pixi.js"></script>--}}
{{--    <script src="js/pixi-spine.js"></script>--}}

{{--<script>--}}
{{--    const app =  new PIXI.Application({--}}
{{--            width: 800,         // default: 800--}}
{{--            height: 600,        // default: 600--}}
{{--            antialias: true,    // default: false--}}
{{--            backgroundAlpha: 0.5, // default: false--}}
{{--            resolution: 1       // default: 1--}}
{{--        });--}}
{{--    document.body.appendChild(app.view);--}}

{{--    app.stop();--}}

{{--    // load spine data--}}
{{--    app.loader--}}
{{--        .add('doll', 'cgi/kyaru/106031.json')--}}
{{--        .load(onAssetsLoaded);--}}
{{--    console.log(app.loader);--}}

{{--    function onAssetsLoaded(loader, res) {--}}
{{--        console.log(res)--}}
{{--        // instantiate the spine animation--}}
{{--        dragon = new PIXI.spine.Spine(res.doll.spineData);--}}
{{--        dragon.skeleton.setToSetupPose();--}}
{{--        dragon.update(0);--}}
{{--        dragon.autoUpdate = false;--}}

{{--        // create a container for the spine animation and add the animation to it--}}
{{--        const dragonCage = new PIXI.Container();--}}
{{--        dragonCage.addChild(dragon);--}}

{{--        // measure the spine animation and position it inside its container to align it to the origin--}}
{{--        const localRect = dragon.getLocalBounds();--}}
{{--        dragon.position.set(-localRect.x, -localRect.y);--}}

{{--        // now we can scale, position and rotate the container as any other display object--}}
{{--        const scale = Math.min(--}}
{{--            (app.screen.width ) / (dragonCage.width* 0.5),--}}
{{--            (app.screen.height ) / (dragonCage.height* 0.5),--}}
{{--        );--}}
{{--        dragonCage.scale.set(scale, scale);--}}
{{--        dragonCage.position.set(--}}
{{--            (app.screen.width - dragonCage.width) * 0.5,--}}
{{--            (app.screen.height - dragonCage.height) * 0.5,--}}
{{--        );--}}

{{--        // add the container to the stage--}}
{{--        app.stage.addChild(dragonCage);--}}

{{--        // once position and scaled, set the animation to play--}}
{{--        dragon.state.setAnimation(0, '07_idle', true);--}}

{{--        app.start();--}}
{{--    }--}}

{{--    app.ticker.add(() => {--}}
{{--        // update the spine animation, only needed if dragon.autoupdate is set to false--}}
{{--        dragon.update(1/80); // HARDCODED FRAMERATE!--}}
{{--    });--}}

{{--</script>--}}
</html>
