<template>
    <div>

        <headers></headers>
        <div class="container text-right" dir="rtl" v-if="article!=null">
            <nav aria-label="breadcrumb" dir="rtl">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><span class="icofont-home"></span></a></li>
                    <li  v-if="article.to_article.publish!=0"  class="breadcrumb-item"> <a :href="'/group/'+article.to_article.url" v-text="' '+article.to_article.name"></a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page"> {{ article.name }}</li>
                </ol>
            </nav>
            <h1 v-if="article.to_article.publish!=0"  class="titleblog">{{ article.name }}</h1>
            <hr>
            <div class="container" v-html="article.text"></div>
            <hr>
        </div>
        <foot></foot>

    </div>
</template>

<script>
   import headers from "../Tools/header";
    import foot from "../Tools/foot";
    export default {
        name: "blog",
        components: {
            foot,
            headers
        },
        data() {
            return {
                article:null
            }
        },
        methods:{
            loadarticle(){
                let that=this;
                this.$axios.get(this.$url+'blog/'+that.$route.params.url).then(function (res) {
                    that.article=res.data;
                })
            }
        },
        mounted() {
            this.loadarticle();

        }

    }
</script>

<style scoped>
    .titleblog{ font-size: 25px;}


</style>