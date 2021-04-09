<template>
    <div class="d-flex">
        <div id="canvas"></div>
        <div >
            <select  v-if="animations.length > 0" @change="setAnimation(animations[$event.target.value])">
                <option v-for="(animation,index) in animations" :value="index">[{{index}}]{{animation.name}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data (){
          return {
              app : null ,
              doll : null ,
              debug : true,
              animations : []
          }
        },
        methods : {
            initCanvas(char = 'kyaru', model = '106031'){
                this.app = Object.seal(
                    new PIXI.Application({
                        width: 800,         // default: 800
                        height: 600,        // default: 600
                        antialias: true,    // default: false
                        backgroundAlpha: 0.5, // default: false
                        resolution: 1       // default: 1
                    })
                );

                document.querySelector('#canvas').appendChild(this.app.view);
                if (this.debug){
                    this.app.loader.onProgress.add(this.loadProgressHandler);
                }

                this.app.loader
                    .add('doll',`cgi/${char}/${model}.json`)
                    .load(this.onAssetsLoaded);

            },
            onAssetsLoaded(loader, res){
                this.doll = Object.seal(
                    new PIXI.spine.Spine(
                        res.doll.spineData
                    )
                );

                this.animations = this.spineAnimations(this.doll);

                this.doll.skeleton.setToSetupPose();
                this.doll.update(0);

                let dollCage = new PIXI.Container();
                dollCage.addChild(this.doll);
                this.app.stage.addChild(dollCage);


                let localRect = this.doll.getLocalBounds();
                this.doll.position.set(-localRect.x, -localRect.y);

                let scale = Math.min(
                    (this.app.screen.width ) / (dollCage.width * 0.5),
                    (this.app.screen.height ) / (dollCage.height * 0.5),
                );

                dollCage.scale.set(scale, scale);
                dollCage.position.set(
                    (this.app.screen.width - dollCage.width) * 0.5,
                    (this.app.screen.height - dollCage.height) * 0.75,
                );

                this.doll.autoUpdate = true;
                this.setAnimation(this.animations[25])
                this.app.start();



            },
            loadProgressHandler(loader, resource) {
                console.log(`Loaded ${resource.name} | ${resource.url} => Progress ${ ((loader.progress) * 1).toFixed(2) } %`);
            },
            spineAnimations(spine){
                return Object.seal(spine.skeleton.data.animations);
            },
            setAnimation(animation){
                this.doll.state.setAnimation(0,animation.name,true);
            }

        },
        mounted() {
            // this.createCanvas();
            this.initCanvas();
        }
    }
</script>
