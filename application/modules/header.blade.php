<!-- secondary sidebar -->
<aside id="sidebar_secondary" class="tabbed_sidebar">
    <ul class="uk-tab uk-tab-icons uk-tab-grid" data-uk-tab="{connect:'#dashboard_sidebar_tabs', animation:'slide-horizontal'}">
        <li class="uk-active uk-width-1-2"><a href="#"><i class="material-icons">&#xE422;</i></a></li>
        <li class="uk-width-1-2 chat_sidebar_tab"><a href="#"><i class="material-icons">&#xE0B7;</i></a></li>
    </ul>

    <div class="scrollbar-inner">
        <ul style="margin-top:40px;" id="dashboard_sidebar_tabs" class="uk-switcher">
            <li>
                <div class="timeline timeline_small uk-margin-bottom">
                    @php
                        $notif = get_instance()->base_config->notificationlist();
                        $nonotif2 =false;
                    @endphp
                    @foreach($notif as $notifval2)
                        @if($notifval2->notification_type  == 'timeline')
                            @php $nonotif2 =true   @endphp
                            <div class="timeline_item">
                                <div class="timeline_icon timeline_icon_success"><i class="material-icons">@if($notifval2->notification_icon == 'update') &#xE150; @elseif($notifval2->notification_icon == 'delete') &#xE15C; @else &#xE147; @endif</i></div>
                                <div class="timeline_date">
                                    {{ get_instance()->base_config->timeAgo($notifval2->notification_date) }}
                                </div>
                                <div class="timeline_content">{!! $notifval2->notification_desc !!}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </li>
            <li>
                <ul class="md-list md-list-addon ">
                    @php
                        $userpanellist = get_instance()->base_config->userpanellist();
                    @endphp
                    @foreach($userpanellist as $user)
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-@if($user->active == 1) success @else danger @endif"></span>
                                <img class="md-user-image md-list-addon-avatar" src="img/load/80/80/crop/{{ $user->user_avatar }}" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading">{{ $user->user_display_name }}</span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate">{{ $user->user_company }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <button type="button" class="chat_sidebar_close uk-close"></button>
    <div class="chat_submit_box">
        <div class="uk-input-group">
            <input type="text" class="md-input" name="submit_message" id="submit_message" placeholder="Send message">
            <span class="uk-input-group-addon">
                    <a href="#"><i class="material-icons md-24">&#xE163;</i></a>
                </span>
        </div>
    </div>
</aside>
<!-- secondary sidebar end -->