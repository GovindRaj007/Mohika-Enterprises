/* ══════════════════════════════════════════════════════════════════════
   Motion — Motion (motion.dev: `animate` from motion/mini, plus inView,
   scroll, stagger) + Lenis, from assets/js/vendor/motion-lenis.min.js.

   Only runs when html.motion-ready is set (no reduced-motion preference).
   window.__motion is set at the very end of a successful boot; if it never
   is, partials/head.php removes motion-ready after 3 s so no content stays
   hidden.

   - Lenis smooth scrolling on mouse/trackpad; phones keep native momentum
   - staggered reveals per [data-reveal-group], inline styles cleared after
   - hero slide text entrance (window.siteMotion.slide, called by site.js)
   - number counters, inner-hero photo parallax, process-line draw
   The hero photos' slow drift (Ken Burns) is pure CSS — see hero.css.
   ══════════════════════════════════════════════════════════════════════ */
(function () {
  'use strict';

  var html = document.documentElement;
  var M = window.Motion;

  // Lenis-backed scroll API used by nav.js and the lightbox. Defined even
  // without Lenis so callers never need to check.
  var lenis = null;
  window.siteScroll = {
    top: function () { lenis ? lenis.scrollTo(0) : window.scrollTo({ top: 0, behavior: html.classList.contains('motion-ready') ? 'smooth' : 'auto' }); },
    stop: function () { if (lenis) { lenis.stop(); } },
    start: function () { if (lenis) { lenis.start(); } }
  };

  if (!html.classList.contains('motion-ready') || !M) {
    html.classList.remove('motion-ready');
    return;
  }

  try {
    var animate = M.animate, inView = M.inView, scroll = M.scroll, stagger = M.stagger;
    var ease = [0.22, 1, 0.36, 1];

    // Resolve when an animation finishes, whatever shape the controls take.
    function done(controls, fallbackMs) {
      return new Promise(function (resolve) {
        var settled = false;
        function finish() { if (!settled) { settled = true; resolve(); } }
        try {
          var p = controls && (controls.finished || (typeof controls.then === 'function' ? controls : null));
          if (p) { Promise.resolve(p).then(finish, finish); }
        } catch (e) { /* fall through to the timer */ }
        window.setTimeout(finish, fallbackMs);
      });
    }
    function clear(el) {
      el.removeAttribute('data-reveal');
      el.style.opacity = '';
      el.style.transform = '';
    }
    function rise(els, opts) {
      opts = opts || {};
      var step = opts.step || 0.07;
      var dur = opts.duration || 0.6;
      return done(
        animate(els, { opacity: [0, 1], transform: ['translateY(' + (opts.y || 22) + 'px)', 'none'] }, { duration: dur, ease: ease, delay: stagger(step, { startDelay: opts.start || 0 }) }),
        ((opts.start || 0) + dur + step * els.length) * 1000 + 120
      );
    }

    /* ── Lenis ── */
    if (window.Lenis && window.matchMedia('(pointer: fine)').matches) {
      var header = document.querySelector('[data-header]');
      lenis = new window.Lenis({
        duration: 1.1,
        smoothWheel: true,
        syncTouch: false,
        autoRaf: true,
        anchors: { offset: -((header ? header.offsetHeight : 72) + 16) }
      });
    }

    /* ── reveals ── */
    function reveal(els) {
      if (!els.length) { return; }
      rise(els).then(function () { els.forEach(clear); });
    }
    document.querySelectorAll('[data-reveal-group]').forEach(function (group) {
      inView(group, function () {
        reveal(Array.prototype.slice.call(group.querySelectorAll('[data-reveal]')).filter(function (el) {
          return el.closest('[data-reveal-group]') === group;
        }));
      }, { amount: 0.12 });
    });
    document.querySelectorAll('[data-reveal]').forEach(function (el) {
      if (el.closest('[data-reveal-group]')) { return; }
      inView(el, function () { reveal([el]); }, { amount: 0.15 });
    });

    /* ── hero slides: text rises in, line by line ── */
    function slideIn(slide, start) {
      if (!slide) { return; }
      var parts = Array.prototype.slice.call(slide.querySelectorAll('[data-slide-anim]'));
      if (!parts.length) { return; }
      rise(parts, { y: 28, duration: 0.75, step: 0.08, start: start || 0 }).then(function () {
        parts.forEach(function (el) { el.style.opacity = ''; el.style.transform = ''; });
      });
    }
    var hero = document.querySelector('[data-hero]');
    if (hero) {
      // The first slide's text is held hidden by CSS until this point
      // (.motion-ready .hero:not(.is-ready)), so it rises in rather than
      // flashing up and then animating.
      var first = hero.querySelector('.slide.is-active');
      if (first) {
        first.querySelectorAll('[data-slide-anim]').forEach(function (el) { el.style.opacity = '0'; });
      }
      hero.classList.add('is-ready');
      slideIn(first, 0.1);
      var head = hero.querySelector('.hero__head');
      if (head) {
        done(animate(head, { opacity: [0, 1], transform: ['translateY(-10px)', 'none'] }, { duration: 0.7, ease: ease }), 900)
          .then(function () { head.style.opacity = ''; head.style.transform = ''; });
      }
    }

    /* ── counters (requestAnimationFrame; mini animate has no number tweens) ── */
    document.querySelectorAll('[data-count]').forEach(function (el) {
      var target = parseInt(el.getAttribute('data-count'), 10) || 0;
      var suffix = el.getAttribute('data-suffix') || '';
      inView(el, function () {
        var t0 = performance.now();
        var len = 1200;
        (function tick(now) {
          var p = Math.min(1, (now - t0) / len);
          var eased = 1 - Math.pow(1 - p, 3);
          el.textContent = Math.round(target * eased) + suffix;
          if (p < 1) { window.requestAnimationFrame(tick); }
        })(t0);
      }, { amount: 0.6 });
    });

    /* ── inner-page hero photo parallax ── */
    document.querySelectorAll('[data-parallax] img').forEach(function (img) {
      scroll(function (progress) {
        img.style.transform = 'translate3d(0,' + (progress * 40).toFixed(1) + 'px,0) scale(1.06)';
      }, { target: img.parentElement, offset: ['start start', 'end start'] });
    });

    /* ── process line draw ── */
    document.querySelectorAll('[data-process]').forEach(function (list) {
      inView(list, function () {
        try {
          var wide = window.matchMedia('(min-width: 1024px)').matches;
          list.animate(
            { transform: wide ? ['scaleX(0)', 'scaleX(1)'] : ['scaleY(0)', 'scaleY(1)'] },
            { duration: 1100, easing: 'cubic-bezier(0.22, 1, 0.36, 1)', pseudoElement: '::before', fill: 'both' }
          );
        } catch (e) { /* pseudoElement unsupported: the line simply shows */ }
      }, { amount: 0.3 });
    });

    /* ── hooks used by site.js ── */
    window.siteMotion = {
      slide: function (slide) { slideIn(slide, 0.15); }
    };

    window.__motion = true;
  } catch (err) {
    html.classList.remove('motion-ready');
    document.querySelectorAll('[data-reveal], [data-slide-anim]').forEach(function (el) { el.style.opacity = ''; el.style.transform = ''; });
  }
})();
