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
$('tr').on('click', function() {
    window.location.href = "./detail.html"
})

    $(document)
        .ready(function() {
            $('.special.card .image').dimmer({
                on: 'hover'
            });
            $('.star.rating')
                .rating();
            $('.card .dimmer')
                .dimmer({
                    on: 'hover'
                });
        });

Vue.component('demo-grid', {
    template: '#grid-template',
    replace: true,
    props: {
        // data: Array,
        columns: Array,
        filterKey: String,
        skulist: Array,
        filterStatus: String
    },
    data: function() {
        var sortOrders = {}
        this.columns.forEach(function(key) {
            sortOrders[key] = 1
        })
        return {
            sortKey: '',
            sortOrders: sortOrders,
        }
    },
    computed: {
        filteredData: function() {

            var self = this;
            var sortKey = this.sortKey
            var filterKey = this.filterKey && this.filterKey.toLowerCase()
            var order = this.sortOrders[sortKey] || 1
            var data = this.skulist
            if (filterKey) {
                data = data.filter(function(row) {
                    return Object.keys(row).some(function(key) {
                        return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                    })
                })
            }
            if(this.filterStatus) {
                data = data.filter(function(row){
                    return row.skuStatus == self.filterStatus
                })
            }
            if (sortKey) {
                if (sortKey == 'price') {
                    data = data.slice().sort(function(a, b) {
                        a = parseFloat(a[sortKey])
                        b = parseFloat(b[sortKey])
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                } else {
                    data = data.slice().sort(function(a, b) {
                        a = a[sortKey]
                        b = b[sortKey]
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }

            }
            console.log('filteredData::::')
            console.log(data)
            return data
        }
    },
    filters: {
        capitalize: function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        }
    },
    mounted: function() {
        var self = this;
        // self.getSkuList();


    },

    methods: {
        sortBy: function(key) {
            this.sortKey = key
            this.sortOrders[key] = this.sortOrders[key] * -1
        },



        updateSku: function(e) {
            var self = this;
            var barcode = $(e.target).closest('tr').attr('data-skuid');
            var photoinput = $(e.target).closest('tr').find('.updatephoto');
            var target = _.find(self.skulist, function(sku) {
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
            console.log(photoinput[0].files)
            if (photoinput[0].files[0]) {
                formData.append("photo", photoinput[0].files[0]);
            } else {
                formData.append("photo", target.photo);
            }
            console.log(target.photo)



            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=update",
                // url: "http://192.168.1.5/mixmatch/Api/SkuAction.php?action=update",
                url: "http://10.32.80.152:8099/mixmatch/Api/SkuAction.php?action=update",
                // url: "http://192.168.0.104/mixmatch/Api/SkuAction.php?action=update",
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
                //假数据END
                console.log(res)
                // self.getSkuList();

                self.$emit('renderList')

            });
        },
        activeDropdown: function(e) {
            // $(e.target).closest('.ui.dropdown').dropdown('show');

            // $('.ui.floating.labeled.dropdown.button')
            $(e.target).closest('.ui.dropdown')
                .dropdown('set selected', '5');

        },
        vmodelSkuStatus: function(skuid, value) {
            var self = this;
            console.log(skuid)
            if (skuid) {
                var target = _.find(self.skulist, function(sku) {
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
        cancelSku: function() {
            var self = this;
            // self.getSkuList();
            self.$emit('renderList')
        },
        deleteSku: function() {
            var self = this;
        }
    }
})

Vue.component('sku-status-selects', {
    template: '#sku-status-selects-template',
    props: ['selectedvalue', 'skuid', 'module'],
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
    mounted: function() {
        var self = this;
        $(self.$el).dropdown('set selected', self.selectedvalue).dropdown({
            onChange: function(value, text, $selectedItem) {
                if (self.skuid || self.module == 'newsku') {
                    self.$emit('changeskustatus', self.skuid, value)
                } else {
                    self.$emit('filterstatus', value);
                }
            }
        });
    },
    methods: {
        pageclickhandler: function(e) {
            var self = this;
            // self.$emit('activepagechanged', pageindex)
        }
    }
})

new Vue({
    el: '#app',
    data: {
        filterStatus: '',
        searchQuery: '',
        // gridColumns: ['name', 'power'],
        gridColumns: ['photo', 'skuStatus', 'skuName', 'size', 'price', 'brand', 'channel', 'purchaseDate', 'skuType'],
        // gridData: [
        //   { name: 'Chuck Norris', power: Infinity },
        //   { name: 'Bruce Lee', power: 9000 },
        //   { name: 'Jackie Chan', power: 7000 },
        //   { name: 'Jet Li', power: 8000 }
        // ],
        newsku: {},
        skulist: []

    },
    computed: {
        // token: function() {
        //     return getCookie('token')
        // }
    },
    components: {},
    // created: function(){
    //     var self = this;
    //     if(!self.token) {
    //         window.location.href = "./login.html" //取不到token跳转登录页
    //     }
    // },
    mounted: function() {
        var self = this;
        self.getSkuList();

        $('.ui.modal')
            .modal('setting', 'dimmerSettings', {
                opacity: 0.2,
                closable : false
            })
            .modal('setting', 'allowMultiple', true)
            // .modal('setting', 'closable', false)
   
        // $('.second.modal')
        //   .modal('attach events', '.first.modal .button')
        // ;
        $('.first.modal')
            .modal({
               // closable  : false,
                // onDeny    : function(){
                //   window.alert('Wait not yet!');
                //   return false;
                // },
                onApprove : function() {
                    self.saveSku();
                    return false;
                } 
            });
        $( "#datepicker" ).datepicker({
                // numberOfMonths: 1,
                // showOn: 'both',
                // buttonText: '',
                // prevText: '',
                // nextText: '',
                // beforeShow: function(input, inst) {
                //     var newclass = 'admin-form';
                //     var themeClass = $(this).parents('.admin-form').attr('class');
                //     var smartpikr = inst.dpDiv.parent();
                //     if (!smartpikr.hasClass(themeClass)) {
                //         inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                //     }
                // },
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                onSelect: function(dateText, event) {
                    self.newsku.purchaseDate = dateText;
                    // self.$emit('selectedhandler', dateText, self.labelid)
                }
            });
        $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd")


    },
    methods: {
        addNewSku: function(){
            var self = this;
            $('.first.modal').modal('show');

        },

        fliterStatusData: function(value) {
            var self = this;
            self.filterStatus = value;

        },
        getSkuList: function() {
            var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                // url: "http://192.168.1.5/mixmatch/Api/GetSkuList.php",
                url: "http://10.32.80.152:8099/mixmatch/Api/GetSkuList.php",
                // url: "http://192.168.0.104/mixmatch/Api/GetSkuList.php",
                data: {}
            }).always(function(res) {
                
                console.log(res)
                self.skulist = res;
            });
        },
        vmodelSkuStatus2: function(skuid, value) {
            var self = this;
            if (skuid) {
                var target = _.find(self.skulist, function(sku) {
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
        activeDropdown2: function(e) {
            // $(e.target).closest('.ui.dropdown').dropdown('show');

            // $('.ui.floating.labeled.dropdown.button')
            $(e.target).closest('.ui.dropdown')
                .dropdown('set selected', '5');

        },

        saveSku: function(e) {
            
            var self = this;
            var formData = new FormData();

            formData.append("skuName", self.newsku.skuName);
            formData.append("skuType", self.newsku.skuType);
            formData.append("skuLink", self.newsku.skuLink);
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
                // url: "http://192.168.1.5/mixmatch/Api/SkuAction.php?action=add",
                url: "http://10.32.80.152:8099/mixmatch/Api/SkuAction.php?action=add",
                // url: "http://192.168.0.104/mixmatch/Api/SkuAction.php?action=add",
                // data: {
                //     sku: formData
                // },
                data: formData,
                processData: false,
                contentType: false
            }).always(function(res) {
                //假数据START

                //假数据END
                alert(res.success)

                if (res.success) {
                    // $('.first.modal').modal('hide')

                } else {
                    alert('error')

                }
                self.getSkuList();

            });
        },

    }
})