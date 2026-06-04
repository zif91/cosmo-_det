/* ============================================================
   КОСМОС ДЕТЕЙЛИНГ — interactions
   ============================================================ */
(function () {
  "use strict";
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Header scroll state ---------- */
  const header = $(".site-header");
  const onScroll = () => header && header.classList.toggle("scrolled", window.scrollY > 30);
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  /* ---------- Mobile menu ---------- */
  const burger = $(".burger");
  const menu = $(".mobile-menu");
  if (burger && menu) {
    const toggle = (open) => {
      burger.classList.toggle("open", open);
      menu.classList.toggle("open", open);
      document.body.style.overflow = open ? "hidden" : "";
    };
    burger.addEventListener("click", () => toggle(!menu.classList.contains("open")));
    $$("a", menu).forEach((a) => a.addEventListener("click", () => toggle(false)));
  }

  /* ---------- Scroll reveal ---------- */
  const reveals = $$("[data-reveal]");
  if (reveals.length && "IntersectionObserver" in window && !reduce) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add("in");
            io.unobserve(e.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -8% 0px" }
    );
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("in"));
  }

  /* ---------- Animated counters ---------- */
  const counters = $$("[data-count]");
  if (counters.length && "IntersectionObserver" in window) {
    const cio = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (!e.isIntersecting) return;
          const el = e.target;
          const target = parseFloat(el.dataset.count);
          const suffix = el.dataset.suffix || "";
          const dur = 1600;
          const start = performance.now();
          const tick = (now) => {
            const p = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            const val = target * eased;
            el.textContent =
              (Number.isInteger(target) ? Math.round(val) : val.toFixed(1)).toLocaleString("ru-RU") + suffix;
            if (p < 1) requestAnimationFrame(tick);
          };
          if (reduce) el.textContent = target.toLocaleString("ru-RU") + suffix;
          else requestAnimationFrame(tick);
          cio.unobserve(el);
        });
      },
      { threshold: 0.5 }
    );
    counters.forEach((c) => cio.observe(c));
  }

  /* ---------- FAQ accordion ---------- */
  $$(".qa").forEach((qa) => {
    const btn = $("button", qa);
    const ans = $(".ans", qa);
    if (!btn || !ans) return;
    btn.addEventListener("click", () => {
      const open = qa.classList.contains("open");
      $$(".qa.open").forEach((o) => {
        o.classList.remove("open");
        $(".ans", o).style.maxHeight = null;
      });
      if (!open) {
        qa.classList.add("open");
        ans.style.maxHeight = ans.scrollHeight + "px";
      }
    });
  });

  /* ---------- Quiz chips (single/multi) ---------- */
  $$(".chips").forEach((group) => {
    const multi = group.dataset.multi === "true";
    $$(".chip", group).forEach((chip) => {
      chip.addEventListener("click", () => {
        if (multi) chip.classList.toggle("active");
        else {
          $$(".chip", group).forEach((c) => c.classList.remove("active"));
          chip.classList.add("active");
        }
      });
    });
  });

  /* ---------- Lead form (демо-отправка) ---------- */
  $$("form[data-lead]").forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const ok = $(".form-ok", form.parentElement) || $(".form-ok", form);
      form.style.display = "none";
      if (ok) ok.classList.add("show");
    });
  });

  /* ---------- Lightbox gallery ---------- */
  const shots = $$(".gallery .shot");
  if (shots.length) {
    const lb = document.createElement("div");
    lb.className = "lightbox";
    lb.innerHTML =
      '<button class="lb-btn lb-close" aria-label="Закрыть"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
      '<button class="lb-btn lb-prev" aria-label="Назад"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M15 6l-6 6 6 6"/></svg></button>' +
      '<img alt="Работа Космос Детейлинг">' +
      '<button class="lb-btn lb-next" aria-label="Вперёд"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="22" height="22"><path d="M9 6l6 6-6 6"/></svg></button>' +
      '<div class="lb-count"></div>';
    document.body.appendChild(lb);
    const lbImg = $("img", lb);
    const lbCount = $(".lb-count", lb);
    const srcs = shots.map((s) => $("img", s).dataset.full || $("img", s).src);
    let idx = 0;
    const show = (i) => {
      idx = (i + srcs.length) % srcs.length;
      lbImg.src = srcs[idx];
      lbCount.textContent = idx + 1 + " / " + srcs.length;
    };
    const open = (i) => {
      show(i);
      lb.classList.add("open");
      document.body.style.overflow = "hidden";
    };
    const close = () => {
      lb.classList.remove("open");
      document.body.style.overflow = "";
    };
    shots.forEach((s, i) => s.addEventListener("click", () => open(i)));
    $(".lb-close", lb).addEventListener("click", close);
    $(".lb-next", lb).addEventListener("click", () => show(idx + 1));
    $(".lb-prev", lb).addEventListener("click", () => show(idx - 1));
    lb.addEventListener("click", (e) => {
      if (e.target === lb) close();
    });
    document.addEventListener("keydown", (e) => {
      if (!lb.classList.contains("open")) return;
      if (e.key === "Escape") close();
      if (e.key === "ArrowRight") show(idx + 1);
      if (e.key === "ArrowLeft") show(idx - 1);
    });
  }

  /* ---------- Hero parallax (лёгкий) ---------- */
  const heroMedia = $(".hero-media img");
  if (heroMedia && !reduce) {
    window.addEventListener(
      "scroll",
      () => {
        const y = window.scrollY;
        if (y < window.innerHeight) heroMedia.style.transform = "translate3d(0," + y * 0.18 + "px,0) scale(1.06)";
      },
      { passive: true }
    );
  }

  /* ---------- Starfield canvas (тонкий, не планетарий) ---------- */
  const canvas = $("#stars");
  if (canvas && !reduce) {
    const ctx = canvas.getContext("2d");
    let w, h, stars, dpr;
    const init = () => {
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      w = canvas.width = innerWidth * dpr;
      h = canvas.height = innerHeight * dpr;
      canvas.style.width = innerWidth + "px";
      canvas.style.height = innerHeight + "px";
      const count = Math.min(120, Math.floor((innerWidth * innerHeight) / 14000));
      stars = Array.from({ length: count }, () => ({
        x: Math.random() * w,
        y: Math.random() * h,
        r: (Math.random() * 1.2 + 0.2) * dpr,
        a: Math.random() * 0.6 + 0.2,
        tw: Math.random() * 0.02 + 0.004,
        ph: Math.random() * Math.PI * 2,
        gold: Math.random() > 0.82,
      }));
    };
    const draw = (t) => {
      ctx.clearRect(0, 0, w, h);
      for (const s of stars) {
        const tw = s.a + Math.sin(t * s.tw + s.ph) * 0.25;
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
        ctx.fillStyle = s.gold
          ? "rgba(230,207,154," + Math.max(0, tw) + ")"
          : "rgba(255,255,255," + Math.max(0, tw) + ")";
        ctx.fill();
      }
      requestAnimationFrame(draw);
    };
    init();
    requestAnimationFrame(draw);
    let rt;
    window.addEventListener("resize", () => {
      clearTimeout(rt);
      rt = setTimeout(init, 200);
    });
  }

  /* ---------- Active nav by current page ---------- */
  const path = location.pathname.split("/").pop() || "index.html";
  $$(".nav a, .mobile-menu a").forEach((a) => {
    const href = a.getAttribute("href");
    if (href === path || (path === "index.html" && href === "index.html")) a.classList.add("active");
  });

  /* ---------- Year ---------- */
  $$("[data-year]").forEach((el) => (el.textContent = new Date().getFullYear()));

  /* Сигнал, что скрипт успешно отработал — отключает failsafe-показ контента из <head> */
  window.__kosmosReady = true;
})();
