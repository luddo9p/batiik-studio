import AppearTexts from '../../helpers/AppearTexts';

class ContactContainer {
  constructor(container) {
    this.container = container
    this.$ = {}
    this.init = this.init.bind(this);
    this.appearTexts = new AppearTexts();

    if (document.body.classList.contains('js-loaded-once')) {
      this.initTimeout = setTimeout(() => this.init(), 500)
    } else {
      window.addEventListener('customLoadedEvent', this.init);
    }
  }

  init() {
    this.appearTexts.start(0.1, 0.1);
  }

  onDestroy() {
    // Retirer l'event listener
    window.removeEventListener('customLoadedEvent', this.init);
    // Nettoyer le setTimeout
    if (this.initTimeout) {
      clearTimeout(this.initTimeout);
    }
  }

}

export default ContactContainer
