<!DOCTYPE html>
<html lang="en" data-critters-container>
<head>
    <meta charset="utf-8">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="" href="favicon.ico" /> -->
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/regular.min.css"
          integrity="sha512-3YMBYASBKTrccbNMWlnn0ZoEOfRjVs9qo/dlNRea196pg78HaO0H/xPPO2n6MIqV6CgTYcWJ1ZB2EgWjeNP6XA=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>@charset "UTF-8";
        @charset "UTF-8";
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-primary-text-emphasis: #052c65;
            --bs-secondary-text-emphasis: #2b2f32;
            --bs-success-text-emphasis: #0a3622;
            --bs-info-text-emphasis: #055160;
            --bs-warning-text-emphasis: #664d03;
            --bs-danger-text-emphasis: #58151c;
            --bs-light-text-emphasis: #495057;
            --bs-dark-text-emphasis: #495057;
            --bs-primary-bg-subtle: #cfe2ff;
            --bs-secondary-bg-subtle: #e2e3e5;
            --bs-success-bg-subtle: #d1e7dd;
            --bs-info-bg-subtle: #cff4fc;
            --bs-warning-bg-subtle: #fff3cd;
            --bs-danger-bg-subtle: #f8d7da;
            --bs-light-bg-subtle: #fcfcfd;
            --bs-dark-bg-subtle: #ced4da;
            --bs-primary-border-subtle: #9ec5fe;
            --bs-secondary-border-subtle: #c4c8cb;
            --bs-success-border-subtle: #a3cfbb;
            --bs-info-border-subtle: #9eeaf9;
            --bs-warning-border-subtle: #ffe69c;
            --bs-danger-border-subtle: #f1aeb5;
            --bs-light-border-subtle: #e9ecef;
            --bs-dark-border-subtle: #adb5bd;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, .15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg: #fff;
            --bs-body-bg-rgb: 255, 255, 255;
            --bs-emphasis-color: #000;
            --bs-emphasis-color-rgb: 0, 0, 0;
            --bs-secondary-color: rgba(33, 37, 41, .75);
            --bs-secondary-color-rgb: 33, 37, 41;
            --bs-secondary-bg: #e9ecef;
            --bs-secondary-bg-rgb: 233, 236, 239;
            --bs-tertiary-color: rgba(33, 37, 41, .5);
            --bs-tertiary-color-rgb: 33, 37, 41;
            --bs-tertiary-bg: #f8f9fa;
            --bs-tertiary-bg-rgb: 248, 249, 250;
            --bs-heading-color: inherit;
            --bs-link-color: #0d6efd;
            --bs-link-color-rgb: 13, 110, 253;
            --bs-link-decoration: underline;
            --bs-link-hover-color: #0a58ca;
            --bs-link-hover-color-rgb: 10, 88, 202;
            --bs-code-color: #d63384;
            --bs-highlight-bg: #fff3cd;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-color: #dee2e6;
            --bs-border-color-translucent: rgba(0, 0, 0, .175);
            --bs-border-radius: .375rem;
            --bs-border-radius-sm: .25rem;
            --bs-border-radius-lg: .5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-xxl: 2rem;
            --bs-border-radius-2xl: var(--bs-border-radius-xxl);
            --bs-border-radius-pill: 50rem;
            --bs-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
            --bs-box-shadow-sm: 0 .125rem .25rem rgba(0, 0, 0, .075);
            --bs-box-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, .175);
            --bs-box-shadow-inset: inset 0 1px 2px rgba(0, 0, 0, .075);
            --bs-focus-ring-width: .25rem;
            --bs-focus-ring-opacity: .25;
            --bs-focus-ring-color: rgba(13, 110, 253, .25);
            --bs-form-valid-color: #198754;
            --bs-form-valid-border-color: #198754;
            --bs-form-invalid-color: #dc3545;
            --bs-form-invalid-border-color: #dc3545
        }

        *, :after, :before {
            box-sizing: border-box
        }

        @media (prefers-reduced-motion: no-preference) {
            :root {
                scroll-behavior: smooth
            }
        }

        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        :root {
            --bs-breakpoint-xs: 0;
            --bs-breakpoint-sm: 576px;
            --bs-breakpoint-md: 768px;
            --bs-breakpoint-lg: 992px;
            --bs-breakpoint-xl: 1200px;
            --bs-breakpoint-xxl: 1400px
        }

        :root {
            --surface-a: #ffffff;
            --surface-b: #f8f9fa;
            --surface-c: #e9ecef;
            --surface-d: #dee2e6;
            --surface-e: #ffffff;
            --surface-f: #ffffff;
            --text-color: #495057;
            --text-color-secondary: #6c757d;
            --primary-color: #3B82F6;
            --primary-color-text: #ffffff;
            --font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
            --surface-0: #ffffff;
            --surface-50: #FAFAFA;
            --surface-100: #F5F5F5;
            --surface-200: #EEEEEE;
            --surface-300: #E0E0E0;
            --surface-400: #BDBDBD;
            --surface-500: #9E9E9E;
            --surface-600: #757575;
            --surface-700: #616161;
            --surface-800: #424242;
            --surface-900: #212121;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #EEEEEE;
            --gray-300: #E0E0E0;
            --gray-400: #BDBDBD;
            --gray-500: #9E9E9E;
            --gray-600: #757575;
            --gray-700: #616161;
            --gray-800: #424242;
            --gray-900: #212121;
            --content-padding: 1.25rem;
            --inline-spacing: .5rem;
            --border-radius: 6px;
            --surface-ground: #eff3f8;
            --surface-section: #ffffff;
            --surface-card: #ffffff;
            --surface-overlay: #ffffff;
            --surface-border: #dfe7ef;
            --surface-hover: #f6f9fc;
            --focus-ring: 0 0 0 .2rem #BFDBFE;
            --maskbg: rgba(0, 0, 0, .4);
            --highlight-bg: #EFF6FF;
            --highlight-text-color: #1D4ED8;
            color-scheme: light
        }

        * {
            box-sizing: border-box
        }

        :root {
            --blue-50: #f5f9ff;
            --blue-100: #d0e1fd;
            --blue-200: #abc9fb;
            --blue-300: #85b2f9;
            --blue-400: #609af8;
            --blue-500: #3b82f6;
            --blue-600: #326fd1;
            --blue-700: #295bac;
            --blue-800: #204887;
            --blue-900: #183462;
            --green-50: #f4fcf7;
            --green-100: #caf1d8;
            --green-200: #a0e6ba;
            --green-300: #76db9b;
            --green-400: #4cd07d;
            --green-500: #22c55e;
            --green-600: #1da750;
            --green-700: #188a42;
            --green-800: #136c34;
            --green-900: #0e4f26;
            --yellow-50: #fefbf3;
            --yellow-100: #faedc4;
            --yellow-200: #f6de95;
            --yellow-300: #f2d066;
            --yellow-400: #eec137;
            --yellow-500: #eab308;
            --yellow-600: #c79807;
            --yellow-700: #a47d06;
            --yellow-800: #816204;
            --yellow-900: #5e4803;
            --cyan-50: #f3fbfd;
            --cyan-100: #c3edf5;
            --cyan-200: #94e0ed;
            --cyan-300: #65d2e4;
            --cyan-400: #35c4dc;
            --cyan-500: #06b6d4;
            --cyan-600: #059bb4;
            --cyan-700: #047f94;
            --cyan-800: #036475;
            --cyan-900: #024955;
            --pink-50: #fef6fa;
            --pink-100: #fad3e7;
            --pink-200: #f7b0d3;
            --pink-300: #f38ec0;
            --pink-400: #f06bac;
            --pink-500: #ec4899;
            --pink-600: #c93d82;
            --pink-700: #a5326b;
            --pink-800: #822854;
            --pink-900: #5e1d3d;
            --indigo-50: #f7f7fe;
            --indigo-100: #dadafc;
            --indigo-200: #bcbdf9;
            --indigo-300: #9ea0f6;
            --indigo-400: #8183f4;
            --indigo-500: #6366f1;
            --indigo-600: #5457cd;
            --indigo-700: #4547a9;
            --indigo-800: #363885;
            --indigo-900: #282960;
            --teal-50: #f3fbfb;
            --teal-100: #c7eeea;
            --teal-200: #9ae0d9;
            --teal-300: #6dd3c8;
            --teal-400: #41c5b7;
            --teal-500: #14b8a6;
            --teal-600: #119c8d;
            --teal-700: #0e8174;
            --teal-800: #0b655b;
            --teal-900: #084a42;
            --orange-50: #fff8f3;
            --orange-100: #feddc7;
            --orange-200: #fcc39b;
            --orange-300: #fba86f;
            --orange-400: #fa8e42;
            --orange-500: #f97316;
            --orange-600: #d46213;
            --orange-700: #ae510f;
            --orange-800: #893f0c;
            --orange-900: #642e09;
            --bluegray-50: #f7f8f9;
            --bluegray-100: #dadee3;
            --bluegray-200: #bcc3cd;
            --bluegray-300: #9fa9b7;
            --bluegray-400: #818ea1;
            --bluegray-500: #64748b;
            --bluegray-600: #556376;
            --bluegray-700: #465161;
            --bluegray-800: #37404c;
            --bluegray-900: #282e38;
            --purple-50: #fbf7ff;
            --purple-100: #ead6fd;
            --purple-200: #dab6fc;
            --purple-300: #c996fa;
            --purple-400: #b975f9;
            --purple-500: #a855f7;
            --purple-600: #8f48d2;
            --purple-700: #763cad;
            --purple-800: #5c2f88;
            --purple-900: #432263;
            --red-50: #fff5f5;
            --red-100: #ffd0ce;
            --red-200: #ffaca7;
            --red-300: #ff8780;
            --red-400: #ff6259;
            --red-500: #ff3d32;
            --red-600: #d9342b;
            --red-700: #b32b23;
            --red-800: #8c221c;
            --red-900: #661814;
            --primary-50: #f5f9ff;
            --primary-100: #d0e1fd;
            --primary-200: #abc9fb;
            --primary-300: #85b2f9;
            --primary-400: #609af8;
            --primary-500: #3b82f6;
            --primary-600: #326fd1;
            --primary-700: #295bac;
            --primary-800: #204887;
            --primary-900: #183462
        }

        @font-face {
            font-family: Montserrat;
            src: url(Montserrat-VariableFont_wght.d44e189596018794.ttf) format("ttf")
        }

        @font-face {
            font-family: Roboto;
            src: url(Roboto-Regular.0e6e4c28297310dc.ttf) format("ttf")
        }

        @font-face {
            font-family: Inter;
            src: url(Inter-VariableFont_slnt,wght.11bf447c34a2180c.ttf) format("ttf")
        }

        @font-face {
            font-family: Montserrat;
            src: url(Montserrat-VariableFont_wght.d44e189596018794.ttf) format("ttf")
        }

        @font-face {
            font-family: Roboto;
            src: url(Roboto-Regular.0e6e4c28297310dc.ttf) format("ttf")
        }

        @font-face {
            font-family: Inter;
            src: url(Inter-VariableFont_slnt,wght.11bf447c34a2180c.ttf) format("ttf")
        }

        :root {
            --primary: #C40001;
            --mainColor: #003d5b;
            --white: #ffffff;
            --black: #000000;
            --lightGray: #f8f8f8;
            --text-font-size: 14px;
            --text-title-font-size: 18.13px;
            --red: #d1495b;
            --color1: #003D5B;
            --color2: #D1495B;
            --color3: #00798C;
            --color4: #00798C33;
            --color5: #00798C33;
            --color6: #00798C33;
            --color7: linear-gradient(0deg, #003D5B, #003D5B), linear-gradient(0deg, #DADCE0, #DADCE0);
            --color8: linear-gradient(0deg, #FFFFFF, #FFFFFF), linear-gradient(0deg, #D0D5DD, #D0D5DD);
            --color9: #D1495B33;
            --color10: #30638E;
            --color11: #EDAE49;
            --color12: #EDAE4933;
            --color13: #979797;
            --color14: #2E2E2E;
            --color15: #C6DFE2;
            --color16: #F8F8F8;
            --color17: #101828;
            --grey: #667085;
            --input-font-size: 15px;
            --input-line-height: 23px;
            --input-font-Weight: 400;
            --input-number-line-height: 18px;
            --label-font-size: 14px;
            --label-line-height: 20px;
            --label-font-Weight: 500;
            --label-font-family: var(--Inter);
            --btn-font-size: 14px;
            --btn-line-height: 20px;
            --btn-font-Weight: 400;
            --btn-font-family: var(--Montserrat);
            --btn-border-radius: 5px;
            --module-selected-font-size: 13px;
            --module-selected-color: var(--color3);
            --module-selected-background-color: var(--color15);
            --module-selected-line-height: 16px;
            --module-selected-font-Weight: 500;
            --module-selected-font-family: var(--Roboto);
            --module-selected-border-radius: 24px;
            --module-selected-padding: 6px 15px;
            --module-selected-margin: .5rem 1rem;
            --page-title-font-size: 18px;
            --page-title-line-height: 24px;
            --page-title-letter-spacing: 0rem;
            --page-title-font-family: var(--Montserrat);
            --page-title-font-Weight: 600;
            --page-title-font-color: var(--black);
            --title-font-size: 18px;
            --title-line-height: 24px;
            --title-letter-spacing: 0rem;
            --title-font-family: var(--Montserrat);
            --title-font-Weight: 600;
            --title-font-color: var(--mainColor);
            --sup-title-font-size: 16px;
            --sup-title-line-height: 28px;
            --sup-title-letter-spacing: 0rem;
            --sup-title-font-family: var(--Inter);
            --sup-title-font-Weight: 600;
            --sup-title-font-color: var(--color17);
            --border-color: var(--color1);
            --text-font-family: var(--Inter);
            --text-error: var(--red);
            --box-shadow: 0px 8px 8px -4px #1018280A;
            background: #344054;
            --border-radius: 9.54341983795166px
        }

        @font-face {
            font-family: Montserrat;
            src: url(Montserrat-VariableFont_wght.d44e189596018794.ttf) format("ttf")
        }

        @font-face {
            font-family: Roboto;
            src: url(Roboto-Regular.0e6e4c28297310dc.ttf) format("ttf")
        }

        @font-face {
            font-family: Inter;
            src: url(Inter-VariableFont_slnt,wght.11bf447c34a2180c.ttf) format("ttf")
        }

        :root {
            --Montserrat: "Montserrat";
            --Roboto: "Roboto";
            --Inter: "Inter";
            --Jost: "Jost"
        }

        * {
            box-sizing: border-box;
            padding: 0
        }

        html, body {
            background-color: #f4f6f9 !important;
            font-size: 10px;
            font-family: Montserrat, sans-serif;
            min-height: 100%;
            overflow: auto;
            padding-right: 0 !important
        }</style>
    <link rel="stylesheet" href="{{asset('styles.7827d7c8f5301009.css')}}" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{asset('styles.7827d7c8f5301009.css')}}">
    </noscript>
</head>
<body>
<noscript><p>This page requires JavaScript to work properly. Please enable JavaScript in your browser.</p></noscript>
<app-root></app-root>
<script src="{{asset('runtime.366c19f62d5fa922.js')}}" type="module"></script>
<script src="{{asset('polyfills.d0283fcbcab4d65e.js')}}" type="module"></script>
<script src="{{asset('main.48db6fb307ab4d0e.js')}}" type="module"></script>
</body>
</html>
