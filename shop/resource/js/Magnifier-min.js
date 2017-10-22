(function() {
	function f(a) {
		w.innerHTML = a;
		return w.firstChild
	}
	function r(a) {
		l ? e.style.backgroundImage = "url(" + a + ")": m.src = a
	}
	function J() {
		s[this.big] = this.width;
		n = this.width / i.width;
		this.small == i.src && (r(this.src), o())
	}
	function K(a) {
		var a = a || event,
		a = a.target || a.srcElement,
		b = a.getAttribute("bigsrc");
		if (b) {
			i = a;
			var c = s[b];
			if (0 < c) n = c / a.width,
			r(b);
			else if (r(a.src), null == c) s[b] = 0,
			c = new Image,
			c.onload = J,
			c.big = b,
			c.small = a.src,
			c.src = b;
			t(document, "mousemove", x);
			t(document, y, z)
		}
	}
	function x(a) {
		var a = a || event,
		b = A.scrollLeft || B.scrollLeft,
		c = A.scrollTop || B.scrollTop,
		d = a.pageX || a.clientX + b,
		a = a.pageY || a.clientY + c,
		e = i.getBoundingClientRect(),
		f = e.left + b,
		b = e.right + b,
		g = e.top + c,
		c = e.bottom + c;
		if (d < f || d > b || a < g || a > c) C(document, "mousemove", x),
		C(document, y, z),
		h.display = "none",
		u = !1;
		else {
			if (!u) u = !0,
			h.display = "block",
			o();
			h.left = d - L + "px";
			h.top = a - M + "px";
			D = d - f;
			E = a - g; (N || O) && o();
			F()
		}
	}
	function z(a) {
		a = a || event;
		d += 0 < (a.wheelDelta || -a.detail) ? G: -G;
		o();
		F();
		v ? (a.stopPropagation(), a.preventDefault()) : a.returnValue = !1
	}
	function F() {
		var a = p( - d * D + g),
		b = p( - d * E + g);
		l ? e.style.backgroundPosition = a + "px " + b + "px": (j.pixelLeft = a, j.pixelTop = b)
	}
	function o() {
		d < H ? d = H: d > n && (d = n);
		var a = p(i.width * d),
		b = p(i.height * d);
		l ? e.style.backgroundSize = a + "px " + b + "px": (j.pixelWidth = a, j.pixelHeight = b)
	}
	var q = navigator.userAgent,
	P = /Firefox/.test(q);
	/MSIE/.test(q);
	var N = /MSIE 6/.test(q),
	O = /MSIE 7/.test(q) || 7 == document.documentMode,
	y = P ? "DOMMouseScroll": "mousewheel",
	v = !!window.addEventListener,
	w = document.createElement("div"),
	t = v ?
	function(a, b, c) {
		a.addEventListener(b, c, !1)
	}: function(a, b, c) {
		a.attachEvent("on" + b, c)
	},
	C = v ?
	function(a, b, c) {
		a.removeEventListener(b, c, !1)
	}: function(a, b, c) {
		a.detachEvent("on" + b, c)
	},
	A = document.documentElement,
	B = document.body,
	g = 90,
	I = 2 * g,
	L = 40 + g,
	M = 11 + g,
	G = 0.2,
	H = 1.5,
	n = 3.5,
	d = 2.5,
	p = Math.round,
	l,
	k,
	h,
	m,
	j,
	e,
	i,
	s = {},
	D = 0,
	E = 0,
	u; (function() {
		var a = "left:45px;top:15px;width:" + I + "px;height:" + I + "px;background-color: #FFF;position: absolute;";
		k = f("<div style='width:370px;height:370px;position: absolute;; z-index:999; cursor:none; display:none'></div>");
		h = k.style; (l = "borderRadius" in
		h) ? (e = f("<div style='" + a + "border-radius:" + g + "px; border:2px #ccc solid; background-repeat:no-repeat'></div>"), a = f("<img   style='position: absolute'>")) : (m = f("<img style='position:absolute'>"), j = m.style, e = f("<div style='" + a + "filter:chroma(color=#123456); background-repeat:no-repeat; overflow:hidden'></div>"), a = f("<img src='http://www.jcang.com.cn/themes/jcang/images/mask.png' style='position:absolute'>"), e.appendChild(m), e.appendChild(a), a = f("<div style='bwidth:370px;height:370px;position: absolute;'></div>"), h.cursor = "url(http://www.jcang.com.cn/themes/jcang/images/blank.ico)");
		k.appendChild(e);
		k.appendChild(a);
		document.body.appendChild(k);
		t(document, "mouseover", K);
		h.display = "none"
	})()
})();