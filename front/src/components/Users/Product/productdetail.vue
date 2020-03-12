<template>
    <div class="container pt-4">
       <div class="wmaster text-right" dir="rtl">
           <h4 v-text="$t('product')"></h4>
           <hr>
           <a @click="add" class="btn btn-success icofont-ui-add p-3 text-white"></a>
           <a @click="listproduct()" class="btn btn-success icofont-listing-box  mr-4 p-3 text-white"></a>
           <hr>
           <p @click="listgroup"  v-text="mode"></p>

           <template v-if="mode=='list'">

               <table class="table  table-striped">

                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col" v-text="$t('name')"></th>
                       <th scope="col" v-text="$t('group')"></th>
                       <th  class="text-center" scope="col" v-text="$t('action')"></th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr v-for="(item,index) in listitems.data"  :key="index">
                       <th scope="row" v-text="index+1"></th>
                       <td v-text="item.name"></td>
                       <td v-text="item.group"></td>
                       <td class="text-center" >
                           <button  @click="edit(item.id)" class="btn btn-success icofont-ui-edit"></button>
                           <button  @click="del(item.id)" class="btn btn-danger mr-2 icofont-ui-delete"></button>
                       </td>
                   </tr>

                   </tbody>
               </table>
           </template>
           <template v-if="mode=='edit'">

               <form @submit.prevent="save" class="row">

                   <div class="form-group col-sm-6 col-xs-12">
                       <label  v-text="$t('name')"></label>
                       <input @keyup="urlcreate" type="text" v-model="product.name" class="form-control" :placeholder="$t('name')">
                       <small  class="form-text text-muted"></small>
                   </div>
                   <div class="form-group col-sm-6 col-xs-12">
                       <label v-text="$t('url')"></label>
                       <input   type="text" v-model="product.url" class="form-control"  :placeholder="$t('url')">
                       <small  class="form-text text-muted"></small>
                   </div>
                   <div class="form-group col-sm-6 col-xs-12" v-if="product.id==null">
                       <label v-text="$t('group')"></label>
                       <select v-model="product.parent" class="form-control">
                           <template v-for="(item,index) in group" >
                               <option  v-if="item.to_sub.length==0" :key="index" :value="item.id" v-text="item.name"></option>
                               <optgroup   v-if="item.to_sub.length!=0"  :key="index"  :label="item.name">
                                   <option v-for="(items,index2) in item.to_sub" :key="index2"  :value="items.id" v-text="items.name"></option>
                               </optgroup>

                           </template>

                       </select>
                       <small  class="form-text text-muted"></small>
                   </div>
                   <div class="container" v-if="product.id!=null">
                       <br>
                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item">
                               <a class="nav-link active" data-toggle="tab" href="#home" v-text="$t('specifications')" ></a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#menu1"  v-text="$t('images')" ></a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#menu2"   v-text="$t('PricingFeature')"></a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#menu3"   v-text="$t('Attribute')"></a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#review"   v-text="$t('description')"></a>
                           </li>
                       </ul>

                       <!-- Tab panes -->
                       <div class="tab-content ">
                           <div id="home" class="container tab-pane active pb-5"><br>
                               <h3 v-text="$t('specifications')"></h3>
                               <div class="row">
                               <div class="form-group col-sm-6 col-xs-12">
                                   <label v-text="$t('title')"></label>
                                   <input   type="text" v-model="product.title" class="form-control"  :placeholder="$t('title')">
                                   <small  class="form-text text-muted"></small>
                               </div>
                               <div class="form-group col-sm-6 col-xs-12">
                                   <label v-text="$t('model')"></label>
                                   <input   type="text" v-model="product.model" class="form-control"  :placeholder="$t('model')">
                                   <small  class="form-text text-muted"></small>
                               </div>

                                   <div class="form-group col-sm-6 col-xs-12">
                                       <label v-text="$t('status')"></label>
                                       <select class="form-control" v-model="product.status">
                                           <option v-for="(item,index) in status" :key="index" :value="index" v-text="item"></option>
                                       </select>
                                       <small  class="form-text text-muted"></small>
                                   </div>

                                   <div class="form-group col-sm-6 col-xs-12">
                                       <label v-text="$t('special')"></label>
                                       <select class="form-control" v-model="product.special">
                                           <option v-for="(item,index) in special" :key="index" :value="index" v-text="item"></option>
                                       </select>
                                       <small  class="form-text text-muted"></small>
                                   </div>
                                   <div class="form-group col-sm-6 col-xs-12">
                                       <label v-text="$t('discount')"></label>
                                       <select class="form-control" v-model="product.special">
                                           <option v-for="(item,index) in booleanarray" :key="index" :value="index" v-text="item"></option>
                                       </select>
                                       <small  class="form-text text-muted"></small>
                                   </div>
                                   <div class="form-group col-sm-6 col-xs-12">
                                       <label v-text="$t('expressdelivery')"></label>
                                       <select class="form-control" v-model="product.expressdelivery">
                                           <option v-for="(item,index) in booleanarray" :key="index" :value="index" v-text="item"></option>
                                       </select>
                                       <small  class="form-text text-muted"></small>
                                   </div>

                                   <div class="form-group col-sm-12 col-xs-12">

                                   <h3 v-text="$t('abstract')"></h3>
                                   <p>
                                       <tisseditor  :key="1"  :text="product.morecomment" v-on:myevent="morecommentedit"   :mode="'Product'"></tisseditor>
                                   </p>
                                   </div>
                               </div>
                               </div>
                           <div id="menu1" class="container tab-pane fade"><br>
                               <h3  @click="loadimage" v-text="$t('images')"></h3>
                               <div class="row">
                                   <div class="col-sm-3">
                                       <file-uploader
                                               :key="1"
                                               mode="Product"
                                               v-on:filename="addpicture"
                                               :id='product.id'
                                               :showthump="false"
                                               name="random"
                                               :deletefile="false"
                                               :file="group.thump"
                                       ></file-uploader>
                                   </div>
                                   <div class="col-sm-8 pb-5 ">
                                        <div class="row">
                                            <div  v-for="(item,index) in imagelist" :key="index" class="col-sm-4  mt-2 col-xs-12">
                                                <div class="card"  >
                                                    <img class="card-img-top" :src="$storage+'media/Product/'+product.id+'/thump/'+item.file" alt="Card image cap">
                                                    <div class="card-body">
                                                        <a @click="delimage(item.id)" class="btn btn-primary icofont-2x icofont-ui-delete" ></a> |
                                                        <a v-if="item.master==0" @click="masterimg(item.id)" :title="$t('masteriamge')" class=" btn btn-danger  icofont-2x icofont-toggle-off"></a>
                                                        <a   v-if="item.master==1"   :title="$t('masteriamge')" class=" btn btn-primary  icofont-2x icofont-toggle-on"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                               </div>
                               <p>

                               </p>
                           </div>

                           <div id="menu2" class="container tab-pane fade"><br>
                               <h3 v-text="$t('fatureandprice')"></h3>
                               <label v-text="$t('price')"></label>
                               <money dir="ltr"  class="form-control" v-model="price" v-bind="money"></money>
                               <label v-text="$t('pricediscount')"></label>
                               <money dir="ltr"  class="form-control" v-model="discount" v-bind="money"></money>
                               <input type="button" class="btn btn-primary mt-4" @click="newpricesubmit" :value="$t('save')">

                               <hr>
                               <div class="container">
                                   <h4 v-text="$t('baseprice')"></h4>
                                   <div v-for="(item,index) in product.to_group.to_attr" :key="index" class="form-group col-sm-12 col-xs-12">
                                       <label>{{ item.name }}</label>
                                       <template v-if="item.mode==1">
                                       <input @blur="textfea(item.id)" v-model="attr[item.id]" :ref="'fate'+item.id" class="form-control" type="text" >
                                   </template>
                                       <template v-if="item.mode==2">
                                           <input @blur="textfea(item.id)" v-model="attr[item.id]" :ref="'attr'+item.id" class="form-control" type="number" min="1" >
                                       </template>
                                       <template v-if="item.mode==3">
                                           <select  @blur="textfea(item.id)" v-model="attr[item.id]" :ref="'attr'+item.id" class="form-control" >
                                               <option value="1" v-text="$t('yes')"></option>
                                               <option value="0" v-text="$t('no')"></option>
                                           </select>
                                       </template>
                                       <template v-if="item.mode==4">
                                           <div :ref="'attr'+item.id" >
                                               <template v-for="(opt,inx) in item.to_options"   >
                                                   <div   :key="inx">
                                                       <div class="row">
                                                       <div class="col-sm-6 col-xs-12">
                                                           <div class="mychecker" dir="rtl">
                                                               <label>
                                                                   <input   :ref="'opt'+opt.id" v-model="optionattr[opt.id]"    :value="opt.id"  type="checkbox"  >
                                                                   <span class="checkmark"></span>
                                                                   <span v-text="opt.name"></span></label>
                                                           </div>
                                                           <input type="button" class="btn btn-primary" :value="$t('save')">
                                                       </div>
                                                       <div class="col-sm-6 col-xs-12">
                                                           <label v-text="$t('price')"></label>
                                                           <money dir="ltr"  class="form-control"  v-bind="money"></money>
                                                           <label v-text="$t('pricediscount')"></label>
                                                           <money dir="ltr"  class="form-control"  v-bind="money"></money>

                                                       </div>
                                                   </div>
                                                   <hr>
                                                   </div>



                                               </template>
                                           </div>
                                       </template>
                                       <hr>
                                   </div>

                                   </div>
                           </div>
                           <div id="menu3" class="container tab-pane fade"><br>
                               <h3 v-text="$t('feature')"></h3>
                               <hr>
                               <div class="container">
                                   <div v-for="(item,index) in product.to_group.to_feature" :key="index" class="form-group col-sm-12 col-xs-12">
                                       <label>{{ item.name }}</label>
                                       <template v-if="item.mode==1">
                                           <input @blur="textattr(item.id)" v-model="attr[item.id]" :ref="'attr'+item.id" class="form-control" type="text" >
                                       </template>
                                       <template v-if="item.mode==2">
                                           <input @blur="textattr(item.id)" v-model="attr[item.id]" :ref="'attr'+item.id" class="form-control" type="number" min="1" >
                                       </template>
                                       <template v-if="item.mode==3">
                                           <select  @blur="textattr(item.id)" v-model="attr[item.id]" :ref="'attr'+item.id" class="form-control" >
                                               <option value="1" v-text="$t('yes')"></option>
                                               <option value="0" v-text="$t('no')"></option>
                                           </select>
                                       </template>
                                       <template v-if="item.mode==4">
                                           <div :ref="'attr'+item.id" >
                                               <pre>{{ attr[item.id] }}</pre>
                                               <div v-for="(opt,inx) in item.to_options" :key="inx" class="mychecker" dir="rtl">
                                                   <label>
                                                       <input   :ref="'opt'+opt.id" v-model="optionsattr[opt.id]"  @change="clickoptattr(opt.id,item.id)"   :value="opt.id"  type="checkbox"  >
                                                       <span class="checkmark"></span>

                                                       <span v-text="opt.name"></span></label>
                                               </div>
                                           </div>
                                       </template>
                                       <hr>
                                   </div>

                               </div>
                           </div>
                           <div id="review" class="container tab-pane fade"><br>

                               <h3 v-text="$t('review')"></h3>
                               <p>
                                   <tisseditor :key="2" :text="product.review" v-on:myevent="reviewedit"   :mode="'Product'"></tisseditor>
                               </p>
                               <h3 v-text="$t('description')"></h3>
                               <p>
                                   <tisseditor   :key="1"  :text="product.description" v-on:myevent="descriptionedit"   :mode="'Product'"></tisseditor>
                               </p>
                               <h3 v-text="$t('help')"></h3>
                               <p>
                                   <tisseditor  :key="4"  :text="product.help" v-on:myevent="helpedit"   :mode="'Product'"></tisseditor>
                               </p>
                           </div>

                       </div>
                   </div>
                   <div class="col-sm-12">
                       <input type="submit" class="btn btn-primary" :value="$t('save')">
                   </div>
               </form>

           </template>
       </div>
        <showerror :errors="error"></showerror>
    </div>
