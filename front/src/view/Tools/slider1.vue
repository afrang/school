<template>
    <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol class="carousel-indicators" >
                <li data-target="#carouselExampleIndicators" v-for="(item,inx) in slider.todetail" :key="inx" :data-slide-to="inx" :class="active(inx)">2</li>

            </ol>
            <div class="carousel-inner">
                <div v-for="(item,inx) in slider.todetail" :key="inx" class="carousel-item " :class="active(inx)">
                    <img class="d-block w-100"  :style="{height: height}" :src="$storage+'media/gallery/'+item.id+'/orginal/'+item.file" alt="First slide">
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "slider1",
        props:{
            name:{
                type:String,

            },
            height:{
                type:String,
                default: '800px'

            }
        },
        data(){
            return{
                slider:{},
            }
        },
        methods:{
            active(inx){
                if(inx==0){
                    return 'active';
                }
            },
            loadslider(){
                let that=this;
                this.$axios.get(this.$url+'slider',{
                    params:{
                        url:this.name
                    }
                }).then(function (res) {
                    that.slider=res.data;
                })
            }
        },
        mounted() {
            this.loadslider();
        }
    }
</script>

<style scoped>

</style>