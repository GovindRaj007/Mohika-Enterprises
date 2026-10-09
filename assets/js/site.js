/* ══════════════════════════════════════════════════════════════════════
   Page widgets — jQuery 3.7.1.
   Hero slideshow, FAQ open/close animation, area finder, gallery filters,
   area carousel,
   lightbox, quote-form validation (on blur and submit, never keypress),
   and GTM dataLayer events for calls, WhatsApp and quote clicks.
   Every widget exits quietly when its markup is absent.
   ══════════════════════════════════════════════════════════════════════ */
(function ($) {
  'use strict';
  if (!$) { return; }

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)');

  $(function () {

    /* ── home hero slideshow ──────────────────────────────────────────
       Autoplay every 7 s in step with the CSS progress bar; stops while
       hovered or focused (APG carousel), while the tab is hidden, when
       paused, and never starts under reduced motion. Arrow keys and swipe
       move between slides; each tab is a real link to the service page
       when JS is off. */
    $('[data-hero]').each(function () {
      var $hero = $(this);
      var $slides = $hero.find('[data-slide]');
      var $bgs = $hero.find('[data-hero-bg]');
      var $tabs = $hero.find('[data-slide-to]');
      var $pause = $hero.find('[data-hero-pause]');
      var $live = $hero.find('[data-hero-live]');
      var count = $slides.length;
      var DUR = 7000;
      var current = 0;
      var timer = null;
      var startedAt = 0;
      var remaining = DUR;
      var userPaused = reduce.matches;
      var holds = 0;           // hover / focus / hidden-tab holds
      var prevTimer = null;

      if (count < 2) { return; }
      $hero[0].style.setProperty('--hero-dur', DUR + 'ms');
      if (reduce.matches) { $hero.addClass('no-autoplay'); }

      // Warm the other photos once the page itself has finished loading.
      $(window).on('load', function () { $hero.addClass('is-loaded'); });
      if (document.readyState === 'complete') { $hero.addClass('is-loaded'); }

      function syncPauseButton() {
        $pause.attr({
          'aria-pressed': userPaused ? 'true' : 'false',
          'aria-label': userPaused ? 'Play slideshow' : 'Pause slideshow'
        });
        $live.attr('aria-live', userPaused ? 'polite' : 'off');
        $hero.toggleClass('is-paused', userPaused || holds > 0);
      }

      function stopTimer() {
        if (timer) {
          window.clearTimeout(timer);
          timer = null;
          remaining = Math.max(0, remaining - (Date.now() - startedAt));
        }
      }
      function startTimer() {
        if (timer || userPaused || holds > 0) { return; }
        startedAt = Date.now();
        timer = window.setTimeout(function () { timer = null; go(current + 1); }, remaining);
      }

      function restartBar($tab) {
        var bar = $tab.find('.hero__tab-bar span')[0];
        if (!bar) { return; }
        bar.style.animation = 'none';
        void bar.offsetWidth;   // reflow so the animation restarts
        bar.style.animation = '';
      }

      function go(index) {
        index = (index + count) % count;
        if (index === current) { return; }
        var $oldBg = $bgs.eq(current);
        $bgs.removeClass('is-prev');
        $oldBg.removeClass('is-active').addClass('is-prev');
        $bgs.eq(index).addClass('is-active');
        window.clearTimeout(prevTimer);
        prevTimer = window.setTimeout(function () { $oldBg.removeClass('is-prev'); }, 1300);

        $slides.eq(current).removeClass('is-active').attr('aria-hidden', 'true').prop('inert', true);
        var $next = $slides.eq(index).addClass('is-active').removeAttr('aria-hidden').prop('inert', false);

        $tabs.removeClass('is-active').removeAttr('aria-current');
        var $tab = $tabs.eq(index).addClass('is-active').attr('aria-current', 'true');
        restartBar($tab);

        current = index;
        if (window.siteMotion && window.siteMotion.slide) { window.siteMotion.slide($next[0]); }

        stopTimer();
        remaining = DUR;
        startTimer();
      }

      function hold() { holds++; stopTimer(); syncPauseButton(); }
      function release() { holds = Math.max(0, holds - 1); syncPauseButton(); startTimer(); }

      $tabs.on('click', function (e) {
        e.preventDefault();
        go(parseInt($(this).attr('data-slide-to'), 10));
      });
      $hero.find('[data-hero-prev]').on('click', function () { go(current - 1); });
      $hero.find('[data-hero-next]').on('click', function () { go(current + 1); });
      $pause.on('click', function () {
        userPaused = !userPaused;
        if (userPaused) { stopTimer(); } else { remaining = remaining || DUR; }
        syncPauseButton();
        startTimer();
      });

      $hero.on('keydown', function (e) {
        if ($(e.target).is('input, textarea, select')) { return; }
        if (e.key === 'ArrowRight') { go(current + 1); }
        else if (e.key === 'ArrowLeft') { go(current - 1); }
      });

      // Hovering the interactive parts (controls, buttons, spec card) and
      // keyboard focus hold the rotation. Not the whole hero: it fills the
      // screen, so a resting mouse would otherwise stop it for good.
      if (window.matchMedia('(hover: hover)').matches) {
        $hero.on('mouseenter', '.hero__controls, .slide__actions, .slide__card', hold)
             .on('mouseleave', '.hero__controls, .slide__actions, .slide__card', release);
      }
      $hero.on('focusin', function (e) {
        if (!$hero[0].contains(e.relatedTarget)) { hold(); }
      }).on('focusout', function (e) {
        if (!$hero[0].contains(e.relatedTarget)) { release(); }
      });
      document.addEventListener('visibilitychange', function () {
        if (document.hidden) { hold(); } else { release(); }
      });

      // Swipe on touch screens.
      var touchX = null;
      var touchY = null;
      $hero.on('touchstart', function (e) {
        var t = e.originalEvent.touches[0];
        touchX = t.clientX;
        touchY = t.clientY;
      }).on('touchend', function (e) {
        if (touchX === null) { return; }
        var t = e.originalEvent.changedTouches[0];
        var dx = t.clientX - touchX;
        var dy = t.clientY - touchY;
        if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy) * 1.5) { go(dx < 0 ? current + 1 : current - 1); }
        touchX = touchY = null;
      });

      syncPauseButton();
      startTimer();
    });

    /* ── FAQ: animate native <details>; without JS they still work ── */
    $('.faq__item').each(function () {
      var details = this;
      var $answer = $(details).find('.faq__a');
      $(details).find('summary').on('click', function (e) {
        if (reduce.matches) { return; }
        e.preventDefault();
        if (details.open) {
          $answer.stop(true).slideUp(220, function () { details.open = false; $answer.css('display', ''); });
        } else {
          details.open = true;
          $answer.hide().stop(true).slideDown(260, function () { $answer.css('display', ''); });
        }
      });
    });

    /* ── installation clips (partials/reel.php) ──────────────────────
       Native controls give way to one play/pause toggle. Clips play,
       muted, only while at least half on screen; never on their own under
       reduced motion. A clip the visitor paused stays paused; one they
       started keeps the "auto" behaviour off. Nothing downloads before the
       first play (preload="none"). */
    $('[data-reel]').each(function () {
      var video = this;
      var $toggle = $(video).siblings('[data-reel-toggle]');
      var label = $toggle.attr('aria-label').replace(/^Play video: /, '');
      var userChoice = null;          // null = automatic, 'play' / 'pause' = chosen
      video.controls = false;
      $toggle.prop('hidden', false);

      function sync() {
        var playing = !video.paused;
        $toggle.attr({ 'aria-pressed': playing ? 'true' : 'false', 'aria-label': (playing ? 'Pause video: ' : 'Play video: ') + label });
        $(video).closest('.reel').toggleClass('is-playing', playing);
      }
      function play() { var p = video.play(); if (p && p.catch) { p.catch(function () { sync(); }); } }
      $(video).on('play pause', sync);
      $toggle.on('click', function () {
        if (video.paused) { userChoice = 'play'; play(); } else { userChoice = 'pause'; video.pause(); }
      });
      $(video).on('click', function () { $toggle.trigger('click'); });

      if (!reduce.matches && 'IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (userChoice === 'pause') { return; }
            if (entry.isIntersecting && entry.intersectionRatio >= 0.5) { play(); }
            else if (!video.paused && userChoice !== 'play') { video.pause(); }
          });
        }, { threshold: [0, 0.5] }).observe(video);
      }
      sync();
    });

    /* ── card carousels (service areas, reviews): prev/next step one
       card; touch and trackpad swipe are native scroll-snap ── */
    $('[data-area-rail]').each(function () {
      var $rail = $(this);
      var track = $rail.find('[data-area-track]')[0];
      var $prev = $rail.find('[data-area-prev]');
      var $next = $rail.find('[data-area-next]');
      if (!track) { return; }
      function step() {
        var card = track.firstElementChild;
        if (!card) { return track.clientWidth; }
        var gap = parseFloat(window.getComputedStyle(track).columnGap) || 0;
        return card.getBoundingClientRect().width + gap;
      }
      function update() {
        var max = track.scrollWidth - track.clientWidth - 2;
        $rail.toggleClass('is-static', max <= 0);   // everything fits: no arrows
        $prev.prop('disabled', track.scrollLeft <= 2);
        $next.prop('disabled', track.scrollLeft >= max);
      }
      $prev.on('click', function () { track.scrollBy({ left: -step(), behavior: reduce.matches ? 'auto' : 'smooth' }); });
      $next.on('click', function () { track.scrollBy({ left: step(), behavior: reduce.matches ? 'auto' : 'smooth' }); });
      $(track).on('scroll', function () { window.requestAnimationFrame(update); });
      $(window).on('resize', update);
      update();
    });

    /* ── area finder ── */
    $('[data-area-finder]').each(function () {
      var $input = $(this).find('[data-area-input]');
      var $empty = $(this).find('[data-area-empty]');
      var $items = $('[data-area-item]');
      var $groups = $('[data-area-group]');
      $input.on('input', function () {
        var q = $.trim(String($input.val() || '')).toLowerCase();
        var shown = 0;
        $items.each(function () {
          var match = q === '' || String($(this).data('area-name')).indexOf(q) !== -1;
          $(this).toggle(match);
          if (match) { shown++; }
        });
        // Judge groups by their items' own display, not :visible — an item
        // inside a hidden group is never :visible, so the group would stay hidden.
        $groups.each(function () {
          var any = $(this).find('[data-area-item]').filter(function () { return this.style.display !== 'none'; }).length > 0;
          $(this).toggle(any);
        });
        $empty.prop('hidden', shown > 0);
      });
      $input.on('keydown', function (e) {
        if (e.key !== 'Enter') { return; }
        var $visible = $items.filter(function () { return this.style.display !== 'none'; });
        if ($visible.length === 1) { window.location.href = $visible.find('.city-card__name a').attr('href'); }
      });
    });

    /* ── gallery filters ── */
    $('[data-filters]').each(function () {
      var $buttons = $(this).find('[data-filter]');
      var $groups = $('[data-filter-group]');
      function apply(key) {
        $buttons.each(function () {
          var on = $(this).data('filter') === key;
          $(this).toggleClass('is-active', on).attr('aria-pressed', on ? 'true' : 'false');
        });
        $groups.each(function () { $(this).prop('hidden', key !== 'all' && $(this).data('filter-group') !== key); });
      }
      $buttons.on('click', function () { apply($(this).data('filter')); });
      var hash = window.location.hash.replace('#', '');
      if (hash && $groups.filter('[data-filter-group="' + hash + '"]').length) { apply(hash); }
    });

    /* ── lightbox ── */
    var $links = $('[data-lightbox]');
    if ($links.length) {
      var $box = null;
      var current = 0;
      var $set = $();
      var opener = null;
      function show(i) {
        current = (i + $set.length) % $set.length;
        var $a = $set.eq(current);
        var alt = $a.find('img').attr('alt') || '';
        $box.find('.lightbox__img').attr({ src: $a.attr('href'), alt: alt });
        $box.find('.lightbox__caption').text(alt);
      }
      function close() {
        if (!$box) { return; }
        $box.removeClass('is-open');
        var $old = $box;
        $box = null;
        window.setTimeout(function () { $old.remove(); }, reduce.matches ? 0 : 220);
        $('html').removeClass('is-scroll-locked');
        if (window.siteScroll) { window.siteScroll.start(); }
        if (opener) { opener.focus(); }
      }
      $links.on('click', function (e) {
        e.preventDefault();
        opener = this;
        $set = $(this).closest('[data-gallery]').find('[data-lightbox]');
        $box = $('<div class="lightbox" role="dialog" aria-modal="true" aria-label="Photo viewer">' +
          '<figure><img class="lightbox__img" src="" alt=""><figcaption class="lightbox__caption"></figcaption></figure>' +
          '<button class="lightbox__btn lightbox__close" type="button" aria-label="Close photo">&times;</button>' +
          ($set.length > 1 ? '<button class="lightbox__btn lightbox__prev" type="button" aria-label="Previous photo">&rarr;</button>' +
          '<button class="lightbox__btn lightbox__next" type="button" aria-label="Next photo">&rarr;</button>' : '') +
          '</div>').appendTo('body');
        show($set.index(this));
        $('html').addClass('is-scroll-locked');
        if (window.siteScroll) { window.siteScroll.stop(); }
        window.requestAnimationFrame(function () { if ($box) { $box.addClass('is-open'); $box.find('.lightbox__close').trigger('focus'); } });
        $box.on('click', function (ev) { if (ev.target === this) { close(); } });
        $box.on('click', '.lightbox__close', close);
        $box.on('click', '.lightbox__prev', function () { show(current - 1); });
        $box.on('click', '.lightbox__next', function () { show(current + 1); });
      });
      $(document).on('keydown', function (e) {
        if (!$box) { return; }
        if (e.key === 'Escape') { close(); }
        else if (e.key === 'ArrowRight' && $set.length > 1) { show(current + 1); }
        else if (e.key === 'ArrowLeft' && $set.length > 1) { show(current - 1); }
        else if (e.key === 'Tab') {
          var $f = $box.find('button');
          var idx = $f.index(document.activeElement);
          e.preventDefault();
          $f.eq((idx + (e.shiftKey ? -1 : 1) + $f.length) % $f.length).trigger('focus');
        }
      });
    }

    /* ── quote form: same four rules as the server ── */
    $('[data-quote-form]').each(function () {
      var $form = $(this);
      var rules = {
        name: function () { var v = $.trim($form.find('[name="name"]').val() || ''); return v !== '' && v.length <= 100; },
        phone: function () {
          var d = String($form.find('[name="phone"]').val() || '').replace(/\D/g, '');
          if (d.length === 12 && d.indexOf('91') === 0) { d = d.slice(2); }
          else if (d.length === 11 && d.charAt(0) === '0') { d = d.slice(1); }
          return /^[6-9]\d{9}$/.test(d);
        },
        city: function () { return ($form.find('[name="city"]').val() || '') !== ''; },
        services: function () { return $form.find('[name="services[]"]:checked').length > 0; }
      };
      function check(field) {
        var ok = rules[field]();
        var $err = $('#err-' + field);
        var $ctl = field === 'services' ? $form.find('.form__group') : $form.find('[name="' + field + '"]');
        $err.prop('hidden', ok);
        if (field === 'services') {
          ok ? $ctl.removeAttr('aria-describedby') : $ctl.attr('aria-describedby', 'err-services');
        } else if (ok) {
          $ctl.removeAttr('aria-invalid aria-describedby');
        } else {
          $ctl.attr({ 'aria-invalid': 'true', 'aria-describedby': 'err-' + field });
        }
        return ok;
      }
      $form.find('[name="name"], [name="phone"], [name="city"]').on('blur', function () {
        if ($(this).val() !== '') { check(this.name); }
      });
      $form.find('[name="services[]"]').on('change', function () { if (!$('#err-services').prop('hidden')) { check('services'); } });
      $form.on('submit', function (e) {
        var firstBad = null;
        $.each(['name', 'phone', 'city', 'services'], function (_, f) { if (!check(f) && !firstBad) { firstBad = f; } });
        if (firstBad) {
          e.preventDefault();
          (firstBad === 'services' ? $form.find('[name="services[]"]').first() : $form.find('[name="' + firstBad + '"]')).trigger('focus');
        } else {
          $form.find('[type="submit"]').prop('disabled', true);
        }
      });
    });

    /* ── analytics events (only when GTM is on the page) ── */
    $(document).on('click', 'a[href^="tel:"], a[href*="wa.me/"], [data-track]', function () {
      if (!window.dataLayer) { return; }
      var href = $(this).attr('href') || '';
      var type = href.indexOf('tel:') === 0 ? 'call_click' : href.indexOf('wa.me/') !== -1 ? 'whatsapp_click' : 'cta_click';
      window.dataLayer.push({ event: type, cta_position: $(this).data('track') || '', page_path: window.location.pathname });
    });
    if (/[?&]sent=1/.test(window.location.search) && window.dataLayer) {
      window.dataLayer.push({ event: 'quote_submitted', page_path: window.location.pathname });
    }
  });
})(window.jQuery);
