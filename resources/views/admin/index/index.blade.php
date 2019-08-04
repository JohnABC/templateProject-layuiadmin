@extends('admin.layouts.app')

@section('content')
    <div id="LAY_app">
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header">
                <!-- 头部区域 -->
                <ul class="layui-nav layui-layout-left">
                    <li class="layui-nav-item layadmin-flexible" lay-unselect>
                        <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                            <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                        </a>
                    </li>
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<a href="http://www.layui.com/admin/" target="_blank" title="前台">--}}
                    {{--<i class="layui-icon layui-icon-website"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;" layadmin-event="refresh" title="刷新">
                            <i class="layui-icon layui-icon-refresh-3"></i>
                        </a>
                    </li>
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search"--}}
                    {{--layadmin-event="serach" lay-action="template/search.html?keywords=">--}}
                    {{--</li>--}}
                </ul>
                <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

                    {{--<li class="layui-nav-item" lay-unselect>--}}
                    {{--<a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">--}}
                    {{--<i class="layui-icon layui-icon-notice"></i>--}}

                    {{--<!-- 如果有新消息，则显示小圆点 -->--}}
                    {{--<span class="layui-badge-dot"></span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
                    {{--<a href="javascript:;" layadmin-event="theme">--}}
                    {{--<i class="layui-icon layui-icon-theme"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;" layadmin-event="note">
                            <i class="layui-icon layui-icon-note"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;" layadmin-event="fullscreen">
                            <i class="layui-icon layui-icon-screen-full"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;">
                            <cite>{{$admin->name}}</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="{{ URL::asset('/admin/admin/editMyself') }}">基本资料</a></dd>
                            <dd><a lay-href="{{ URL::asset('/admin/admin/editPassword') }}">修改密码</a></dd>
                            <hr>
                            <dd style="text-align: center;"><a
                                        href="{{ URL::asset('/admin/logout') }}">退出</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;"><i
                                    class="layui-icon layui-icon-more-vertical"></i></a>
                    </li>
                </ul>
            </div>

            <!-- 侧边菜单 -->
            <div class="layui-side layui-side-menu">
                <div class="layui-side-scroll">
                    <div class="layui-logo" lay-href="home/console.html">
                        <span>{{env('APP_NAME', '')}} | 管理后台</span>
                    </div>

                    <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
                        lay-filter="layadmin-system-side-menu">
                        <li data-name="home" class="layui-nav-item layui-nav-itemed">
                            <a href="javascript:;" lay-tips="业务概览" lay-direction="2">
                                <i class="layui-icon layui-icon-home"></i>
                                <cite>业务概览</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd data-name="console">
                                    <a lay-href="{{ URL::asset('/admin/overview/manCompanyStmt') }}">物业公司报表</a>
                                </dd>
                                <dd data-name="console">
                                    <a lay-href="{{ URL::asset('/admin/overview/busCompanyStmt') }}">在管项目报表</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="component" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="角色管理" lay-direction="2">
                                <i class="layui-icon layui-icon-user"></i>
                                <cite>用户管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd data-name="button">
                                    <a lay-href="{{ URL::asset('/admin/admin/index') }}">管理员信息</a>
                                </dd>
                            </dl>
                            <dl class="layui-nav-child">
                                <dd data-name="button">
                                    <a lay-href="{{ URL::asset('/admin/user/index') }}">用户信息</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="get" class="layui-nav-item">
                            <a href="javascript:;" lay-href="{{ URL::asset('/admin/ad/index') }}" lay-tips="轮播设置"
                               lay-direction="2">
                                <i class="layui-icon layui-icon-carousel"></i>
                                <cite>轮播设置</cite>
                            </a>
                        </li>
                        <li data-name="app" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="物业、在管项目" lay-direction="2">
                                <i class="layui-icon layui-icon-app"></i>
                                <cite>物业、在管项目</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/manCompany/index') }}">物业公司</a>
                                </dd>
                                <dd data-name="workorder">
                                    <a lay-href="{{ URL::asset('/admin/busCompany/index') }}">在管项目</a>
                                </dd>
                                <dd data-name="workorder">
                                    <a lay-href="{{ URL::asset('/admin/companyUser/index') }}">职员管理</a>
                                </dd>
                                <dd data-name="workorder">
                                    <a lay-href="{{ URL::asset('/admin/companyContract/index') }}">合同管理</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="app" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="员工管理" lay-direction="2">
                                <i class="layui-icon layui-icon-senior"></i>
                                <cite>员工管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/applyWorker/index') }}?audit_status=0">人员审核</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/worker/index') }}">人力目录</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/companyWorker/index') }}">雇佣关系查询</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/exportWorkerSalary/index') }}">工资表导出</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="app" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="任务管理" lay-direction="2">
                                <i class="layui-icon layui-icon-form"></i>
                                <cite>任务管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/jobOrder/index') }}">工作包管理</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/jobOrderWorker/index') }}">工作包接单</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/jobOrderItem/index') }}">工作包任务</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="user" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="业务设置" lay-direction="2">
                                <i class="layui-icon layui-icon-set"></i>
                                <cite>业务设置</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/city/index') }}">开通城市</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/job/index') }}">工作设置</a>
                                </dd>
                                <dd>
                                    <a lay-href="{{ URL::asset('/admin/rule/index') }}">预警规则</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="template" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="页面管理" lay-direction="2">
                                <i class="layui-icon layui-icon-template"></i>
                                <cite>页面管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd><a lay-href="{{ URL::asset('/admin/ruleTw/index') }}">规则配置</a></dd>
                                <dd><a lay-href="{{ URL::asset('/admin/company/edit') }}">联系方式</a></dd>
                            </dl>
                        </li>
                        <li data-name="get" class="layui-nav-item">
                            <a href="javascript:;" lay-href="{{URL::asset('/admin/aboutus/index')}}" lay-tips="授权信息"
                               lay-direction="2">
                                <i class="layui-icon layui-icon-auz"></i>
                                <cite>授权信息</cite>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 页面标签 -->
            <div class="layadmin-pagetabs" id="LAY_app_tabs">
                <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-down">
                    <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                        <li class="layui-nav-item" lay-unselect>
                            <a href="javascript:;"></a>
                            <dl class="layui-nav-child layui-anim-fadein">
                                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                    <ul class="layui-tab-title" id="LAY_app_tabsheader">
                        <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i
                                    class="layui-icon layui-icon-home"></i></li>
                    </ul>
                </div>
            </div>


            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">
                <div class="layadmin-tabsbody-item layui-show">
                    <iframe src="{{ URL::asset('/admin/overview/index') }}" frameborder="0"
                            class="layadmin-iframe"></iframe>
                </div>
            </div>

            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">


        layui.use(['index'], function () {

        });


    </script>
@endsection

