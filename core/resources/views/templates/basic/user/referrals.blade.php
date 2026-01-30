@extends('layouts.users')


@section('content')

    <body data-theme-color="color-orange">
        <div class="page-wraper">


            <style>
                .header .header-content .mid-content {
                    flex: 1;
                    text-align: left;
                }

                .header {
                    background-color: #ed7016;
                    min-height: 55px;
                    z-index: 2;
                    border-bottom: 0px solid #dddddd;
                }

                #preloader {
                    top: 0;
                }

                i.fa-solid.fa-bell {
                    font-size: 22px;
                    color: white;
                    margin-top: 12px;
                    padding-right: 7px;
                }

                i.fa-solid.fa-globe {
                    font-size: 22px;
                    color: white;
                    margin-top: 12px;
                    padding-right: 7px;
                }

                .header .sticky-header {
                    top: 0px;
                    background: #00000000;
                }

                .toast.style-1.toast-danger {
                    background-color: #1e1e1e5e;
                    color: #fff;
                    border: 0px white solid;
                    backdrop-filter: blur(5px);
                }

                .toast.style-1 .toast-body {
                    display: flex;
                    align-items: center;
                    padding: 14px;
                }

                .toast.style-1.toast-danger .toast-content strong {
                    color: #fff;
                    font-weight: 600;
                }
            </style>


            <!-- Header -->
            <header class="header">
                <div class="main-bar">
                    <div class="container">
                        <div class="header-content">

                            <div class="mid-content">
                                <h5 class="mb-0">Team</h5>
                            </div>
                            <!--              <div class="right-content">-->
                            <!--                  <a href="javascript:void(0);" class="menu-toggler">-->
                            <!--	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                            <!--		<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"/>-->
                            <!--		<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"/>-->
                            <!--	</svg>-->
                            <!--</a>-->
                            <!--              </div>-->
                        </div>
                    </div>
                </div>
            </header>





            <!--   <div id="preloader">-->
            <!--	<div class="spinner"></div>-->
            <!--</div>-->
            <meta name="theme-color" content="#fff">

            <style>
                body {
                    background: #FFF2C6;
                    background-image: url({{ asset('assets/app/img/bg.png') }});
                    background-size: 100%;
                    background-repeat: no-repeat;

                }

                .profile-header {
                    color: #3d3d3d;
                    padding: 12px 29px;
                    text-align: center;
                    border-radius: 15px;
                    background: linear-gradient(180deg, #120938, #0b0822) !important;
                    position: fixed;
                    width: 101%;
                    bottom: 54px;
                    left: 50%;
                    transform: translateX(-50%);
                }

                .text-white {
                    --bs-text-opacity: 1;
                    color: rgb(7 125 255) !important;
                    font-weight: 700;
                    font-size: 31px;
                }

                .w-32 {
                    width: 32%;
                }

                .header {
                    background: #ffffff00 !important;
                    min-height: 40px;
                    border-bottom: 0px solid #dddddd;
                    border-bottom-left-radius: 0%;
                    border-bottom-right-radius: 0%;
                }

                .common_card {
                    background: rgba(255, 255, 255, 1);
                    border-radius: 8px 8px 8px 8px;
                    padding: 15px;
                    margin-bottom: 20px;
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                }

                .common_card .common_card_content {
                    background: #FFFFFF;
                    border-radius: 8px;
                }

                .common_explain {
                    border-left: 4px solid #EBD8A3;
                    padding-left: 10px;
                    font-family: Arial, Arial;
                    font-weight: 700;
                    font-size: 18px;
                    color: #3D3D3D;
                    line-height: 21px;
                }

                .common_content {
                    margin-top: 15px;
                    font-family: Arial, Arial;
                    font-weight: 400;
                    font-size: 14px;
                    color: #2A415C;
                    line-height: 22px;
                }

                .common_content p {
                    margin-bottom: 15px;
                }

                .card-body {
                    padding: 0px 0px 7px 0px;
                }

                h5.mb-0 {
                    color: white;
                    margin-top: 3px;
                }

                .header .header-content .mid-content {
                    flex: 1;
                    text-align: center;
                }

                .code-card {
                    max-width: 735px;
                    height: 98px;
                    background: #f8cbcb;
                    background-size: 100% 100%;
                    margin-top: 10px;
                    box-sizing: border-box;
                    padding-top: 11px;
                    border-radius: 12px;
                    display: none;
                }

                .code-text {
                    font-size: 16px;
                    font-weight: 600;
                    margin-top: 5px;
                    margin-left: 10px;
                    color: #000000;
                }

                .invite-link {
                    max-width: 381px;
                    height: 60px;
                    margin-left: -30px;
                    margin-top: 4px;
                }

                .f26 {
                    font-size: 14px;
                }

                .f600 {
                    font-weight: 600;
                }

                .tooltips {
                    width: 65px;
                    height: 36px;
                    background: #000;
                    color: #fff;
                    text-align: center;
                    line-height: 36px;
                    border-radius: 8px;
                }

                div#copyBtn {
                    width: 99px;
                    height: 38px;
                    background: #ec181800;
                    color: #fff;
                    text-align: center;
                    line-height: 38px;
                    border-radius: 8px;
                }

                .d-b-cd {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                }

                .team-info {
                    max-width: 381px;
                    margin-top: -22px;
                    height: 108px;
                    column-gap: 17px;
                }

                .team-info-item {
                    width: 181px;
                    height: 76px;
                    background: #f1f2f3;
                    border-radius: 8px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 10px 0;
                    box-sizing: border-box;
                    align-content: stretch;
                }

                .level-wrap {
                    max-width: 381px;
                    height: 130px;
                    background: url({{ asset('assets/app/img/download-44-11zon.png') }}) no-repeat;
                    background-size: 100% 100%;
                    margin-top: 16px;
                    padding: 10px;
                    box-sizing: border-box;
                }

                .d-b-c {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                }

                .level-title {
                    width: 209px;
                    height: 26px;
                }

                .detail {
                    width: 64px;
                    height: 31px;
                    background: #000;
                    color: #fff;
                    text-align: center;
                    line-height: 33px;
                    border-radius: 8px;
                    font-size: 12px;
                }

                .level-bottom.d-b-c {
                    width: 100%;
                    height: 61px;
                    margin-top: 12px;
                }

                .level-bottom-item {
                    width: 142px;
                    height: 61px;
                    background: #fff;
                    border-radius: 8px;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    padding: 8px 10px;
                    box-sizing: border-box;
                }

                .profile-header {
                    display: none;
                }

                .content-inner {
                    padding-top: 40px;
                    padding-bottom: 100px;
                }

                .fb {
                    padding-bottom: 71px;
                    padding-top: 145px;
                }

                /*-------------------------------------------------------------------------------------------------------------------------------------------*/

                .team-box1 {
                    position: absolute;
                    left: 50%;
                    top: 200px;
                    transform: translateX(-50%);
                    width: 330px;
                    border-radius: 15px;
                    padding: 20px;
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                    color: #ff0000;
                    font-size: 17px;
                    margin-top: -25px;
                    border: 1px #ffffff47 solid;
                    background: #f8cbcb;
                }

                .team-box2 {
                    position: absolute;
                    top: 350px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 330px;
                    border-radius: 15px;
                    padding: 20px;
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                    color: #ff0000;
                    font-size: 17px;
                    margin-top: -34px;
                    border: 1px #ffffff47 solid;
                    background: #f8cbcb;
                }

                .team-box3 {
                    position: absolute;
                    top: 500px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 330px;
                    border-radius: 15px;
                    padding: 20px;
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                    color: #ff0000;
                    font-size: 17px;
                    margin-top: -40px;
                    border: 1px #ffffff47 solid;
                    background: #f8cbcb;
                }

                .team-box1 .row,
                .team-box2 .row,
                .team-box3 .row {
                    align-items: center;
                    font-weight: bold;
                }

                .team-box1 img,
                .team-box2 img,
                .team-box3 img {
                    height: 30px;
                }

                .team-box1 h1,
                .team-box2 h1,
                .team-box3 h1 {
                    font-size: 13px;
                    font-weight: bold;
                    pointer-events: none;
                    color: #6a6a6a;
                }

                .team-box1 .commission,
                .team-box2 .commission,
                .team-box3 .commission {
                    font-size: 11px;
                    pointer-events: none;
                    background: #ff1f1f;
                    padding: 7px 6px;
                    margin-right: 30px;
                    margin-top: -26px;
                    border-radius: 0px 0px 10px 10px;
                    border: 0px #ffffff5e solid;
                    color: #ffffff;
                    margin-left: -27px;
                    text-align: center;
                    box-shadow: rgba(255, 255, 255, 0.1) -3px -3px 9px inset, rgba(255, 255, 255, 0.15) 0 3px 9px inset,
                        rgba(255, 255, 255, 0.6) 0 1px 1px inset, rgba(0, 0, 0, 0.12) 0 -8px 36px inset, rgba(255, 255, 255, 0.6) 0 1px 5px inset, rgb(0 0 0 / 10%) 2px 19px 31px;
                }

                .balance-box,
                .team-box1,
                .team-box2,
                .team-box3,
                .team-activity-box {
                    width: calc(100% - 30px) !important;
                }

                .flex_space {
                    display: flex;
                }

                .view-button {
                    background: #ff0000;
                    color: #ffffff;
                    border: 1px #ffffff54 solid;
                    border-radius: 10px 13px 0px 14px;
                    padding: 7px 15px;
                    font-size: 0.8rem;
                    margin-top: -37px;
                    position: absolute;
                    margin-left: -19px;
                    box-shadow: rgba(255, 255, 255, 0.1) -3px -3px 9px inset, rgba(255, 255, 255, 0.15) 0 3px 9px inset,
                        rgba(255, 255, 255, 0.6) 0 1px 1px inset, rgba(0, 0, 0, 0.12) 0 -8px 36px inset, rgba(255, 255, 255, 0.6) 0 1px 5px inset, rgb(0 0 0 / 10%) 2px 19px 31px;
                }


                .statistics p {
                    font-size: 8px;
                    font-weight: bold;
                    pointer-events: none;
                }

                .tasks_lottery_card {
                    /*border-radius: 16px;*/
                    background-image: url("/public/v1/img/tasks/lottery_bg.png");
                    background-size: 100%;
                    background-repeat: no-repeat;
                    height: 105px;
                    padding: 10px;
                    margin-bottom: 15px;
                    display: block;
                }

                .tasks_lottery_card .title {
                    font-weight: 700;
                    font-size: 16px;
                    color: #372F2D;
                    line-height: 18px;
                    margin-bottom: 5px;
                }

                .tasks_lottery_card .desc {
                    font-weight: 400;
                    font-size: 14px;
                    color: #333333;
                    line-height: 20px;
                    text-align: left;
                    width: 221px;
                }

                .tasks_lottery_card .go_lottery {
                    margin-top: 15px;
                    width: 50px;
                    height: 18px;
                    padding: 4px 10px;
                    background: linear-gradient(270deg, #FD6035 0%, #F1993B 100%);
                    border-radius: 100px 100px 100px 100px;
                    font-weight: 700;
                    font-size: 16px;
                    color: #FFFFFF;

                }

                .tasks_lottery_card img {
                    width: 18px;
                    height: 18px;
                    display: inline-block;
                    line-height: 18px;
                }

                .tasks_invite_rewards {
                    background: linear-gradient(180deg, #FFFCE2 0%, #FFFDEF 49%, #FFFFFF 97%);
                    border: 2px solid #FFFFFF;
                    border-radius: 16px;
                    padding: 15px;
                }

                .tasks_invite_rewards .title {
                    font-weight: 700;
                    font-size: 18px;
                    color: #07262C;
                }

                .invite_friends_card {

                    background: #FFF9DA;
                    box-shadow: 0px 4px 16px 0px rgba(255, 205, 119, 0.2);
                    border-radius: 8px 8px 8px 8px;
                    border: 2px solid #FFFFFF;
                    padding: 15px 10px;
                }

                .invite_friends_card_item {
                    width: 33%;
                    height: 40px;
                }

                .invite_friends_card_item .value {
                    font-weight: 700;
                    font-size: 16px;
                    color: #07262C;
                    line-height: 18px;
                }

                .invite_friends_card_item .label {
                    font-weight: 400;
                    font-size: 12px;
                    color: #3D3D3D;
                    line-height: 16px;
                    margin-top: 5px;
                }

                .invite_friends_card_item img {
                    width: 36px;
                    height: 36px;
                }

                .team_level_card {
                    margin-top: 15px;
                }

                .team_level_title {
                    font-weight: 700;
                    font-size: 16px;
                    color: #3D3D3D;
                    line-height: 18px;
                    text-align: left;
                }

                .team_level_details {
                    font-weight: 400;
                    font-size: 12px;
                    color: #888888;
                    line-height: 18px;
                }

                .team_level_item_card {
                    width: 100%;
                    height: 80px;
                    background: #FFFCED;
                    border-radius: 8px 8px 8px 8px;
                    border: 2px solid #FFD68E;

                    margin: 10px 0;
                }

                .team_level_item_list {
                    width: 100%;
                }

                .team_level_item {
                    width: 33%;
                    padding: 20px 0;
                }

                .team_level_img {
                    height: 67px;
                    width: 50px;
                    margin: 0 10px;
                }

                .tasks_reward_text_card {
                    background: linear-gradient(180deg, #FFFCE4 0%, #FFFEF8 53%, #FFFFFF 100%);
                    border-radius: 12px 12px 12px 12px;
                    border: 2px solid #FFFFFF;
                    margin: 15px;
                    padding: 15px;
                    margin-bottom: 80px;
                    margin-top: 0px;
                }

                .tasks_reward_title {
                    font-weight: 700;
                    font-size: 18px;
                    color: #07262C;
                    text-align: left;
                    margin-bottom: 10px;
                }

                .tasks_reward_text {
                    font-family: PingFang SC, PingFang SC;
                    font-weight: 400;
                    font-size: 14px;
                    color: #07262C;
                    line-height: 26px;
                    text-align: left;
                    margin-bottom: 10px;
                }

                .backbutton {
                    width: 36px;
                    height: 36px;
                    background: #ffffff1c;
                    border-radius: 12px 12px 12px 12px;
                    border: 1px solid #ffffff80;
                    line-height: 36px;
                    text-align: center;
                    position: absolute;
                    top: 20px;
                    left: 15px;
                    color: white;
                }
            </style>
            <div class="page-content">

                <div class="content-inner pt-0">
                    <div class="container fb">

                        <div class="tasks_invite_rewards" bis_skin_checked="1">
                            <div class="flex_space" bis_skin_checked="1">
                                <div bis_skin_checked="1">
                                    <div class="title" bis_skin_checked="1">
                                        Invite rewards
                                    </div>
                                    <div style="width: 126px;height: 6px;background: linear-gradient( 90deg, #FFF077 0%, rgba(255,255,255,0) 100%);border-radius: 4px 4px 4px 4px;"
                                        bis_skin_checked="1"></div>
                                    <div class="text"
                                        style="font-weight: 400;font-size: 14px;color: #666666;margin-top: 10px;"
                                        bis_skin_checked="1">
                                        Invest together, get rich together
                                    </div>
                                </div>
                                <img src="{{ asset('assets/app/img/happy.png') }}"
                                    style="height: 68px;width: 118px">
                            </div>

                            <div id="invite_friends_card" bis_skin_checked="1">
                                <div class="invite_friends_card flex_space" bis_skin_checked="1">
                                    <div class="invite_friends_card_item" bis_skin_checked="1">
                                        <div class="value commission_amount" bis_skin_checked="1">{{ $general->cur_sym }}{{ number_format($level1_bonus+$level2_bonus+$level3_bonus) }}</div>
                                        <div class="label" bis_skin_checked="1">Commission</div>
                                    </div>
                                    <div class="invite_friends_card_item" bis_skin_checked="1">
                                        <div class="value invite_code" bis_skin_checked="1">{{ auth()->user()->ref_code }}</div>
                                        <div class="label" bis_skin_checked="1">Invite Code</div>
                                    </div>
                                    <div id="copyBtn" class="copy"
                                        onclick="copyToClipboard('inviteLink') "
                                        style="justify-content: center" bis_skin_checked="1"> <img
                                            src="{{ asset('assets/app/img/link.png') }}"
                                            id="copy" style="margin-right: 10px;width: 40px;"> <img src="	"
                                            id="poster"> </div>
                                </div>
                            </div>
                            <div id="team_level_card" bis_skin_checked="1">
                                <div class="team_level_card" bis_skin_checked="1">
                                    <a href="#" class="flex_space" bis_skin_checked="1">
                                        <div class="team_level_title" bis_skin_checked="1">Team Level</div>
                                        <!--<div class="team_level_details" bis_skin_checked="1">Team Detalls &gt;</div>-->
                                    </a>
                                    <div class="team_level_item_card flex_space" bis_skin_checked="1"> <img
                                            src="{{ asset('assets/app/img/lv1.png') }}"
                                            class="team_level_img">
                                        <div class="team_level_item_list flex_space" bis_skin_checked="1">
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Rebate</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->lv1 }}%</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Recharge</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->cur_sym }}{{ number_format(teamDeposit($user->id, 1)) }}</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Members</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $level1->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team_level_item_card flex_space" bis_skin_checked="1"> <img
                                            src="{{ asset('assets/app/img/lv2.png') }}"
                                            class="team_level_img">
                                        <div class="team_level_item_list flex_space" bis_skin_checked="1">
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Rebate</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->lv2 }}%</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Recharge</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->cur_sym }}{{ number_format(teamDeposit($user->id, 2)) }}</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Members</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $level2->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team_level_item_card flex_space" bis_skin_checked="1"> <img
                                            src="{{ asset('assets/app/img/lv3.png') }}"
                                            class="team_level_img">
                                        <div class="team_level_item_list flex_space" bis_skin_checked="1">
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Rebate</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->lv3 }}%</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Recharge</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $general->cur_sym }}{{ number_format(teamDeposit($user->id, 3)) }}</div>
                                            </div>
                                            <div class="team_level_item" bis_skin_checked="1">
                                                <div class="team_level_details" bis_skin_checked="1">Members</div>
                                                <div class="team_level_title" bis_skin_checked="1">{{ $level3->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="profile-header bg-primary">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-4">
                                        <p class="mb-1" style="color: white;font-weight: bold;"><i
                                                class="fa-solid fa-envelope"></i> Invite Link</p>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                value="{{ route('home') }}?shareCode={{ auth()->user()->ref_code }}"
                                                id="inviteLink" readonly="">
                                            <button class="btn btn-outline-primary"
                                                onclick="copyToClipboard('inviteLink')">Copy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="code-card">

                            <div class="invite-link d-b-c" style="margin-left: -19px;">
                                <div>
                                    <div class="f26">Invitation Code</div>
                                    <div class="f34 f600 mt10" id="inviteCode">
                                        {{ auth()->user()->ref_code }} </div>
                                </div>
                                <div id="copyBtn" class="invite-copy"
                                    onclick="copyToClipboard(document.getElementById('inviteLink').value)"
                                    style="margin-left: 47px;">Copy</div>
                            </div>
                        </div>

                        <div class="title-bar mt-3">
                            <p class="backbutton" onclick="navigate('/home/');">
                                <i class="fa-solid fa-chevron-left" style="color: white;"></i>
                            </p>

                            <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
                        </div>







                    </div>
                </div>
            </div>



            <!-----------------------------------------------------------------------3-Level--------------------------------------------------------------------------------------------------->


            <script>
                // function copyToClipboard(elementId) {
                //     const input = document.getElementById(elementId);
                //     input.select();
                //     input.setSelectionRange(0, 99999); // For mobile devices

                //     try {
                //         document.execCommand("copy");
                //         notify("Copied Successfully!");
                //     } catch (err) {
                //         notify("Failed to copy text.");
                //     }

                //     // Optional: Unselect text after copy
                //     window.getSelection().removeAllRanges();
                // }

                function shareLink() {
                    const url = '{{ route('home') }}?shareCode={{ auth()->user()->ref_code }}';
                    if (navigator.share) {
                        navigator.share({
                            title: "Join {{ $general->sitename }}  Family",
                            text: "Use my referral code and join the app to earn rewards.",
                            url: url,
                        }).catch(console.error);
                    } else {
                        notify("error", "error while sharing");
                    }
                }
            </script>


        </div>
        </div>
        </div>


        <style>
            .menubar-area .toolbar-inner .nav-link.active:after,
            .menubar-area .toolbar-inner .menu-toggler.active:after {
                content: "";
                position: absolute;
                bottom: -11px;
                height: 5px;
                background: #340166;
            }

            .menubar-area {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #fff;
                padding: 20px;
                z-index: 999;
                padding-top: 12px !important;
                padding-bottom: 10px !important;
                border-radius: 8px 8px 0px 0px;
                box-shadow: 0 12px 26px 0 rgba(0, 0, 0, 0.3);
            }

            a:hover,
            a:focus,
            .fa-solid,
            a.active,
            .fa-solid.active {
                text-decoration: none;
                outline: none;
                color: var(--primary-hover);
            }
        </style>




        </div>

    </body>

    <script>
        function copyToClipboard(elementId) {
            const input = document.getElementById(elementId);

            // Create a temporary input to ensure compatibility
            const tempInput = document.createElement("input");
            tempInput.style.position = "absolute";
            tempInput.style.left = "-9999px";
            tempInput.value = input.value;
            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                const successful = document.execCommand("copy");
                if (successful) {
                    message("Copied Successfully!");
                } else {
                    alert("Copy command failed.");
                }
            } catch (err) {
                console.error("Copy error:", err);
                alert("Failed to copy.");
            }

            document.body.removeChild(tempInput);
        }
    </script>
@endsection
