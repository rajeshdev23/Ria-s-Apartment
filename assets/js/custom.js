document.querySelector(".menu__bar").addEventListener("click", function () {
  this.classList.toggle("menu__close");
  document.querySelector(".navbar__main").classList.toggle("show__menu");
  setTimeout(function () {
    document.querySelector("body").classList.toggle("overflow-hidden");
  }, 400);
});

window.addEventListener("scroll", function () {
  let headerMain = document.querySelector(".header__main");
  let navbar = document.querySelector(".navbar__main");

  if (window.scrollY > 40) {
    headerMain.classList.add("fixed");
  } else {
    headerMain.classList.remove("fixed");
  }
});

// Initialize slider
jQuery(document).ready(function () {
  // Initialize slider
  function initRoomSlider() {
    jQuery(".feature-room-slider")
      .not(".slick-initialized")
      .slick({
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        prevArrow:
          '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="fa-solid fa-arrow-right"></i></button>',
        dots: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        pauseOnHover: true,
        responsive: [
          {
            breakpoint: 768,
            settings: { slidesToShow: 2 },
          },
          {
            breakpoint: 576,
            settings: { slidesToShow: 1 },
          },
        ],
      });
  }

  initRoomSlider(); // First initialize

  // Refresh slider when tab becomes visible
  jQuery('button[data-bs-toggle="pill"]').on("shown.bs.tab", function () {
    jQuery(".feature-room-slider").slick("setPosition");
  });
});

// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const flipContainer = document.getElementById("langFlip");
  if (!flipContainer) return;

  const frontBtn = flipContainer.querySelector(".language__button--front");
  const backBtn = flipContainer.querySelector(".language__button--back");

  const normalize = (s) =>
    String(s || "")
      .trim()
      .toLowerCase();

  // 1) Determine page language (priority order)
  let pageLang =
    normalize(flipContainer.dataset.currentLang) ||
    normalize(document.documentElement.lang) ||
    normalize(document.body?.dataset?.lang) ||
    ""; // leave empty if none found

  // 2) Read button langs (if provided)
  const frontLang = normalize(frontBtn?.dataset?.lang);
  const backLang = normalize(backBtn?.dataset?.lang);

  // 3) If pageLang is empty, try to infer from which button already has .active in markup
  if (!pageLang) {
    if (
      frontBtn.classList.contains("active") &&
      !backBtn.classList.contains("active")
    ) {
      pageLang = frontLang || "";
    } else if (
      backBtn.classList.contains("active") &&
      !frontBtn.classList.contains("active")
    ) {
      pageLang = backLang || "";
    }
  }

  // 4) Decide which button should be active (default -> front)
  let frontIsActive = true; // default
  if (pageLang) {
    if (pageLang === frontLang) frontIsActive = true;
    else if (pageLang === backLang) frontIsActive = false;
    else {
      // If pageLang doesn't match either, fallback to existing markup or front
      frontIsActive =
        frontBtn.classList.contains("active") &&
        !backBtn.classList.contains("active");
      if (
        !frontBtn.classList.contains("active") &&
        !backBtn.classList.contains("active")
      )
        frontIsActive = true;
    }
  } else {
    // no pageLang found, use markup or default front
    frontIsActive =
      frontBtn.classList.contains("active") &&
      !backBtn.classList.contains("active");
    if (
      !frontBtn.classList.contains("active") &&
      !backBtn.classList.contains("active")
    )
      frontIsActive = true;
  }

  // 5) Apply active classes and initial transform
  frontBtn.classList.toggle("active", frontIsActive);
  backBtn.classList.toggle("active", !frontIsActive);

  let flipped = !frontIsActive; // flipped true => back face is shown
  flipContainer.style.transform = flipped ? "rotateY(180deg)" : "rotateY(0deg)";

  // ensure a smooth flip if not defined in CSS
  if (!flipContainer.style.transition)
    flipContainer.style.transition = "transform 0.4s ease";
  flipContainer.style.transformStyle = "preserve-3d";

  // Hover preview: temporarily show the other side while hovering
  flipContainer.addEventListener("mouseenter", () => {
    flipContainer.style.transform = flipped
      ? "rotateY(0deg)"
      : "rotateY(180deg)";
  });
  flipContainer.addEventListener("mouseleave", () => {
    flipContainer.style.transform = flipped
      ? "rotateY(180deg)"
      : "rotateY(0deg)";
  });

  // Click to toggle language UI and optionally redirect
  flipContainer.addEventListener("click", () => {
    flipped = !flipped;
    flipContainer.style.transform = flipped
      ? "rotateY(180deg)"
      : "rotateY(0deg)";

    // Update active classes immediately to reflect the new selection
    frontBtn.classList.toggle("active", !flipped);
    backBtn.classList.toggle("active", flipped);

    // Optional redirect (if you set data-url on buttons)
    const targetBtn = flipped ? backBtn : frontBtn;
    const url = targetBtn?.dataset?.url;
    if (url)
      setTimeout(() => {
        window.location.href = url;
      }, 200);
  });

  //    adding booking form classes

  // Select the <input> element inside the <p>
  const button = document.querySelector(
    ".mphb_sc_search-submit-button-wrapper .button",
  );
  if (!button) return;
  button.classList.add(
    "btn-theme",
    "search-btn",
    "w-100",
    "d-flex",
    "align-items-center",
    "justify-content-center",
    "gap-2",
  );
});

