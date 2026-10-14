const qs = (selector, root = document) => root.querySelector(selector);
const qsa = (selector, root = document) => [...root.querySelectorAll(selector)];

const currentPage = location.pathname.split("/").pop() || "index.html";

// Replace legacy static homepage links with Laravel's clean home route.
qsa('a[href="index.html"]').forEach((link) => link.setAttribute("href", "/"));

if ("IntersectionObserver" in window) {
  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  qsa("[data-reveal]").forEach((item) => revealObserver.observe(item));
} else {
  qsa("[data-reveal]").forEach((item) => item.classList.add("is-visible"));
}
qsa(".desktop-nav > a.nav-link").forEach((link) => {
  const href = link.getAttribute("href");
  link.removeAttribute("aria-current");
  if (href === currentPage || (currentPage === "product-detail.html" && href === "products.html")) {
    link.setAttribute("aria-current", "page");
  }
});

const landingHeader = qs("[data-landing-header]");
if (landingHeader) {
  const headerLogo = qs("[data-header-logo]", landingHeader);
  const updateLandingHeader = () => {
    const isScrolled = window.scrollY > 24;
    landingHeader.classList.toggle("is-scrolled", isScrolled);
    if (headerLogo) headerLogo.src = isScrolled ? headerLogo.dataset.darkLogo : headerLogo.dataset.lightLogo;
  };
  updateLandingHeader();
  window.addEventListener("scroll", updateLandingHeader, { passive: true });
}

qsa("[data-dropdown-trigger]").forEach((trigger) => {
  const panel = qs(`#${trigger.getAttribute("aria-controls")}`);
  trigger.addEventListener("click", () => {
    const open = trigger.getAttribute("aria-expanded") === "true";
    qsa("[data-dropdown-trigger]").forEach((item) => item.setAttribute("aria-expanded", "false"));
    qsa(".dropdown-panel").forEach((item) => item.dataset.open = "false");
    trigger.setAttribute("aria-expanded", String(!open));
    panel.dataset.open = String(!open);
  });
});

document.addEventListener("click", (event) => {
  if (!event.target.closest("[data-dropdown-root]")) {
    qsa("[data-dropdown-trigger]").forEach((item) => item.setAttribute("aria-expanded", "false"));
    qsa(".dropdown-panel").forEach((item) => item.dataset.open = "false");
  }
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    qsa("[data-dropdown-trigger]").forEach((item) => item.setAttribute("aria-expanded", "false"));
    qsa(".dropdown-panel").forEach((item) => item.dataset.open = "false");
    closeDrawer();
    closeSearch();
  }
});

const drawer = qs("#mobileDrawer");
const backdrop = qs("#drawerBackdrop");
const menuButton = qs("#menuButton");
function openDrawer() {
  drawer.dataset.open = "true";
  drawer.removeAttribute("aria-hidden");
  backdrop.dataset.open = "true";
  menuButton?.setAttribute("aria-expanded", "true");
  qs("#drawerClose")?.focus();
}
function closeDrawer() {
  drawer.dataset.open = "false";
  drawer.setAttribute("aria-hidden", "true");
  backdrop.dataset.open = "false";
  menuButton?.setAttribute("aria-expanded", "false");
}
menuButton?.addEventListener("click", openDrawer);
qs("#drawerClose")?.addEventListener("click", closeDrawer);
backdrop?.addEventListener("click", closeDrawer);
qsa("#mobileDrawer a").forEach((link) => link.addEventListener("click", closeDrawer));

qsa("[data-accordion]").forEach((button) => {
  button.addEventListener("click", () => {
    const target = qs(`#${button.getAttribute("aria-controls")}`);
    const expanded = button.getAttribute("aria-expanded") === "true";
    qsa("[data-accordion]").forEach((item) => {
      item.setAttribute("aria-expanded", "false");
      qs(`#${item.getAttribute("aria-controls")}`).hidden = true;
    });
    button.setAttribute("aria-expanded", String(!expanded));
    target.hidden = expanded;
  });
});

