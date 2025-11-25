import barba from "@barba/core";
import { TimelineMax, Power3 } from "gsap/all";
import { transitions, transitionsMobile } from "./transitions";
import { getBodyClass } from "./helpers";
import { BP_MOBILE } from "./config";
import components from "./components/index.js";
import LazyLoad from "./helpers/LazyLoad";
import Burger from "./components/Burger";

import "./vendors/modernizr.custom.js";

class App {
  constructor() {
    this.initLoader();
    this.initComponents();

    if (window.innerWidth > BP_MOBILE) {
      this.initBarba();
    } else {
      this.initBarbaMobile();
    }

    const burger = document.querySelector(".burger");
    this.burger = new Burger(burger);

    this.initNoBarba();
    this.lazyload = new LazyLoad();
    this.lazyload.load();

    // Mettre à jour les liens actifs au chargement initial
    this.updateActiveNavLink(window.location.href);
  }

  initLoader() {
    const loader = document.querySelector(".loader");
    const tlLoader = new TimelineMax({
      paused: true,
      onComplete: () => {
        window.dispatchEvent(customLoadedEvent);
        loader.style.display = "none";
      },
    });

    tlLoader.to(loader, 0.3, { opacity: 0, ease: Power3.ease }, "0.5");

    tlLoader.play();
  }

  initComponents() {
    this.components = {};

    components.forEach((component) => {
      this.elems = [...document.querySelectorAll(component.selector)];
      if (this.elems.length > 0) {
        this.components[component.namespace] = [];
        this.elems.forEach((elem) => {
          this.components[component.namespace].push(new component.class(elem));
        });
      }
    });
  }

  destroyComponents() {
    let t = setInterval(null, 0);
    while (t--) {
      clearInterval(t);
    }

    for (var component in this.components) {
      if (this.components.hasOwnProperty(component)) {
        this.components[component].forEach((comp) => {
          if (typeof comp.onDestroy == "function") {
            comp.onDestroy();
          }
        });
        this.components[component].length = 0;
        delete this.components[component];
      }
    }
  }

  initBarbaMobile() {
    barba.hooks.after(() => {
      this.destroyComponents();
      this.initComponents();
    });

    barba.hooks.beforeEnter((data) => {
      document.querySelector("body").scrollTop = 0;
      document.documentElement.scrollTop = 0;
      window.scrollTo(0, 0);
      document.body.setAttribute(
        "class",
        `${getBodyClass(data.next.html)} js-loaded-once`
      );
      this.lazyload.load();
      this.updateActiveNavLink(data.next.url.href);
    });

    barba.init({
      cacheIgnore: true,
      transitions: transitionsMobile,
      debug: false,
      timeout: 5000,
    });
  }

  initBarba() {
    barba.hooks.after(() => {
      this.destroyComponents();
      this.initComponents();
    });

    barba.hooks.beforeEnter((data) => {
      document.querySelector("body").scrollTop = 0;
      document.documentElement.scrollTop = 0;
      window.scrollTo(0, 0);
      document.body.setAttribute(
        "class",
        `${getBodyClass(data.next.html)} js-loaded-once`
      );
      this.updateActiveNavLink(data.next.url.href);
    });

    barba.hooks.afterEnter((data) => {
      this.lazyload.load(data.next.container);
    });

    barba.init({
      cacheIgnore: true,
      transitions: transitions,
      debug: false,
      timeout: 5000,
    });
  }

  updateActiveNavLink(currentUrl) {
    // Retirer toutes les classes active
    const navLinks = document.querySelectorAll('.nav__link');
    const navAnchors = document.querySelectorAll('.nav__link a');

    navLinks.forEach(link => link.classList.remove('active'));
    navAnchors.forEach(anchor => anchor.classList.remove('active'));

    // Ajouter la classe active sur le lien correspondant à l'URL actuelle
    navAnchors.forEach(anchor => {
      const linkUrl = anchor.getAttribute('href');
      // Comparer les URLs en retirant le slash final et en normalisant
      const normalizedCurrent = currentUrl.replace(/\/$/, '');
      const normalizedLink = linkUrl.replace(/\/$/, '');

      if (normalizedCurrent === normalizedLink) {
        anchor.classList.add('active');
        anchor.closest('.nav__link').classList.add('active');
      }
    });
  }

  initNoBarba() {
    const elms = document.querySelectorAll(".no-barba");
    for (let i = 0; i < elms.length; i += 1) {
      elms[i].addEventListener("click", () => {
        const href = elms[i].getAttribute("data-href");
        window.location.href = href;
      });
    }
  }
}

function createNewEvent(eventName) {
  var event;
  if (typeof Event === "function") {
    event = new Event(eventName);
  } else {
    event = document.createEvent("Event");
    event.initEvent(eventName, true, true);
  }
  return event;
}

window.onresize = function () {
  // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
  let vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document
  document.documentElement.style.setProperty("--vh", `${vh}px`);
};
window.onresize();

window.customLoadedEvent = createNewEvent("customLoadedEvent");

new App();
