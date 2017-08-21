<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! $this->url->htmlLink( 'framework.css' ) !!}
        {!! $this->url->htmlLink( 'layout.css' ) !!}
        {!! $this->url->htmlLink( 'pages.css' ) !!}
        {!! $this->url->htmlLink( 'elements.css' ) !!}
    </head>
    <body >
        <div id="homepage" class="clear">
            <section class="clear">
                @yield( 'content' )

            </section>
        </div>
        <!-- Foot Scripts -->
        @yield( 'scripts' )
                    <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
            <script src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
            <script>
                window.jQuery || document.write('<script src="/layout/scripts/jquery-latest.min.js"><\/script>\
                <script src="/layout/scripts/jquery-ui.min.js"><\/script>')
            </script>
            <script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
            <script src="http://www.uteq.edu.ec/scripts/jquery-mobilemenu.min.js"></script>
            <script src="http://www.uteq.edu.ec/scripts/custom.js"></script>
            <script src="http://www.uteq.edu.ec/scripts/responsiveslides.min.js"></script>
            
            <script src="http://www.uteq.edu.ec/dist/js/lightbox-plus-jquery.min.js"></script>
    </body>
</html>