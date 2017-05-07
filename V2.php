<?php
/**
 * 用户相关路由声明定义
 * 
 * @author fanyilong <fanyilong@kuaiqiangche.com>
 * @copyright COPYRIGHT © 2016,KUAIQIANGCHE.COM ALL RIGHTS RESERVED
 * @since 1.0.1
 */
$api->version(['v2.0'], function ($api) {
    $api->any('/', function () {
        return 'hello this is cyb api!';
    });
    $api->group(['namespace' => 'App\Api\V2\V2_0\Controllers\Users', 'middleware' => 'kqc.common'], function ($api) {
                // 需要登录才能调用的接口
        $api->group(['middleware' => 'kqc.auth'], function ($api) {

            //管理员员工相关
            $api->get('/staff', 'StaffController@index');
            //员工列表
            $api->get('/staff/list', 'StaffController@lists');
            //获取员工信息
            $api->get('/staff/info', 'StaffController@staffInfo');
            //添加员工
            $api->post('/staff/add', 'StaffController@addStaff');
            //删除员工
            $api->get('/staff/delete', 'StaffController@deleteStaff');
            //审核员工
            $api->post('/staff/check', 'StaffController@checkStaff');
            //搜索员工
            $api->get('/staff/search', 'StaffController@searchStaff');
            //模糊搜索公司名全称
            $api->get('/staff/fuzzy', 'StaffController@fuzzyCompany');
            //通过公司ID获取公司信息
            $api->get('/staff/company', 'StaffController@companyInfo');
            //申请加入公司
            $api->post('/staff/apply', 'StaffController@applyToCompany');
            //提交企业认证
            $api->post('/company/apply_company_auth', 'StaffController@applyCompanyAuth');
            //提交意见反馈
            $api->post('/user/post_feedback','UserController@submitFeedback');
            //退出公司
            $api->post('/company/exit_company', 'StaffController@exitCompany');

            //代办事项列表
            $api->get('/todo', 'TodoListController@index');
            //代办事项详情
            $api->get('/todo/detail', 'TodoListController@detail');
            //待办事项驳回
            $api->get('/todo/reject', 'TodoListController@reject');
            //获取车源列表
            $api->get('/user/car_list','UserController@carList');
            //获取车款信息
            $api->get('/user/type_list','UserController@typeList');

        });
        //代金券相关
        $api->group(['middleware' => 'kqc.auth'], function ($api) {
            $api->get('/coupon/get_coupon_list','CouponController@getCouponList');
        });
            //钱包相关接口
        $api->group(['middleware' => 'kqc.auth'], function ($api) {
            //用户银行卡列表
            $api->get('/account/card_list','AccountController@cardList');
            //绑定银行卡
            $api->post('/account/binding_card','AccountController@bindingCard');
            //提现余额
            $api->post('/account/get_cash','AccountController@getCash');
            //提现记录
            $api->get('/account/get_cash_log','AccountController@getCashLog');
            //设置支付密码
            $api->post('/account/set_pay_password','AccountController@setPayPassword');
            //验证支付密码
            $api->post('/account/verify_pay_password','AccountController@verifyPayPassword');
            //修改支付密码
            $api->post('/account/change_pay_password','AccountController@changePayPassword');
            //获取企业账户信息
            $api->get('/account/get_company_account','AccountController@getCompanyAccount');
            //更换银行卡
            $api->post('/account/replace_card','AccountController@replaceCard');
            //忘记支付密码
            $api->post('/account/forgot_pay_password','AccountController@forgotPayPassword');
            //充值记录
            $api->get('/account/recharge_Log','AccountController@rechargeLog');
            //充值订单
            $api->post('/account/recharge','AccountController@recharge');
            //账单明细
            $api->get('/account/get_bill_detail','AccountController@getBillDetail');
            //校验验证码
            $api->post('/account/verify_code','AccountController@VerifyCode');

            
        });


        /*
         * 对公账户
         */
        //银行卡绑定接口
        $api->get('/account/company_bind_card','AccountController@CompanyBindCard');
        //公账鉴权
        $api->get('/account/company_card_validate','AccountController@CompanyCardValidate');
        

        //银行列表
        $api->get('/account/bank_list','AccountController@bankList');

        //版本更新
        $api->get('/appupdate/check','AppUpdateController@check');
        //android热更新
        $api->get('/appupdate/app_patch','AppUpdateController@appPatch');

        /* ----- 新消息列表接口 ------ */

        $api->get('/msg/class_list','MsgController@queryClassList');
        $api->get('/msg/set_all_read','MsgController@setClassAllMessageStatus');
        $api->get('/msg/msg_list','MsgController@queryClassMessageList');
        // 首页消息提醒条数
        $api->get('/index_message','MessageController@indexMessage');
        
        
        $api->get('/msg/list/trade_order','MsgController@queryTradeOrderList');
        $api->get('/msg/content/trade_order','MsgController@queryTradeOrderContent');
        $api->get('/msg/list/logistics_order','MsgController@queryLogisticsOrderList');
        $api->get('/msg/content/logistics_order','MsgController@queryLogisticsOrderContent');
        $api->get('/msg/list/system','MsgController@querySystemList');

        /* ----- end 新消息列表接口 ------ */

        $api->group(['middleware' => 'kqc.auth'], function ($api) {
            $api->get('/user_info','UserController@getUser');
            $api->post('/complete_user_info','UserController@completeUserInfo');
            // 用户重置密码接口
            $api->post('/verify/reset_password','PassportController@resetPassword');
            
            
            // 首页消息列表
            $api->get('/message/index_list','MessageController@messageList');
            // 小红点
            $api->get('/order_red','MessageController@OrderListRed');
            // 用户每日登录
            $api->post('/daily_used','UserController@dailyUsed');
            // 用户关闭推送
            $api->post('/turn_off_push','UserController@isPushOn');
            // 用户初始化个推信息
            $api->post('/set_device_info','UserController@setDeviceToken');
            // 用户提交个人认证
            $api->post('/user/apply_user_auth','UserController@submitUserAuth');
            // 用户获取企业认证信息
            $api->get('/company/company_info', 'CompanyController@getCompanyInfo');
            //保存用户通讯录
            $api->post('save_contacts/save','UserController@saveContacts');
            //判断用户是否设置过密码
            $api->get('/verify/is_password_set','PassportController@isPasswordSet');
            //用户第一次设置登录密码
            $api->post('/verify/set_password','PassportController@setPassword');
            //获取用户分享的二维码生成
            $api->get('/invite/qr_code','UserController@getQrCode');
        });
        // 需要登录 信息未完善 调用的接口
        // 个人信息查看 修改个人信息
        $api->group(['middleware' => 'kqc.auth:1'], function ($api) {
        });
//        $api->match(['get', 'post'], '/test', 'HomeController@test');
        // 不需要登录就可以调用的接口
        // 登录
        $api->match(['get', 'post'], '/login', 'PassportController@login');
        // 获取图形验证
        $api->get('/verify/captcha', 'VerifyController@sendCaptcha');
        // 验证图形验证码
        //$api->post('/verify/captcha', 'VerifyController@checkCaptcha');
        // 发送短信验证码
        $api->get('/verify/sms', 'VerifyController@sendSMSCode');
        // 验证短信验证码
        //$api->post('/verify/sms', 'VerifyController@checkSMSCode');
        // 发送语音验证码
        $api->get('/verify/voice', 'VerifyController@sendVoiceCode');
        // 验证语音验证码
        //$api->post('/verify/voice', 'VerifyController@checkVoiceCode');
        // 用户注册接口
        $api->post('/verify/register', 'PassportController@register');
        // 用户忘记密码接口
        $api->post('/verify/forgot_password','PassportController@forgotPassword');
        // 用户退出登录接口
        $api->post('/verify/login_out','PassportController@loginOut');
        //初始化七牛云的token
        $api->post('/qiniu/get_token','QiNiuController@initializeToken');
        //七牛云的回调
        $api->any('/qiniu/callback','QiNiuController@callBack');
        //七牛js获取token
        $api->post('/qiniu/get_js_token','QiNiuController@initializeJsToken');
        //短信登录接口
        $api->match(['get', 'post'], '/sms_login', 'PassportController@loginBySMS');
        //获取微信分享内容
        $api->get('/invite/wx_share','UserController@prepareWxShare');
        //分享邀请注册
        $api->post('/invite/register','PassportController@registerBySms');
        //获取验证码的到期时间
        $api->get('/verify/sms_remain','VerifyController@getSmsRemain');

        // 微信小程序登录及帐号关联
        $api->match(['get', 'post'], '/wechat_login', 'OauthController@wechatLogin');
        $api->match(['get', 'post'], '/wechat_bind', 'OauthController@wechatBind');

        // 车源宝官网 跳转链接 二维码扫描数据统计
        $api->match(['get', 'post'], '/website_statistics', 'WebsiteStatController@qrCode');

    });
    // wap 端调用的接口
    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'kqc.common:wap'], function ($api) {
//        $api->get('/', 'HomeController@index');
    });

});
