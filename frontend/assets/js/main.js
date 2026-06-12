/**
* Template Name: SoftLand - v4.10.0
* Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Mobile nav toggle
   */
  const setMobileNavState = (open) => {
    const navbar = select('#navbar')
    const header = select('#header')
    const drawer = select('.mobile-nav-drawer')
    if (!navbar) return

    navbar.classList.toggle('navbar-mobile', open)
    if (header) {
      header.classList.toggle('mobile-nav-open', open)
    }
    document.body.classList.toggle('mobile-nav-active', open)

    if (drawer) {
      drawer.setAttribute('aria-hidden', open ? 'false' : 'true')
      drawer.setAttribute('aria-modal', open ? 'true' : 'false')
    }

    if (!open) {
      navbar.querySelectorAll('.dropdown-active').forEach((submenu) => {
        submenu.classList.remove('dropdown-active')
      })
      navbar.querySelectorAll('.dropdown-open').forEach((item) => {
        item.classList.remove('dropdown-open')
      })
    }
  }

  const toggleMobileNav = () => {
    const navbar = select('#navbar')
    if (!navbar) return
    setMobileNavState(!navbar.classList.contains('navbar-mobile'))
  }

  on('click', '.mobile-nav-toggle', function(e) {
    e.preventDefault()
    toggleMobileNav()
  })

  on('click', '.mobile-nav-close, .mobile-nav-backdrop', function(e) {
    e.preventDefault()
    setMobileNavState(false)
  })

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
    on('click', '.back-to-top', function(e) {
      e.preventDefault()
      window.scrollTo({ top: 0, behavior: 'smooth' })
    })
  }

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    const navbar = select('#navbar')
    if (!navbar || !navbar.classList.contains('navbar-mobile')) {
      return
    }

    const parentLink = this.classList.contains('mobile-menu-link--parent')
    const submenu = this.nextElementSibling

    if (!parentLink || !submenu || submenu.tagName !== 'UL') {
      setMobileNavState(false)
      return
    }

    e.preventDefault()
    const parentItem = this.parentElement
    const isOpen = submenu.classList.toggle('dropdown-active')
    parentItem.classList.toggle('dropdown-open', isOpen)
  }, true)

  on('keydown', document, function(e) {
    const navbar = select('#navbar')
    if (e.key === 'Escape' && navbar && navbar.classList.contains('navbar-mobile')) {
      setMobileNavState(false)
    }
  })

  /**
   * Testimonials slider
   */
  const testimonialsSlider = select('.testimonials-slider')
  if (testimonialsSlider) {
    new Swiper('.testimonials-slider', {
      speed: 600,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      }
    })
  }

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

})()