const searchOverlay = qs("#searchOverlay");
function openSearch() {
  searchOverlay?.classList.remove("hidden");
  qs("#siteSearchInput")?.focus();
}
function closeSearch() {
  searchOverlay?.classList.add("hidden");
}
qsa("[data-open-search]").forEach((button) => button.addEventListener("click", openSearch));
qs("#searchClose")?.addEventListener("click", closeSearch);

const productSearch = qs("#productSearch");
if (productSearch) {
  const cards = qsa("[data-product-card]");
  const resultCount = qs("#resultCount");
  const update = () => {
    const text = productSearch.value.toLowerCase();
    const family = qs("#familyFilter").value;
    const brand = qs("#brandFilter").value;
    let visible = 0;
    cards.forEach((card) => {
      const matchesText = card.textContent.toLowerCase().includes(text);
      const matchesFamily = !family || card.dataset.family === family;
      const matchesBrand = !brand || card.dataset.brand === brand;
      const show = matchesText && matchesFamily && matchesBrand;
      card.hidden = !show;
      if (show) visible += 1;
    });
    resultCount.textContent = `${visible} results`;
  };
  ["input", "change"].forEach((eventName) => {
    productSearch.addEventListener(eventName, update);
    qs("#familyFilter").addEventListener(eventName, update);
    qs("#brandFilter").addEventListener(eventName, update);
  });
  qs("#clearFilters")?.addEventListener("click", () => {
    productSearch.value = "";
    qs("#familyFilter").value = "";
    qs("#brandFilter").value = "";
    update();
  });
  update();
}

// Shared site chrome is driven by the Laravel admin panel.
const makeLink = (item, className = "nav-link") => {
  const link = document.createElement("a");
  link.className = className;
  link.href = item.url;
  link.textContent = item.label;
  if (item.open_in_new_tab) { link.target = "_blank"; link.rel = "noopener"; }
  return link;
};

const bindMenu = (root) => {
  root.querySelectorAll("[data-dropdown-trigger]").forEach((trigger) => trigger.addEventListener("click", () => {
    const panel = root.querySelector(`#${trigger.getAttribute("aria-controls")}`);
    const open = trigger.getAttribute("aria-expanded") === "true";
    root.querySelectorAll("[data-dropdown-trigger]").forEach((item) => item.setAttribute("aria-expanded", "false"));
    root.querySelectorAll(".dropdown-panel").forEach((item) => item.dataset.open = "false");
    trigger.setAttribute("aria-expanded", String(!open));
    panel.dataset.open = String(!open);
  }));
};

