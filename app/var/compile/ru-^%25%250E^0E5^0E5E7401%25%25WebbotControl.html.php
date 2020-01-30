<?php /* Smarty version 2.6.13, created on 2019-11-28 14:24:59
         compiled from /home/c484884/gastreet.com/www/app/Templates/WebbotControl.html */ ?>
<div class="webbot">
    <?php echo '
        <style>
            .g-chat-paranja, .g-chat-paranja *, .g-chat-popup, .g-chat-popup *, .g-chat-widget, .g-chat-widget * {
                font-family: YS Text Chat Widget, Helvetica Neue, Helvetica, Arial, sans-serif;
                font-weight: 400;
                font-style: normal;
                line-height: normal;
                position: static;
                z-index: auto;
                top: auto;
                right: auto;
                bottom: auto;
                left: auto;
                display: block;
                overflow: visible;
                clip: auto;
                zoom: normal;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                min-width: 0;
                max-width: none;
                height: auto;
                min-height: 0;
                max-height: none;
                margin: 0;
                padding: 0;
                resize: none;
                cursor: auto;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-animation: 0s none;
                animation: 0s none;
                text-align: left;
                text-decoration: none;
                text-indent: 0;
                letter-spacing: normal;
                word-spacing: normal;
                text-transform: none;
                -o-text-overflow: clip;
                text-overflow: clip;
                word-wrap: normal;
                word-break: normal;
                opacity: 1;
                color: inherit;
                border: 0;
                outline: 0 none;
                background: none;
                -webkit-box-shadow: none;
                box-shadow: none;
                text-shadow: none;
                direction: ltr;
                -webkit-flex: none;
                -ms-flex: none;
                flex: none;
                -webkit-justify-content: flex-start;
                -ms-flex-pack: start;
                justify-content: flex-start;
                -o-object-fit: fill;
                object-fit: fill;
                -webkit-order: 1;
                -ms-flex-order: 1;
                order: 1;
                -webkit-perspective: none;
                perspective: none;
                unicode-bidi: normal;}
            .g-chat-popup iframe {
                position: absolute!important;
                height: calc(100% + 110px)!important;
                bottom: 0!important;}
            @font-face {
                font-family: YS Text Chat Widget;
                src:url(//yastatic.net/s3/home/fonts/ys/1/text-medium.woff2) format("woff2"),
                    url(//yastatic.net/s3/home/fonts/ys/1/text-medium.woff) format("woff");
                font-weight: 500;
                font-style: normal;
                font-stretch: normal;}
            .g-chat-disable-page-scroll {
                overscroll-behavior: none;
                overflow: hidden;}
            .g-chat-disable-page-scroll_ios {
                position: fixed;
                left: 0;
                top: 0;
                right: 0;}
            .g-chat-widget__mount {
                position: relative;
                -webkit-flex: 1 1;
                -ms-flex: 1 1;
                flex: 1 1;
                width: 100%;
                visibility: hidden;
                -webkit-transition: visibility .4s ease;
                -o-transition: visibility ease .4s;
                transition: visibility .4s ease;}
            .g-chat-widget__mount_visible {
                visibility: visible;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;}
            .g-chat-widget_theme_legacy {
                position: relative;
                width: 35px;
                height: 35px;}
            .g-chat-widget_theme_dark, .g-chat-widget_theme_light {
                position: fixed;
                top: auto;
                right: 15px;
                bottom: 15px;
                z-index: 10000;}
            .g-chat-widget_theme_dark.g-chat-widget_desktop, .g-chat-widget_theme_light.g-chat-widget_desktop {
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-align-items: flex-end;
                -ms-flex-align: end;
                align-items: flex-end;
                -webkit-justify-content: flex-end;
                -ms-flex-pack: end;
                justify-content: flex-end;
                min-width: 40px;
                height: 40px;
                -webkit-box-shadow: 0 6px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);
                box-shadow: 0 6px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);
                border-radius: 24px;
                -webkit-transition: min-width .4s ease, height .4s ease, max-height .4s ease, border-radius .4s ease, -webkit-box-shadow .4s ease;
                transition: min-width .4s ease, height .4s ease, max-height .4s ease, border-radius .4s ease, -webkit-box-shadow .4s ease;
                -o-transition: min-width .4s ease, height .4s ease, max-height .4s ease, box-shadow .4s ease, border-radius .4s ease;
                transition: min-width .4s ease, height .4s ease, max-height .4s ease, box-shadow .4s ease, border-radius .4s ease;
                transition: min-width .4s ease, height .4s ease, max-height .4s ease, box-shadow .4s ease, border-radius .4s ease, -webkit-box-shadow .4s ease;}
            @media screen and (max-height:560px) {
                .g-chat-widget_theme_dark.g-chat-widget_desktop, .g-chat-widget_theme_light.g-chat-widget_desktop {
                    max-height: calc(100vh - 40px);}
            }
            .g-chat-widget_theme_dark.g-chat-widget_desktop.g-chat-widget_visible, .g-chat-widget_theme_light.g-chat-widget_desktop.g-chat-widget_visible {
                min-width: 400px;
                max-width: calc(100vw - 30px);
                height: 520px;
                max-height: calc(100vh - 40px);
                -webkit-box-shadow: 0 10px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);
                box-shadow: 0 10px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);
                border-radius: 8px;}
            .g-chat-widget_theme_dark.g-chat-widget_desktop.g-chat-widget_theme_light, .g-chat-widget_theme_light.g-chat-widget_desktop.g-chat-widget_theme_light {
                background-color: #fff;}
            .g-chat-widget_theme_dark.g-chat-widget_desktop.g-chat-widget_theme_dark, .g-chat-widget_theme_light.g-chat-widget_desktop.g-chat-widget_theme_dark {
                background-color: #292c33;}
            .g-chat-widget_theme_dark.g-chat-widget_size_large, .g-chat-widget_theme_light.g-chat-widget_size_large {
                min-width: 60px;
                height: 60px;
                border-radius: 36px;}
            .g-chat-widget_theme_hidden {
                position: fixed;
                top: auto;
                right: 20px;
                bottom: 20px;
                z-index: 10000;}
            .g-chat-paranja {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 10005;
                display: none;
                visibility: hidden;
                -webkit-transition: opacity .32s ease .08s, visibility 0s ease .4s;
                -o-transition: opacity .32s ease .08s, visibility 0s ease .4s;
                transition: opacity .32s ease .08s, visibility 0s ease .4s;
                opacity: 0;
                background-color: rgba(0, 0, 0, .56);
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
            .g-chat-paranja_visible {
                visibility: visible;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;
                opacity: 1;}
            .g-chat-paranja_mobile {
                display: block;}
            .g-chat-popup {
                z-index: 10010;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                visibility: hidden;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                opacity: 0;
                -webkit-flex: 1 1 auto;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
                -webkit-transition: opacity .32s ease .08s, visibility 0s ease .4s;
                -o-transition: opacity .32s ease .08s, visibility 0s ease .4s;
                transition: opacity .32s ease .08s, visibility 0s ease .4s;}
            .g-chat-popup:before {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                content: "";
                background: #fff;}
            .g-chat-popup_mobile.g-chat-popup:before {
                top: 8px;}
            .g-chat-popup_position_static {
                position: absolute;
                bottom: 0;
                right: 0;}
            .g-chat-popup_position_target {
                position: fixed;
                left: -9999px;
                top: -9999px;}
            .g-chat-popup_position_absolute {
                position: absolute;
                left: -9999px;
                top: -9999px;}
            .g-chat-popup_fullscreen, .g-chat-popup_position_fixed {
                position: fixed;
                left: 0;
                top: 40px;
                bottom: 0;
                right: 0;
                border-radius: 0;
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
                overflow: visible;}
            .g-chat-popup_visible {
                visibility: visible;
                opacity: 1;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;
                -webkit-transform: translateY(0);
                transform: translateY(0);}
            .g-chat-popup.g-chat-popup_visible.g-chat-popup_fullscreen {
                width: 100%;
                height: 100%;
                max-height: 100%;
                top: 0;
                border-radius: 0;}
            .g-chat-popup_mobile {
                -webkit-transition-duration: .4s, .32s, 0s;
                -o-transition-duration: .4s, .32s, 0s;
                transition-duration: .4s, .32s, 0s;}
            .g-chat-popup_mobile.g-chat-popup_visible {
                -webkit-transition-delay: 0s, .08s, 0s;
                -o-transition-delay: 0s, .08s, 0s;
                transition-delay: 0s, .08s, 0s;}
            .g-chat-popup_theme_hidden.g-chat-popup_desktop, .g-chat-popup_theme_legacy.g-chat-popup_desktop {
                overflow: visible;
                border: none;
                border-radius: 4px;
                -webkit-box-shadow: 0 1.5ex 2ex -1ex rgba(0, 0, 0, .3);
                box-shadow: 0 1.5ex 2ex -1ex rgba(0, 0, 0, .3);
                width: 420px;
                height: 600px;}
            .g-chat-popup_theme_hidden.g-chat-popup_desktop:before, .g-chat-popup_theme_legacy.g-chat-popup_desktop:before {
                border-radius: 4px;
                -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, .05);
                box-shadow: 0 0 0 1px rgba(0, 0, 0, .05);}
            .g-chat-popup_theme_hidden.g-chat-popup_desktop {
                max-height: calc(100vh - 40px);}
            .g-chat-popup_theme_legacy.g-chat-popup_desktop {
                max-height: calc(100vh - 80px);}
            .g-chat-popup_theme_dark, .g-chat-popup_theme_hidden.g-chat-popup_mobile, .g-chat-popup_theme_legacy.g-chat-popup_mobile, .g-chat-popup_theme_light {
                -webkit-transition-timing-function: ease, ease-in, ease;
                -o-transition-timing-function: ease, ease-in, ease;
                transition-timing-function: ease, ease-in, ease;
                -webkit-transition-property: opacity, visibility, -webkit-transform;
                transition-property: opacity, visibility, -webkit-transform;
                -o-transition-property: transform, opacity, visibility;
                transition-property: transform, opacity, visibility;
                transition-property: transform, opacity, visibility, -webkit-transform;
                -webkit-transition-delay: 0s, 0s, .4s;
                -o-transition-delay: 0s, 0s, .4s;
                transition-delay: 0s, 0s, .4s;}
            .g-chat-popup_theme_dark.g-chat-popup_desktop, .g-chat-popup_theme_light.g-chat-popup_desktop {
                overflow: hidden;
                width: 100%;
                height: 100%;
                border-radius: inherit;
                -webkit-transition-duration: .4s, .16s, 0s;
                -o-transition-duration: .4s, .16s, 0s;
                transition-duration: .4s, .16s, 0s;}
            .g-chat-popup_theme_dark.g-chat-popup_desktop.g-chat-popup_visible, .g-chat-popup_theme_light.g-chat-popup_desktop.g-chat-popup_visible {
                -webkit-transition-delay: 0s, .24s, 0s;
                -o-transition-delay: 0s, .24s, 0s;
                transition-delay: 0s, .24s, 0s;}
            .g-chat-badge {
                position: absolute;
                -webkit-transition: -webkit-transform .08s ease-out;
                transition: -webkit-transform .08s ease-out;
                -o-transition: transform .08s ease-out;
                transition: transform .08s ease-out;
                transition: transform .08s ease-out, -webkit-transform .08s ease-out;
                -webkit-transform: scale(0);
                transform: scale(0);}
            .g-chat-badge_has-count {
                -webkit-transform: scale(1);
                transform: scale(1);}
            .g-chat-badge_type_dot {
                bottom: auto;
                left: auto;
                width: 8px;
                height: 8px;
                -webkit-box-sizing: content-box;
                box-sizing: content-box;
                border: 2px solid #fff;
                border-radius: 50%;
                background-clip: padding-box;
                background-color: red;}
            .g-chat-badge_type_dot .g-chat-badge__count {
                display: none;}
            .g-chat-badge__count {
                font-size: 13px;
                font-weight: 700;
                line-height: 15px;
                color: #fff;
                vertical-align: middle;
                text-align: center;
                border-radius: 15px;
                cursor: pointer;
                padding: 0 4px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                background-color: red;}
            .g-chat-badge_theme_legacy {
                top: 3px;
                right: 3px}
            .g-chat-badge_theme_dark, .g-chat-badge_theme_light {
                top: -3px;
                right: -3px;}
            .g-chat-button {
                display: block;
                visibility: visible;
                cursor: pointer;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                -webkit-user-select: none;}
            .g-chat-button * {
                color: #4e66ff!important;}
            .g-chat-button_mobile {
                top: 12px;
                left: 12px;}
            .g-chat-button__container {
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;}
            .g-chat-button__container, .g-chat-button__text {
                overflow: hidden;
                cursor: pointer;}
            .g-chat-button__text {
                -webkit-flex: 1 1 auto;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;}
            .g-chat-button__text-container {
                overflow: hidden;
                padding-left: 8px;
                font-size: 14px;
                font-weight: 500;
                line-height: 40px;
                vertical-align: middle;
                white-space: nowrap;
                -o-text-overflow: ellipsis;
                text-overflow: ellipsis;
                cursor: pointer;}
            .g-chat-button_theme_legacy {
                width: 100%;
                height: 100%;}
            .g-chat-button_theme_legacy .g-chat-button__container {
                padding: 0 7px;
                height: 100%;}
            .g-chat-button_theme_legacy .g-chat-button__text {
                display: none;}
            .g-chat-button_theme_legacy .g-chat-icon {
                width: 21px;
                height: 21px;}
            .g-chat-button_theme_legacy:active .g-chat-icon {
                -webkit-transform: scale(.9);
                transform: scale(.9);}
            .g-chat-button_theme_dark, .g-chat-button_theme_light {
                position: relative;
                -webkit-transition: opacity .32s ease .08s;
                -o-transition: opacity .32s ease .08s;
                transition: opacity .32s ease .08s;}
            .g-chat-button_theme_dark.g-chat-button_hidden, .g-chat-button_theme_light.g-chat-button_hidden {
                opacity: 0;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;
                visibility: hidden!important;}
            .g-chat-button_theme_dark .g-chat-button__container, .g-chat-button_theme_light .g-chat-button__container {
                vertical-align: top;
                white-space: nowrap;
                padding-left: 12px;
                padding-right: 16px;
                height: 40px;
                max-width: 280px;
                -webkit-transition: padding .4s ease, max-width .4s ease;
                -o-transition: padding .4s ease, max-width .4s ease;
                transition: padding .4s ease, max-width .4s ease;
                -webkit-transform-origin: 100% 50%;
                transform-origin: 100% 50%;
                border-radius: 24px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;}
            .g-chat-button_theme_dark .g-chat-button__container_size_large, .g-chat-button_theme_light .g-chat-button__container_size_large {
                height: 60px;
                max-width: 420px;
                border-radius: 36px;}
            .g-chat-button_theme_dark.g-chat-button_desktop .g-chat-button__container:after, .g-chat-button_theme_light.g-chat-button_desktop .g-chat-button__container:after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: calc(100% + 20px);
                height: calc(100% + 20px);}
            .g-chat-button_theme_dark.g-chat-button_mobile .g-chat-button__container, .g-chat-button_theme_light.g-chat-button_mobile .g-chat-button__container {
                -webkit-box-shadow: 0 6px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);
                box-shadow: 0 6px 20px -5px rgba(0, 0, 0, .4), 0 0 0 1px rgba(0, 0, 0, .06);}
            .g-chat-button_theme_dark.g-chat-button_mobile .g-chat-button__container:after, .g-chat-button_theme_light.g-chat-button_mobile .g-chat-button__container:after {
                content: "";
                position: absolute;
                left: -12px;
                top: -12px;
                width: calc(100% + 24px);
                height: calc(100% + 24px);}
            .g-chat-button_theme_dark.g-chat-button_collapsed_always .g-chat-button__container, .g-chat-button_theme_light.g-chat-button_collapsed_always .g-chat-button__container {
                padding-left: 8px;
                padding-right: 8px;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_always .g-chat-button__container_size_large, .g-chat-button_theme_light.g-chat-button_collapsed_always .g-chat-button__container_size_large {
                padding-left: 12px;
                padding-right: 12px;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_always .g-chat-button__text, .g-chat-button_theme_light.g-chat-button_collapsed_always .g-chat-button__text {
                display: none;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_hover .g-chat-button__text, .g-chat-button_theme_light.g-chat-button_collapsed_hover .g-chat-button__text {
                -webkit-transition: opacity .4s ease;
                -o-transition: opacity .4s ease;
                transition: opacity .4s ease;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__container, .g-chat-button_theme_light.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__container {
                max-width: 40px;
                padding-left: 8px;
                padding-right: 8px;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__container_size_large, .g-chat-button_theme_light.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__container_size_large {
                max-width: 60px;
                padding-left: 12px;
                padding-right: 12px;}
            .g-chat-button_theme_dark.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__text, .g-chat-button_theme_light.g-chat-button_collapsed_hover:not(:hover) .g-chat-button__text {
                opacity: 0;}
            .g-chat-button_theme_light .g-chat-button__container {
                background-color: #fff;}
            .g-chat-button_theme_light .g-chat-button__text {
                color: #292c33;}
            .g-chat-button_theme_dark .g-chat-button__container {
                background-color: #292c33;}
            .g-chat-button_theme_dark .g-chat-button__text {
                color: #fff;}
            .g-chat-button.g-chat-button_theme_hidden {
                display: none;}
            .g-chat-icon {
                position: relative;
                width: 24px;
                height: 24px;
                -webkit-flex: none;
                -ms-flex: none;
                flex: none;
                cursor: pointer;
                color: #4e66ff!important;}
            .g-chat-icon .g-chat-icon__g {
                fill: #fff;}
            .g-chat-icon_type_black {
                color: #000;}
            .g-chat-icon_type_white {
                color: #fff;}
            .g-chat-icon_size_large {
                height: 36px;
                width: 36px;}
            .g-chat-header {
                display: none;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                position: relative;
                width: 100%;
                height: 49px;
                border-bottom: 1px solid #e6ebf1;
                background-color: #f3f5f8;
                visibility: hidden;
                display: block;
                -webkit-transition: visibility .4s ease;
                -o-transition: visibility ease .4s;
                transition: visibility .4s ease;}
            .g-chat-header__text {
                font-size: 16px;
                font-weight: 500;
                line-height: 48px;
                overflow: hidden;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                width: 100%;
                max-width: 100%;
                padding: 0 48px 0 16px;
                white-space: nowrap;
                -o-text-overflow: ellipsis;
                text-overflow: ellipsis;
                color: #333;
                -webkit-user-select: none;}
            .g-chat-header__close {
                position: absolute;
                top: 0;
                right: 0;
                width: 48px;
                height: 100%;
                cursor: pointer;
                opacity: .8;
                background: url("data:image/svg+xml;charset=utf-8,%3Csvg width=\'24\' height=\'24\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M17.566 17.566a.8.8 0 000-1.132L13.13 12l4.435-4.434a.8.8 0 10-1.132-1.132L12 10.87 7.566 6.434a.8.8 0 10-1.132 1.132L10.87 12l-4.435 4.434a.8.8 0 001.132 1.132L12 13.13l4.434 4.435a.8.8 0 001.132 0z\' fill=\'%23919CB5\'/%3E%3C/svg%3E") no-repeat 50%;
                background-size: 50%;}
            .g-chat-header__close:hover {
                opacity: 1;}
            .g-chat-header_visible {
                visibility: visible;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;
                z-index: 9999;}
            .g-chat-header_hidden, .g-chat-header_mobile .g-chat-header__close {
                display: none;}
            .g-chat-header_mobile {
                border-radius: 8px 8px 0 0;}
            .g-chat-header_theme_hidden.g-chat-header_empty, .g-chat-header_theme_legacy.g-chat-header_empty {
                display: none;}
            .g-chat-messenger-iframe {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                border: 0;
                display: none;}
            .g-chat-messenger-iframe_visible {
                display: block;}
            .g-chat-error {
                position: absolute;
                z-index: 10020;
                top: 50%;
                left: 50%;
                color: #292c33;
                display: none;
                max-width: 95%;
                padding: 10px;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                text-align: center;}
            .g-chat-error_visible {
                display: block;}
            .g-chat-error__title {
                font-size: 22.5px;
                font-weight: 700;
                line-height: 1.467;
                margin-bottom: 12px;
                text-align: center;}
            .g-chat-error__button {
                font-size: 14px;
                font-weight: 500;
                line-height: 36px;
                padding: 0 16px;
                cursor: pointer;
                text-align: center;
                white-space: nowrap;
                letter-spacing: .5px;
                text-transform: uppercase;
                color: #1c70c4;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
            .g-chat-error_mobile {
                background-color: rgba(0, 0, 0, .05);}
            .g-chat-error_theme_dark {
                color: #fff;}
            .g-chat-mobile-header {
                left: 0;
                display: none;
                height: 40px;
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
                visibility: hidden;}
            .g-chat-mobile-header, .g-chat-mobile-header__close {
                position: absolute;
                right: 0;
                top: 0;}
            .g-chat-mobile-header__close {
                font-size: 14px;
                line-height: 40px;
                height: 100%;
                padding: 0 12px;
                vertical-align: middle;
                color: #fff;
                cursor: pointer;
                -webkit-user-select: none;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
            .g-chat-mobile-header__slider {
                display: none;
                position: absolute;
                bottom: 4px;
                left: 50%;
                width: 32px;
                height: 4px;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                border-radius: 2px;
                background-color: #fff;}
            .g-chat-mobile-header_mobile {
                display: block;}
            .g-chat-mobile-header_visible {
                visibility: visible;}
            .g-chat-loader {
                position: absolute;
                z-index: 10030;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                visibility: hidden;
                -webkit-transition: visibility 0s ease-in-out .2s, opacity .2s ease-in-out;
                -o-transition: visibility 0s ease-in-out .2s, opacity .2s ease-in-out;
                transition: visibility 0s ease-in-out .2s, opacity .2s ease-in-out;
                opacity: 0;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;}
            .g-chat-loader__spinner {
                width: 38px;
                height: 38px;
                border-color: #1c70c4 transparent transparent #1c70c4;
                border-style: solid;
                border-width: 2px;
                border-radius: 50%;}
            .g-chat-loader_visible {
                visibility: visible;
                -webkit-transition-delay: 0s;
                -o-transition-delay: 0s;
                transition-delay: 0s;
                opacity: 1}
            .g-chat-loader_visible .g-chat-loader__spinner {
                -webkit-animation: g-chat-loader-spinner-rotate 1s linear infinite;
                animation: g-chat-loader-spinner-rotate 1s linear infinite;}
            .g-chat-widget .ui-resizable-handle {
                position: absolute;
                font-size: 0.1px;
                display: block;
                -ms-touch-action: none;
                touch-action: none;}
            .g-chat-widget .ui-resizable-e {
                cursor: e-resize;
                width: 7px;
                right: -5px;
                top: 0;
                height: 100%;}
            .g-chat-widget .ui-resizable-s {
                cursor: s-resize;
                height: 7px;
                width: 100%;
                bottom: -5px;
                left: 0;}
            .g-chat-widget .ui-icon, .ui-widget-content .ui-icon {
                *background-image: url(images/ui-icons_444444_256x240.png);}
            .g-chat-widget .ui-icon-gripsmall-diagonal-se {
                background-position: -64px -224px;}
            .g-chat-widget .ui-icon {
                width: 16px;
                height: 16px;}
            .g-chat-widget .ui-resizable-se {
                cursor: se-resize;
                width: 12px;
                height: 12px;
                right: 1px;
                bottom: 1px;}
            @-webkit-keyframes g-chat-loader-spinner-rotate {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0);}
                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn);}
            }
            @keyframes g-chat-loader-spinner-rotate {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0);}
                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn);}
            }
            @media (max-width: 420px) {
                .g-chat-widget_theme_dark.g-chat-widget_desktop.g-chat-widget_visible, .g-chat-widget_theme_light.g-chat-widget_desktop.g-chat-widget_visible {
                        min-width: 290px;}
            }
            .ui-resizable-resizing iframe {
                visibility: hidden;
                display: none;
            }
        </style>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).on(\'click\', \'.g-chat-widget .g-chat-button\', function() {
               $(\'.g-chat-widget\').addClass(\'g-chat-widget_visible\');
               $(\'.g-chat-paranja\').addClass(\'g-chat-paranja_visible\');
               $(\'.g-chat-popup\').addClass(\'g-chat-popup_visible\');
               $(\'.g-chat-mobile-header\').addClass(\'g-chat-mobile-header_visible\');
               $(\'.g-chat-header\').addClass(\'g-chat-header_visible\');
               $(\'.g-chat-widget__mount\').addClass(\'g-chat-widget__mount_visible\');
               $(\'.g-chat-button\').addClass(\'g-chat-button_hidden\');
            });
            $(document).on(\'click\', \'.g-chat-header__close\', function() {
               $(\'.g-chat-widget\').removeClass(\'g-chat-widget_visible\').attr(\'style\', \'\');
               $(\'.g-chat-paranja\').removeClass(\'g-chat-paranja_visible\');
               $(\'.g-chat-popup\').removeClass(\'g-chat-popup_visible\');
               $(\'.g-chat-mobile-header\').removeClass(\'g-chat-mobile-header_visible\');
               $(\'.g-chat-header\').removeClass(\'g-chat-header_visible\');
               $(\'.g-chat-widget__mount\').removeClass(\'g-chat-widget__mount_visible\');
               $(\'.g-chat-button\').removeClass(\'g-chat-button_hidden\');
            });
            $(function() {
                $(".g-chat-widget").resizable().draggable({ handle: ".g-chat-header" });;
            });
        </script>
        '; ?>

        <div class="g-chat-widget g-chat-widget_desktop g-chat-widget_theme_light g-chat-widget_size_large">
            <a href="javascript:void(0);" class="g-chat-button g-chat-button_theme_light g-chat-button_collapsed_always g-chat-button_size_large g-chat-button_desktop">
                <div class="g-chat-button__container g-chat-button__container_size_large">
                    <svg class="g-chat-icon g-chat-icon_type_colored g-chat-icon_size_large" viewBox="-288 411.9 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" fill="currentColor" d="M-279,429.9c-5,0-9-4-9-9c0-5,4-9,9-9c5,0,9,4,9,9c0,1.2-0.2,2.4-0.7,3.4c-1.1,2.1-1,0.4,0.5,4.8c0.1,0.2-0.1,0.5-0.3,0.5 c-0.1,0-0.2,0-0.2,0l-2.6-0.7c-0.1,0-0.2,0-0.3-0.1v0c-0.6-0.1-1.3,0-2,0.2C-276.6,429.7-277.8,429.9-279,429.9z"/>
                        <path class="g-chat-icon__g" d="M-277.1,425.9c-0.5,0.1-1,0.2-1.6,0.2c-0.7,0-1.5-0.1-2.1-0.4c-0.6-0.3-1.2-0.6-1.7-1.1c-0.5-0.5-0.9-1-1.2-1.6 c-0.3-0.6-0.4-1.3-0.4-2c0-0.7,0.1-1.4,0.4-2c0.3-0.6,0.6-1.2,1.2-1.6c0.5-0.5,1.1-0.8,1.7-1.1s1.3-0.4,2.1-0.4 c0.6,0,1.2,0.1,1.7,0.2c0.6,0.1,1,0.3,1.5,0.6c0.3,0.2,0.6,0.4,0.9,0.6l-0.3,2.3l-2-0.3l0.1-0.6c-0.5-0.3-1.1-0.5-1.9-0.5 c-0.3,0-0.7,0.1-1,0.2c-0.3,0.1-0.6,0.3-0.8,0.6c-0.3,0.3-0.4,0.5-0.6,0.9c-0.1,0.3-0.2,0.7-0.2,1c0,0.4,0.1,0.8,0.2,1.1 c0.1,0.3,0.3,0.6,0.6,0.9s0.5,0.4,0.8,0.6c0.3,0.1,0.6,0.2,1,0.2c0.3,0,0.6,0,0.9-0.1c0.3-0.1,0.5-0.2,0.8-0.3v-0.3h-1.8v-2.2h4.6 v3.9c-0.4,0.3-0.8,0.6-1.3,0.8C-276.1,425.7-276.6,425.8-277.1,425.9z"/>
                    </svg>
                </div>
                <div class="g-chat-badge g-chat-badge_theme_light g-chat-badge_type_num g-chat-badge_size_large">
                    <div class="g-chat-badge__count"></div>
                </div>
            </a>
            <div class="g-chat-paranja"></div>
            <div class="g-chat-popup g-chat-popup_position_static g-chat-popup_desktop g-chat-popup_theme_light">
                <div class="g-chat-mobile-header">
                    <div class="g-chat-mobile-header__close">Закрыть</div>
                    <div class="g-chat-mobile-header__slider"></div>
                </div>
                <div class="g-chat-header g-chat-header_theme_light">
                    <div class="g-chat-header__text">Чат</div>
                    <a href="javascript:void(0);" class="g-chat-header__close"></a>
                </div>
                <div class="g-chat-error g-chat-error_theme_light">
                    <div class="g-chat-error__title">Не удалось загрузить чат</div>
                    <div class="g-chat-error__button">Попробовать ещё раз</div>
                </div>
                <div class="g-chat-widget__mount">
                    <div class="g-chat-loader g-chat-loader_theme_light">
                        <div class="g-chat-loader__spinner"></div>
                    </div>
                    <iframe allow="" width="100%" height="100%" src="https://console.dialogflow.com/api-client/demo/embedded/c50044ba-be56-4659-9525-f7e333c370bd"></iframe>
                </div>
            </div>
        </div>
    </div>