// document.addEventListener("DOMContentLoaded", () => {

//   const togglebtn = document.getElementById("toggle-popup");
//   const popup = document.querySelector(".amenities-popup");
//   const pageContent = document.querySelector("body");
//   const closeBtn = document.querySelector(".close-popup");
//   togglebtn.addEventListener("click", () => {
//     popup.classList.toggle("show");
//     if (popup.classList.contains("show")) {
//       pageContent.classList.add("end-scroll");
//     } else {
//       pageContent.classList.remove("end-scroll");
//     }
//   });
//   closeBtn.addEventListener("click", () => {
//     popup.classList.remove("show");
//     pageContent.classList.remove("end-scroll");
//   });

// });

// === Robust MotoPress datepicker auto-flip script ===
// Paste into console for testing, or add to your theme JS.

// === Robust MotoPress datepicker auto-flip script ===
// Paste into console for testing, or add to your theme JS.

// (function() {
//   const ROOT_SELECTOR = '.homepage-banner-widget';
//   const POPUP_SELECTORS = ['.datepick-popup', '.ui-datepicker', '.datepick'].join(',');
//   const root = document.querySelector(ROOT_SELECTOR);
//   if (!root) return; // run only on homepage banner

//   let lastInput = null;

//   // Click detection to track which input was clicked
//   root.addEventListener('click', (ev) => {
//     const inEl = ev.target.closest('.mphb-datepick, .mphb_datepicker, input.mphb-datepick');
//     if (inEl) {
//       lastInput = inEl;
//       const existing = document.querySelectorAll(POPUP_SELECTORS);
//       existing.forEach(p => {
//         p.style.removeProperty('top');
//         p.style.removeProperty('left');
//       });
//       setTimeout(() => tryPositionExistingPopups(), 70);
//     }
//   }, true);

//   function tryPositionExistingPopups() {
//     const popups = Array.from(document.querySelectorAll(POPUP_SELECTORS)).filter(p => {
//       const cs = window.getComputedStyle(p);
//       return cs.display !== 'none' && cs.visibility !== 'hidden' && p.offsetParent !== null;
//     });
//     if (!popups.length) return;

//     popups.forEach(p => {
//       // only reposition if input is inside homepage banner
//       if (root.contains(lastInput)) {
//         positionPopupForInput(p, lastInput);
//       }
//     });
//   }

//   function positionPopupForInput(popup, input) {
//     if (!popup) return;
//     if (!input || !document.body.contains(input)) {
//       input = document.activeElement && document.activeElement.classList && document.activeElement.classList.contains('mphb-datepick')
//         ? document.activeElement
//         : root.querySelector('.mphb-datepick');
//     }
//     if (!input) return;

//     popup.style.removeProperty('top');

