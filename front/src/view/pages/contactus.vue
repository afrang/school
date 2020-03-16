<template>
    <div>
        <headers ></headers>
        <div class="container ">
            <div class="row  bordercontct" dir="rtl">
                <div class="col-sm-8 col-xs-12">
                    <address>
                        <div class="text-right">
                            <span class="icofont-location-pin"></span>
                            {{ contactus.address  }} <hr>
                        </div>
                        <div dir="ltr" class="mt-4">
                            <span class="icofont-phone-circle"></span> {{ contactus.phone }}
                            <hr>
                        </div>
                        <div dir="ltr" class="mt-1">
                            <span class="icofont-email"></span> {{ contactus.email }} <hr>
                        </div>
                        <div dir="ltr" class="mt-1">
                            <span class="icofont-telegram"></span> {{ contactus.telegram }} <hr>
                        </div>
                        <div dir="ltr" class="mt-1">
                            <span class="icofont-instagram"></span> {{ contactus.instagram }} <hr>
                        </div>
                    </address>
                </div>
                <div class="col-sm-4 col-xs-12 text-center pt-5">
                    <img height="70" :title="setting.webname" :src="$storage+'media/setting/'+setting.id+'/thump/'+setting.logo" :alt="setting.webname">

                </div>
                </div>
        </div>

        <foot></foot>
    </div>
</template>

<script>
    import Foot from "../Tools/foot";
    import headers from "../Tools/header";
    export default {
        name: "contactus",
        components: {headers, Foot},
        data(){
            return{
                contactus:null,
                setting:null
            }
        },
        methods:{

        },
        mounted() {
            let that=this;
            this.$axios.get(this.$url+'setting').then(function (res) {
                that.setting=res.data;
            });
            this.$axios.get(this.$url+'contactusapi').then(function (res) {
                that.contactus=res.data;
            });

        }
    }
</script>

<style scoped>
    .bordercontct{
        background: rgb(236,235,237);
        background: linear-gradient(-90deg, rgba(236,235,237,1) 0%, rgba(210,210,231,1) 44%, rgba(255,255,255,1) 100%);
        padding: 25px;
        border-top: solid 2px #333333;
        border-radius:20px 20px 0px 0px;

    }
</style>