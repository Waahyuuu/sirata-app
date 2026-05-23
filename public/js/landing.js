/* ═══════════════════════════════════════════════════════════
   LANDING PAGE SCRIPTS — SIRATA
   Handles: hamburger menu, tabs, FAQ accordion,
   form mock submit, scroll fade-up, count-up animation
   ═══════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

  /* ── HAMBURGER MOBILE MENU ──────────────────────── */
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const mobileNav    = document.getElementById('mobileNav');

  if (hamburgerBtn && mobileNav) {
    hamburgerBtn.addEventListener('click', () => {
      mobileNav.classList.toggle('open');
    });
  }

  /* ── CLOSE MOBILE NAV ───────────────────────────── */
  window.closeMobileNav = function () {
    if (mobileNav) mobileNav.classList.remove('open');
  };

  /* ── FEATURE TABS ───────────────────────────────── */
  const tabBtns   = document.querySelectorAll('.tab-btn');
  const tabPanels = document.querySelectorAll('.tab-panel');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      tabPanels.forEach(p => p.classList.remove('active'));

      btn.classList.add('active');
      const target = document.getElementById('tab-' + btn.dataset.tab);
      if (target) target.classList.add('active');
    });
  });

  /* ── FAQ ACCORDION ──────────────────────────────── */
  document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => {
      const item   = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');

      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ── SCROLL FADE-UP ─────────────────────────────── */
  const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        fadeObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

  /* ── COUNT-UP ANIMATION ─────────────────────────── */
  const counters = document.querySelectorAll('.count');
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el       = entry.target;
        const target   = +el.dataset.target;
        const duration = 1800;
        const step     = target / (duration / 16);
        let current    = 0;

        const timer = setInterval(() => {
          current += step;
          if (current >= target) {
            el.textContent = target;
            clearInterval(timer);
          } else {
            el.textContent = Math.floor(current);
          }
        }, 16);

        statsObserver.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => statsObserver.observe(c));

  /* ── FORM MOCK SUBMIT ───────────────────────────── */
  const searchForm = document.getElementById('searchForm');
  if (searchForm) {
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const label = document.getElementById('submitLabel');
      const resultCard = document.getElementById('resultCard');

      if (label) label.textContent = 'Mencari...';

      setTimeout(() => {
        if (label) label.textContent = 'Cari Informasi';
        if (resultCard) {
          resultCard.classList.add('show');
          resultCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
      }, 1200);
    });
  }

});
