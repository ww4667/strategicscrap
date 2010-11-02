/**
2	 * Cookie plugin
3	 *
4	 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
5	 * Dual licensed under the MIT and GPL licenses:
6	 * http://www.opensource.org/licenses/mit-license.php
7	 * http://www.gnu.org/licenses/gpl.html
8	 *
9	 */
10	
11	/**
12	 * Create a cookie with the given name and value and other optional parameters.
13	 *
14	 * @example $.cookie('the_cookie', 'the_value');
15	 * @desc Set the value of a cookie.
16	 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
17	 * @desc Create a cookie with all available options.
18	 * @example $.cookie('the_cookie', 'the_value');
19	 * @desc Create a session cookie.
20	 * @example $.cookie('the_cookie', null);
21	 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
22	 *       used when the cookie was set.
23	 *
24	 * @param String name The name of the cookie.
25	 * @param String value The value of the cookie.
26	 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
27	 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
28	 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
29	 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
30	 *                             when the the browser exits.
31	 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
32	 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
33	 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
34	 *                        require a secure protocol (like HTTPS).
35	 * @type undefined
36	 *
37	 * @name $.cookie
38	 * @cat Plugins/Cookie
39	 * @author Klaus Hartl/klaus.hartl@stilbuero.de
40	 */
41	
42	/**
43	 * Get the value of a cookie with the given name.
44	 *
45	 * @example $.cookie('the_cookie');
46	 * @desc Get the value of a cookie.
47	 *
48	 * @param String name The name of the cookie.
49	 * @return The value of the cookie.
50	 * @type String
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
96	 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};