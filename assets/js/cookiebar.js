(function ($) {

    // cookies
    $(document).ready(function () {

        var data = {
            closeClass: _wpcb__obj.closeClass,
            mess: _wpcb__obj.mess,
            expire: _wpcb__obj.expire,
            posi: _wpcb__obj.posi,
            linkRules: _wpcb__obj.linkRules,
            textlinkRules: _wpcb__obj.textlinkRules,
            yes: _wpcb__obj.yes,
            no: _wpcb__obj.no,
            gaID: _wpcb__obj.gaID
    };


        if ($.cookie("cookiebar") === undefined) {

            $(".wpcb-cookie-bar").append(
                '<div id="cookie-message" class="cookie-message">'
                    + data.mess
                    + '<div id="cookie-btn--yes" class="' + data.closeClass + '">' + data.yes +  '</div>'
                    + '<div id="cookie-btn--no" class="' + data.closeClass + ' nothanks">' + data.no +  '</div>'
                    + '<a id="cookie-rules" class="cookie-rules" href="' + data.linkRules + '">' + data.textlinkRules + '</a>'
                + '</div>'
            );
            $("#cookie-message").css(data.posi, "0");

            $("#cookie-btn--yes").click(function (e) {
                e.preventDefault();
                $("#cookie-message").fadeOut();
                $.cookie("cookiebar", "viewed", {expires: parseInt(data.expire, 10)});// because wp_localize_script() send only strings we need to type cast
            });

            // opt out
            $("#cookie-btn--no").click(function (e) {
                e.preventDefault();
                var disableStr = 'ga-disable-' + data.gaID;
                window[ disableStr ] = true;
                $.cookie("cookiebar", "nothanks", {expires: parseInt(data.expire, 10)});// because wp_localize_script() send only strings we need to type cast
                $("#cookie-message").fadeOut();
            });
        }

        return false;

    });

})(jQuery);