<template>
    <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol class="carousel-indicators" >
                <li data-target="#carouselExampleIndicators" v-for="(item,inx) in slider.todetail" :key="inx" :data-slide-to="inx" :class="active(inx)">2</li>

            </ol>
            <div class="carousel-inner">
                <div v-for="(item,inx) in slider.todetail" :key="inx" class="carousel-item " :class="active(inx)">
                    <div class="carousel-caption animated fadeInDown  pt-5 " style="text-align: right; ">
                        <h5 style=" text-shadow: 2px 2px #242425; font-size: 35px;" class=" " v-html="item.name"></h5>
                        <a :href="item.text" type="button" class="btn btn-primary mt-4" >بیشتر بخوانید</a>
                    </div>
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
                default: null
            },
            id:{
                type:String,
                default:null

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
                        url:this.name,
                        id:this.id
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
    .carousel-item {
        text-align: right;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .carousel-caption {
        bottom: 220px;
    }

    .carousel-caption h5 {
        font-size: 45px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 25px;
    }

    .carousel-caption p {
        width: 75%;
        margin: auto;
        font-size: 18px;
        line-height: 1.9;
    }

    .navbar-light .navbar-brand {
        color: #fff;
        font-size: 25px;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .navbar-light .navbar-nav .active > .nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show > .nav-link {
        color: #fff;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #fff;
    }

    .navbar-toggler {
        background: #fff;
    }

    .navbar-nav {
        text-align: center;
    }

    .nav-link {
        padding: .2rem 1rem;
    }

    .nav-link.active,.nav-link:focus{
        color: #fff;
    }

    .navbar-toggler {
        padding: 1px 5px;
        font-size: 18px;
        line-height: 0.3;
    }

    .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
        color: #fff;
    }






    /* ignore the code below */


    .link-area
    {
        position:fixed;
        bottom:20px;
        left:20px;
        padding:15px;
        border-radius:40px;
        background:tomato;
    }
    .link-area a
    {
        text-decoration:none;
        color:#fff;
        font-size:25px;
    }
</style>