<div >
    <table class="table table-hover  table-bordered" ng-show="list!=null" ng-cloak>
        <thead>
        <tr>
            <th>账号</th>
            <th>设备号</th>
        </tr>
        </thead>
        <tbody>
                <tr ng-repeat="item in list.data">
                    <td style="vertical-align: inherit">
                      @{{ item.mobile }}
                    </td>
                    <td style="vertical-align: inherit">
                        @{{ item.id }}
                    </td>
                    <td style="vertical-align: inherit" >
                        <a href=""
                    </td>
                </tr>

        </tbody>
    </table>
</div>
<div class="float-right">
{{--    @include('admin.include.paginator')--}}
</div>
