<template>
    <div>
        <headers></headers>
        <slider1 class="myslider" :name="'topslider'"></slider1>
        <div class="bg-yellow">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-xs-12" >
                        <vue-flux
                                :options="fluxOptions"
                                :images="fluxImages"
                                :transitions="fluxTransitions"
                                ref="slider">
                        </vue-flux>


                    </div>
                    <div class="col-sm-4 col-xs-12" >
                        111111111111111111111111
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import headers from "../Tools/header";
    import slider1 from "../Tools/slider1";
    import { VueFlux, Transitions } from 'vue-flux';



    export default {
        name: "firstpage",
        components:{
            slider1,
            headers,
            'vue-flux': VueFlux

        },
        data: () => ({
            fluxOptions: {
                autoplay: true
            },
            fluxImages: [
                'URL1',
                'URL2',
                'URL3'
            ],
            fluxTransitions: {
                transitionTurn3d: Transitions.transitionTurn3d
            }
        })
    }
</script>

<style scoped>

.bg-yellow{
    background-color:yellow ;
}
</style>