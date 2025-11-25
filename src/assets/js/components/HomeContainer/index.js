import { lerp, mapRange } from "../../helpers";
import AppearTexts from "../../helpers/AppearTexts";
import normalizeWheel from "../../vendors/normalizeWheel";

const ITEM_SCALE = 1.1;

class HomeContainer {
  constructor(container) {
    // if (window.innerWidth < 737) {
    // 	let url = '/projets';
    //   if (window.location.href.search('/en/') !== -1) {
    //     url = '/en/projects';
    // 	}
    //   window.location.href = url;
    // }

    this.container = container;
    this.$ = {
      wrapper: this.container.querySelector(".home-container__wrapper"),
      projects: this.container.querySelectorAll(".home-container__project"),
      projectsColumns: [],
      projectsItems: [],
      lastColumn: null,
      scrollCta: this.container.querySelector(".scroll-cta"),
      copyright: document.querySelector(".copyright"),
      texts: this.container.querySelectorAll(".home-container__text"),
      allProjects: this.container.querySelector(
        ".home-container__text--allprojects"
      ),
    };
    this.cScale = 1;
    this.lastTouch = 0;
    this.mouseOffsetX = 0;
    this.isTouchEvent = document
      .querySelector("html")
      .classList.contains("touchevents")
      ? true
      : false;

    this.init = this.init.bind(this);
    this.initAnimation = this.initAnimation.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handleTouchStart = this.handleTouchStart.bind(this);
    this.handleTouchMove = this.handleTouchMove.bind(this);
    this.handleMouseMove = this.handleMouseMove.bind(this);
    this.handleResize = this.handleResize.bind(this);
    this.animate = this.animate.bind(this);

    this.appearTexts = new AppearTexts();

    this.init();

    if (document.body.classList.contains("js-loaded-once")) {
      this.initAnimationTimeout = setTimeout(() => this.initAnimation(), 500);
    } else {
      window.addEventListener("customLoadedEvent", this.initAnimation);
    }
  }

  init() {
    for (let i = 0; i < this.$.projects.length; i += 1) {
      this.$.projectsColumns[i] = this.$.projects[i].querySelectorAll(
        ".home-container__column"
      );
      this.$.projectsItems[i] = this.$.projects[i].querySelectorAll(
        ".home-container__item"
      );
    }

    const lastProjectIndex = this.$.projects.length - 1;
    this.$.lastColumn =
      this.$.projectsColumns[lastProjectIndex][
        this.$.projectsColumns[lastProjectIndex].length - 1
      ];

    this.handleResize();
    this.canOverlap = true;
    this.canShowCta = false;
    this.tX = this.startX + window.innerWidth * 0.5;
    this.cX = this.tX;

    // Events
    window.addEventListener("wheel", this.handleScroll, { passive: false });
    window.addEventListener("touchstart", this.handleTouchStart);
    window.addEventListener("touchmove", this.handleTouchMove);
    window.addEventListener("mousemove", this.handleMouseMove);
    window.addEventListener("resize", this.handleResize);

    this.animate();

    // FIX : sometimes this.totalWidth does not have the correct size at start
    this.handleResizeInterval = setInterval(() => {
      if (this.totalWidth === this.$.wrapper.offsetWidth) {
        clearInterval(this.handleResizeInterval);
      } else if (this.totalWidth < this.$.wrapper.offsetWidth) {
        this.handleResize();
        clearInterval(this.handleResizeInterval);
      }
    }, 2000);
  }

  initAnimation() {
    this.container.classList.add("visible");
    this.appearTexts.start();
    this.canOverlap = false;
    this.showCtaTimeout = setTimeout(() => (this.canShowCta = true), 500);
    this.tX = this.startX;
  }

  handleScroll(e) {
    e.preventDefault();

    const normalizedEvent = normalizeWheel(e);
    let movement = -normalizedEvent.pixelY * 8;
    movement = mapRange(movement, -100, 100, -40, 40);
    this.tX += movement;
  }

  handleTouchStart(e) {
    this.lastTouch = e.touches[0].screenX;
  }

  handleTouchMove(e) {
    const movement = e.touches[0].screenX - this.lastTouch;
    this.tX += movement * 4;
    this.lastTouch = e.touches[0].screenX;
  }

  handleMouseMove(e) {
    const diffToCenterX = e.clientX - this.midScreenX;
    this.mouseOffsetX = mapRange(
      diffToCenterX,
      -this.midScreenX,
      this.midScreenX,
      -50,
      50
    );
  }

