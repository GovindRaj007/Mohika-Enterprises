// Source of assets/js/vendor/motion-lenis.min.js — see README → Motion.
// `animate` comes from motion/mini (Web Animations API only, a fraction of
// the size); inView, scroll and stagger from the main entry; plus Lenis.
import { animate } from 'motion/mini';
import { inView, scroll, stagger } from 'motion';
import Lenis from 'lenis';
window.Motion = { animate, inView, scroll, stagger };
window.Lenis = Lenis;
