
 

var SkuSelection = {
    props: ['skulistprop', 'skumixid'],
    data: function() {
        return {
            counter: 1,
            
        }
    },
    computed: {
        pageindex: function() {
            var self = this;
            
            return tmp;
        }
    },
    template: [
        '<div class="ui fluid multiple search selection dropdown">',
            '<input type="hidden" name="country" value="">',
            '<i class="dropdown icon"></i>',
            '<input class="search" autocomplete="off" tabindex="0" style="width: 9px;"><span class="sizer"></span>',
            '<div class="default text">Select Sku</div>',
            '<div  class="menu transition hidden "  tabindex="-1">',
                '<div v-for="sku in skulistprop" class="item" :data-value="sku.barcode"><img :src="sku.photo"/>{{sku.skuName}}</div>',
            '</div>',
        '</div>'
    ].join(''),
    mounted: function(){
        var self = this;
        $(self.$el).dropdown('set selected', self.selectedvalue).dropdown({
            onChange: function(value, text, $selectedItem) {
                self.$emit('skuselected', self.skumixid, value)
            }
        });
    },
    methods: {
        pageclickhandler: function(e) {
            var self = this;
            // self.$emit('activepagechanged', pageindex)
        }
    }
}

new Vue({
    el: '#app',
    data: {
        skulist: [],
        newsku: {},
        newskumix: {},
        skumixlist: []
    },
    computed: {
        // seasonalRiskList: function() {
        //     var self = this;
        //     var tmp = [];
        //     var classList = [
        //         'text-warning',
        //         'text-primary',
        //         'text-info',
        //         'text-alert'
        //     ]
        //     $.each(self.seasonalRiskListRaw, function(k, v) {
        //         tmp.push($.extend({}, v, {
        //             className: classList[k]
        //         }))
        //     })
        //     console.log(tmp)
        //     return tmp;
        // },
        // token: function() {
        //     return getCookie('token')
        // }
    },
    components: {
        'skuselection': SkuSelection
    },
    // created: function(){
    //     var self = this;
    //     if(!self.token) {
    //         window.location.href = "./login.html" //取不到token跳转登录页
    //     }
    // },
    // created: function(){
    //     var self = this;

    // },
    mounted: function() {
        var self = this;
        self.getAllSku();
        self.getSkuList();
        self.getSkuMixList();
   
    // $('.ui.card').on('click', '.ui.move.reveal.image', function(){
    $('.ui.card').on('click', '.canclick', function() {
        $(this).toggleClass('active');
    })
    $('.ui.sticky').sticky();
    // $('tr').on('click', function(){
    //   window.location.href = "./detail.html"
    // })
    },
    methods: {
        toggleView: function(e){
            e.preventDefault();
            e.stopPropagation();
            $(e.target).closest('.ui.card').find('.sku').transition('toggle');
        },
        togglePhotoModel: function(e){
            var self = this;
            $(e.target).closest('.ui.card').toggleClass('compare');
            $('.ui.move.reveal.image').toggleClass('canclick').removeClass('active');
        },
        getSkuList: function() {
            var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                url: "http://192.168.1.5/mixmatch/Api/GetSkuList.php",
                data: {}
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                console.log(res)
                // res = [
                // {
                //     "barcode": "1",
                //     "skuName": "冬款小公主加厚保暖印花中筒袜",
                //     "skuType": "4",
                //     "skuStatus": "1",
                //     "price": "17",
                //     "channel": "淘宝戴维贝拉旗舰店",
                //     "brand": "戴维贝拉davebella",
                //     "size": "9cm",
                //     "purchaseDate": "2017-10-25 20:58:19",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // },
                // {
                //     "barcode": "2",
                //     "skuName": "冬款加厚保暖条纹印花中筒袜",
                //     "skuType": "4",
                //     "skuStatus": "2",
                //     "price": "17",
                //     "channel": "淘宝戴维贝拉旗舰店",
                //     "brand": "戴维贝拉davebella",
                //     "size": "9cm",
                //     "purchaseDate": "2017-10-25 20:58:19",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // },
                // {
                //     "barcode": "3",
                //     "skuName": "婴儿马甲粉小熊",
                //     "skuType": "1",
                //     "skuStatus": "5",
                //     "price": "59",
                //     "channel": "老豆商城七天无理由退换货",
                //     "brand": "无",
                //     "size": "86cm(12-18月)",
                //     "purchaseDate": "2017-10-21 18:51:08",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // }]
                self.skulist = res;

            });
        },
        getSkuMixList: function() {
            var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                url: "http://192.168.1.5/mixmatch/Api/GetSkuMixList.php",
                data: {}
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                console.log(res)
                
               
                _.each(res, function(skumix, k){
                    skumix['skuMixArray'] = _.filter(self.skulist, function(sku){
                        return skumix.skuMix.indexOf(sku.barcode) > -1
                    })

                })
                console.log(res)
                self.skumixlist = res;

            });
        },
        saveSkuMix: function(e) {
            var self = this;
            var formData = new FormData();
            console.log('===')
            console.log(self.newskumix)
            formData.append("skuMixName", self.newskumix.skuName);
            formData.append("skuMixType", self.newskumix.skuType);
            formData.append("price", self.newskumix.price);
            // formData.append("skuMix", '2,3,24,36');
            formData.append("skuMix", self.newskumix.skuMix);
            // HTML 文件类型input，由用户选择
            formData.append("photo", $('#photo')[0].files[0]);
            formData.append("photoModel", $('#photoModel')[0].files[0]);
            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=add",
                url: "http://192.168.1.5/mixmatch/Api/SkuMixAction.php?action=add",
                // data: {
                //     sku: formData
                // },
                data:formData,
                processData: false,
                contentType: false
            }).always(function(res) {
                //假数据START
                
                //假数据END
                if(res.success) {
                   self.newskumix = {};
                } else {
                    alert('error')
                   
                }
                // self.getSkuList(); 
                

            });
        },
        skuSelectionHandler: function(skuMixId, skuMix){
            var self = this;
            if(!skuMixId) {
                self.newskumix.skuMix = skuMix;
            }

        },
        updateSku: function(e) {
            var self = this;
            var barcode = $(e.target).closest('tr').attr('data-skuid');
            var photoinput = $(e.target).closest('tr').find('.updatephoto');
            var target = _.find(self.skulist, function(sku){
                return sku.barcode == barcode
            })

            var formData = new FormData();
            formData.append("barcode", barcode);
            formData.append("skuName", target.skuName);
            formData.append("skuType", target.skuType);
            formData.append("skuStatus", target.skuStatus);
            formData.append("channel", target.channel);
            formData.append("brand", target.brand);
            formData.append("size", target.size);
            formData.append("price", target.price);
            formData.append("purchaseDate", target.purchaseDate);
            // HTML 文件类型input，由用户选择
            console.log('++++')
            console.log(photoinput[0].files)
            if(photoinput[0].files[0]) {
                formData.append("photo", photoinput[0].files[0]);
            } else {
                formData.append("photo", target.photo);
            }
            console.log(target.photo)

     

            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=update",
                url: "http://192.168.1.5/mixmatch/Api/SkuAction.php?action=update",
                data: formData,
                processData: false,
                contentType: false
                // data: {
                //     sku: {
                //         barcode: barcode,
                //         skuName: target.skuName,
                //         skuType: target.skuType,
                //         skuStatus: target.skuStatus,
                //         channel: target.channel,
                //         brand: target.brand,
                //         size: target.size,
                //         price: target.price,
                //         photo: target.photo,
                //         purchaseDate: target.purchaseDate
                //     }
                // }
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                console.log(res)
                self.getSkuList();

            });
        },
        getAllSku: function(){
                        var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                url: "http://192.168.1.5/mixmatch/Api/GetSku.php",
                data: {}
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                console.log(res)
                // res = [
                // {
                //     "barcode": "1",
                //     "skuName": "冬款小公主加厚保暖印花中筒袜",
                //     "skuType": "4",
                //     "skuStatus": "1",
                //     "price": "17",
                //     "channel": "淘宝戴维贝拉旗舰店",
                //     "brand": "戴维贝拉davebella",
                //     "size": "9cm",
                //     "purchaseDate": "2017-10-25 20:58:19",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // },
                // {
                //     "barcode": "2",
                //     "skuName": "冬款加厚保暖条纹印花中筒袜",
                //     "skuType": "4",
                //     "skuStatus": "2",
                //     "price": "17",
                //     "channel": "淘宝戴维贝拉旗舰店",
                //     "brand": "戴维贝拉davebella",
                //     "size": "9cm",
                //     "purchaseDate": "2017-10-25 20:58:19",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // },
                // {
                //     "barcode": "3",
                //     "skuName": "婴儿马甲粉小熊",
                //     "skuType": "1",
                //     "skuStatus": "5",
                //     "price": "59",
                //     "channel": "老豆商城七天无理由退换货",
                //     "brand": "无",
                //     "size": "86cm(12-18月)",
                //     "purchaseDate": "2017-10-21 18:51:08",
                //     "photo": ".\/upload\/2013\/07\/20074100.jpg"
                // }]
                // self.skulist = res;

            });
        },
        // toggleModal: function(){
        //     var self = this;
        //     $('.ui.modal').modal('show');

        // },
        vmodelSkuStatus: function(skuid, value){
            var self = this;
            console.log(skuid)
            if(skuid) {
               var target = _.find(self.skulist, function(sku){
                console.log(sku.barcode)
                return sku.barcode == skuid
                })
                target.skuStatus = value; 
                // self.updateSku();
            // var barcode = $(e.target).closest('tr').attr('data-skuid');
                $("[data-skuid='" + skuid + "']").find('.ui.button.orange').trigger('click');
            } else {
                //新增sku
                self.newsku.skuStatus = value;
            }
            
        },
        cancelSku: function(){
            var self = this;
            self.getSkuList();
        },
        deleteSku: function(){
            var self = this;
        }

    }
})