  animate() {
    this.animationFrame = requestAnimationFrame(this.animate);
    if (this.cScale < ITEM_SCALE)
      this.cScale = lerp(this.cScale, ITEM_SCALE, 0.1);

    this.cX = lerp(this.cX, this.tX - this.mouseOffsetX, 0.1);
    if (this.tX > this.startX && this.canOverlap === false)
      this.tX = this.startX;
    else if (Math.abs(this.tX) > this.endX) this.tX = -this.endX;
    this.$.wrapper.style.transform = `translate3d(${this.cX}px, 0, 0)`;

    if (!this.isTouchEvent) {
      for (let i = 0; i < this.$.projects.length; i += 1) {
        const projectX = this.$.projects[i].getBoundingClientRect().x;
        if (projectX < window.innerWidth) {
          const imagesSpace = mapRange(
            projectX,
            window.innerWidth * 0.25,
            window.innerWidth,
            -100,
            200
          );
          for (let j = 0; j < this.$.projectsColumns[i].length; j += 1) {
            const itemSpace = imagesSpace * (j * 0.5);
            const delay = j * this.imageBaseDelay;
            this.$.projectsColumns[i][j].style.transform = `translate3d(${
              itemSpace + delay
            }px, 0, 0)`;

            const imageX = this.$.projectsItems[i][j].getBoundingClientRect().x;
            if (imageX < window.innerWidth && imageX > 0) {
              const originalSize = this.$.projectsColumns[i][j].offsetWidth;
              const scaledSize = originalSize * ITEM_SCALE;
              const padding = scaledSize - originalSize;
              let innerSpace = mapRange(
                imageX,
                0,
                window.innerWidth,
                0,
                padding
              );
              this.$.projectsItems[i][j].style.transform = `scale(${
                this.cScale
              }) translate3d(${-innerSpace}px, 0, 0)`;
            }
          }
        }
      }
    }

    if (this.canShowCta) {
      let opacityCta = mapRange(this.cX, 0, this.ctaVisibilityThreshold, 0, 1);
      if (opacityCta < 0) opacityCta = 0;
      else if (opacityCta > 1) opacityCta = 1;
      this.$.scrollCta.style.opacity = lerp(
        this.$.scrollCta.style.opacity,
        opacityCta,
        0.05
      );
    } else this.$.scrollCta.style.opacity = 0;

    let opacityCopy = mapRange(
      this.cX,
      -this.copyVisibilityThreshold,
      -this.endX,
      0,
      1
    );
    if (opacityCopy < 0) opacityCopy = 0;
    else if (opacityCopy > 1) opacityCopy = 1;
    this.$.copyright.style.opacity = opacityCopy;
  }

  handleResize() {
    this.firstTextWidth = 0;
    if (this.$.texts[0]) {
      const text = this.$.texts[0];
      const width = text.offsetWidth;
      const left = parseInt(window.getComputedStyle(text).marginRight);
      this.firstTextWidth = width + left;
    }

    this.totalWidth = this.$.wrapper.offsetWidth;
    this.midScreenX = window.innerWidth * 0.5;
    this.endX = this.totalWidth - window.innerWidth;
    if (!this.$.projectsColumns[0][0]) return;
    this.startX =
      window.innerWidth -
      this.$.projectsColumns[0][0].offsetWidth -
      this.$.projectsColumns[0][1].offsetWidth -
      this.firstTextWidth;
    if (this.startX < window.innerWidth * 0.25)
      this.startX = window.innerWidth * 0.25;
    this.ctaVisibilityThreshold = window.innerWidth * 0.2;
    this.copyVisibilityThreshold = this.endX - window.innerWidth * 0.2;
    this.imageBaseDelay = 150;
    if (window.innerWidth < 415) this.imageBaseDelay = 450;
    else if (window.innerWidth < 769) this.imageBaseDelay = 350;
    else if (window.innerWidth < 1025) this.imageBaseDelay = 200;
    else if (window.innerWidth > 2000) this.imageBaseDelay = 50;
  }

  onDestroy() {
    // Retirer tous les event listeners pour éviter qu'ils persistent après la navigation
    window.removeEventListener('wheel', this.handleScroll);
    window.removeEventListener('touchstart', this.handleTouchStart);
    window.removeEventListener('touchmove', this.handleTouchMove);
    window.removeEventListener('mousemove', this.handleMouseMove);
    window.removeEventListener('resize', this.handleResize);
    window.removeEventListener('customLoadedEvent', this.initAnimation);
    // Arrêter l'animation
    if (this.animationFrame) {
      cancelAnimationFrame(this.animationFrame);
    }
    // Nettoyer le setInterval
    if (this.handleResizeInterval) {
      clearInterval(this.handleResizeInterval);
    }
    // Nettoyer les setTimeout
    if (this.initAnimationTimeout) {
      clearTimeout(this.initAnimationTimeout);
    }
    if (this.showCtaTimeout) {
      clearTimeout(this.showCtaTimeout);
    }
  }
}

export default HomeContainer;
