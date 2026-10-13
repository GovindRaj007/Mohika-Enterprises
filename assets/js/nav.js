/* ══════════════════════════════════════════════════════════════════════
   Navigation — jQuery 3.7.1.
   Sticky header (transparent over the hero at the top, solid once
   scrolled; hides on scroll-down, returns on scroll-up), desktop dropdowns,
   mobile drawer (focus trap, Escape, scroll lock, one-open accordions),
   back-to-top (footer button + a floating arrow shown on scroll-up). Animation itself lives in motion.js.
   ══════════════════════════════════════════════════════════════════════ */
(function ($) {
  'use strict';
  if (!$) { return; }

  $(function () {
    var $win = $(window);
    var $html = $('html');
    var $header = $('[data-header]');
    var $drawer = $('[data-drawer]');
    var $burger = $('[data-drawer-toggle]');
    var $toTop = $('[data-to-top-fab]');
    var toTopRunning = false;   // our own smooth scroll up must not re-show it
    var lastY = window.scrollY;
    var ticking = false;
    var drawerOpen = false;
    var lockedY = 0;
    var phone = window.matchMedia('(max-width: 1023px)');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)');

    var scroller = {
      top: function () {
        if (window.siteScroll && window.siteScroll.top) { window.siteScroll.top(); return; }
        $('html, body').animate({ scrollTop: 0 }, reduce.matches ? 0 : 500);
      },
      stop: function () { if (window.siteScroll) { window.siteScroll.stop(); } },
      start: function () { if (window.siteScroll) { window.siteScroll.start(); } }
    };

    /* ── header state on scroll (rAF-throttled) ── */
    function onScroll() {
      var y = window.scrollY;
      $header.toggleClass('is-scrolled', y > 8);
      var goingDown = y > lastY + 4;
      var goingUp = y < lastY - 4;
      // Every width: hide while scrolling down, return on the way back up.
      // Never while the drawer or a mega menu is open, or the bar has focus.
      var menuOpen = $('.mega.is-open').length > 0;
      if (!drawerOpen && !menuOpen && !$header.is(':focus-within')) {
        if (goingDown && y > 160) { $header.addClass('is-hidden'); }
        else if (goingUp || y < 160) { $header.removeClass('is-hidden'); }
      } else {
        $header.removeClass('is-hidden');
      }
      // Floating back-to-top (bottom left): only while scrolling up, and
      // only once the visitor is a good way down the page.
      if (toTopRunning && y < 300) { toTopRunning = false; }
      if (goingUp && y > 600 && !toTopRunning) { $toTop.addClass('is-visible'); }
      else if (goingDown || y < 300) { $toTop.removeClass('is-visible'); }
      lastY = y;
      ticking = false;
    }
    $win.on('scroll', function () {
      if (!ticking) { ticking = true; window.requestAnimationFrame(onScroll); }
    });
    onScroll();

    /* ── desktop dropdowns ── */
    var $toggles = $('.nav__toggle');
    function closeMenus(except) {
      $toggles.each(function () {
        if (this === except) { return; }
        $(this).attr('aria-expanded', 'false');
        $('#' + $(this).attr('aria-controls')).removeClass('is-open');
      });
    }
    $toggles.on('click', function (e) {
      e.stopPropagation();
      var open = $(this).attr('aria-expanded') === 'true';
      closeMenus(this);
      $(this).attr('aria-expanded', open ? 'false' : 'true');
      $('#' + $(this).attr('aria-controls')).toggleClass('is-open', !open);
    });
    $(document).on('click', function (e) {
      if (!$(e.target).closest('.nav__item--menu').length) { closeMenus(); }
    });
    $(document).on('keydown', function (e) {
      if (e.key !== 'Escape') { return; }
      var $open = $toggles.filter('[aria-expanded="true"]');
      if ($open.length) { closeMenus(); $open.trigger('focus'); }
    });
    // Hover opens on pointer devices too, but click stays the source of truth.
    $('.nav__item--menu').on('mouseenter', function () {
      if (!window.matchMedia('(hover: hover)').matches) { return; }
      var t = $(this).find('.nav__toggle')[0];
      closeMenus(t);
      $(t).attr('aria-expanded', 'true');
      $('#' + $(t).attr('aria-controls')).addClass('is-open');
    }).on('mouseleave', function () {
      if (!window.matchMedia('(hover: hover)').matches) { return; }
      closeMenus();
    });

    /* ── drawer ── */
    function focusables() {
      return $drawer.find('a[href], button:not([disabled])').filter(':visible');
    }
    function openDrawer() {
      drawerOpen = true;
      lockedY = window.scrollY;
      $drawer.prop('hidden', false);
      $html.addClass('is-scroll-locked');
      scroller.stop();
      $burger.attr({ 'aria-expanded': 'true', 'aria-label': 'Close menu' });
      $header.removeClass('is-hidden');
      window.requestAnimationFrame(function () {
        $drawer.addClass('is-open');
        $drawer.find('.drawer__close').trigger('focus');
      });
    }
    function closeDrawer(returnFocus) {
      if (!drawerOpen) { return; }
      drawerOpen = false;
      $drawer.removeClass('is-open');
      $html.removeClass('is-scroll-locked');
      scroller.start();
      window.scrollTo(0, lockedY);
      $burger.attr({ 'aria-expanded': 'false', 'aria-label': 'Open menu' });
      window.setTimeout(function () { if (!drawerOpen) { $drawer.prop('hidden', true); } }, reduce.matches ? 0 : 320);
      if (returnFocus !== false) { $burger.trigger('focus'); }
    }
    $burger.on('click', function () { drawerOpen ? closeDrawer() : openDrawer(); });
    $drawer.on('click', '[data-drawer-close]', function () { closeDrawer(); });
    $drawer.on('click', 'a[href]', function () { closeDrawer(false); });
    $(document).on('keydown', function (e) {
      if (!drawerOpen) { return; }
      if (e.key === 'Escape') { e.preventDefault(); closeDrawer(); return; }
      if (e.key !== 'Tab') { return; }
      var $f = focusables();
      if (!$f.length) { return; }
      var first = $f[0];
      var last = $f[$f.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    });
    $win.on('resize', function () { if (!phone.matches) { closeDrawer(false); } });

    // Accordions (nested: Service areas → state → city): one open at a time
    // per level — opening a city closes the other cities, not the state.
    $drawer.on('click', '.drawer__acc', function () {
      var $btn = $(this);
      var open = $btn.attr('aria-expanded') === 'true';
      $btn.closest('.drawer__group').siblings('.drawer__group').children('.drawer__acc').attr('aria-expanded', 'false').each(function () {
        $('#' + $(this).attr('aria-controls')).prop('hidden', true);
      });
      $btn.attr('aria-expanded', open ? 'false' : 'true');
      $('#' + $btn.attr('aria-controls')).prop('hidden', open);
    });
    // Open the group holding the current page.
    $drawer.find('.drawer__sub').each(function () {
      if ($(this).find('[aria-current="page"]').length) {
        $(this).prop('hidden', false);
        $('[aria-controls="' + this.id + '"]').attr('aria-expanded', 'true');
      }
    });

    /* ── back to top ── */
    $('[data-to-top]').on('click', function (e) {
      toTopRunning = true;
      $toTop.removeClass('is-visible');
      scroller.top();
      // Keyboard users (detail 0 = no pointer) land back at the start of the
      // page instead of on a button that is about to hide.
      if (this.hasAttribute('data-to-top-fab') && e.detail === 0) { $('.skip-link').trigger('focus'); }
    });
  });
})(window.jQuery);
