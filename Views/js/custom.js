$(document).ready(function () {
    var tabFadeOut = 400;
    var tabFadeIn = 800;
    var colors = ['#45596a', '#5A599F', '#61C1DF', '#ee8310', '#8d10ee', '#5a3b16', '#26a4ed', '#f45a90', '#e9e744'];
    $(".datatable").dataTable();
    /*$('select').select_skin();*/
    $('input[type=checkbox], input[type=radio]').prettyCheckboxes();
    $('#secondary ul li a').click(function () {
        var currentTab = $('#secondary ul li.current a').attr('href');
        var clicked = $(this).attr('href');
        $('#secondary ul li').removeClass('current');
        $(this).parent('li').addClass('current');
        $(currentTab).fadeOut(400, 0, function () {
            $(clicked).fadeIn(800)
        })
    });
    $('.barchart').visualize({
        type: 'bar',
        colors: colors
    });
    $('.linechart').visualize({
        type: 'line',
        lineWeight: 2,
        colors: colors
    });
    $('.areachart').visualize({
        type: 'area',
        lineWeight: 1,
        colors: colors
    });
    $('.piechart').visualize({
        type: 'pie',
        colors: colors
    });
    $('.barchart, .linechart, .areachart, .piechart').hide();
    $('#footer-right').append('Powered By <a href="http://www.etisalat.ae" target="_blank">Etisalat</a>')
});

function notify(msg, type) {
    $.tcNotes({
        'message': msg,
        'type': type
    })
};
(function (d) {
    var k = d.scrollTo = function (a, i, e) {
            d(window).scrollTo(a, i, e)
        };
    k.defaults = {
        axis: 'xy',
        duration: parseFloat(d.fn.jquery) >= 1.3 ? 0 : 1
    };
    k.window = function (a) {
        return d(window)._scrollable()
    };
    d.fn._scrollable = function () {
        return this.map(function () {
            var a = this,
                i = !a.nodeName || d.inArray(a.nodeName.toLowerCase(), ['iframe', '#document', 'html', 'body']) != -1;
            if (!i) return a;
            var e = (a.contentWindow || a).document || a.ownerDocument || a;
            return d.browser.safari || e.compatMode == 'BackCompat' ? e.body : e.documentElement
        })
    };
    d.fn.scrollTo = function (n, j, b) {
        if (typeof j == 'object') {
            b = j;
            j = 0
        }
        if (typeof b == 'function') b = {
            onAfter: b
        };
        if (n == 'max') n = 9e9;
        b = d.extend({}, k.defaults, b);
        j = j || b.speed || b.duration;
        b.queue = b.queue && b.axis.length > 1;
        if (b.queue) j /= 2;
        b.offset = p(b.offset);
        b.over = p(b.over);
        return this._scrollable().each(function () {
            var q = this,
                r = d(q),
                f = n,
                s, g = {},
                u = r.is('html,body');
            switch (typeof f) {
            case 'number':
            case 'string':
                if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)) {
                    f = p(f);
                    break
                }
                f = d(f, this);
            case 'object':
                if (f.is || f.style) s = (f = d(f)).offset()
            }
            d.each(b.axis.split(''), function (a, i) {
                var e = i == 'x' ? 'Left' : 'Top',
                    h = e.toLowerCase(),
                    c = 'scroll' + e,
                    l = q[c],
                    m = k.max(q, i);
                if (s) {
                    g[c] = s[h] + (u ? 0 : l - r.offset()[h]);
                    if (b.margin) {
                        g[c] -= parseInt(f.css('margin' + e)) || 0;
                        g[c] -= parseInt(f.css('border' + e + 'Width')) || 0
                    }
                    g[c] += b.offset[h] || 0;
                    if (b.over[h]) g[c] += f[i == 'x' ? 'width' : 'height']() * b.over[h]
                } else {
                    var o = f[h];
                    g[c] = o.slice && o.slice(-1) == '%' ? parseFloat(o) / 100 * m : o

                }
                if (/^\d+$/.test(g[c])) g[c] = g[c] <= 0 ? 0 : Math.min(g[c], m);
                if (!a && b.queue) {
                    if (l != g[c]) t(b.onAfterFirst);
                    delete g[c]
                }
            });
            t(b.onAfter);

            function t(a) {
                r.animate(g, j, b.easing, a &&
                function () {
                    a.call(this, n, b)
                })
            }
        }).end()
    };
    k.max = function (a, i) {
        var e = i == 'x' ? 'Width' : 'Height',
            h = 'scroll' + e;
        if (!d(a).is('html,body')) return a[h] - d(a)[e.toLowerCase()]();
        var c = 'client' + e,
            l = a.ownerDocument.documentElement,
            m = a.ownerDocument.body;
        return Math.max(l[h], m[h]) - Math.min(l[c], m[c])
    };

    function p(a) {
        return typeof a == 'object' ? a : {
            top: a,
            left: a
        }
    }
})(jQuery);
jQuery.fn.prettyCheckboxes = function (a) {
    a = jQuery.extend({
        checkboxWidth: 17,
        checkboxHeight: 17,
        className: "prettyCheckbox",
        display: "list"
    }, a);
    $(this).each(function () {
        $label = $('label[for="' + $(this).attr("id") + '"]');
        $label.prepend("<span class='holderWrap'><span class='holder'></span></span>");
        if ($(this).is(":checked")) {
            $label.addClass("checked")
        }
        $label.addClass(a.className).addClass($(this).attr("type")).addClass(a.display);
        $label.find("span.holderWrap").width(a.checkboxWidth).height(a.checkboxHeight);
        $label.find("span.holder").width(a.checkboxWidth);
        $(this).addClass("hiddenCheckbox");
        $label.bind("click", function () {
            $("input#" + $(this).attr("for")).triggerHandler("click");
            if ($("input#" + $(this).attr("for")).is(":checkbox")) {
                $(this).toggleClass("checked");
                $("input#" + $(this).attr("for")).checked = true;
                $(this).find("span.holder").css("top", 0)
            } else {
                $toCheck = $("input#" + $(this).attr("for"));
                $('input[name="' + $toCheck.attr("name") + '"]').each(function () {
                    $('label[for="' + $(this).attr("id") + '"]').removeClass("checked")
                });
                $(this).addClass("checked");
                $toCheck.checked = true
            }
        });
        $("input#" + $label.attr("for")).bind("keypress", function (b) {
            if (b.keyCode == 32) {
                if ($.browser.msie) {
                    $('label[for="' + $(this).attr("id") + '"]').toggleClass("checked")
                } else {
                    $(this).trigger("click")
                }
                return false
            }
        })
    })
};
checkAllPrettyCheckboxes = function (b, a) {
    if ($(b).is(":checked")) {
        $(a).find("input[type=checkbox]:not(:checked)").each(function () {
            $('label[for="' + $(this).attr("id") + '"]').trigger("click");
            if ($.browser.msie) {
                $(this).attr("checked", "checked")
            } else {
                $(this).trigger("click")
            }
        })
    } else {
        $(a).find("input[type=checkbox]:checked").each(function () {
            $('label[for="' + $(this).attr("id") + '"]').trigger("click");
            if ($.browser.msie) {
                $(this).attr("checked", "")
            } else {
                $(this).trigger("click")
            }
        })
    }
};

function showhide(divid, state){
document.getElementById(divid).style.display=state;
};