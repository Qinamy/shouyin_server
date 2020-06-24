<div class="w-100 mt-2"></div>
<form class="form-inline" method="get" action="html"  >
    <div class="col-md-1 text-right"><span>用户账号：</span></div>
    <div class="col-md-2">
        <input type="text" name="mobile" class="form-control form-control-sm" ng-model="filter.mobile"/>
    </div>

    <div class="col-md-2">
        <input type="text" name="dev_id" class="form-control form-control-sm" ng-model="filter.dev_id"/>
    </div>

{{--    <div class="w-100 mt-2"></div>--}}

{{--    <div class="status col-md-4 offset-md-1">--}}
        <button type="button" class="btn btn-success btn-sm" ng-click="search()">
            <span ng-show="isLoading == false">查询</span>
            <i class="fa fa-spinner fa-pulse" ng-show="isLoading"></i>
        </button>
{{--    </div>--}}

</form>

<hr>