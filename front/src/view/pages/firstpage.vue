<template>
    <div v-if="firstpage!=null">
        <headers ></headers>
        <slider1 class="slider" height="200" :id="firstpage[3].image" ></slider1>
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 container text-center" dir="rtl">
                        <blockquote  style="margin-top: -20px;" >
                            <div v-html="firstpage[18].text"></div>
                            <span class="author"><i v-text="firstpage[20].text">Lorem ipsum</i></span>
                        </blockquote>
                    </div>
                    <div class="col-sm-4 col-xs-12" >
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row" dir="rtl">
                <div class="col-sm-2">
                    <div dir="rtl" v-html="schools.text"></div>
                </div>

            <div class="col-sm-6">
                <ul class="schooltems" >
                    <li class="animated  fadeInDown" v-for="(item,inx) in schools.to_articles" :key="inx" @mouseenter="changepic(inx)" >
                        <a :href="'/blog/'+item.url" v-text="item.name"></a>
                    </li>
                </ul>
            </div>
                <div content="col-sm-2">
                    <img v-if='imgschools!=null' class="img-thumbnail w-100" :src="imgschools">
                </div>
            </div>

        </div>

        <hr>
        <div class="newsbar pb-4">
            <div class="text-center">
                <h5 v-text="'جدید اخبار'"></h5>
                <hr>
                <div >
                    <div class="container">
                        <VueSlickCarousel v-bind="settings" :arrows="true" :dots="true">

                            <div v-for="(item,inx) in news.to_articles"  :key="inx" class="card m-4" style="width: 100%;">
                                <img class="card-img-top" :src="$storage+'media/Articles/'+item.id+'/thump.png'" :alt="item.name">
                                <div class="card-body">
                                    <h5 class="card-title" v-text="item.name"></h5>
                                </div>

                                <div class="card-body">
                                    <a :href="'/blog/'+item.url" class="card-link" >بیشتر بخوانید</a>
                                </div>
                            </div>

                        </VueSlickCarousel>
                    </div>
                </div>
            </div>
        </div>
        <div class="abouttexrt" v-bind:style="{
               backgroundImage:'url('+$storage+'media/firspage/'+firstpage[0].id+'/orginal/'+firstpage[0].image+')'
        }"
        >
            <h4 class="author mt-4 text-center text-blue" v-text="firstpage[21].text"></h4>

        </div>
        <div class="m-4">
            <div class="box" dir="rtl">
                <div class="content">
                    <p v-html="firstpage[24].text" ></p>            </div>
            </div>
        </div>
        <foot></foot>

    </div>
</template>

<script>
    import headers from "../Tools/header";
    import slider1 from "../Tools/slider1";
    import foot from "../Tools/foot";
    import { VueFlux, Transitions } from 'vue-flux';
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

    import VueSlickCarousel from 'vue-slick-carousel'
    export default {
        name: "firstpage",
        components:{
            slider1,
            headers,
            foot,
            VueSlickCarousel
        },
        head:{
            title: {
                inner: '',
                separator: '',
                complement: ''
            },
        },
       data(){
            return {
                setting: {

                },
                firstpage:null,
                schools:null,
                imgschools:null,
                fgf:'fg',
                news:null,
                settings: {
                    "dots": true,
                    "focusOnSelect": true,
                    "infinite": true,
                    "speed": 500,
                    "slidesToShow": 3,
                    "slidesToScroll": 3,
                    "touchThreshold": 5
                }

            }
        },
        computed:{


        },
        methods:{
            changepic(inx){
              let myschool=this.schools.to_articles[inx].id;
              this.imgschools=this.$storage+'media/Articles/'+myschool+'/thump.png';

            },
            loadsetting(){
                let that=this;
                this.$axios.get(this.$url+'setting').then(function (res) {
                        that.setting=res.data;
                })

            },
            getAsyncData: function () {
                var self = this
                self.title = 'My async title'
                self.$emit('updateHead');
            },
            loadfirstpage(){
                let that=this;
                this.$axios.get(this.$url+'firstpage').then(function (res) {
                    that.firstpage=res.data;


                });
            },

       },

        beforeCreate: function () {
                let that=this;
                this.$axios.get(this.$url+'setting').then(function (res) {
                    that.firstpage=res.data;


                });
            this.$axios.get(this.$url+'bloggroup/schools').then(function (res) {
                that.schools=res.data;
                that.imgschools=that.$storage+'media/BlogGroup/2/thump.png';

            });
            this.$axios.get(this.$url+'blog/news').then(function (res) {
                that.news=res.data;

            });



        },
        created() {
            let self=this;
            this.$on('okHead', function () {
                self.title = 'My async title'
                self.$emit('updateHead')
            });
        },
        mounted() {
            this.loadfirstpage();
            this.$axios.get(this.$url+'setting').then(function (res) {
                that.setting=res.data;
                that.getAsyncData();

            });
        }
    }
