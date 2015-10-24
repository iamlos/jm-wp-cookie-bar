var tagAnalyticsCNIL = {}

tagAnalyticsCNIL.CookieConsent = function () {

    var gaProperty = _wpcb__obj.gaID;

    var disableStr = 'ga-disable-' + gaProperty;
    var firstCall = false;
    var domaineName = '';


    function getCookieExpireDate() {
        var cookieTimeout = 33696000000;
        var date = new Date();
        date.setTime(date.getTime() + cookieTimeout);
        return "; expires=" + date.toGMTString();
    }

    function getDomainName() {
        if (domaineName != '') {
            return domaineName;
        } else {
            var hostname = document.location.hostname;
            if (hostname.indexOf("www.") === 0)
                hostname = hostname.substring(4);
            return hostname;
        }
    }

    function getCookieDomainName() {
        var hostname = getDomainName();
        return "domain=" + "." + hostname;
    }


    function checkFirstVisit() {
        var consentCookie = getCookie('hasConsent');
        if (!consentCookie) return true;
    }

    function showBanner() {
        var bodytag = document.getElementsByTagName('body')[0];
        var div = document.createElement('div');
        div.setAttribute('id', 'cookie-banner');
        div.setAttribute('width', '70%');
        div.innerHTML = '' + '<div style="background-color:#fff;text-align:center;padding:5px;font-size:12px;border-bottom:1px solid #eeeeee;" id="cookie-banner-message" align="center">' + _wpcb__obj.mess + ' <a href="javascript:tagAnalyticsCNIL.CookieConsent.showInform()">' +  _wpcb__obj.a_more + '</a>.</div>';
        bodytag.insertBefore(div, bodytag.firstChild);
        document.getElementsByTagName('body')[0].className += ' cookiebanner';
        createInformAndAskDiv();
    }

    function getCookie(NameOfCookie) {
        if (document.cookie.length > 0) {
            begin = document.cookie.indexOf(NameOfCookie + "=");
            if (begin != -1) {
                begin += NameOfCookie.length + 1;
                end = document.cookie.indexOf(";", begin);
                if (end == -1) end = document.cookie.length;
                return unescape(document.cookie.substring(begin, end));
            }
        }
        return null;
    }

    function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        } else if (navigator.appName == 'Netscape') {
            var ua = navigator.userAgent;
            var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }

    function askDNTConfirmation() {
        return confirm(_wpcb__obj.donottrack);
    }

    function notToTrack() {
        if ((navigator.doNotTrack && (navigator.doNotTrack == 'yes' || navigator.doNotTrack == '1')) || ( navigator.msDoNotTrack && navigator.msDoNotTrack == '1')) {
            var isIE = (getInternetExplorerVersion() != -1)
            if (!isIE) {
                return true;
            } else {
                return askDNTConfirmation();
            }
            return false;
        }
    }

    function isToTrack() {
        if (navigator.doNotTrack && (navigator.doNotTrack == 'no' || navigator.doNotTrack == 0 )) {
            return true;
        }
    }

    function delCookie(name) {
        var path = ";path=" + "/";
        var expiration = "Thu, 01-Jan-1970 00:00:01 GMT";
        document.cookie = name + "=" + path + " ; " + getCookieDomainName() + ";expires=" + expiration;
    }

    function deleteAnalyticsCookies() {
        var cookieNames = ["__utma", "__utmb", "__utmc", "__utmz", "_ga", "_gat"]
        for (var i = 0; i < cookieNames.length; i++)
            delCookie(cookieNames[i]);
    }

    function createInformAndAskDiv() {
        var bodytag = document.getElementsByTagName('body')[0];
        var div = document.createElement('div');
        div.setAttribute('id', 'inform-and-ask');
        div.style.width = window.innerWidth + "px";
        div.style.height = window.innerHeight + "px";
        div.style.display = "none";
        div.style.position = "fixed";
        div.style.zIndex = "100000";
        div.innerHTML = '<div style="width: 300px; background-color: white; repeat scroll 0% 0% white; border: 1px solid #cccccc; padding :10px 10px;text-align:center; position: fixed; top:30px; left:50%; margin-top:0px; margin-left:-150px; z-index:100000; opacity:1" id="inform-and-consent">\
		<div><span>' + _wpcb__obj.explanation + '<div style="padding :10px 10px;text-align:center;"><button style="margin-right:50px;" name="_wpcb__obj.no" onclick="tagAnalyticsCNIL.CookieConsent.gaOptout();tagAnalyticsCNIL.CookieConsent.hideInform();" id="optout-button" >' + _wpcb__obj.no + '</button><button name="cancel" onclick="tagAnalyticsCNIL.CookieConsent.hideInform()" >' + _wpcb__obj.yes + '</button></div></div>';
        bodytag.insertBefore(div, bodytag.firstChild);
    }


    function isClickOnOptOut(evt) {
        return (evt.target.parentNode.id == 'cookie-banner' || evt.target.parentNode.parentNode.id == 'cookie-banner' || evt.target.id == 'optout-button')
    }

    function consent(evt) {
        if (!isClickOnOptOut(evt)) {
            if (!clickprocessed) {
                evt.preventDefault();
                document.cookie = 'hasConsent=true; ' + getCookieExpireDate() + ' ; ' + getCookieDomainName() + ' ; path=/';
                callGoogleAnalytics();
                clickprocessed = true;
                window.setTimeout(function () {
                    evt.target.click();
                }, 1000)
            }
        }
    }

    function callGABeforeConsent() {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', '__gaTracker');
        // Ici on desactive les cookie
        __gaTracker('create', gaProperty, {'storage': 'none', 'clientId': '0'});
        __gaTracker('send', 'event', 'page', 'load', {'nonInteraction': 1});
    }


    function callGoogleAnalytics() {
        if (firstCall) return;
        else firstCall = true;
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', gaProperty, 'auto');  // Replace with your property ID.
        ga('send', 'pageview');
    }

    return {

        gaOptout: function () {
            document.cookie = disableStr + '=true;' + getCookieExpireDate() + ' ; ' + getCookieDomainName() + ' ; path=/';
            document.cookie = 'hasConsent=false;' + getCookieExpireDate() + ' ; ' + getCookieDomainName() + ' ; path=/';
            var div = document.getElementById('cookie-banner');
            clickprocessed = true;

            if (div != null) div.innerHTML = '<div style="background-color:#fff;text-align:center;padding:5px;font-size:12px;border-bottom:1px solid #eeeeee;" id="cookie-message"> _wpcb__obj.confirm_no </div>';
            window[disableStr] = true;
            deleteAnalyticsCookies();
        },


        showInform: function () {
            var div = document.getElementById("inform-and-ask");
            div.style.display = "";
        },


        hideInform: function () {
            var div = document.getElementById("inform-and-ask");
            div.style.display = "none";
            var div = document.getElementById("cookie-banner");
            div.style.display = "none";
        },


        start: function () {
            var consentCookie = getCookie('hasConsent');
            clickprocessed = false;
            if (!consentCookie) {
                if (notToTrack()) {
                    tagAnalyticsCNIL.CookieConsent.gaOptout();
                    alert( _wpcb__obj_.dnt );
                } else {
                    if (isToTrack()) { //DNT is set to 0, no need to ask for consent just set cookies
                        consent();
                    } else {
                        if (window.addEventListener) { // See note https://github.com/CNILlab/Cookie-consent_Google-Analytics/commit/e323b3be2c4a4d05300e35cdc11102841abdcbc9
                            // Standard browsers
                            window.addEventListener("load", showBanner, false);
                            document.addEventListener("click", consent, false);
                        } else {
                            window.attachEvent("onload", showBanner);
                            document.attachEvent("onclick", consent);
                        }
                        callGABeforeConsent();
                    }
                }
            } else {
                if (document.cookie.indexOf('hasConsent=false') > -1)
                    window[disableStr] = true;
                else
                    callGoogleAnalytics();
            }
        }
    }

}();

tagAnalyticsCNIL.CookieConsent.start();