fetch("/site-data")
  .then((response) => response.ok ? response.json() : null)
  .then((data) => {
    if (!data) return;
    const navigation = document.querySelector(".desktop-nav");
    if (navigation && data.navigation?.length) {
      navigation.replaceChildren(...data.navigation.map((item, index) => {
        if (!item.children?.length || item.menu_type === "link") return makeLink(item);
        const root = document.createElement("div");
        root.className = "relative";
        root.dataset.dropdownRoot = "";
        const panelId = `dynamicMenu${index}`;
        const button = document.createElement("button");
        button.className = "nav-link focus-ring inline-flex items-center gap-1";
        button.dataset.dropdownTrigger = "";
        button.setAttribute("aria-expanded", "false");
        button.setAttribute("aria-controls", panelId);
        button.append(document.createTextNode(`${item.label} `));
        const chevron = document.createElement("i");
        chevron.dataset.lucide = "chevron-down";
        chevron.className = "h-4 w-4";
        chevron.setAttribute("aria-hidden", "true");
        button.append(chevron);
        const panel = document.createElement("div");
        panel.className = item.menu_type === "mega" ? "dropdown-panel mega-panel" : "dropdown-panel";
        panel.id = panelId;
        panel.dataset.open = "false";
        if (item.menu_type === "mega") {
          const grid = document.createElement("div");
          const hasPromo = Boolean(item.promo_title || item.promo_text || item.promo_button_label);
          grid.className = hasPromo ? "grid gap-6 lg:grid-cols-[1fr_1fr_1fr_300px]" : "grid gap-6 lg:grid-cols-3";
          if (!hasPromo || item.label === "Products") {
            panel.classList.add("mega-panel--compact");
            grid.classList.add("mega-menu-grid--compact");
          }
          const groups = [...new Set(item.children.map((child) => child.menu_group || "More"))];
          groups.forEach((group) => {
            const column = document.createElement("div");
            const heading = document.createElement("h3");
            heading.className = "mb-3 font-black";
            heading.textContent = group;
            column.append(heading);
            item.children.filter((child) => (child.menu_group || "More") === group).forEach((child) => {
              const link = makeLink(child, "mega-link");
              const icon = document.createElement("span");
              icon.className = "mega-icon";
              const iconElement = document.createElement("i");
              iconElement.dataset.lucide = child.icon || "circle";
              iconElement.className = "h-4 w-4";
              icon.append(iconElement);
              const copy = document.createElement("span");
              const title = document.createElement("b");
              title.textContent = child.label;
              const description = document.createElement("small");
              description.className = "mt-1 block leading-5 text-slate-600";
              description.textContent = child.description || "";
              copy.append(title, description); link.replaceChildren(icon, copy); column.append(link);
            });
            grid.append(column);
          });
          if (hasPromo) {
            const promo = document.createElement("div");
            promo.className = "rounded-lg bg-sky-50 p-5";
            const promoTitle = document.createElement("h3"); promoTitle.className = "font-black"; promoTitle.textContent = item.promo_title;
            const promoText = document.createElement("p"); promoText.className = "mt-2 text-sm leading-6 text-slate-600"; promoText.textContent = item.promo_text || "";
            const promoButton = makeLink({label: item.promo_button_label || "Contact Us", url: item.promo_button_url || "/contact"}, "btn btn-primary mt-5 w-full");
            const overview = makeLink({label: `View All ${item.label}`, url: item.url}, "mt-4 block text-center text-sm font-black text-sky-700");
            promo.append(promoTitle, promoText, promoButton, overview); grid.append(promo);
          }
          panel.append(grid);
        } else {
          const list = document.createElement("div"); list.className = "grid gap-2";
          item.children.forEach((child) => list.append(makeLink(child, "mega-link"))); panel.append(list);
        }
        root.append(button, panel); return root;
      }));
      bindMenu(navigation);
      window.lucide?.createIcons();
    }
    const mobileNavigation = document.querySelector("#mobileDrawer .space-y-2");
    if (mobileNavigation && data.navigation?.length) {
      mobileNavigation.replaceChildren(...data.navigation.flatMap((item) => {
        const nodes = [makeLink(item, "block py-3 font-bold")];
        item.children?.forEach((child) => nodes.push(makeLink(child, "block py-2 pl-4 text-slate-600")));
        return nodes;
      }));
    }
    if (data.settings?.site_name) document.title = `${document.title.split("|")[0].trim()} | ${data.settings.site_name}`;
    qsa('a[href="404.html"]').filter((link) => link.textContent.trim() === "Privacy Policy").forEach((link) => link.href = "/privacy-policy");
    qsa("a").filter((link) => link.textContent.includes("Discuss Your Project")).forEach((link) => link.href = "/consultation");
    if (data.settings?.home_hero_title) { const title = qs(".hero h1"); if (title) title.textContent = data.settings.home_hero_title; }
    if (data.settings?.home_hero_description) { const description = qs(".hero h1 + p"); if (description) description.textContent = data.settings.home_hero_description; }
    const settingAsset = (path) => path?.startsWith("site/") ? `/storage/${path}` : `/${path}`;
    // Header logo sources are rendered from Site Settings by Laravel. The
    // landing header scroll handler owns the light/dark transition.
    if (data.settings?.favicon) { const favicon = qs('link[rel="icon"]'); if (favicon) favicon.href = settingAsset(data.settings.favicon); }
  })
  .catch(() => {});
