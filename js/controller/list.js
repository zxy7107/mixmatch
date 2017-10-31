$('.toggleview').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(e.target).closest('.ui.card').find('.sku').transition('toggle');
})
// $('.ui.card').on('click', '.ui.move.reveal.image', function(){
$('.ui.card').on('click', '.canclick', function() {
    $(this).toggleClass('active');
})
$('.asterisk.icon').on('click', function() {
    $(this).closest('.ui.card').toggleClass('compare');
    $('.ui.move.reveal.image').toggleClass('canclick').removeClass('active');

})
$('.ui.sticky').sticky();
// $('tr').on('click', function(){
//   window.location.href = "./detail.html"
// })

var SkuStatusSelects = {
    props: ['selectedvalue', 'skuid'],
    data: function() {
        return {
            counter: 1,
            classObject: {
                isFirstDisabled: true,
                isLastDisabled: true
            },
            activePageIndex: 1
        }
    },
    computed: {
        pageindex: function() {
            var self = this;
            
            return tmp;
        }
    },
    template: [
        '<div class="ui floating labeled dropdown button" tabindex="0">',
        '<select>',
            '<option value="">状态</option>',
            '<option value="1">1</option>',
            '<option value="2">2</option>',
            '<option value="3">3</option>',
            '<option value="4">4</option>',
            '<option value="5">5</option>',
        '</select>',
        '<div class="default text">状态</div>',
        '<i class="dropdown icon"></i>',
        '<div class="menu" tabindex="-1">',
          '<div class="item" data-value="1"><span class="canuse"><i class="checkmark icon"></i></span> </div>',
          '<div class="item" data-value="2"><span class="cantuse"><i class="minus circle icon"></i></span></div>',
          '<div class="item" data-value="3"><span class="canbuy"><i class="shop icon"></i></span></div>',
          '<div class="item" data-value="4"><span class="lookfor"><i class="search icon"></i></span></div>',
          '<div class="item" data-value="5"><span class="dropped"><i class="remove circle outline icon"></i></span></div>',
        '</div>',
        '</div>',
    ].join(''),
    mounted: function(){
        var self = this;
        $(self.$el).dropdown('set selected', self.selectedvalue).dropdown({
            onChange: function(value, text, $selectedItem) {
                self.$emit('changeskustatus', self.skuid, value)
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
        newsku: {}
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
        'skustatusselection': SkuStatusSelects
    },
    // created: function(){
    //     var self = this;
    //     if(!self.token) {
    //         window.location.href = "./login.html" //取不到token跳转登录页
    //     }
    // },
    mounted: function() {
        var self = this;
        self.getSkuList();


    },
    methods: {

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
        saveSku: function(e) {
            var self = this;
            var formData = new FormData();

            formData.append("skuName", self.newsku.skuName);
            formData.append("skuType", self.newsku.skuType);
            formData.append("skuStatus", self.newsku.skuStatus);
            formData.append("channel", self.newsku.channel);
            formData.append("brand", self.newsku.brand);
            formData.append("size", self.newsku.size);
            formData.append("price", self.newsku.price);
            formData.append("purchaseDate", self.newsku.purchaseDate);
            // HTML 文件类型input，由用户选择
            formData.append("photo", $('#photo')[0].files[0]);
            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=add",
                url: "http://192.168.1.5/mixmatch/Api/SkuAction.php?action=add",
                // data: {
                //     sku: formData
                // },
                data:formData,
                processData: false,
                contentType: false
            }).always(function(res) {
                //假数据START
                
                //假数据END
                alert(res.success)

                if(res.success) {
                   self.newsku = {};
                } else {
                    alert('error')
                   
                }
                self.getSkuList(); 
                

            });
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
        activeDropdown: function(e) {
            // $(e.target).closest('.ui.dropdown').dropdown('show');

            // $('.ui.floating.labeled.dropdown.button')
            $(e.target).closest('.ui.dropdown')
                .dropdown('set selected', '5');

        },
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