</script>

<style lang="scss" scoped >
    .box
    {
        width: 100%;
        margin: 0 auto;
        padding: 2px;
        background-color: #eaab00; /* gold */
        /* Single pixel data uri image http://jsfiddle.net/LPxrT/
        /* background-image: gold, gold, white */
        background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAOqrAP///yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=='),  url('data:image/gif;base64,R0lGODlhAQABAPAAAOqrAP///yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=='),
        url('data:image/gif;base64,R0lGODlhAQABAPAAAP///////yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==');
        background-repeat: no-repeat;
        background-size: 0 2px, 0 100%, 0% 2px;
        background-position: top center, top center, bottom center;

    }
    .box:hover{
        -webkit-animation: drawBorderFromCenter 4s;

    }

    /* Chrome, Safari, Opera */
    @-webkit-keyframes drawBorderFromCenter {
        0% {
            background-size: 0 2px, 0 0, 100% 100%;
        }
        20% {
            background-size: 100% 2px, 100% 0, 100% 100%;
        }
        66%
        {
            background-size: 100% 2px, 100% 98%, 100% 100%;
        }
        99%
        {
            background-size: 100% 2px, 100% 98%, 0 2px;
        }
    }



    .content
    {
        background: white;
        padding: 2em;
        text-align: center;
        text-transform: uppercase;
    }

    .abouttexrt{
        height: 300px;
        background-attachment: fixed;
    }
.newsbar{
    background-color: #cecece;
}
.newsbar h5{
    color: #214b89;;
    font-size: 32px;
    font-weight: bold;
    padding-top: 20px;
    padding-bottom: 10px;

}
.bg-yellow{
    background-color:yellow ;
}
blockquote {
    position: relative;
    display: inline-block;
    background: #eee;
    padding: 40px 30px 30px 60px;
    border-radius: 10px;
    color: #333;
    text-align: right;

    box-shadow: 1px 1px 1px #999,
    2px 2px 1px #999,
    3px 3px 1px #999;
    transition-duration: .3s;

    span.author {
        position: relative;
        display: block;
        text-align: right;
        margin-top: 5px;
        color: #999;

        i {
            position: relative;
            background: #eee;
            padding-left: 5px;
            font-style: italic;
            z-index: 5;
        }

        &::before {
            display: block;
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: #ccc;
            z-index: 1;
        }
    }

    &:hover {
        box-shadow: 1px 1px 5px #999,
        2px 2px 6px #999,
        3px 3px 7px #999;
    }

    &::before {
        display: block;
        position: absolute;
        top: 10px;
        left: 10px;
        content: "\"";
        font-family: 'Bitter', serif;
        font-size: 120px;
        color: #999
    }
}
.schooltems{
    text-align: right;
}
    .schooltems li{
        list-style: none;
        line-height: 22px;
    }
    .schooltems li:before{
        content: ' ○ ';
        color:lightseagreen;;
        font-size: 25px;
    }
    .schooltems li a{
        color: #333;
    }
    .schooltems li a:hover{
        list-style: none;
        font-weight: bold;;
        text-decoration: none;
    }
    .text-blue{
        color: #f9f9ff;
        padding-top: 100px;
        font-size: 45px;
        text-shadow: 0 1px 0 #CCCCCC, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);    }
</style>