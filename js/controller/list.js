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



    new Vue({
        el: '#app',
        data: {
            skulist: []
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
            // 'panel-tab': ChildPanelTab
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
            self.updateSku();

        },
        methods: {

            getSkuList: function() {
                var self = this;
                
                $.ajax({
                    method: "GET",
                    url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                    data: {
                    }
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
                    self.skulist = res;
                 
                });
            },
            updateSku: function() {
                var self = this;
                
                $.ajax({
                    method: "POST",
                    url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=update",
                    data: {
                        sku:{
                            barcode: '1',
                            skuName: 'ceshi',
                            skuType: '4',
                            skuStatus: '3',
                            channel: 'ceshichannel',
                            brand: 'ceshibrand',
                            size: 'ceshisize',
                            price: '1.2',
                            photo:'./upload/2013/07/20074100.jpg',
                            purchaseDate: '2017-1-1'
                        }
                    }
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
            

        }
    })