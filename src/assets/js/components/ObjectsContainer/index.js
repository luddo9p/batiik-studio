import HorizontalScroll from '../../helpers/HorizontalScroll';
import HoverImage from '../../helpers/HoverImage';
import AppearTexts from '../../helpers/AppearTexts';

class ObjectsContainer {
  constructor(container) {
    this.container = container;
    this.$ = {
      wrapper: this.container.querySelector('.objects-container__wrapper')
    };
    this.init = this.init.bind(this);
    this.initAnimation = this.initAnimation.bind(this);

    this.horizontalScroll = new HorizontalScroll(this.container, this.$.wrapper);
    this.hoverImage = new HoverImage(this.$.wrapper);
    this.appearTexts = new AppearTexts();

    this.init()

    if (document.body.classList.contains('js-loaded-once')) {
      this.initAnimationTimeout = setTimeout(() => this.initAnimation(), 500)
    } else {
      window.addEventListener('customLoadedEvent', this.initAnimation);
    }
  }

  init() {
    this.horizontalScroll.init();
    this.hoverImage.init();
  }

  initAnimation() {
    this.horizontalScroll.initAnimation();
    this.appearTexts.start(0.02);
  }

  onDestroy() {
    // Retirer l'event listener et détruire les sous-composants
    window.removeEventListener('customLoadedEvent', this.initAnimation);
    if (this.horizontalScroll && typeof this.horizontalScroll.onDestroy === 'function') {
      this.horizontalScroll.onDestroy();
    }
    if (this.hoverImage && typeof this.hoverImage.onDestroy === 'function') {
      this.hoverImage.onDestroy();
    }
    // Nettoyer le setTimeout
    if (this.initAnimationTimeout) {
      clearTimeout(this.initAnimationTimeout);
    }
  }
}

export default ObjectsContainer;
