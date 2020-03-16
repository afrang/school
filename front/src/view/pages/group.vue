<template>
    <div>
        <headers></headers>
        <hr>

        <div class="container" dir="rtl" v-if="artilce!=null">
            <h1 class="text-right">{{ artilce.name }}</h1>
            <hr>

            <div dir="rtl">
                <div class="text-right" v-html="artilce.text"></div>
            </div>
            <div class="row">
           <div v-for="(item,index) in artilce.to_articles" :key="index" class="card col-sm-4 colxs-12 pb-4" style="width: 18rem;">
                    <img v-if="item.image!=null" class="card-img-top" height="200" :src="$storage+'media/Articles/'+item.id+'/thump.png'" alt="Card image cap">
                    <img v-if="item.image==null" class="card-img-top" height="200" :src="$storage+'media/Other/noimage.png'" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-center" style="height: 70px;  font-size: 20px;" v-text="item.name"></h5>
                        <a :href="'/blog/'+item.url" class="btn btn-primary ">بیشتر بخوانید</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <foot></foot>


    </div>
</template>

<script>
    import headers from "../Tools/header";
   import foot from "../Tools/foot";

    export default {
        name: "group",
        components:{
            headers,foot
        },
        data(){
            return{
                artilce:null
            }
        },
        methods:{
            loadgroup(){
                let that=this;
                this.$axios.get(this.$url+'bloggroup/'+that.$route.params.url).then(function (res) {
                    that.artilce=res.data;
                })
            }
        },
        mounted() {
            this.loadgroup();

        }
    }
</script>

<style scoped>

</style>