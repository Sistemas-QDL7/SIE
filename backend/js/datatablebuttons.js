/*!
 Buttons for DataTables 2.2.3
 ©2016-2022 SpryMedia Ltd - datatables.net/license
*/
(function (d) {
  "function" === typeof define && define.amd
    ? define(["jquery", "datatables.net"], function (A) {
        return d(A, window, document);
      })
    : "object" === typeof exports
    ? (module.exports = function (A, C) {
        A || (A = window);
        (C && C.fn.dataTable) || (C = require("datatables.net")(A, C).$);
        return d(C, A, A.document);
      })
    : d(jQuery, window, document);
})(function (d, A, C, p) {
  function I(a, b, c) {
    d.fn.animate
      ? a.stop().fadeIn(b, c)
      : (a.css("display", "block"), c && c.call(a));
  }
  function J(a, b, c) {
    d.fn.animate
      ? a.stop().fadeOut(b, c)
      : (a.css("display", "none"), c && c.call(a));
  }
  function L(a, b) {
    a = new u.Api(a);
    b = b ? b : a.init().buttons || u.defaults.buttons;
    return new x(a, b).container();
  }
  var u = d.fn.dataTable,
    O = 0,
    P = 0,
    D = u.ext.buttons,
    x = function (a, b) {
      if (!(this instanceof x))
        return function (c) {
          return new x(c, a).container();
        };
      "undefined" === typeof b && (b = {});
      !0 === b && (b = {});
      Array.isArray(b) && (b = { buttons: b });
      this.c = d.extend(!0, {}, x.defaults, b);
      b.buttons && (this.c.buttons = b.buttons);
      this.s = {
        dt: new u.Api(a),
        buttons: [],
        listenKeys: "",
        namespace: "dtb" + O++,
      };
      this.dom = {
        container: d("<" + this.c.dom.container.tag + "/>").addClass(
          this.c.dom.container.className
        ),
      };
      this._constructor();
    };
  d.extend(x.prototype, {
    action: function (a, b) {
      a = this._nodeToButton(a);
      if (b === p) return a.conf.action;
      a.conf.action = b;
      return this;
    },
    active: function (a, b) {
      var c = this._nodeToButton(a);
      a = this.c.dom.button.active;
      c = d(c.node);
      if (b === p) return c.hasClass(a);
      c.toggleClass(a, b === p ? !0 : b);
      return this;
    },
    add: function (a, b, c) {
      var e = this.s.buttons;
      if ("string" === typeof b) {
        b = b.split("-");
        var h = this.s;
        e = 0;
        for (var f = b.length - 1; e < f; e++) h = h.buttons[1 * b[e]];
        e = h.buttons;
        b = 1 * b[b.length - 1];
      }
      this._expandButton(
        e,
        a,
        a !== p ? a.split : p,
        (a === p || a.split === p || 0 === a.split.length) && h !== p,
        !1,
        b
      );
      (c !== p && !0 !== c) || this._draw();
      return this;
    },
    collectionRebuild: function (a, b) {
      a = this._nodeToButton(a);
      if (b !== p) {
        var c;
        for (c = a.buttons.length - 1; 0 <= c; c--)
          this.remove(a.buttons[c].node);
        for (c = 0; c < b.length; c++) {
          var e = b[c];
          this._expandButton(
            a.buttons,
            e,
            e !== p && e.config !== p && e.config.split !== p,
            !0,
            e.parentConf !== p && e.parentConf.split !== p,
            c,
            e.parentConf
          );
        }
      }
      this._draw(a.collection, a.buttons);
    },
    container: function () {
      return this.dom.container;
    },
    disable: function (a) {
      a = this._nodeToButton(a);
      d(a.node).addClass(this.c.dom.button.disabled).attr("disabled", !0);
      return this;
    },
    destroy: function () {
      d("body").off("keyup." + this.s.namespace);
      var a = this.s.buttons.slice(),
        b;
      var c = 0;
      for (b = a.length; c < b; c++) this.remove(a[c].node);
      this.dom.container.remove();
      a = this.s.dt.settings()[0];
      c = 0;
      for (b = a.length; c < b; c++)
        if (a.inst === this) {
          a.splice(c, 1);
          break;
        }
      return this;
    },
    enable: function (a, b) {
      if (!1 === b) return this.disable(a);
      a = this._nodeToButton(a);
      d(a.node).removeClass(this.c.dom.button.disabled).removeAttr("disabled");
      return this;
    },
    index: function (a, b, c) {
      b || ((b = ""), (c = this.s.buttons));
      for (var e = 0, h = c.length; e < h; e++) {
        var f = c[e].buttons;
        if (c[e].node === a) return b + e;
        if (f && f.length && ((f = this.index(a, e + "-", f)), null !== f))
          return f;
      }
      return null;
    },
    name: function () {
      return this.c.name;
    },
    node: function (a) {
      if (!a) return this.dom.container;
      a = this._nodeToButton(a);
      return d(a.node);
    },
    processing: function (a, b) {
      var c = this.s.dt,
        e = this._nodeToButton(a);
      if (b === p) return d(e.node).hasClass("processing");
      d(e.node).toggleClass("processing", b);
      d(c.table().node()).triggerHandler("buttons-processing.dt", [
        b,
        c.button(a),
        c,
        d(a),
        e.conf,
      ]);
      return this;
    },
    remove: function (a) {
      var b = this._nodeToButton(a),
        c = this._nodeToHost(a),
        e = this.s.dt;
      if (b.buttons.length)
        for (var h = b.buttons.length - 1; 0 <= h; h--)
          this.remove(b.buttons[h].node);
      b.conf.destroying = !0;
      b.conf.destroy && b.conf.destroy.call(e.button(a), e, d(a), b.conf);
      this._removeKey(b.conf);
      d(b.node).remove();
      a = d.inArray(b, c);
      c.splice(a, 1);
      return this;
    },
    text: function (a, b) {
      var c = this._nodeToButton(a);
      a = this.c.dom.collection.buttonLiner;
      a = c.inCollection && a && a.tag ? a.tag : this.c.dom.buttonLiner.tag;
      var e = this.s.dt,
        h = d(c.node),
        f = function (g) {
          return "function" === typeof g ? g(e, h, c.conf) : g;
        };
      if (b === p) return f(c.conf.text);
      c.conf.text = b;
      a
        ? h.children(a).eq(0).filter(":not(.dt-down-arrow)").html(f(b))
        : h.html(f(b));
      return this;
    },
    _constructor: function () {
      var a = this,
        b = this.s.dt,
        c = b.settings()[0],
        e = this.c.buttons;
      c._buttons || (c._buttons = []);
      c._buttons.push({ inst: this, name: this.c.name });
      for (var h = 0, f = e.length; h < f; h++) this.add(e[h]);
      b.on("destroy", function (g, l) {
        l === c && a.destroy();
      });
      d("body").on("keyup." + this.s.namespace, function (g) {
        if (!C.activeElement || C.activeElement === C.body) {
          var l = String.fromCharCode(g.keyCode).toLowerCase();
          -1 !== a.s.listenKeys.toLowerCase().indexOf(l) && a._keypress(l, g);
        }
      });
    },
    _addKey: function (a) {
      a.key &&
        (this.s.listenKeys += d.isPlainObject(a.key) ? a.key.key : a.key);
    },
    _draw: function (a, b) {
      a || ((a = this.dom.container), (b = this.s.buttons));
      a.children().detach();
      for (var c = 0, e = b.length; c < e; c++)
        a.append(b[c].inserter),
          a.append(" "),
          b[c].buttons &&
            b[c].buttons.length &&
            this._draw(b[c].collection, b[c].buttons);
    },
    _expandButton: function (a, b, c, e, h, f, g) {
      var l = this.s.dt,
        m = 0,
        r = Array.isArray(b) ? b : [b];
      b === p && (r = Array.isArray(c) ? c : [c]);
      c = 0;
      for (var q = r.length; c < q; c++) {
        var n = this._resolveExtends(r[c]);
        if (n)
          if (
            ((b = n.config !== p && n.config.split ? !0 : !1), Array.isArray(n))
          )
            this._expandButton(
              a,
              n,
              k !== p && k.conf !== p ? k.conf.split : p,
              e,
              g !== p && g.split !== p,
              f,
              g
            );
          else {
            var k = this._buildButton(
              n,
              e,
              n.split !== p || (n.config !== p && n.config.split !== p),
              h
            );
            if (k) {
              f !== p && null !== f ? (a.splice(f, 0, k), f++) : a.push(k);
              if (k.conf.buttons || k.conf.split) {
                k.collection = d(
                  "<" +
                    (b
                      ? this.c.dom.splitCollection.tag
                      : this.c.dom.collection.tag) +
                    "/>"
                );
                k.conf._collection = k.collection;
                if (k.conf.split)
                  for (var t = 0; t < k.conf.split.length; t++)
                    "object" === typeof k.conf.split[t] &&
                      ((k.conf.split[t].parent = g),
                      k.conf.split[t].collectionLayout === p &&
                        (k.conf.split[t].collectionLayout =
                          k.conf.collectionLayout),
                      k.conf.split[t].dropup === p &&
                        (k.conf.split[t].dropup = k.conf.dropup),
                      k.conf.split[t].fade === p &&
                        (k.conf.split[t].fade = k.conf.fade));
                else
                  d(k.node).append(
                    d(
                      '<span class="dt-down-arrow">' +
                        this.c.dom.splitDropdown.text +
                        "</span>"
                    )
                  );
                this._expandButton(
                  k.buttons,
                  k.conf.buttons,
                  k.conf.split,
                  !b,
                  b,
                  f,
                  k.conf
                );
              }
              k.conf.parent = g;
              n.init && n.init.call(l.button(k.node), l, d(k.node), n);
              m++;
            }
          }
      }
    },
    _buildButton: function (a, b, c, e) {
      var h = this.c.dom.button,
        f = this.c.dom.buttonLiner,
        g = this.c.dom.collection,
        l = this.c.dom.splitCollection,
        m = this.c.dom.splitDropdownButton,
        r = this.s.dt,
        q = function (v) {
          return "function" === typeof v ? v(r, k, a) : v;
        };
      if (a.spacer) {
        var n = d("<span></span>")
          .addClass("dt-button-spacer " + a.style + " " + h.spacerClass)
          .html(q(a.text));
        return {
          conf: a,
          node: n,
          inserter: n,
          buttons: [],
          inCollection: b,
          isSplit: c,
          inSplit: e,
          collection: null,
        };
      }
      !c && e && l ? (h = m) : !c && b && g.button && (h = g.button);
      !c && e && l.buttonLiner
        ? (f = l.buttonLiner)
        : !c && b && g.buttonLiner && (f = g.buttonLiner);
      if (a.available && !a.available(r, a) && !a.hasOwnProperty("html"))
        return !1;
      if (a.hasOwnProperty("html")) var k = d(a.html);
      else {
        var t = function (v, E, F, G) {
          G.action.call(E.button(F), v, E, F, G);
          d(E.table().node()).triggerHandler("buttons-action.dt", [
            E.button(F),
            E,
            F,
            G,
          ]);
        };
        g = a.tag || h.tag;
        var y = a.clickBlurs === p ? !0 : a.clickBlurs;
        k = d("<" + g + "/>")
          .addClass(h.className)
          .addClass(e ? this.c.dom.splitDropdownButton.className : "")
          .attr("tabindex", this.s.dt.settings()[0].iTabIndex)
          .attr("aria-controls", this.s.dt.table().node().id)
          .on("click.dtb", function (v) {
            v.preventDefault();
            !k.hasClass(h.disabled) && a.action && t(v, r, k, a);
            y && k.trigger("blur");
          })
          .on("keypress.dtb", function (v) {
            13 === v.keyCode &&
              (v.preventDefault(),
              !k.hasClass(h.disabled) && a.action && t(v, r, k, a));
          });
        "a" === g.toLowerCase() && k.attr("href", "#");
        "button" === g.toLowerCase() && k.attr("type", "button");
        f.tag
          ? ((g = d("<" + f.tag + "/>")
              .html(q(a.text))
              .addClass(f.className)),
            "a" === f.tag.toLowerCase() && g.attr("href", "#"),
            k.append(g))
          : k.html(q(a.text));
        !1 === a.enabled && k.addClass(h.disabled);
        a.className && k.addClass(a.className);
        a.titleAttr && k.attr("title", q(a.titleAttr));
        a.attr && k.attr(a.attr);
        a.namespace || (a.namespace = ".dt-button-" + P++);
        a.config !== p && a.config.split && (a.split = a.config.split);
      }
      f =
        (f = this.c.dom.buttonContainer) && f.tag
          ? d("<" + f.tag + "/>")
              .addClass(f.className)
              .append(k)
          : k;
      this._addKey(a);
      this.c.buttonCreated && (f = this.c.buttonCreated(a, f));
      if (c) {
        n = d("<div/>").addClass(this.c.dom.splitWrapper.className);
        n.append(k);
        var w = d.extend(a, {
          text: this.c.dom.splitDropdown.text,
          className: this.c.dom.splitDropdown.className,
          closeButton: !1,
          attr: { "aria-haspopup": "dialog", "aria-expanded": !1 },
          align: this.c.dom.splitDropdown.align,
          splitAlignClass: this.c.dom.splitDropdown.splitAlignClass,
        });
        this._addKey(w);
        var B = function (v, E, F, G) {
            D.split.action.call(
              E.button(d("div.dt-btn-split-wrapper")[0]),
              v,
              E,
              F,
              G
            );
            d(E.table().node()).triggerHandler("buttons-action.dt", [
              E.button(F),
              E,
              F,
              G,
            ]);
            F.attr("aria-expanded", !0);
          },
          z = d(
            '<button class="' +
              this.c.dom.splitDropdown.className +
              ' dt-button"><span class="dt-btn-split-drop-arrow">' +
              this.c.dom.splitDropdown.text +
              "</span></button>"
          )
            .on("click.dtb", function (v) {
              v.preventDefault();
              v.stopPropagation();
              z.hasClass(h.disabled) || B(v, r, z, w);
              y && z.trigger("blur");
            })
            .on("keypress.dtb", function (v) {
              13 === v.keyCode &&
                (v.preventDefault(), z.hasClass(h.disabled) || B(v, r, z, w));
            });
        0 === a.split.length && z.addClass("dtb-hide-drop");
        n.append(z).attr(w.attr);
      }
      return {
        conf: a,
        node: c ? n.get(0) : k.get(0),
        inserter: c ? n : f,
        buttons: [],
        inCollection: b,
        isSplit: c,
        inSplit: e,
        collection: null,
      };
    },
    _nodeToButton: function (a, b) {
      b || (b = this.s.buttons);
      for (var c = 0, e = b.length; c < e; c++) {
        if (b[c].node === a) return b[c];
        if (b[c].buttons.length) {
          var h = this._nodeToButton(a, b[c].buttons);
          if (h) return h;
        }
      }
    },
    _nodeToHost: function (a, b) {
      b || (b = this.s.buttons);
      for (var c = 0, e = b.length; c < e; c++) {
        if (b[c].node === a) return b;
        if (b[c].buttons.length) {
          var h = this._nodeToHost(a, b[c].buttons);
          if (h) return h;
        }
      }
    },
    _keypress: function (a, b) {
      if (!b._buttonsHandled) {
        var c = function (e) {
          for (var h = 0, f = e.length; h < f; h++) {
            var g = e[h].conf,
              l = e[h].node;
            g.key &&
              (g.key === a
                ? ((b._buttonsHandled = !0), d(l).click())
                : !d.isPlainObject(g.key) ||
                  g.key.key !== a ||
                  (g.key.shiftKey && !b.shiftKey) ||
                  (g.key.altKey && !b.altKey) ||
                  (g.key.ctrlKey && !b.ctrlKey) ||
                  (g.key.metaKey && !b.metaKey) ||
                  ((b._buttonsHandled = !0), d(l).click()));
            e[h].buttons.length && c(e[h].buttons);
          }
        };
        c(this.s.buttons);
      }
    },
    _removeKey: function (a) {
      if (a.key) {
        var b = d.isPlainObject(a.key) ? a.key.key : a.key;
        a = this.s.listenKeys.split("");
        b = d.inArray(b, a);
        a.splice(b, 1);
        this.s.listenKeys = a.join("");
      }
    },
    _resolveExtends: function (a) {
      var b = this,
        c = this.s.dt,
        e,
        h = function (m) {
          for (var r = 0; !d.isPlainObject(m) && !Array.isArray(m); ) {
            if (m === p) return;
            if ("function" === typeof m) {
              if (((m = m.call(b, c, a)), !m)) return !1;
            } else if ("string" === typeof m) {
              if (!D[m]) return { html: m };
              m = D[m];
            }
            r++;
            if (30 < r) throw "Buttons: Too many iterations";
          }
          return Array.isArray(m) ? m : d.extend({}, m);
        };
      for (a = h(a); a && a.extend; ) {
        if (!D[a.extend])
          throw "Cannot extend unknown button type: " + a.extend;
        var f = h(D[a.extend]);
        if (Array.isArray(f)) return f;
        if (!f) return !1;
        var g = f.className;
        a.config !== p &&
          f.config !== p &&
          (a.config = d.extend({}, f.config, a.config));
        a = d.extend({}, f, a);
        g && a.className !== g && (a.className = g + " " + a.className);
        var l = a.postfixButtons;
        if (l) {
          a.buttons || (a.buttons = []);
          g = 0;
          for (e = l.length; g < e; g++) a.buttons.push(l[g]);
          a.postfixButtons = null;
        }
        if ((l = a.prefixButtons)) {
          a.buttons || (a.buttons = []);
          g = 0;
          for (e = l.length; g < e; g++) a.buttons.splice(g, 0, l[g]);
          a.prefixButtons = null;
        }
        a.extend = f.extend;
      }
      return a;
    },
    _popover: function (a, b, c, e) {
      e = this.c;
      var h = !1,
        f = d.extend(
          {
            align: "button-left",
            autoClose: !1,
            background: !0,
            backgroundClassName: "dt-button-background",
            closeButton: !0,
            contentClassName: e.dom.collection.className,
            collectionLayout: "",
            collectionTitle: "",
            dropup: !1,
            fade: 400,
            popoverTitle: "",
            rightAlignClassName: "dt-button-right",
            tag: e.dom.collection.tag,
          },
          c
        ),
        g = b.node(),
        l = function () {
          h = !0;
          J(d(".dt-button-collection"), f.fade, function () {
            d(this).detach();
          });
          d(
            b.buttons('[aria-haspopup="dialog"][aria-expanded="true"]').nodes()
          ).attr("aria-expanded", "false");
          d("div.dt-button-background").off("click.dtb-collection");
          x.background(!1, f.backgroundClassName, f.fade, g);
          d(A).off("resize.resize.dtb-collection");
          d("body").off(".dtb-collection");
          b.off("buttons-action.b-internal");
          b.off("destroy");
        };
      if (!1 === a) l();
      else {
        c = d(
          b.buttons('[aria-haspopup="dialog"][aria-expanded="true"]').nodes()
        );
        c.length &&
          (g.closest("div.dt-button-collection").length && (g = c.eq(0)), l());
        c = d(".dt-button", a).length;
        e = "";
        3 === c
          ? (e = "dtb-b3")
          : 2 === c
          ? (e = "dtb-b2")
          : 1 === c && (e = "dtb-b1");
        var m = d("<div/>")
          .addClass("dt-button-collection")
          .addClass(f.collectionLayout)
          .addClass(f.splitAlignClass)
          .addClass(e)
          .css("display", "none")
          .attr({ "aria-modal": !0, role: "dialog" });
        a = d(a).addClass(f.contentClassName).attr("role", "menu").appendTo(m);
        g.attr("aria-expanded", "true");
        g.parents("body")[0] !== C.body && (g = C.body.lastChild);
        f.popoverTitle
          ? m.prepend(
              '<div class="dt-button-collection-title">' +
                f.popoverTitle +
                "</div>"
            )
          : f.collectionTitle &&
            m.prepend(
              '<div class="dt-button-collection-title">' +
                f.collectionTitle +
                "</div>"
            );
        f.closeButton &&
          m
            .prepend('<div class="dtb-popover-close">x</div>')
            .addClass("dtb-collection-closeable");
        I(m.insertAfter(g), f.fade);
        c = d(b.table().container());
        var r = m.css("position");
        if ("container" === f.span || "dt-container" === f.align)
          (g = g.parent()), m.css("width", c.width());
        if ("absolute" === r) {
          var q = d(g[0].offsetParent);
          c = g.position();
          e = g.offset();
          var n = q.offset(),
            k = q.position(),
            t = A.getComputedStyle(q[0]);
          n.height = q.outerHeight();
          n.width = q.width() + parseFloat(t.paddingLeft);
          n.right = n.left + n.width;
          n.bottom = n.top + n.height;
          q = c.top + g.outerHeight();
          var y = c.left;
          m.css({ top: q, left: y });
          t = A.getComputedStyle(m[0]);
          var w = m.offset();
          w.height = m.outerHeight();
          w.width = m.outerWidth();
          w.right = w.left + w.width;
          w.bottom = w.top + w.height;
          w.marginTop = parseFloat(t.marginTop);
          w.marginBottom = parseFloat(t.marginBottom);
          f.dropup && (q = c.top - w.height - w.marginTop - w.marginBottom);
          if ("button-right" === f.align || m.hasClass(f.rightAlignClassName))
            y = c.left - w.width + g.outerWidth();
          if ("dt-container" === f.align || "container" === f.align)
            y < c.left && (y = -c.left),
              y + w.width > n.width && (y = n.width - w.width);
          k.left + y + w.width > d(A).width() &&
            (y = d(A).width() - w.width - k.left);
          0 > e.left + y && (y = -e.left);
          k.top + q + w.height > d(A).height() + d(A).scrollTop() &&
            (q = c.top - w.height - w.marginTop - w.marginBottom);
          k.top + q < d(A).scrollTop() && (q = c.top + g.outerHeight());
          m.css({ top: q, left: y });
        } else
          (r = function () {
            var B = d(A).height() / 2,
              z = m.height() / 2;
            z > B && (z = B);
            m.css("marginTop", -1 * z);
          }),
            r(),
            d(A).on("resize.dtb-collection", function () {
              r();
            });
        f.background &&
          x.background(
            !0,
            f.backgroundClassName,
            f.fade,
            f.backgroundHost || g
          );
        d("div.dt-button-background").on(
          "click.dtb-collection",
          function () {}
        );
        f.autoClose &&
          setTimeout(function () {
            b.on("buttons-action.b-internal", function (B, z, v, E) {
              E[0] !== g[0] && l();
            });
          }, 0);
        d(m).trigger("buttons-popover.dt");
        b.on("destroy", l);
        setTimeout(function () {
          h = !1;
          d("body")
            .on("click.dtb-collection", function (B) {
              if (!h) {
                var z = d.fn.addBack ? "addBack" : "andSelf",
                  v = d(B.target).parent()[0];
                ((!d(B.target).parents()[z]().filter(a).length &&
                  !d(v).hasClass("dt-buttons")) ||
                  d(B.target).hasClass("dt-button-background")) &&
                  l();
              }
            })
            .on("keyup.dtb-collection", function (B) {
              27 === B.keyCode && l();
            })
            .on("keydown.dtb-collection", function (B) {
              var z = d("a, button", a),
                v = C.activeElement;
              9 === B.keyCode &&
                (-1 === z.index(v)
                  ? (z.first().focus(), B.preventDefault())
                  : B.shiftKey
                  ? v === z[0] && (z.last().focus(), B.preventDefault())
                  : v === z.last()[0] &&
                    (z.first().focus(), B.preventDefault()));
            });
        }, 0);
      }
    },
  });
  x.background = function (a, b, c, e) {
    c === p && (c = 400);
    e || (e = C.body);
    a
      ? I(d("<div/>").addClass(b).css("display", "none").insertAfter(e), c)
      : J(d("div." + b), c, function () {
          d(this).removeClass(b).remove();
        });
  };
  x.instanceSelector = function (a, b) {
    if (a === p || null === a)
      return d.map(b, function (f) {
        return f.inst;
      });
    var c = [],
      e = d.map(b, function (f) {
        return f.name;
      }),
      h = function (f) {
        if (Array.isArray(f)) for (var g = 0, l = f.length; g < l; g++) h(f[g]);
        else
          "string" === typeof f
            ? -1 !== f.indexOf(",")
              ? h(f.split(","))
              : ((f = d.inArray(f.trim(), e)), -1 !== f && c.push(b[f].inst))
            : "number" === typeof f
            ? c.push(b[f].inst)
            : "object" === typeof f && c.push(f);
      };
    h(a);
    return c;
  };
  x.buttonSelector = function (a, b) {
    for (
      var c = [],
        e = function (l, m, r) {
          for (var q, n, k = 0, t = m.length; k < t; k++)
            if ((q = m[k]))
              (n = r !== p ? r + k : k + ""),
                l.push({ node: q.node, name: q.conf.name, idx: n }),
                q.buttons && e(l, q.buttons, n + "-");
        },
        h = function (l, m) {
          var r,
            q = [];
          e(q, m.s.buttons);
          var n = d.map(q, function (k) {
            return k.node;
          });
          if (Array.isArray(l) || l instanceof d)
            for (n = 0, r = l.length; n < r; n++) h(l[n], m);
          else if (null === l || l === p || "*" === l)
            for (n = 0, r = q.length; n < r; n++)
              c.push({ inst: m, node: q[n].node });
          else if ("number" === typeof l)
            m.s.buttons[l] && c.push({ inst: m, node: m.s.buttons[l].node });
          else if ("string" === typeof l)
            if (-1 !== l.indexOf(","))
              for (q = l.split(","), n = 0, r = q.length; n < r; n++)
                h(q[n].trim(), m);
            else if (l.match(/^\d+(\-\d+)*$/))
              (n = d.map(q, function (k) {
                return k.idx;
              })),
                c.push({ inst: m, node: q[d.inArray(l, n)].node });
            else if (-1 !== l.indexOf(":name"))
              for (l = l.replace(":name", ""), n = 0, r = q.length; n < r; n++)
                q[n].name === l && c.push({ inst: m, node: q[n].node });
            else
              d(n)
                .filter(l)
                .each(function () {
                  c.push({ inst: m, node: this });
                });
          else
            "object" === typeof l &&
              l.nodeName &&
              ((q = d.inArray(l, n)),
              -1 !== q && c.push({ inst: m, node: n[q] }));
        },
        f = 0,
        g = a.length;
      f < g;
      f++
    )
      h(b, a[f]);
    return c;
  };
  x.stripData = function (a, b) {
    if ("string" !== typeof a) return a;
    a = a.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "");
    a = a.replace(/<!\-\-.*?\-\->/g, "");
    if (!b || b.stripHtml) a = a.replace(/<[^>]*>/g, "");
    if (!b || b.trim) a = a.replace(/^\s+|\s+$/g, "");
    if (!b || b.stripNewlines) a = a.replace(/\n/g, " ");
    if (!b || b.decodeEntities) (M.innerHTML = a), (a = M.value);
    return a;
  };
  x.defaults = {
    buttons: ["copy", "excel", "csv", "pdf", "print"],
    name: "main",
    tabIndex: 0,
    dom: {
      container: { tag: "div", className: "dt-buttons" },
      collection: { tag: "div", className: "" },
      button: {
        tag: "button",
        className: "dt-button",
        active: "active",
        disabled: "disabled",
        spacerClass: "",
      },
      buttonLiner: { tag: "span", className: "" },
      split: { tag: "div", className: "dt-button-split" },
      splitWrapper: { tag: "div", className: "dt-btn-split-wrapper" },
      splitDropdown: {
        tag: "button",
        text: "&#x25BC;",
        className: "dt-btn-split-drop",
        align: "split-right",
        splitAlignClass: "dt-button-split-left",
      },
      splitDropdownButton: {
        tag: "button",
        className: "dt-btn-split-drop-button dt-button",
      },
      splitCollection: { tag: "div", className: "dt-button-split-collection" },
    },
  };
  x.version = "2.2.3";
  d.extend(D, {
    collection: {
      text: function (a) {
        return a.i18n("buttons.collection", "Collection");
      },
      className: "buttons-collection",
      closeButton: !1,
      init: function (a, b, c) {
        b.attr("aria-expanded", !1);
      },
      action: function (a, b, c, e) {
        e._collection.parents("body").length
          ? this.popover(!1, e)
          : this.popover(e._collection, e);
        "keypress" === a.type && d("a, button", e._collection).eq(0).focus();
      },
      attr: { "aria-haspopup": "dialog" },
    },
    split: {
      text: function (a) {
        return a.i18n("buttons.split", "Split");
      },
      className: "buttons-split",
      closeButton: !1,
      init: function (a, b, c) {
        return b.attr("aria-expanded", !1);
      },
      action: function (a, b, c, e) {
        this.popover(e._collection, e);
      },
      attr: { "aria-haspopup": "dialog" },
    },
    copy: function (a, b) {
      if (D.copyHtml5) return "copyHtml5";
    },
    csv: function (a, b) {
      if (D.csvHtml5 && D.csvHtml5.available(a, b)) return "csvHtml5";
    },
    excel: function (a, b) {
      if (D.excelHtml5 && D.excelHtml5.available(a, b)) return "excelHtml5";
    },
    pdf: function (a, b) {
      if (D.pdfHtml5 && D.pdfHtml5.available(a, b)) return "pdfHtml5";
    },
    pageLength: function (a) {
      a = a.settings()[0].aLengthMenu;
      var b = [],
        c = [];
      if (Array.isArray(a[0])) (b = a[0]), (c = a[1]);
      else
        for (var e = 0; e < a.length; e++) {
          var h = a[e];
          d.isPlainObject(h)
            ? (b.push(h.value), c.push(h.label))
            : (b.push(h), c.push(h));
        }
      return {
        extend: "collection",
        text: function (f) {
          return f.i18n(
            "buttons.pageLength",
            { "-1": "Show all rows", _: "Show %d rows" },
            f.page.len()
          );
        },
        className: "buttons-page-length",
        autoClose: !0,
        buttons: d.map(b, function (f, g) {
          return {
            text: c[g],
            className: "button-page-length",
            action: function (l, m) {
              m.page.len(f).draw();
            },
            init: function (l, m, r) {
              var q = this;
              m = function () {
                q.active(l.page.len() === f);
              };
              l.on("length.dt" + r.namespace, m);
              m();
            },
            destroy: function (l, m, r) {
              l.off("length.dt" + r.namespace);
            },
          };
        }),
        init: function (f, g, l) {
          var m = this;
          f.on("length.dt" + l.namespace, function () {
            m.text(l.text);
          });
        },
        destroy: function (f, g, l) {
          f.off("length.dt" + l.namespace);
        },
      };
    },
    spacer: {
      style: "empty",
      spacer: !0,
      text: function (a) {
        return a.i18n("buttons.spacer", "");
      },
    },
  });
  u.Api.register("buttons()", function (a, b) {
    b === p && ((b = a), (a = p));
    this.selector.buttonGroup = a;
    var c = this.iterator(
      !0,
      "table",
      function (e) {
        if (e._buttons)
          return x.buttonSelector(x.instanceSelector(a, e._buttons), b);
      },
      !0
    );
    c._groupSelector = a;
    return c;
  });
  u.Api.register("button()", function (a, b) {
    a = this.buttons(a, b);
    1 < a.length && a.splice(1, a.length);
    return a;
  });
  u.Api.registerPlural("buttons().active()", "button().active()", function (a) {
    return a === p
      ? this.map(function (b) {
          return b.inst.active(b.node);
        })
      : this.each(function (b) {
          b.inst.active(b.node, a);
        });
  });
  u.Api.registerPlural("buttons().action()", "button().action()", function (a) {
    return a === p
      ? this.map(function (b) {
          return b.inst.action(b.node);
        })
      : this.each(function (b) {
          b.inst.action(b.node, a);
        });
  });
  u.Api.registerPlural(
    "buttons().collectionRebuild()",
    "button().collectionRebuild()",
    function (a) {
      return this.each(function (b) {
        for (var c = 0; c < a.length; c++)
          "object" === typeof a[c] && (a[c].parentConf = b);
        b.inst.collectionRebuild(b.node, a);
      });
    }
  );
  u.Api.register(["buttons().enable()", "button().enable()"], function (a) {
    return this.each(function (b) {
      b.inst.enable(b.node, a);
    });
  });
  u.Api.register(["buttons().disable()", "button().disable()"], function () {
    return this.each(function (a) {
      a.inst.disable(a.node);
    });
  });
  u.Api.register("button().index()", function () {
    var a = null;
    this.each(function (b) {
      b = b.inst.index(b.node);
      null !== b && (a = b);
    });
    return a;
  });
  u.Api.registerPlural("buttons().nodes()", "button().node()", function () {
    var a = d();
    d(
      this.each(function (b) {
        a = a.add(b.inst.node(b.node));
      })
    );
    return a;
  });
  u.Api.registerPlural(
    "buttons().processing()",
    "button().processing()",
    function (a) {
      return a === p
        ? this.map(function (b) {
            return b.inst.processing(b.node);
          })
        : this.each(function (b) {
            b.inst.processing(b.node, a);
          });
    }
  );
  u.Api.registerPlural("buttons().text()", "button().text()", function (a) {
    return a === p
      ? this.map(function (b) {
          return b.inst.text(b.node);
        })
      : this.each(function (b) {
          b.inst.text(b.node, a);
        });
  });
  u.Api.registerPlural(
    "buttons().trigger()",
    "button().trigger()",
    function () {
      return this.each(function (a) {
        a.inst.node(a.node).trigger("click");
      });
    }
  );
  u.Api.register("button().popover()", function (a, b) {
    return this.map(function (c) {
      return c.inst._popover(a, this.button(this[0].node), b);
    });
  });
  u.Api.register("buttons().containers()", function () {
    var a = d(),
      b = this._groupSelector;
    this.iterator(!0, "table", function (c) {
      if (c._buttons) {
        c = x.instanceSelector(b, c._buttons);
        for (var e = 0, h = c.length; e < h; e++) a = a.add(c[e].container());
      }
    });
    return a;
  });
  u.Api.register("buttons().container()", function () {
    return this.containers().eq(0);
  });
  u.Api.register("button().add()", function (a, b, c) {
    var e = this.context;
    e.length &&
      ((e = x.instanceSelector(this._groupSelector, e[0]._buttons)),
      e.length && e[0].add(b, a, c));
    return this.button(this._groupSelector, a);
  });
  u.Api.register("buttons().destroy()", function () {
    this.pluck("inst")
      .unique()
      .each(function (a) {
        a.destroy();
      });
    return this;
  });
  u.Api.registerPlural("buttons().remove()", "buttons().remove()", function () {
    this.each(function (a) {
      a.inst.remove(a.node);
    });
    return this;
  });
  var H;
  u.Api.register("buttons.info()", function (a, b, c) {
    var e = this;
    if (!1 === a)
      return (
        this.off("destroy.btn-info"),
        J(d("#datatables_buttons_info"), 400, function () {
          d(this).remove();
        }),
        clearTimeout(H),
        (H = null),
        this
      );
    H && clearTimeout(H);
    d("#datatables_buttons_info").length &&
      d("#datatables_buttons_info").remove();
    a = a ? "<h2>" + a + "</h2>" : "";
    I(
      d('<div id="datatables_buttons_info" class="dt-button-info"/>')
        .html(a)
        .append(d("<div/>")["string" === typeof b ? "html" : "append"](b))
        .css("display", "none")
        .appendTo("body")
    );
    c !== p &&
      0 !== c &&
      (H = setTimeout(function () {
        e.buttons.info(!1);
      }, c));
    this.on("destroy.btn-info", function () {
      e.buttons.info(!1);
    });
    return this;
  });
  u.Api.register("buttons.exportData()", function (a) {
    if (this.context.length) return Q(new u.Api(this.context[0]), a);
  });
  u.Api.register("buttons.exportInfo()", function (a) {
    a || (a = {});
    var b = a;
    var c =
      "*" === b.filename &&
      "*" !== b.title &&
      b.title !== p &&
      null !== b.title &&
      "" !== b.title
        ? b.title
        : b.filename;
    "function" === typeof c && (c = c());
    c === p || null === c
      ? (c = null)
      : (-1 !== c.indexOf("*") &&
          (c = c.replace("*", d("head > title").text()).trim()),
        (c = c.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g, "")),
        (b = K(b.extension)) || (b = ""),
        (c += b));
    b = K(a.title);
    b =
      null === b
        ? null
        : -1 !== b.indexOf("*")
        ? b.replace("*", d("head > title").text() || "Exported data")
        : b;
    return {
      filename: c,
      title: b,
      messageTop: N(this, a.message || a.messageTop, "top"),
      messageBottom: N(this, a.messageBottom, "bottom"),
    };
  });
  var K = function (a) {
      return null === a || a === p ? null : "function" === typeof a ? a() : a;
    },
    N = function (a, b, c) {
      b = K(b);
      if (null === b) return null;
      a = d("caption", a.table().container()).eq(0);
      return "*" === b
        ? a.css("caption-side") !== c
          ? null
          : a.length
          ? a.text()
          : ""
        : b;
    },
    M = d("<textarea/>")[0],
    Q = function (a, b) {
      var c = d.extend(
        !0,
        {},
        {
          rows: null,
          columns: "",
          modifier: { search: "applied", order: "applied" },
          orthogonal: "display",
          stripHtml: !0,
          stripNewlines: !0,
          decodeEntities: !0,
          trim: !0,
          format: {
            header: function (t) {
              return x.stripData(t, c);
            },
            footer: function (t) {
              return x.stripData(t, c);
            },
            body: function (t) {
              return x.stripData(t, c);
            },
          },
          customizeData: null,
        },
        b
      );
      b = a
        .columns(c.columns)
        .indexes()
        .map(function (t) {
          var y = a.column(t).header();
          return c.format.header(y.innerHTML, t, y);
        })
        .toArray();
      var e = a.table().footer()
          ? a
              .columns(c.columns)
              .indexes()
              .map(function (t) {
                var y = a.column(t).footer();
                return c.format.footer(y ? y.innerHTML : "", t, y);
              })
              .toArray()
          : null,
        h = d.extend({}, c.modifier);
      a.select &&
        "function" === typeof a.select.info &&
        h.selected === p &&
        a.rows(c.rows, d.extend({ selected: !0 }, h)).any() &&
        d.extend(h, { selected: !0 });
      h = a.rows(c.rows, h).indexes().toArray();
      var f = a.cells(h, c.columns);
      h = f.render(c.orthogonal).toArray();
      f = f.nodes().toArray();
      for (
        var g = b.length, l = [], m = 0, r = 0, q = 0 < g ? h.length / g : 0;
        r < q;
        r++
      ) {
        for (var n = [g], k = 0; k < g; k++)
          (n[k] = c.format.body(h[m], r, k, f[m])), m++;
        l[r] = n;
      }
      b = { header: b, footer: e, body: l };
      c.customizeData && c.customizeData(b);
      return b;
    };
  d.fn.dataTable.Buttons = x;
  d.fn.DataTable.Buttons = x;
  d(C).on("init.dt plugin-init.dt", function (a, b) {
    "dt" === a.namespace &&
      (a = b.oInit.buttons || u.defaults.buttons) &&
      !b._buttons &&
      new x(b, a).container();
  });
  u.ext.feature.push({ fnInit: L, cFeature: "B" });
  u.ext.features && u.ext.features.register("buttons", L);
  return x;
});
