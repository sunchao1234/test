@extends('admin.layout')
@section('content')
             <!-- START CONTENT FRAME -->
                <div class="content-frame">
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">
                        <div class="page-title">
                            <h2><span class="fa fa-inbox"></span> 详细信息 <small>({{$admin_info['info']->nick_name}})</small></h2>
                        </div>

                    </div>
                    <!-- END CONTENT FRAME TOP -->

                    <!-- START CONTENT FRAME LEFT -->
                    <div class="content-frame-left">
                            <div class="panel panel-default">
                                <div class="panel-body profile bg-info">
                                    <?php echo $user_info['avatar']; ?>
                                    <div class="profile-data">
                                        <div class="profile-data-name">{{{$user_info['nick_name']}}}</div>
                                    </div>
                                    <div class="profile-controls">
                                    </div>
                                </div>
                                <div class="panel-body list-group">
                                    <span class="list-group-item"><span class="fa fa-user"></span> 昵称：{{{$user_info['nick_name']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-mail-forward"></span>邮箱：{{{$user_info['email']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-heart"></span>性别：{{{$user_info['sex']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-cog"></span> 分组：{{{$user_info['group_id']}}} / {{{$user_info['role_id']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-phone"></span> 电话：{{{$user_info['phone']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-clock-o"></span> 创建：{{{$user_info['create_time']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-clock-o"></span> 登录：{{{$user_info['last_login_time']}}}</span>
                                    <span class="list-group-item"><span class="fa fa-info-circle"></span> 状态：<?php echo $user_info['status']; ?></span>
                                    <div class="panel-footer">
                                        <a href="/admin/role/edit/{{$user_info['id']}}" class="btn btn-primary pull-right">编辑</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- END CONTENT FRAME LEFT -->

                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body">

                        <div class="panel panel-colorful">
                            <div class="panel-heading ui-draggable-handle">
                                <label class=" mail-checkall">
                                    <span class="fa fa-calendar-o"></span> 日志列表
                                </label>
                                <div class="pull-right" style="width: 150px;">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                                        <input class="form-control datepicker" type="text" data-orientation="left"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body mail">
                                <div class="mail-item mail-unread mail-info">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Dmitry Ivaniuk</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">Product development</a>
                                    <div class="mail-date">Today, 11:21</div>
                                </div>

                                <div class="mail-item mail-unread mail-danger">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">John Doe</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">New Windows 9 App</a>
                                    <div class="mail-date">Today, 10:36</div>
                                </div>

                                <div class="mail-item mail-success">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Nadia Ali</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">Check my new song</a>
                                    <div class="mail-date">Yesterday, 20:19</div>
                                </div>

                                <div class="mail-item mail-warning">
                                    <div class="mail-star starred">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Brad Pitt</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">How are you? Need some work?</a>
                                    <div class="mail-date">Sep 15</div>
                                </div>

                                <div class="mail-item mail-info">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Dmitry Ivaniuk</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">Can you check this docs?</a>
                                    <div class="mail-date">Sep 14</div>
                                    <div class="mail-attachments">
                                        <span class="fa fa-paperclip"></span> 11Kb
                                    </div>
                                </div>

                                <div class="mail-item">
                                    <div class="mail-star starred">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">HTC</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">New updates on your phone HD7</a>
                                    <div class="mail-date">Sep 13</div>
                                    <div class="mail-attachments">
                                        <span class="fa fa-paperclip"></span> 58Mb
                                    </div>
                                </div>

                                <div class="mail-item mail-unread">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Unknown</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">You won $15,000,000</a>
                                    <div class="mail-date">Sep 13</div>
                                </div>

                                <div class="mail-item mail-success">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Nadia Ali</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">Your tickets</a>
                                    <div class="mail-date">Sep 11</div>
                                    <div class="mail-attachments">
                                        <span class="fa fa-paperclip"></span> 1.2Mb
                                    </div>
                                </div>

                                <div class="mail-item mail-info">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Dmitry Ivaniuk</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">New bug founded</a>
                                    <div class="mail-date">Sep 11</div>
                                </div>
                                <div class="mail-item">
                                    <div class="mail-star">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">Darth Vader</div>
                                    <a href="pages-mailbox-message.html" class="mail-text">Where drawings of the new spaceship?</a>
                                    <div class="mail-date">Sep 10</div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <ul class="pagination pagination-sm pull-right">
                                    <li class="disabled"><a href="#">«</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->

    <!-- START THIS PAGE PLUGINS-->

        <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/admin/themes/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/validationengine/jquery.validationEngine.js') }}'></script>
        <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/validationengine/languages/jquery.validationEngine-zh_CN.js') }}'></script>
        <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/jquery-validation/jquery.validate.js') }}'></script>
         <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/jquery-validation/localization/messages_zh.js') }}'></script>
        <script type='text/javascript' src='{{ asset('/assets/admin/themes/js/plugins/maskedinput/jquery.maskedinput.min.js') }}'></script>

    <!-- END THIS PAGE PLUGINS-->
@endsection
