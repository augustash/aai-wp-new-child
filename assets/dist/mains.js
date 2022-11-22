(() => {
  // ../ash/assets/src/js/inc/dropdown-menu.js
  var dropdownMenu = document.querySelector(".primary.menu");
  var dropdownLink = dropdownMenu.querySelectorAll("li.expand");
  dropdownLink.forEach(link);
  function link(item) {
    item.addEventListener("mouseover", function() {
      item.classList.add("expanded");
      item.setAttribute("aria-expanded", "true");
    });
    item.addEventListener("mouseout", function() {
      item.classList.remove("expanded");
      item.setAttribute("aria-expanded", "false");
    });
  }

  // ../ash/assets/src/js/inc/drilldown-menu.js
  var drilldownMenu = document.querySelector(".drilldown");
  var submenu = drilldownMenu.querySelectorAll("ul.nested");
  submenu.forEach(expand);
  function expand(item) {
    let link2 = item.previousElementSibling;
    link2.setAttribute("href", "javascript:;");
    let backLink = document.createElement("li");
    backLink.innerHTML = '<a href="javascript:;">Back</a>';
    link2.addEventListener("click", function() {
      item.classList.add("is-visible");
    });
    backLink.addEventListener("click", function() {
      item.closest("ul").classList.remove("is-visible");
    });
    item.insertBefore(backLink, item.firstChild);
  }

  // ../ash/assets/src/js/inc/modal.js
  var Modal = class {
    constructor() {
      this.triggers = document.querySelectorAll(".modal-trigger");
      this.close = document.querySelectorAll(".close-modal");
      this.modals = document.querySelectorAll(".modal");
      this.modalInners = document.querySelectorAll(".modal-inner");
      this.listeners();
    }
    listeners() {
      window.addEventListener("keydown", this.keyDown);
      this.triggers.forEach((el) => {
        el.addEventListener("click", this.openModal, false);
      });
      this.modals.forEach((el) => {
        el.addEventListener("transitionend", this.revealModal, false);
        el.addEventListener("click", this.backdropClose, false);
      });
      this.close.forEach((el) => {
        el.addEventListener("click", Modal.hideModal, false);
      });
      this.modalInners.forEach((el) => {
        el.addEventListener("transitionend", this.closeModal, false);
      });
    }
    keyDown(e) {
      if (27 === e.keyCode && document.body.classList.contains("modal-body")) {
        Modal.hideModal();
      }
    }
    backdropClose(el) {
      if (!el.target.classList.contains("modal-visible")) {
        return;
      }
      let backdrop = el.currentTarget.dataset.backdrop !== void 0 ? el.currentTarget.dataset.backdrop : true;
      if (backdrop === true) {
        Modal.hideModal();
      }
    }
    static hideModal() {
      let modalOpen = document.querySelector(".modal.modal-visible");
      modalOpen.querySelector(".modal-inner").classList.remove("modal-reveal");
      modalOpen.setAttribute("aria-hidden", "true");
      document.querySelector(".modal-body").addEventListener("transitionend", Modal.modalBody, false);
      document.body.classList.add("modal-fadeOut");
    }
    closeModal(el) {
      if ("opacity" === el.propertyName && !el.target.classList.contains("modal-reveal")) {
        document.querySelector(".modal.modal-visible").classList.remove("modal-visible");
      }
    }
    openModal(el) {
      if (!el.currentTarget.dataset.modal) {
        console.error("No data-modal attribute defined!");
        return;
      }
      let modalID = el.currentTarget.dataset.modal;
      let modal = document.getElementById(modalID);
      document.body.classList.add("modal-body");
      modal.classList.add("modal-visible");
      modal.setAttribute("aria-hidden", "false");
      let videoID = el.currentTarget.dataset.modal;
      let video2 = document.getElementById(videoID);
      let iframe = video2.querySelector("iframe");
      let videoUrl = iframe.getAttribute("src");
      iframe.setAttribute("src", videoUrl + "&autoplay=1");
    }
    revealModal(el) {
      if ("opacity" === el.propertyName && el.target.classList.contains("modal-visible")) {
        el.target.querySelector(".modal-inner").classList.add("modal-reveal");
      }
    }
    static modalBody(el) {
      if ("opacity" === el.propertyName && el.target.classList.contains("modal") && !el.target.classList.contains("modal-visible")) {
        document.body.classList.remove("modal-body", "modal-fadeOut");
      }
    }
  };
  new Modal();

  // ../ash/assets/src/js/inc/toggler.js
  var Toggler = class {
    constructor() {
      this.triggers = document.querySelectorAll("button[data-toggle]");
      this.togglers = document.querySelectorAll(".toggler");
      this.listeners();
    }
    listeners() {
      window.addEventListener("keydown", this.keyDown);
      this.triggers.forEach((el) => {
        el.addEventListener("click", this.toggleElement, false);
      });
    }
    keyDown(e) {
      if (27 === e.keyCode && document.body.classList.contains("element-toggled")) {
        Toggler.closeToggle();
      }
    }
    toggleElement(el) {
      if (!el.currentTarget.dataset.toggle) {
        console.error("No data-toggle attribute defined!");
        return;
      }
      let togglerID = el.currentTarget.dataset.toggle;
      let toggler = document.getElementById(togglerID);
      let trigger = document.querySelector('[data-toggle="' + togglerID + '"]');
      document.body.classList.toggle("element-toggled");
      toggler.classList.toggle("toggled");
      trigger.classList.toggle("open");
      if (toggler.getAttribute("aria-expanded") === "true") {
        toggler.setAttribute("aria-expanded", "false");
      } else {
        toggler.setAttribute("aria-expanded", "true");
      }
    }
    static closeToggle(el) {
      console.log(el);
      if (document.body.classList.contains("element-toggled")) {
        document.body.classList.remove("element-toggled");
      }
    }
  };
  new Toggler();

  // ../ash/assets/src/js/inc/video-resize.js
  function video() {
    var videoWrapper = document.querySelector(".video-embed");
    var video2 = document.querySelector(".video-embed iframe");
    if (video2 !== null) {
      var w = videoWrapper.offsetWidth;
      var h = videoWrapper.offsetHeight;
      var width = w;
      var height = w / (16 / 9);
      if (height < h) {
        height = h;
        width = h * (16 / 9);
      }
      height = Math.ceil(height);
      width = Math.ceil(width);
      var top = Math.round(h / 2 - height / 2);
      var left = Math.round(w / 2 - width / 2);
      video2.style.position = "absolute";
      video2.style.left = left + "px";
      video2.style.top = top + "px";
      video2.width = "100%";
      video2.height = "100%";
      video2.style.width = width + "px";
      video2.style.height = height + "px";
    }
  }
  video();
  window.addEventListener("load", (event) => {
    video();
  });
  window.onresize = function(event) {
    video();
  };
})();
