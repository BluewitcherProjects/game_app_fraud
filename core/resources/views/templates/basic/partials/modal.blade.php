<!-- Overlay -->
                        <div class="van-overlay" role="button" tabindex="0" data-v-5b4aea95="" id="overlay"
                            style="z-index: 2002; display: none;"></div>

                        <!-- Popup -->
                        <div role="dialog" tabindex="0" class="van-popup van-popup--left p_tb20 p_lr10"
                            data-v-5b4aea95="" id="settingsPopup"
                            style="z-index: 2002; width: 70%; height: 100%; display: none;">
                            <div data-v-5b4aea95="" class="setPopup">
                                <div data-v-5b4aea95="" class="userCard vertical m_tb20 p_lr5">
                                    <div data-v-5b4aea95="" class="van-image"
                                        style="width: 4rem; height: 4rem; overflow: hidden; border-radius: 1.3rem;"><img
                                            src="{{ asset('images/user/3.png') }}" class="van-image__img"
                                            style="object-fit: cover;"><!----><!----></div>
                                    <!--<div data-v-5b4aea95="" class="userInfo">-->
                                    <!--    <p data-v-5b4aea95=""><span data-v-5b4aea95="">You haven't set a nickname yet</span>-->
                                    <!--    </p>-->
                                    <!--</div>-->
                                </div>
                                <div data-v-5b4aea95="" class="setNav">
                                    <ul data-v-5b4aea95="" class="cell">
                                        <li data-v-5b4aea95="" class="display alignCenter p_lr5">
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1"><span
                                                        data-v-5b4aea95="">Phone number</span></div>
                                                <div data-v-5b4aea95="" class="contInfo">
                                                    <p data-v-5b4aea95="">{{ auth()->user()->mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li data-v-5b4aea95="" class="display alignCenter p_lr5">
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1"><span
                                                        data-v-5b4aea95="">User ID</span></div>
                                                <div data-v-5b4aea95="" class="contInfo">
                                                    <p data-v-5b4aea95="">{{ auth()->user()->ref_code }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <!--<li data-v-5b4aea95="" class="display alignCenter p_lr5">-->
                                        <!--    <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">-->
                                        <!--        <div data-v-5b4aea95="" class="titleLabel flex1"><span-->
                                        <!--                data-v-5b4aea95="">E-mail</span></div>-->
                                        <!--        <div data-v-5b4aea95="" class="contInfo"><span data-v-5b4aea95="">You-->
                                        <!--                haven't filled in your email</span></div>-->
                                        <!--    </div>-->
                                        <!--</li>-->
                                    </ul>
                                    <ul data-v-5b4aea95="" class="cell">
                                        <li onclick="window.location.href='{{ route('user.profile.setting') }}';" data-v-5b4aea95="" class="display alignCenter alignStretch p_tb20 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-user-6-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Userinfo</p>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>
                                        <li onclick="window.location.href='{{ route('user.change.password') }}';" data-v-5b4aea95="" class="display alignCenter alignStretch p_tb20 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-lock-password-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Login Password</p>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>
                                        {{--  <li data-v-5b4aea95=""
                                            class="setPayPWD display alignCenter alignStretch p_tb20 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-shield-keyhole-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Trade Password</p><!---->
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>  --}}
                                    </ul>
                                    <ul data-v-5b4aea95="" class="cell">
                                        <li onclick="window.location.href='https://t.me/chevroncorpproduction';" data-v-5b4aea95="" class="display alignCenter alignStretch p_tb10 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-question-answer-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Service Online</p><span
                                                        data-v-5b4aea95="">Servicing time 09:00 to 18:00</span>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>
                                        {{--  <li data-v-5b4aea95="" class="display alignCenter alignStretch p_tb10 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-chat-quote-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">My apply</p>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>  --}}
                                        {{--  <li data-v-5b4aea95="" class="display alignCenter alignStretch p_tb10 p_lr5">
                                            <div data-v-5b4aea95="" class="icon"><i data-v-5b4aea95=""
                                                    class="ri-chat-new-line"></i></div>
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Self-service</p>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-arrow-right-line"></i></div>
                                            </div>
                                        </li>  --}}
                                    </ul>
                                    <ul onclick="window.location.href='{{ route('user.logout') }}';" data-v-5b4aea95="" class="cell">
                                        <li data-v-5b4aea95=""
                                            class="logOut display alignCenter alignStretch p_tb10 p_lr5">
                                            <div data-v-5b4aea95="" class="infoBar display alignCenter flex1">
                                                <div data-v-5b4aea95="" class="titleLabel flex1">
                                                    <p data-v-5b4aea95="">Log out</p>
                                                </div>
                                                <div data-v-5b4aea95="" class="more"><i data-v-5b4aea95=""
                                                        class="ri-logout-box-r-line"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
