<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
            <i class="fas fa-desktop"></i>
            </div>
        </a>
        <a class="simple-text logo-normal">
            {{ __('Computer Repair') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href=" {{ route('home') }} ">
                    <i class="fas fa-home"></i>
                    <p>{{ __('Home') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="fas fa-cube"></i>
                    <p>
                            {{ __('classroom') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == '1' ? 'active' : '' }}"  >
                            <a href="{{ route('classroom.index', '1') }}">   <!--回傳變數以辨別教室名稱-->
                                <i class="fas fa-dice-one"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（一）') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == '2' ? 'active' : '' }}" id="2" >
                            <a href="{{ route('classroom.index', '2') }}">
                            <i class="fas fa-dice-two"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（二）') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == '3' ? 'active' : '' }}">
                            <a href="{{ route('classroom.index', '3') }}">
                            <i class="fas fa-dice-three"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（三）') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == '4' ? 'active' : '' }}">
                            <a href="{{ route('classroom.index', '4') }}">
                            <i class="fas fa-dice-four"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（四）') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == '5' ? 'active' : '' }}">
                            <a href="{{ route('classroom.index', '5') }}">
                            <i class="fas fa-dice-five"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（五）') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == '6' ? 'active' : '' }}">
                            <a href="{{ route('classroom.index', '6') }}">
                            <i class="fas fa-dice-six"></i>
                                <span class="sidebar-normal">{{ __('電腦教室（六）') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'patrol' ? 'active' : '' }}">
                <a href="{{ route('patrol.index') }}">
                    <i class="fas fa-walking"></i>
                    <p>{{ __('Patrol') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'schedule' ? 'active' : '' }}">
                <a href="{{ route('schedule.index') }}">
                    <i class="fas fa-briefcase"></i>
                    <p>{{ __('Work Schedule') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'lost_property' ? 'active' : '' }}">
                <a href="{{ route('property.index') }}">
                    <i class="fas fa-box-open"></i>
                    <p>{{ __('Lost Property') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
