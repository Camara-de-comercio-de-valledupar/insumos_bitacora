<!DOCTYPE html>
<html>
<head>
    <!--
      If you are serving your web app in a path other than the root, change the
      href value below to reflect the base path you are serving from.

      The path provided below has to start and end with a slash "/" in order for
      it to work correctly.

      For more details:
      * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/base

      This is a placeholder for base href that will be replaced by the value of
      the `--base-href` argument provided to `flutter build`.
    -->
    <base href="/">

    <meta charset="UTF-8">
    <meta content="IE=Edge" http-equiv="X-UA-Compatible">
    <meta name="description" content="A new Flutter project.">

    <!-- iOS meta tags & icons -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="insumos_vitacora_app">
    <link rel="apple-touch-icon" href="{{asset('icons/Icon-192.png')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href={{asset("favicon.png")}}/>

    <title>{{env("APP_NAME")}}</title>
    <link rel="manifest" href={{asset("manifest.json")}}>
</head>
<body>
<script src={{asset("flutter_bootstrap.js")}} async></script>
</body>
</html>
