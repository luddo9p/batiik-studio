import AppearTexts from '../../helpers/AppearTexts';

class AboutContainer {
  constructor(container) {
    this.container = container
    this.$ = {
      links: this.container.querySelectorAll('.js-images-links'),
      images: this.container.querySelectorAll('.js-images-hover')
    }
    this.init = this.init.bind(this);
    this.handleLinkHover = this.handleLinkHover.bind(this);
    this.handleLinkOut = this.handleLinkOut.bind(this);
    this.appearTexts = new AppearTexts();

    if (document.body.classList.contains('js-loaded-once')) {
      this.initTimeout = setTimeout(() => this.init(), 500)
    } else {
      window.addEventListener('customLoadedEvent', this.init);
    }
  }

  init() {
    this.appearTexts.start();
    for (let i = 0; i < this.$.links.length; i += 1) {
      this.$.links[i].addEventListener('mouseenter', this.handleLinkHover);
      this.$.links[i].addEventListener('mouseleave', this.handleLinkOut);
    }
  }

  handleLinkHover(e) {
    const index = parseInt(e.target.getAttribute('data-index')) - 1;
    this.$.images[index].classList.add('visible');
  }

  handleLinkOut(e) {
    const index = parseInt(e.target.getAttribute('data-index')) - 1;
    this.$.images[index].classList.remove('visible');
  }

  onDestroy() {
    // Retirer tous les event listeners
    window.removeEventListener('customLoadedEvent', this.init);
    for (let i = 0; i < this.$.links.length; i += 1) {
      this.$.links[i].removeEventListener('mouseenter', this.handleLinkHover);
      this.$.links[i].removeEventListener('mouseleave', this.handleLinkOut);
    }
    // Nettoyer le setTimeout
    if (this.initTimeout) {
      clearTimeout(this.initTimeout);
    }
  }

}

export default AboutContainer
