class HoverImage {
  constructor(wrapper) {
    this.$ = {
      wrapper: wrapper,
      images: [],
      textElm: null,
      cImage: null
    }
    this.$.images = this.$.wrapper.querySelectorAll('.js-hover-image__image');

    this.handleMouseEnter = this.handleMouseEnter.bind(this);
    this.handleMouseLeave = this.handleMouseLeave.bind(this);
  }

  init() {
    for (let i = 0; i < this.$.images.length; i += 1) {
      this.$.images[i].addEventListener('mouseenter', this.handleMouseEnter);
      this.$.images[i].addEventListener('mouseleave', this.handleMouseLeave);
    }
  }

  handleMouseEnter(e) {
    const id = e.target.getAttribute('data-id') || e.target.parentNode.getAttribute('data-id') || e.target.parentNode.parentNode.getAttribute('data-id');
    this.$.cImage = e.target.classList.contains('js-hover-image__image') ? e.target : e.target.children[0];
    this.$.wrapper.classList.add('js-hover-image__wrapper--hovered');
    this.$.cImage.classList.add('js-hover-image__image--active');
    this.$.textElm = this.$.wrapper.querySelector('.js-hover-image__text[data-id="' + id + '"]');
    this.$.textElm.classList.add('active');
  }

  handleMouseLeave() {
    this.$.wrapper.classList.remove('js-hover-image__wrapper--hovered');
    this.$.cImage.classList.remove('js-hover-image__image--active');
    this.$.cImage = null;
    this.$.textElm.classList.remove('active');
    this.$.textElm = null;
  }

  onDestroy() {
    // Retirer tous les event listeners
    for (let i = 0; i < this.$.images.length; i += 1) {
      this.$.images[i].removeEventListener('mouseenter', this.handleMouseEnter);
      this.$.images[i].removeEventListener('mouseleave', this.handleMouseLeave);
    }
  }
}

export default HoverImage;
