function(t) {
  "function" == typeof define && define.amd ? define(["picker", "jquery"], t) : "object" == typeof exports ? module.exports = t(require("./picker.js"), require("jquery")) : t(Picker, jQuery)
}(function(t, e) {
  function i(t, e) {
    var i = this,
      n = t.$node[0],
      o = n.value,
      a = t.$node.data("value"),
      s = a || o,
      r = a ? e.formatSubmit : e.format,
      l = function() {
        return n.currentStyle ? "rtl" == n.currentStyle.direction : "rtl" == getComputedStyle(t.$root[0]).direction
      };
    i.settings = e, i.$node = t.$node, i.queue = {
      min: "measure create",
      max: "measure create",
      now: "now create",
      select: "parse create validate",
      highlight: "parse navigate create validate",
      view: "parse create validate viewset",
      disable: "deactivate",
      enable: "activate"
    }, i.item = {}, i.item.clear = null, i.item.disable = (e.disable || []).slice(0), i.item.enable = - function(t) {
      return t[0] === !0 ? t.shift() : -1
    }(i.item.disable), i.set("min", e.min).set("max", e.max).set("now"), s ? i.set("select", s, {
      format: r,
      defaultValue: !0
    }) : i.set("select", null).set("highlight", i.item.now), i.key = {
      40: 7,
      38: -7,
      39: function() {
        return l() ? -1 : 1
      },
      37: function() {
        return l() ? 1 : -1
      },
      go: function(t) {
        var e = i.item.highlight,
          n = new Date(e.year, e.month, e.date + t);
        i.set("highlight", n, {
          interval: t
        }), this.render()
      }
    }, t.on("render", function() {
      t.$root.find("." + e.klass.selectMonth).on("change", function() {
        var i = this.value;
        i && (t.set("highlight", [t.get("view").year, i, t.get("highlight").date]), t.$root.find("." + e.klass.selectMonth).trigger("focus"))
      }), t.$root.find("." + e.klass.selectYear).on("change", function() {
        var i = this.value;
        i && (t.set("highlight", [i, t.get("view").month, t.get("highlight").date]), t.$root.find("." + e.klass.selectYear).trigger("focus"))
      })
    }, 1).on("open", function() {
      var n = "";
      i.disabled(i.get("now")) && (n = ":not(." + e.klass.buttonToday + ")"), t.$root.find("button" + n + ", select").attr("disabled", !1)
    }, 1).on("close", function() {
      t.$root.find("button, select").attr("disabled", !0)
    }, 1)
  }
  var n = 7,
    o = 6,
    a = t._;
  i.prototype.set = function(t, e, i) {
    var n = this,
      o = n.item;
    return null === e ? ("clear" == t && (t = "select"), o[t] = e, n) : (o["enable" == t ? "disable" : "flip" == t ? "enable" : t] = n.queue[t].split(" ").map(function(o) {
      return e = n[o](t, e, i)
    }).pop(), "select" == t ? n.set("highlight", o.select, i) : "highlight" == t ? n.set("view", o.highlight, i) : t.match(/^(flip|min|max|disable|enable)$/) && (o.select && n.disabled(o.select) && n.set("select", o.select, i), o.highlight && n.disabled(o.highlight) && n.set("highlight", o.highlight, i)), n)
  }, i.prototype.get = function(t) {
    return this.item[t]
  }, i.prototype.create = function(t, i, n) {
    var o, s = this;
    return i = void 0 === i ? t : i, i == -(1 / 0) || i == 1 / 0 ? o = i : e.isPlainObject(i) && a.isInteger(i.pick) ? i = i.obj : e.isArray(i) ? (i = new Date(i[0], i[1], i[2]), i = a.isDate(i) ? i : s.create().obj) : i = a.isInteger(i) || a.isDate(i) ? s.normalize(new Date(i), n) : s.now(t, i, n), {
      year: o || i.getFullYear(),
      month: o || i.getMonth(),
      date: o || i.getDate(),
      day: o || i.getDay(),
      obj: o || i,
      pick: o || i.getTime()
    }
  }, i.prototype.createRange = function(t, i) {
    var n = this,
      o = function(t) {
        return t === !0 || e.isArray(t) || a.isDate(t) ? n.create(t) : t
      };
    return a.isInteger(t) || (t = o(t)), a.isInteger(i) || (i = o(i)), a.isInteger(t) && e.isPlainObject(i) ? t = [i.year, i.month, i.date + t] : a.isInteger(i) && e.isPlainObject(t) && (i = [t.year, t.month, t.date + i]), {
      from: o(t),
      to: o(i)
    }
  }, i.prototype.withinRange = function(t, e) {
    return t = this.createRange(t.from, t.to), e.pick >= t.from.pick && e.pick <= t.to.pick
  }, i.prototype.overlapRanges = function(t, e) {
    var i = this;
    return t = i.createRange(t.from, t.to), e = i.createRange(e.from, e.to), i.withinRange(t, e.from) || i.withinRange(t, e.to) || i.withinRange(e, t.from) || i.withinRange(e, t.to)
  }, i.prototype.now = function(t, e, i) {
    return e = new Date, i && i.rel && e.setDate(e.getDate() + i.rel), this.normalize(e, i)
  }, i.prototype.navigate = function(t, i, n) {
    var o, a, s, r, l = e.isArray(i),
      c = e.isPlainObject(i),
      u = this.item.view;
    if (l || c) {
      for (c ? (a = i.year, s = i.month, r = i.date) : (a = +i[0], s = +i[1], r = +i[2]), n && n.nav && u && u.month !== s && (a = u.year, s = u.month), o = new Date(a, s + (n && n.nav ? n.nav : 0), 1), a = o.getFullYear(), s = o.getMonth(); new Date(a, s, r).getMonth() !== s;) r -= 1;
      i = [a, s, r]
    }
    return i
  }, i.prototype.normalize = function(t) {
    return t.setHours(0, 0, 0, 0), t
  }, i.prototype.measure = function(t, e) {
    var i = this;
    return e ? "string" == typeof e ? e = i.parse(t, e) : a.isInteger(e) && (e = i.now(t, e, {
      rel: e
    })) : e = "min" == t ? -(1 / 0) : 1 / 0, e
  }, i.prototype.viewset = function(t, e) {
    return this.create([e.year, e.month, 1])
  }, i.prototype.validate = function(t, i, n) {
    var o, s, r, l, c = this,
      u = i,
      h = n && n.interval ? n.interval : 1,
      d = c.item.enable === -1,
      p = c.item.min,
      f = c.item.max,
      m = d && c.item.disable.filter(function(t) {
        if (e.isArray(t)) {
          var n = c.create(t).pick;
          n < i.pick ? o = !0 : n > i.pick && (s = !0)
        }
        return a.isInteger(t)
      }).length;
    if ((!n || !n.nav && !n.defaultValue) && (!d && c.disabled(i) || d && c.disabled(i) && (m || o || s) || !d && (i.pick <= p.pick || i.pick >= f.pick)))
      for (d && !m && (!s && h > 0 || !o && h < 0) && (h *= -1); c.disabled(i) && (Math.abs(h) > 1 && (i.month < u.month || i.month > u.month) && (i = u, h = h > 0 ? 1 : -1), i.pick <= p.pick ? (r = !0, h = 1, i = c.create([p.year, p.month, p.date + (i.pick === p.pick ? 0 : -1)])) : i.pick >= f.pick && (l = !0, h = -1, i = c.create([f.year, f.month, f.date + (i.pick === f.pick ? 0 : 1)])), !r || !l);) i = c.create([i.year, i.month, i.date + h]);
    return i
  }, i.prototype.disabled = function(t) {
    var i = this,
      n = i.item.disable.filter(function(n) {
        return a.isInteger(n) ? t.day === (i.settings.firstDay ? n : n - 1) % 7 : e.isArray(n) || a.isDate(n) ? t.pick === i.create(n).pick : e.isPlainObject(n) ? i.withinRange(n, t) : void 0
      });
    return n = n.length && !n.filter(function(t) {
      return e.isArray(t) && "inverted" == t[3] || e.isPlainObject(t) && t.inverted
    }).length, i.item.enable === -1 ? !n : n || t.pick < i.item.min.pick || t.pick > i.item.max.pick
  }, i.prototype.parse = function(t, e, i) {
    var n = this,
      o = {};
    return e && "string" == typeof e ? (i && i.format || (i = i || {}, i.format = n.settings.format), n.formats.toArray(i.format).map(function(t) {
      var i = n.formats[t],
        s = i ? a.trigger(i, n, [e, o]) : t.replace(/^!/, "").length;
      i && (o[t] = e.substr(0, s)), e = e.substr(s)
    }), [o.yyyy || o.yy, +(o.mm || o.m) - 1, o.dd || o.d]) : e
  }, i.prototype.formats = function() {
    function t(t, e, i) {
      var n = t.match(/[^\x00-\x7F]+|\w+/)[0];
      return i.mm || i.m || (i.m = e.indexOf(n) + 1), n.length
    }

    function e(t) {
      return t.match(/\w+/)[0].length
    }
    return {
      d: function(t, e) {
        return t ? a.digits(t) : e.date
      },
      dd: function(t, e) {
        return t ? 2 : a.lead(e.date)
      },
      ddd: function(t, i) {
        return t ? e(t) : this.settings.weekdaysShort[i.day]
      },
      dddd: function(t, i) {
        return t ? e(t) : this.settings.weekdaysFull[i.day]
      },
      m: function(t, e) {
        return t ? a.digits(t) : e.month + 1
      },
      mm: function(t, e) {
        return t ? 2 : a.lead(e.month + 1)
      },
      mmm: function(e, i) {
        var n = this.settings.monthsShort;
        return e ? t(e, n, i) : n[i.month]
      },
      mmmm: function(e, i) {
        var n = this.settings.monthsFull;
        return e ? t(e, n, i) : n[i.month]
      },
      yy: function(t, e) {
        return t ? 2 : ("" + e.year).slice(2)
      },
      yyyy: function(t, e) {
        return t ? 4 : e.year
      },
      toArray: function(t) {
        return t.split(/(d{1,4}|m{1,4}|y{4}|yy|!.)/g)
      },
      toString: function(t, e) {
        var i = this;
        return i.formats.toArray(t).map(function(t) {
          return a.trigger(i.formats[t], i, [0, e]) || t.replace(/^!/, "")
        }).join("")
      }
    }
  }(), i.prototype.isDateExact = function(t, i) {
    var n = this;
    return a.isInteger(t) && a.isInteger(i) || "boolean" == typeof t && "boolean" == typeof i ? t === i : (a.isDate(t) || e.isArray(t)) && (a.isDate(i) || e.isArray(i)) ? n.create(t).pick === n.create(i).pick : !(!e.isPlainObject(t) || !e.isPlainObject(i)) && (n.isDateExact(t.from, i.from) && n.isDateExact(t.to, i.to))
  }, i.prototype.isDateOverlap = function(t, i) {
    var n = this,
      o = n.settings.firstDay ? 1 : 0;
    return a.isInteger(t) && (a.isDate(i) || e.isArray(i)) ? (t = t % 7 + o, t === n.create(i).day + 1) : a.isInteger(i) && (a.isDate(t) || e.isArray(t)) ? (i = i % 7 + o, i === n.create(t).day + 1) : !(!e.isPlainObject(t) || !e.isPlainObject(i)) && n.overlapRanges(t, i)
  }, i.prototype.flipEnable = function(t) {
    var e = this.item;
    e.enable = t || (e.enable == -1 ? 1 : -1)
  }, i.prototype.deactivate = function(t, i) {
    var n = this,
      o = n.item.disable.slice(0);
    return "flip" == i ? n.flipEnable() : i === !1 ? (n.flipEnable(1), o = []) : i === !0 ? (n.flipEnable(-1), o = []) : i.map(function(t) {
      for (var i, s = 0; s < o.length; s += 1)
        if (n.isDateExact(t, o[s])) {
          i = !0;
          break
        } i || (a.isInteger(t) || a.isDate(t) || e.isArray(t) || e.isPlainObject(t) && t.from && t.to) && o.push(t)
    }), o
  }, i.prototype.activate = function(t, i) {
    var n = this,
      o = n.item.disable,
      s = o.length;
    return "flip" == i ? n.flipEnable() : i === !0 ? (n.flipEnable(1), o = []) : i === !1 ? (n.flipEnable(-1), o = []) : i.map(function(t) {
      var i, r, l, c;
      for (l = 0; l < s; l += 1) {
        if (r = o[l], n.isDateExact(r, t)) {
          i = o[l] = null, c = !0;
          break
        }
        if (n.isDateOverlap(r, t)) {
          e.isPlainObject(t) ? (t.inverted = !0, i = t) : e.isArray(t) ? (i = t, i[3] || i.push("inverted")) : a.isDate(t) && (i = [t.getFullYear(), t.getMonth(), t.getDate(), "inverted"]);
          break
        }
      }
      if (i)
        for (l = 0; l < s; l += 1)
          if (n.isDateExact(o[l], t)) {
            o[l] = null;
            break
          } if (c)
        for (l = 0; l < s; l += 1)
          if (n.isDateOverlap(o[l], t)) {
            o[l] = null;
            break
          } i && o.push(i)
    }), o.filter(function(t) {
      return null != t
    })
  }, i.prototype.nodes = function(t) {
    var e = this,
      i = e.settings,
      s = e.item,
      r = s.now,
      l = s.select,
      c = s.highlight,
      u = s.view,
      h = s.disable,
      d = s.min,
      p = s.max,
      f = function(t, e) {
        return i.firstDay && (t.push(t.shift()), e.push(e.shift())), a.node("thead", a.node("tr", a.group({
          min: 0,
          max: n - 1,
          i: 1,
          node: "th",
          item: function(n) {
            return [t[n], i.klass.weekdays, 'scope=col title="' + e[n] + '"']
          }
        })))
      }((i.showWeekdaysFull ? i.weekdaysFull : i.weekdaysShort).slice(0), i.weekdaysFull.slice(0)),
      m = function(t) {
        return a.node("div", " ", i.klass["nav" + (t ? "Next" : "Prev")] + (t && u.year >= p.year && u.month >= p.month || !t && u.year <= d.year && u.month <= d.month ? " " + i.klass.navDisabled : ""), "data-nav=" + (t || -1) + " " + a.ariaAttr({
          role: "button",
          controls: e.$node[0].id + "_table"
        }) + ' title="' + (t ? i.labelMonthNext : i.labelMonthPrev) + '"')
      },
      v = function() {
        var n = i.showMonthsShort ? i.monthsShort : i.monthsFull;
        return i.selectMonths ? a.node("select", a.group({
          min: 0,
          max: 11,
          i: 1,
          node: "option",
          item: function(t) {
            return [n[t], 0, "value=" + t + (u.month == t ? " selected" : "") + (u.year == d.year && t < d.month || u.year == p.year && t > p.month ? " disabled" : "")]
          }
        }), i.klass.selectMonth, (t ? "" : "disabled") + " " + a.ariaAttr({
          controls: e.$node[0].id + "_table"
        }) + ' title="' + i.labelMonthSelect + '"') : a.node("div", n[u.month], i.klass.month)
      },
      g = function() {
        var n = u.year,
          o = i.selectYears === !0 ? 5 : ~~(i.selectYears / 2);
        if (o) {
          var s = d.year,
            r = p.year,
            l = n - o,
            c = n + o;
          if (s > l && (c += s - l, l = s), r < c) {
            var h = l - s,
              f = c - r;
            l -= h > f ? f : h, c = r
          }
          return a.node("select", a.group({
            min: l,
            max: c,
            i: 1,
            node: "option",
            item: function(t) {
              return [t, 0, "value=" + t + (n == t ? " selected" : "")]
            }
          }), i.klass.selectYear, (t ? "" : "disabled") + " " + a.ariaAttr({
            controls: e.$node[0].id + "_table"
          }) + ' title="' + i.labelYearSelect + '"')
        }
        return a.node("div", n, i.klass.year)
      };
    return a.node("div", (i.selectYears ? g() + v() : v() + g()) + m() + m(1), i.klass.header) + a.node("table", f + a.node("tbody", a.group({
      min: 0,
      max: o - 1,
      i: 1,
      node: "tr",
      item: function(t) {
        var o = i.firstDay && 0 === e.create([u.year, u.month, 1]).day ? -7 : 0;
        return [a.group({
          min: n * t - u.day + o + 1,
          max: function() {
            return this.min + n - 1
          },
          i: 1,
          node: "td",
          item: function(t) {
            t = e.create([u.year, u.month, t + (i.firstDay ? 1 : 0)]);
            var n = l && l.pick == t.pick,
              o = c && c.pick == t.pick,
              s = h && e.disabled(t) || t.pick < d.pick || t.pick > p.pick,
              f = a.trigger(e.formats.toString, e, [i.format, t]);
            return [a.node("div", t.date, function(e) {
              return e.push(u.month == t.month ? i.klass.infocus : i.klass.outfocus), r.pick == t.pick && e.push(i.klass.now), n && e.push(i.klass.selected), o && e.push(i.klass.highlighted), s && e.push(i.klass.disabled), e.join(" ")
            }([i.klass.day]), "data-pick=" + t.pick + " " + a.ariaAttr({
              role: "gridcell",
              label: f,
              selected: !(!n || e.$node.val() !== f) || null,
              activedescendant: !!o || null,
              disabled: !!s || null
            })), "", a.ariaAttr({
              role: "presentation"
            })]
          }
        })]
      }
    })), i.klass.table, 'id="' + e.$node[0].id + '_table" ' + a.ariaAttr({
      role: "grid",
      controls: e.$node[0].id,
      readonly: !0
    })) + a.node("div", a.node("button", i.today, i.klass.buttonToday, "type=button data-pick=" + r.pick + (t && !e.disabled(r) ? "" : " disabled") + " " + a.ariaAttr({
      controls: e.$node[0].id
    })) + a.node("button", i.clear, i.klass.buttonClear, "type=button data-clear=1" + (t ? "" : " disabled") + " " + a.ariaAttr({
      controls: e.$node[0].id
    })) + a.node("button", i.close, i.klass.buttonClose, "type=button data-close=true " + (t ? "" : " disabled") + " " + a.ariaAttr({
      controls: e.$node[0].id
    })), i.klass.footer)
  }, i.defaults = function(t) {
    return {
      labelMonthNext: "Next month",
      labelMonthPrev: "Previous month",
      labelMonthSelect: "Select a month",
      labelYearSelect: "Select a year",
      monthsFull: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      weekdaysFull: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      weekdaysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      today: "Today",
      clear: "Clear",
      close: "Close",
      closeOnSelect: !0,
      closeOnClear: !0,
      format: "d mmmm, yyyy",
      klass: {
        table: t + "table",
        header: t + "header",
        navPrev: t + "nav--prev",
        navNext: t + "nav--next",
        navDisabled: t + "nav--disabled",
        month: t + "month",
        year: t + "year",
        selectMonth: t + "select--month",
        selectYear: t + "select--year",
        weekdays: t + "weekday",
        day: t + "day",
        disabled: t + "day--disabled",
        selected: t + "day--selected",
        highlighted: t + "day--highlighted",
        now: t + "day--today",
        infocus: t + "day--infocus",
        outfocus: t + "day--outfocus",
        footer: t + "footer",
        buttonClear: t + "button--clear",
        buttonToday: t + "button--today",
        buttonClose: t + "button--close"
      }
    }
  }(t.klasses().picker + "__"), t.extend("pickadate", i)
}), $.extend($.fn.pickadate.defaults, {
  selectMonths: !0,
  selectYears: 15,
  onRender: function() {
    var t = this.$root,
      e = this.get("highlight", "yyyy"),
      i = this.get("highlight", "dd"),
      n = this.get("highlight", "mmm"),
      o = this.get("highlight", "dddd");
    t.find(".picker__header").prepend('<div class="picker__date-display"><div class="picker__weekday-display">' + o + '</div><div class="picker__month-display"><div>' + n + '</div></div><div class="picker__day-display"><div>' + i + '</div></div><div    class="picker__year-display"><div>' + e + "</div></div></div>")
  }
}),
