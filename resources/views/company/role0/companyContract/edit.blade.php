@extends('company.layouts.app')

@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">信息配置</div>
                    <div class="layui-card-body" pad15>
                        <div class="layui-form" lay-filter="">
                            <div class="layui-form-item hidden">
                                <label class="layui-form-label">id</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="id" value="{{$data->id}}" class="layui-input"
                                           lay-verify=""
                                           placeholder="id">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">物业公司</label>
                                <div class="layui-input-inline">
                                    <span class="layui-form-mid text-oneline">{{$man_company->name}}</span>
                                </div>
                            </div>
                            <div class="layui-form-item hidden">
                                <label class="layui-form-label">物业公司id</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="man_company_id" value="{{$man_company->id}}"
                                           class="layui-input"
                                           lay-verify="required"
                                           placeholder="物业公司id">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">在管项目</label>
                                <div class="layui-input-inline">
                                    <select name="bus_company_id" lay-verify="required">
                                        <option value="">请选择</option>
                                        @foreach($bus_companys as $bus_company)
                                            <option value="{{$bus_company->id}}"
                                                    {{$data->bus_company_id == $bus_company->id ? 'selected':''}}>{{$bus_company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">合同名</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" value="{{$data->name}}" class="layui-input"
                                           lay-verify="required" style="width: 405px;"
                                           placeholder="请输入合同名">
                                </div>
                                <div class="layui-form-mid layui-word-aux"></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">合同期</label>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input" id="valid_start_time" lay-verify="required"
                                           placeholder="yyyy-MM-dd"
                                           value="{{$data->valid_start_time}}">
                                </div>
                                <div class="layui-form-mid">-</div>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input" id="valid_end_time" lay-verify="required"
                                           placeholder="yyyy-MM-dd"
                                           value="{{$data->valid_end_time}}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">附件</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="attach" name="attach" value="{{$data->attach}}"
                                           class="layui-input"
                                           lay-verify="required" disabled
                                           placeholder="请选择附件上传">
                                </div>
                                <div id="container" class="layui-input-inline">
                                    <button id="pickfiles" class="layui-btn layui-btn-primary">选择合同</button>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="LAY-form-edit">保存信息</button>
                                    <button type="reset" class="layui-btn layui-btn-primary" onclick="reloadPage();">
                                        重新填写
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">


        var layer = null;


        $(function () {
            //初始化七牛模块
            initQNUploader();
        });


        layui.use(['index', 'layer', 'form', 'set', 'laydate'], function () {
            layer = layui.layer;        //初始化layer
            var form = layui.form;

            form.render();

            var laydate = layui.laydate;

            laydate.render({
                elem: '#valid_start_time'
                , calendar: true
                , trigger: 'click'
            });

            laydate.render({
                elem: '#valid_end_time'
                , calendar: true
                , trigger: 'click'
            });

            //表单提交text
            form.on('submit(LAY-form-edit)', function (data) {
                var param = data.field;
                var valid_start_time = $("#valid_start_time").val();
                param.valid_start_time = valid_start_time;
                var valid_end_time = $("#valid_end_time").val();
                param.valid_end_time = valid_end_time;
                consoledebug.log("param:" + JSON.stringify(param));
                var loadding_index = layer.load(1, {time: 10 * 1000});   //加载

                //进行请求
                ajaxRequest('{{URL::asset('/company/role0/companyContract/edit')}}', param, "POST", function (ret) {
                    if (ret.result) {
                        layer.msg('保存成功', {icon: 1, time: 1000});
                        setTimeout(function () {
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.$(".btn-refresh").click();
                            parent.layer.close(index);
                        }, 500);
                    } else {
                        layer.msg(ret.message, {icon: 5, time: 1000});
                    }
                    layer.close(loadding_index);
                });
            });
        });


        //初始化七牛上传模块
        function initQNUploader() {
            var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'pickfiles',         // 上传选择的点选按钮，必需
                container: 'container',//上传按钮的上级元素ID
                // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
                // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
                //    // do something
                //    return uptoken;
                // },
                get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                // downtoken_url: '/downtoken',
                // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                domain: 'http://twst.isart.me/',     // bucket域名，下载资源时用到，必需
                max_file_size: '100mb',             // 最大文件体积限制
                flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                max_retries: 3,                     // 上传失败最大重试次数
                dragdrop: true,                     // 开启可拖曳上传
                drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb',                  // 分块上传时，每块的体积
                auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                //x_vars : {
                //    查看自定义变量
                //    'time' : function(up,file) {
                //        var time = (new Date()).getTime();
                // do something with 'time'
                //        return time;
                //    },
                //    'size' : function(up,file) {
                //        var size = file.size;
                // do something with 'size'
                //        return size;
                //    }
                //},
                init: {
                    'FilesAdded': function (up, files) {
                        plupload.each(files, function (file) {
                            // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                        });
                    },
                    'BeforeUpload': function (up, file) {
                        // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                    },
                    'UploadProgress': function (up, file) {
                        // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                    },
                    'FileUploaded': function (up, file, info) {
                        // 每个文件上传成功后，处理相关的事情
                        // 其中info是文件上传成功后，服务端返回的json，形式如：
                        // {
                        //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                        //    "key": "gogopher.jpg"
                        //  }
                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#attach").val(sourceLink);
//                        console.log($("#pickfiles").attr('src'));
                    },
                    'Error': function (up, err, errTip) {
                        //上传出错时，处理相关的事情
                        console.log(err + errTip);
                    },
                    'UploadComplete': function () {
                        //队列文件处理完毕后，处理相关的事情
                    },
                    'Key': function (up, file) {
                        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                        // 该配置必须要在unique_names: false，save_key: false时才生效

                        var key = "";
                        // do something with key here
                        return key
                    }
                }
            });
        }

    </script>
@endsection