//     const parent = popup.offsetParent || document.documentElement;
//     const parentRect = parent.getBoundingClientRect();
//     const inputRect = input.getBoundingClientRect();
//     let popupHeight = popup.offsetHeight || 300;

//     const spaceBelow = window.innerHeight - inputRect.bottom;
//     const spaceAbove = inputRect.top;

//     const left = inputRect.left - parentRect.left + (parent.scrollLeft || 0);
//     const openBelowTop = inputRect.bottom - parentRect.top + (parent.scrollTop || 0) + 8;
//     const openAboveTop = inputRect.top - parentRect.top + (parent.scrollTop || 0) - popupHeight - 8;

//     const preferAbove = (spaceBelow < popupHeight) && (spaceAbove > spaceBelow);

//     popup.style.position = 'absolute';
//     popup.style.left = Math.max(0, Math.round(left)) + 'px';

//     if (preferAbove) {
//       popup.style.top = Math.round(openAboveTop) + 'px';
//       popup.classList.add('dateflip-open-up');
//       popup.classList.remove('dateflip-open-down');
//     } else {
//       popup.style.top = Math.round(openBelowTop) + 'px';
//       popup.classList.add('dateflip-open-down');
//       popup.classList.remove('dateflip-open-up');
//     }

//     popup.style.zIndex = 999999;

//     // Add visible animation smoothly
//     requestAnimationFrame(() => popup.classList.add('is-visible'));

//     const reposition = () => {
//       if (!document.body.contains(popup) || !popup.offsetParent) {
//         window.removeEventListener('scroll', reposition, true);
//         window.removeEventListener('resize', reposition);
//         return;
//       }
//       positionPopupForInput(popup, input);
//     };
//     window.addEventListener('scroll', reposition, true);
//     window.addEventListener('resize', reposition);
//   }

//   const mo = new MutationObserver((mutations) => {
//     for (const m of mutations) {
//       for (const node of m.addedNodes) {
//         if (!(node instanceof HTMLElement)) continue;
//         if (node.matches && node.matches(POPUP_SELECTORS)) {
//           setTimeout(() => positionPopupForInput(node, lastInput), 20);
//         } else {
//           const found = node.querySelector && node.querySelector(POPUP_SELECTORS);
//           if (found) setTimeout(() => positionPopupForInput(found, lastInput), 20);
//         }
//       }
//     }
//   });
//   mo.observe(document.body, { childList: true, subtree: true });

//   // Add internal style (same as before)
//   const style = document.createElement('style');
//   style.id = 'dateflip-styles';
//   style.textContent = `
//     .homepage-banner-widget .dateflip-open-up { transform-origin: bottom; }
//     .homepage-banner-widget .dateflip-open-down { transform-origin: top; }
//     .homepage-banner-widget .datepick-popup,
//     .homepage-banner-widget .ui-datepicker,
//     .homepage-banner-widget .datepick {
//       transition: transform .12s ease, opacity .12s linear;
//     }
//   `;
//   document.head.appendChild(style);

//   console.info('[dateflip] Scoped datepicker auto-flip initialized inside homepage-banner-widget.');
// })();

// (function() {
//   const ROOT_SELECTOR = '.homepage-banner-widget';
//   const root = document.querySelector(ROOT_SELECTOR);
//   if (!root) return;

//   const selectors = ['.datepick-popup', '.ui-datepicker', '.datepick'];

//   const observer = new MutationObserver(() => {
//     selectors.forEach(sel => {
//       document.querySelectorAll(sel).forEach(el => {
//         if (!root.contains(el)) return; // affect only inside homepage-banner-widget
//         const visible = el.offsetParent !== null && window.getComputedStyle(el).display !== 'none';
//         if (visible && !el.classList.contains('is-visible')) {
//           setTimeout(() => el.classList.add('is-visible'), 120);
//         } else if (!visible && el.classList.contains('is-visible')) {
//           el.classList.remove('is-visible');
//         }
//       });
//     });
//   });

//   observer.observe(document.body, { attributes: true, childList: true, subtree: true });
// })();


