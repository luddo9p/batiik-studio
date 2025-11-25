class AppearTexts {
  constructor() {
    this.$ = {
      toAppear: []
		}
    this.start = this.start.bind(this);
    this.checkScreenPos = this.checkScreenPos.bind(this);
    this.length = null;
    this.delay = null;
    this.animationId = null;
  }

  start(delay = null, baseDelay = 0) {
		this.$.toAppear = [...document.querySelectorAll('.js-to-appear')];
    this.length = this.$.toAppear.length;
		this.delay = delay;
    if (this.delay) {
      for (let i = 0; i < this.length; i += 1) {
        this.$.toAppear[i].style.transitionDelay = baseDelay + (i * this.delay) + 's';
        this.$.toAppear[i].classList.add('appeared');
      }
    } else {
      this.checkScreenPos();
    }
  }

  checkScreenPos() {
    this.animationId = requestAnimationFrame(this.checkScreenPos);
    for (let i = 0; i < this.length; i += 1) {
			const rect = this.$.toAppear[i].getBoundingClientRect(); 
			const x = rect.x || rect.left;
			const y = rect.y || rect.top;
      if (x < window.innerWidth * 1 && y < window.innerHeight * 1) {
        this.$.toAppear[i].classList.add('appeared');
        this.$.toAppear.splice(i, 1);
        this.length = this.$.toAppear.length;
      }
    }
    if (this.length === 0) {
      cancelAnimationFrame(this.animationId);
    }
  }
}

export default AppearTexts;