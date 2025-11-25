import { lerp, mapRange } from '../../helpers';
import AppearTexts from '../../helpers/AppearTexts';
import normalizeWheel from '../../vendors/normalizeWheel';

class ProjectContainer {
  constructor(container) {
    this.container = container
    this.$ = {
      wrapper: this.container.querySelector('.project-container__wrapper'),
      columns: this.container.querySelectorAll('.project-container__column'),
      images: this.container.querySelectorAll('.project-container__image-wrapper'),
      toHide: this.container.querySelectorAll('.project-container .js-to-hide'),
      copyright: document.querySelector('.copyright')
    }
    this.copyrightTimeout = setTimeout(() => this.$.copyright = document.querySelector('.copyright'), 1000);
    this.textsVisible = true;
    this.lastTouch = 0;
		this.canAnimate = true;
		this.isTouchEvent = document.querySelector('html').classList.contains('touchevents') ? true : false;

    this.init = this.init.bind(this);
    this.initAnimation = this.initAnimation.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handleTouchStart = this.handleTouchStart.bind(this);
    this.handleTouchMove = this.handleTouchMove.bind(this);
    this.handleResize = this.handleResize.bind(this);
    this.animate = this.animate.bind(this);

    this.appearTexts = new AppearTexts();

    this.init();

    if (document.body.classList.contains('js-loaded-once')) {
      this.initAnimationTimeout = setTimeout(() => this.initAnimation(), 500)
    } else {
      window.addEventListener('customLoadedEvent', this.initAnimation);
    }
  }

  init() {
    this.handleResize();

    // Ne pas activer le scroll horizontal si le contenu est trop petit ou l'écran trop petit
    if (this.totalWidth < window.innerWidth * 1.1 || window.innerWidth <= 737) {
      this.canAnimate = false;
      return;
    }

    this.canOverlap = true;
    this.tX = (this.startX + window.innerWidth * 0.5);
    this.cX = this.tX;

    // Events
    window.addEventListener('wheel', this.handleScroll, { passive: false });
    window.addEventListener('touchstart', this.handleTouchStart);
    window.addEventListener('touchmove', this.handleTouchMove);
    window.addEventListener('resize', this.handleResize);

		this.animate();

		// FIX : Recalculer la taille régulièrement pour capturer le chargement progressif des images
		this.handleResizeInterval = setInterval(() => {
			const newTotalWidth = this.$.wrapper.offsetWidth;
			if (newTotalWidth !== this.totalWidth) {
				this.handleResize();
			}
		}, 2000)
  }

  initAnimation() {
    const delay = window.innerWidth > 1024 ? 0.025 : null;
    this.appearTexts.start(delay);
    this.canOverlap = false;
    this.tX = this.startX;
  }

  handleScroll(e) {
		// let movement = e.wheelDelta ? e.wheelDelta : -e.deltaY;
		const normalizedEvent = normalizeWheel(e);

    // Bloquer tout scroll horizontal
    if (Math.abs(normalizedEvent.pixelX) > 0) {
      e.preventDefault();
      return;
    }

    e.preventDefault();
    let movement = (-normalizedEvent.pixelY) * 8;
    movement = mapRange(movement, -100, 100, -40, 40);
    this.tX += movement;
  }

  handleTouchStart(e) {
    this.lastTouch = e.touches[0].screenX;
  }

  handleTouchMove(e) {
    const movement = (e.touches[0].screenX - this.lastTouch);
    this.tX += movement * 4;
    this.lastTouch = e.touches[0].screenX;
  }

  animate() {
    if (!this.canAnimate) return;
    this.animationFrame = requestAnimationFrame(this.animate);
    this.cX = lerp(this.cX, this.tX, 0.1);
    if (this.tX > this.startX && this.canOverlap === false) this.tX = this.startX;
    else if (Math.abs(this.tX) > this.endX) this.tX = -this.endX;
		this.$.wrapper.style.transform = `translate3d(${this.cX}px, 0, 0)`;

		if (!this.isTouchEvent) {
			for (let i = 0; i < this.$.images.length; i += 1) {
				const imageRect = this.$.images[i].getBoundingClientRect();
				const imageX = (imageRect.x || imageRect.left) + imageRect.width * 0.5;
				if (imageX < window.innerWidth) {
					let scale = mapRange(imageX, window.innerWidth * 0.5, window.innerWidth, 1, 0.75);
					if (scale < 0.75) scale = 0.75;
					else if (scale > 1) scale = 1;
					this.$.images[i].style.transform = `scale(${scale})`;
				} else {
					this.$.images[i].style.transform = `scale(0.75)`;
				}
			}		
		}

    let opacity = mapRange(this.cX, this.textVisibilityThresholdMin, this.textVisibilityThresholdMax, 0, 1);
    if (opacity < 0) opacity = 0;
    else if (opacity > 1) opacity = 1;
    for (let i = 0; i < this.$.toHide.length; i += 1) {
      this.$.toHide[i].style.opacity = opacity;
    }
    let opacityCopy = mapRange(this.cX, -this.copyVisibilityThreshold, -this.endX, 0, 1);
    if (opacityCopy < 0) opacityCopy = 0; else if (opacityCopy > 1) opacityCopy = 1;
    this.$.copyright.style.opacity = opacityCopy;
  }

  handleResize() {
    this.totalWidth = this.$.wrapper.offsetWidth;
    this.endX = this.totalWidth - window.innerWidth;
    const firstColum = this.$.columns[0];
    let offset = firstColum.offsetWidth * 0.9;
    if (firstColum.classList.contains('landscape')) offset = firstColum.offsetWidth * 0.5;
    this.startX = window.innerWidth - offset * 1.5;
    this.textVisibilityThresholdMin = window.innerWidth * 0.25;
    this.textVisibilityThresholdMax = window.innerWidth * 0.4;
    this.copyVisibilityThreshold = this.endX - window.innerWidth * 0.2;
    if (window.innerWidth > 737) this.canAnimate = true;
    else this.canAnimate = false;
  }

  onDestroy() {
    // Retirer tous les event listeners pour éviter qu'ils persistent après la navigation
    window.removeEventListener('wheel', this.handleScroll);
    window.removeEventListener('touchstart', this.handleTouchStart);
    window.removeEventListener('touchmove', this.handleTouchMove);
    window.removeEventListener('resize', this.handleResize);
    window.removeEventListener('customLoadedEvent', this.initAnimation);
    // Arrêter l'animation
    this.canAnimate = false;
    if (this.animationFrame) {
      cancelAnimationFrame(this.animationFrame);
    }
    // Nettoyer le setInterval
    if (this.handleResizeInterval) {
      clearInterval(this.handleResizeInterval);
    }
    // Nettoyer les setTimeout
    if (this.copyrightTimeout) {
      clearTimeout(this.copyrightTimeout);
    }
    if (this.initAnimationTimeout) {
      clearTimeout(this.initAnimationTimeout);
    }
  }
}

export default ProjectContainer
