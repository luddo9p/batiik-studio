import AppearTexts from '../../helpers/AppearTexts';

class Burger {
  constructor(container) {
    this.container = container
    this.$ = {
      trigger: this.container.querySelector('.burger__trigger'),
      menu: this.container.querySelector('.burger__menu')
    }
    this.init = this.init.bind(this);
    this.handleTrigger = this.handleTrigger.bind(this);

    this.init();
  }

  init() {
    this.$.trigger.addEventListener('click', this.handleTrigger);
  }

  handleTrigger() {
    this.container.classList.toggle('open');
    this.$.menu.classList.toggle('open');
  }

}

export default Burger
