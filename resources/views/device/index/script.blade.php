<script>
    var app = angular.module('cast',['ui.bootstrap']);
</script>
<script src="{{asset('/js/ngnetwork.js')}}"></script>
<script>
    // var app = angular.module('kuailai',['ui.bootstrap']);

    var ngScope;
    // app.controller('controller', function ($scope) {
    app.controller('controller', function ($scope, $network) {
    // app.controller('controller', function ($scope, $network, $interval, $timeout) {
        ngScope = $scope;

        $scope.filter_shops = typeof filter_shops == "undefined" ? null : filter_shops;

        $scope.filter = {
            page: 1,
            date_range: 1,
            mobile: null,
            dev_id: null,
            filter_created_end: null,
        };

        $scope.isLoading = false;

        $scope.search = function(){
            console.log('search');
            if($scope.isLoading){
                return false;
            }

            // if($scope.filter_shops != null && $scope.filter.shop_id == null){
            //     global.msg('请选择商铺');
            //     return false;
            // }
            $scope.filter.page = 1;
            getData();
            return false;
        };
        /**
         * 获取数据
         */
        function getData(){

            $scope.list = null;

            $scope.isLoading = true;

            $network.post('../index/json', $scope.filter, function (data) {
                console.log(data);
                $scope.isLoading = false;
                if (data.code == 200) {
                    $scope.list = data.result.list;
                }
            },function(data){
                $scope.isLoading = false;
            });
        }

        $scope.setPage = function(){
            if($scope.isLoading){
                return;
            }

            $scope.filter.page = $scope.list == null ? 1 : $scope.list.current_page;

            getData();

        }

    });
</script>