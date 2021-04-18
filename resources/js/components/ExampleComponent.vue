<template>
    <div class="container">
        <div class="wrapper p-4 flex flex-row w-full">
            <div id="canvas" class="w-1/4">

            </div>
            <div class="debug w-3/4">
                <div class="w-100">
                    <input type="text" v-if="selectedAnimation" :value="selectedAnimation.name" readonly>
                </div>
                <div class="animation-buttons-wrapper flex flex-row flex-wrap">
                    <button  v-for="(animation,index) in animations" @click="setAnimation(animation)"
                             class="btn w-1/6 mx-1 my-2">{{animation.name}}</button>

                </div>

            </div>
        </div>
        <div class="p-4 flex flex-row w-full">
            <div class="w-1/2">
                <button class="btn w-1/6 my-2" @click="celebration">Celebration</button>
                <button class="btn w-1/6 my-2" @click="droppingBallon">Ballon</button>
            </div>
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
              animations : [],
              selectedAnimation : null,
          }
        },
        methods : {
            initCanvas(char = 'kyaru', model = '106031'){
                this.app = Object.seal(
                    new PIXI.Application({
                        width: 350,         // default: 800
                        height: 350,        // default: 600
                        antialias: true,    // default: false
                        backgroundAlpha: 0, // default: false
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
                //Setup Mixes
                this.setMixes();
                //Play Animation
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
                this.selectedAnimation = Object.seal(animation);
                this.doll.state.setAnimation(0,animation.name,true);
            },
            copyToClipBoard(text){

            },
            setMixes(){
                let mixes = [];
                for(let i = 0; i < this.animations.length; i++){
                    for(let j = 0; j < this.animations.length; j++){
                        if(!(j === i)){
                            this.doll.stateData.setMix(this.animations[i].name,this.animations[j].name, 0.1);
                            if(this.debug){
                                mixes.push({
                                    from : this.animations[i].name,
                                    to : this.animations[j].name,
                                });
                            }
                        }
                    }
                }
                if(this.debug){
                    console.log(mixes);
                }
            },
            //Animations Sequences
            celebration(){
                this.doll.state.setAnimation(0,'000000_mana_jump', false);
                this.doll.state.addAnimation(0,'000000_mana_jump',false,0);
                this.doll.state.addAnimation(0,'000000_mana_jump',false,0);
                this.doll.state.addAnimation(0,'000000_dear_smile', false,0);
                this.doll.state.addAnimation(0,'000000_dear_idol', true,0);
            },
            droppingBallon(){
                this.doll.state.setAnimation(0, '000000_balloon_flying_down', false);
                this.doll.state.addAnimation(0,'000000_balloon_in', false,0);
                this.doll.state.addAnimation(0,'000000_mana_jump',false,0);
                this.doll.state.addAnimation(0,'000000_mana_jump',false,0);
                this.doll.state.addAnimation(0,'000000_mana_jump',false,0);
                this.doll.state.addAnimation(0,'000000_dear_idol', false,0);
                this.doll.state.addAnimation(0,'000000_balloon_out', false,0);
                this.doll.state.addAnimation(0,'000000_balloon_flying_up', false,0);
            }
        },
        mounted() {
            //Init all
            this.initCanvas();
        }
    }
</script>