</template>

<script>
    import Showerror from "../../Custom/Showerror";
    import Tisseditor from "../../Custom/Tisseditor";
    import FileUploader from "../../Custom/FileUploader";
    import {Money} from 'v-money';

    export default {
        name: "productdetail.vue",
        components:{
            Showerror,
            Tisseditor,
            FileUploader,
            Money
        },
        data() {
            return {
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: '',
                    suffix: '',
                    precision: 0,
                    masked: false
                },
                price:0,
                discount:0,
                mode:'edit',
                group:[],
                attr:[],
                fea:[],
                optionsfea:[],
                optionattr:[],
                error:null,
                listitems:[],
                optionsattr:[],
                imagelist:[],
                product:{
                    id:null,
                    name:null,
                    url:null,
                    parent:null
                },
                status:{
                    0:this.$t('inactive'),
                    1:this.$t('active'),
                    2:this.$t('unavailable'),
                },
                special:{
                    0:this.$t('normal'),
                    1:this.$t('special'),

                },
                booleanarray:{
                    0:this.$t('no'),
                    1:this.$t('yes'),

                }

            }
        },
        computed:{

        },
        watch: {
            product:function (data) {
                let that=this;
                    data.to_attr.filter(function (attr) {
                        if(attr.value=='options'){
                            attr.to_option_value.filter(function (opt){
                                that.optionsattr[opt.attr]=opt.value;
                            });
                        }else{
                            that.attr[attr.attr]=attr.value;
                        }


                    })



            }
        },

        methods:{
            newpricesubmit(){
                let data={
                    id:this.product.id,
                    price:this.price,
                    discount:this.discount
                };
                console.log(data);
                this.$axios.post(this.$url+'user/pprice',data, {
                    headers: {
                        Authorization: localStorage.token
                    }
                });
            },
            // Attr Controller

            clickoptattr(id,parent){

                let data={
                    attr:parent,
                    options:id,
                    product:this.product.id
                };

               if(this.$refs['opt'+id][0]['checked']==true){
                    data.value=1;
                }else{
                   data.value=0;
               }

                this.$axios.post(this.$url+'user/popt',data, {
                    headers: {
                        Authorization: localStorage.token
                    }
                });
            },
            checkboxattr(id){
                console.log(this.attr[id]);
              /*  this.$refs['attr'+id][0]['children'].map(function (m) {
                    console.log(m);
                })*/
            },
            textfea(id){

        /*        let data={
                    id:id,
                    product:this.product.id,
                    value:this.$refs['attr'+id][0]['value']
                }
                this.$axios.post(this.$url+'user/pattr',data, {
                    headers: {
                        Authorization: localStorage.token
                    }
                });*/
            },
            textattr(id){

                    let data={
                        id:id,
                        product:this.product.id,
                        value:this.$refs['attr'+id][0]['value']
                    }
                this.$axios.post(this.$url+'user/pattr',data, {
                    headers: {
                        Authorization: localStorage.token
                    }
                });
            },
            // End Attr Controller
            addpicture(e){
             let that=this;
             let data={
                 product:this.product.id,
                 image:e
             }
             this.$axios.post(this.$url+'user/pimage',data,{
                 headers: {
                     Authorization:localStorage.token
                 }
             }).then(function(res){
                that.loadimage();
             })
            },
            masterimg(id){
                let that=this;
                let data={

                };
                this.$axios.put(this.$url+'user/pimage/'+id,data,
                    {
                        headers:{
                            Authorization:localStorage.token
                        }
                    }).then(function (response) {
                    that.loadimage();

                });

            },
            delimage(id){
                let that=this;
              this.$axios.delete(this.$url+'user/pimage/'+id,{
                  headers:{
                      Authorization:localStorage.token

                  }
              }).then(function(res){
                  that.loadimage();
              });
            },
            loadimage(){
                let that=this;

                this.$axios.get(this.$url+'user/pimage',{
                    params:{
                      id:that.product.id
                    },
                    headers: {
                        Authorization:localStorage.token
                    }
                }).then(function(res){
                    that.imagelist=res.data;
                })
            },
            reviewedit(e){
                this.product.review=e;
            },
            morecommentedit(e){
                this.product.morecomment=e;
            },
            descriptionedit(e){
                this.product.description=e;
            },
            helpedit(e){
                this.product.help=e;
            },
            urlcreate(){
                if(this.product.id==null){
                    let str=this.product.name;
                    this.product.url=str.replace(/#| /g,'_');

                };
            },
            save(){
                let that=this;
                if(this.product.id==null){
                    this.$axios.post(this.$url+'user/pdetail',this.product,{
                        headers: {
                            Authorization:localStorage.token
                        }
                    }).then(function(res){
                        that.product=res.data;
                    })
                        .catch((error) => {
                            that.error = error.response.data.errors;

                        });
                }else{

                }
                if(this.product.id!=null){
                    this.$axios.put(this.$url+'user/pdetail/'+this.product.id,this.product,{
                        headers: {
                            Authorization:localStorage.token
                        }
                    }).then(function(res){
                        that.$swal.fire(that.$t('Saved'));
                    })
                        .catch((error) => {
                            that.error = error.response.data.errors;

                        });
                }

            },
            resetform(){
                this.product={
                    id:null,
                        name:null,
                        url:null,
                        parent:null
                }
            },
            add(){
                this.resetform();
                this.mode='edit';

            },
            edit(id){
                let that=this;
                this.$axios.get(this.$url+'user/pdetail/'+id,{
                    headers: {
                        Authorization:localStorage.token
                    }

                }).then(function(res){
                    that.product=res.data;
                    that.imagelist=res.data.to_image;
                    that.mode='edit';
                 /**/
                });
            },
            listgroup(){

                let that=this;
                this.$axios.get(this.$url+'user/pgroup/create',{

                    headers: {
                        Authorization:localStorage.token
                    }
                }).then(function(res){
                    that.group=res.data;
                })
                    .catch((error) => {
                        that.error = error.response.data.errors;

                    });
            },
            listproduct(page='1',name='',group=''){
                this.resetform();
                this.mode='list';
                let that=this;
                this.$axios.get(this.$url+'user/pdetail',{
                    params:{
                        page: page,
                        name: name,
                        group: group,
                    },
                    headers: {
                        Authorization:localStorage.token
                    }
                }).then(function(res){
                    that.listitems=res.data;

                })
                    .catch((error) => {
                        that.error = error.response.data.errors;

                    });
            },
        },
        mounted() {
                this.mode='list';
                this.listgroup();
                this.listproduct();
        }
    }
</script>

<style scoped>
    /* The container */
    .mychecker {
        display: block;
        position: relative;
        padding-right: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 20px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        direction: rtl;
    }

    /* Hide the browser's default checkbox */
    .mychecker input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        right: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .mychecker:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .mychecker input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .mychecker input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .mychecker .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>