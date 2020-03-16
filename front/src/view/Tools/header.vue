<template>
    <div>
        <div class="bg-blueheader">
         <div class="row" dir="rtl">
             <div class="col-sm-4 col-xs-12" >
                 <h4  class="mytext" v-text="setting.wellcometext"></h4>
             </div>
             <div class="col-sm-4 myfitepageicon">
                 <span class=" icofont-video"></span>
                 <span class="  icofont-instagram"></span>
                 <span class="  icofont-telegram"></span>
             </div>
             <div class="col-sm-4">
                 <div class="vl"></div>
                 <div class="row">
                     <div class="col-sm-6 dateshow">     {{ $today }}</div>
                     <div class="col-sm-6"></div>
                 </div>
             </div>
         </div>
        </div>
        <div class="row" dir="rtl">
            <div class="col-sm-6 col-xs-12 row">
                <div class="col-sm-4 p-3">
                    <img height="70" :title="setting.webname" :src="$storage+'media/setting/'+setting.id+'/thump/'+setting.logo" :alt="setting.webname">
                </div>
                <div class="col-sm-8 p-3 text-right mytitleofwebsite">
                    <h2 v-text="setting.webname"></h2>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <ul class="nav  text-right mt-3"  >
                <template v-for="(item,index) in menu" >
                    <li class="nav-item"  v-if="item.children==null" :key="index">

                        <a class="nav-link text-black " :href="item.link" >
                            <span :class="item.icon"></span> | {{ item.name }}
                        </a>
                    </li>

                    <li class="nav-item dropdown" v-if="item.children!=null"  :key="index">

                        <a class="nav-link dropdown-toggle tiss-cursur" data-toggle="dropdown"   role="button" aria-haspopup="true" aria-expanded="false">
                            <span :class="item.icon"></span> | {{  item.name }}
                        </a>
                        <div class="dropdown-menu text-right">
                            <template v-for="(menu,inx) in item.children" >
                                <a :key="inx" class="dropdown-item text-black" :href="menu.link" >{{ menu.name }}</a>
                            </template>
                        </div>
                    </li>
                </template>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "header",
        data(){
            return{

                countbasket:5,
                productgroup:{},
                setting:{},
                show:false,
                menu:{
                    0:{
                        name:this.$t('home'),
                        link:'/',
                        icon:'icofont-home',
                        children:null
                    },
                    1:{
                        name:this.$t('schools'),
                        link:'/group/schools',
                        icon:'icofont-location-pin',
                        children:null
                    },
                    2:{
                        name:this.$t('blog'),
                        link:'/group/blog',
                        icon:'icofont-blogger',
                        children:null
                    },
                    3:{
                        name:this.$t('about'),
                        link:'',
                        icon:'icofont-info',
                        children:{
                            0:{
                                name:this.$t('aboutboss'),
                                link:'/blog/allavasani',
                                icon:'',
                            },
                            1:{
                                name:this.$t('aboutschool'),
                                link:'/blog/aboutschools',
                                icon:''
                            },
                            2:{
                                name:this.$t('aboottall'),
                                link:'/blog/abouttall',
                                icon:''
                            },

                        }
                    },
                    4:{
                        name:this.$t('contactus'),
                        link:'/contactus',
                        icon:'icofont-phone-circle',
                        children:null

                    }
                }
            }
        },
        components: {
/*
            'popper': Popper
*/
        },
        methods:{
            loadsetting(){
                let that=this;
                this.$axios.get(this.$url+'setting').then(function (res) {
                    that.setting=res.data;
                });

            },
            loadproductgroup(){
                let that=this;
                this.$axios.get(this.$url+'pgroup',{
                    params:{
                        parent:0
                    }
                }).then(function (res) {
                    that.productgroup=res.data;
                    that.show=true;
                })

            }
        },
        mounted() {
            this.loadsetting();
            this.loadproductgroup();
        }
    }
</script>

<style scoped>
   .bg-blueheader{
       min-height: 20px;
       width: 100%;
       background-color: #0153a5;

   }
    .mytext{
        font-size: 16px;
        color: #fff;
        padding: 5px;
        padding-top: 20px;
        padding-top: 20px;
    }
    .myfitepageicon span{
        color:#fff;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 45px;
        font-size: 20px;
        padding: 0px;
    }
    .myfitepageicon{
        background-image: url("/asset/icofont/lines.png");
        background-repeat: no-repeat;
        background-position: 120px 0px;
        padding-top: 15px;
    }
   .vl:after{
       background: url('/asset/icofont/lines.png')  0 0 scroll;
        width:20px;
       height: 100%;
       right: 0px;
       position: absolute;
   }
    .dateshow{
        padding-top: 15px;
        color:#fff;
        text-align: right;
        font-size: 14px;
        border-right: solid 1px #fff;

    }
    .mytitleofwebsite h2{
        font-size: 20px;
        padding-top: 20px;
        color: #113f69;

    }
    .bg-blueheader *{

    }
    .text-black{
        color:#333;
    }
</style>