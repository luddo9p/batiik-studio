import { lerp, mapRange } from '../../helpers';
import normalizeWheel from '../../vendors/normalizeWheel';

const ITEM_MARGIN_PERCENT = 0.02; // right border margin
const EXTRA_MARGIN = 40; // margin to align content on the left of the language switcher

class HorizontalScroll {
  constructor(container, wrapper) {
    this.$ = {
      wrapper: wrapper,
      columns: [],
      images: [],
      outsideElm: document.querySelector('.js-horizontal-scroll__outstide'),
			backCta: container.querySelector('.back-cta'),
			scrollCta: container.querySelector('.scroll-cta')
		}
    this.$.columns = this.$.wrapper.querySelectorAll('.js-horizontal-scroll__column');
    for (let i = 0; i < this.$.columns.length; i += 1) {
      const columnImages = this.$.columns[i].querySelectorAll('.js-horizontal-scroll__image');
      for (let j = 0; j < columnImages.length; j += 1) {
        this.$.images.push(columnImages[j]);
      }
    }
    setTimeout(() => {
      this.$.backCta = document.querySelector('.back-cta');
      this.$.backCta.addEventListener('click', this.handleBack);
		}, 1000);

    this.init = this.init.bind(this);
    this.initAnimation = this.initAnimation.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handleTouchStart = this.handleTouchStart.bind(this);
    this.handleTouchMove = this.handleTouchMove.bind(this);
    this.handleResize = this.handleResize.bind(this);
    this.handleBack = this.handleBack.bind(this);
    this.animate = this.animate.bind(this);
  }

  init() {
    this.cScale = 1;
    this.lastTouch = 0;
    this.titlesWidth = 0;
    if (this.$.outsideElm) {
      const rect = this.$.outsideElm.getBoundingClientRect();
      this.titlesWidth = rect.width + 20;
    }

    this.handleResize();

    if (this.totalWidth < window.innerWidth * 1.1) return;
    
		this.canOverlap = true;
		this.canShowCta = false;
    this.tX = this.startX + window.innerWidth * 0.85;
    this.cX = this.tX;

    // Events
    window.addEventListener('wheel', this.handleScroll);
    window.addEventListener('touchstart', this.handleTouchStart);
    window.addEventListener('touchmove', this.handleTouchMove);
    window.addEventListener('resize', this.handleResize);
    this.$.backCta.addEventListener('click', this.handleBack);
    this.animate();
  }

  initAnimation() {
		this.canOverlap = false;
		setTimeout(() => this.canShowCta = true, 500)
    this.tX = this.startX;
  }

  handleScroll(e) {
		// let movement = e.wheelDelta ? e.wheelDelta : -e.deltaY;
		const normalizedEvent = normalizeWheel(e);
    let movement = ((-normalizedEvent.pixelX + -normalizedEvent.pixelY) * 0.5) * 8;
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

  handleBack() {
    this.tX = this.startX;
  }

  animate() {
    requestAnimationFrame(this.animate);
    this.cX = lerp(this.cX, this.tX, 0.1);
    if (this.tX > this.startX && this.canOverlap === false) this.tX = this.startX;
    else if (Math.abs(this.tX) > this.endX && this.canOverlap === false) this.tX = -this.endX;
    this.$.wrapper.style.transform = `translate3d(${this.cX}px, 0, 0)`;
    if (this.backCtaVisibilityThreshold) {
      let opacitybackCta = mapRange(this.cX, -this.backCtaVisibilityThreshold, -this.endX, 0, 1);
      if (opacitybackCta < 0) opacitybackCta = 0; else if (opacitybackCta > 1) opacitybackCta = 1;
			this.$.backCta.style.opacity = opacitybackCta;
			if (opacitybackCta <= 0 && this.$.backCta.style.display === 'block' || this.$.backCta.style.display === '') {
				this.$.backCta.style.display = 'none';
			} else if (opacitybackCta > 0 && this.$.backCta.style.display === 'none') {
				this.$.backCta.style.display = 'block';
			}
    } else {
			this.$.backCta.style.opacity = 0;
			this.$.backCta.style.display = 'none';
		}

		if (this.ctaVisibilityThreshold && this.canShowCta) {
			let opacityCta = mapRange(this.cX, 0, this.ctaVisibilityThreshold, 0, 1);
    	if (opacityCta < 0) opacityCta = 0; else if (opacityCta > 1) opacityCta = 1;
			this.$.scrollCta.style.opacity = lerp(this.$.scrollCta.style.opacity, opacityCta, 0.05);
		} else {
			this.$.scrollCta.style.opacity = 0;
		}
  }

  handleResize() {
    this.itemWidth = this.$.columns[0].offsetWidth;
    this.itemMargin = window.innerWidth * ITEM_MARGIN_PERCENT;
    this.totalWidth = this.$.wrapper.offsetWidth + this.itemMargin;
    this.endX = this.totalWidth - window.innerWidth + EXTRA_MARGIN;
		this.startX = this.itemMargin + this.titlesWidth;
    if (this.endX > window.innerWidth) {
			this.backCtaVisibilityThreshold = this.endX - window.innerWidth * 0.2;
			this.ctaVisibilityThreshold = window.innerWidth * 0.2 - this.titlesWidth;
		}
    else {
			this.backCtaVisibilityThreshold = null;
			this.ctaVisibilityThreshold = null;
		}
  }
}

export default HorizontalScroll;