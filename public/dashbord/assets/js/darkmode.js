/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
window.colors = {
  solid: {
    primary: '#7367F0',
    secondary: '#82868b',
    success: '#28C76F',
    info: '#00cfe8',
    warning: '#FF9F43',
    danger: '#EA5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    body: '#f8f8f8'
  },
  light: {
    primary: '#7367F01a',
    secondary: '#82868b1a',
    success: '#28C76F1a',
    info: '#00cfe81a',
    warning: '#FF9F431a',
    danger: '#EA54551a',
    dark: '#4b4b4b1a'
  }
};
(function (window, document, $) {
  'use strict';
  var $html = $('html');
  var $body = $('body');
  var $textcolor = '#4e5154';
  var assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // to remove sm control classes from datatables
  if ($.fn.dataTable) {
    $.extend($.fn.dataTable.ext.classes, {
      sFilterInput: 'form-control',
      sLengthSelect: 'form-select'
    });
  }


  // Hide overlay menu on content overlay click on small screens
  $(document).on('click', '.sidenav-overlay', function (e) {
    // Hide menu
    $.app.menu.hide();
    return false;
  });

  
  

  $(document).on('click', '.menu-toggle, .modern-nav-toggle', function (e) {
    e.preventDefault();

    // Toggle menu
    $.app.menu.toggle();

    setTimeout(function () {
      $(window).trigger('resize');
    }, 200);

    if ($('#collapse-sidebar-switch').length > 0) {
      setTimeout(function () {
        if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
          $('#collapse-sidebar-switch').prop('checked', false);
        } else {
          $('#collapse-sidebar-switch').prop('checked', true);
        }
      }, 50);
    }

    // Save menu collapsed status in localstorage
    if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
      localStorage.setItem('menuCollapsed', false);
    } else {
      localStorage.setItem('menuCollapsed', true);
    }
    

    // Hides dropdown on click of menu toggle
    // $('[data-bs-toggle="dropdown"]').dropdown('hide');

    return false;
  });

  // Add Children Class
  $('.navigation').find('li').has('ul').addClass('has-sub');
  // Update manual scroller when window is resized
  $(window).resize(function () {
    $.app.menu.manualScroller.updateHeight();
  });

  $('#sidebar-page-navigation').on('click', 'a.nav-link', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this),
      href = $this.attr('href');
    var offset = $(href).offset();
    var scrollto = offset.top - 80; // minus fixed header height
    $('html, body').animate(
      {
        scrollTop: scrollto
      },
      0
    );
    setTimeout(function () {
      $this.parent('.nav-item').siblings('.nav-item').children('.nav-link').removeClass('active');
      $this.addClass('active');
    }, 100);
  });

  // main menu internationalization

  // init i18n and load language file
  if ($body.attr('data-framework') === 'laravel') {
    // change language according to data-language of dropdown item
    var language = $('html')[0].lang;
    if (language !== null) {
      // get the selected flag class
      var selectedLang = $('.dropdown-language')
        .find('a[data-language=' + language + ']')
        .text();
      var selectedFlag = $('.dropdown-language')
        .find('a[data-language=' + language + '] .flag-icon')
        .attr('class');
      // set the class in button
      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
    }
  } else {
    i18next.use(window.i18nextXHRBackend).init(
      {
        debug: false,
        fallbackLng: 'en',
        backend: {
          loadPath: assetPath + 'data/locales/{{lng}}.json'
        },
        returnObjects: true
      },
      function (err, t) {
        // resources have been loaded
        jqueryI18next.init(i18next, $);
      }
    );

    // change language according to data-language of dropdown item
    $('.dropdown-language .dropdown-item').on('click', function () {
      var $this = $(this);
      $this.siblings('.selected').removeClass('selected');
      $this.addClass('selected');
      var selectedLang = $this.text();
      var selectedFlag = $this.find('.flag-icon').attr('class');
      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
      var currentLanguage = $this.data('language');
      i18next.changeLanguage(currentLanguage, function (err, t) {
        $('.main-menu, .horizontal-menu-wrapper').localize();
      });
    });
  }

  /********************* Bookmark & Search ***********************/
  // This variable is used for mouseenter and mouseleave events of search list
  var $filename = $('.search-input input').data('search'),
    bookmarkWrapper = $('.bookmark-wrapper'),
    bookmarkStar = $('.bookmark-wrapper .bookmark-star'),
    bookmarkInput = $('.bookmark-wrapper .bookmark-input'),
    navLinkSearch = $('.nav-link-search'),
    searchInput = $('.search-input'),
    searchInputInputfield = $('.search-input input'),
    searchList = $('.search-input .search-list'),
    appContent = $('.app-content'),
    bookmarkSearchList = $('.bookmark-input .search-list');

  // Bookmark icon click
  bookmarkStar.on('click', function (e) {
    e.stopPropagation();
    bookmarkInput.toggleClass('show');
    bookmarkInput.find('input').val('');
    bookmarkInput.find('input').blur();
    bookmarkInput.find('input').focus();
    bookmarkWrapper.find('.search-list').addClass('show');

    var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
      $arrList = '',
      $activeItemClass = '';

    $('ul.search-list li').remove();

    for (var i = 0; i < arrList.length; i++) {
      if (i === 0) {
        $activeItemClass = 'current_item';
      } else {
        $activeItemClass = '';
      }

      var iconName = '',
        className = '';
      if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
        var classString = arrList[i].firstChild.firstChild.getAttribute('class');
        iconName = classString.split('feather-')[1].split(' ')[0];
        className = classString.split('feather-')[1].split(' ')[1];
      }

      $arrList +=
        '<li class="auto-suggestion ' +
        $activeItemClass +
        '">' +
        '<a class="d-flex align-items-center justify-content-between w-100" href=' +
        arrList[i].firstChild.href +
        '>' +
        '<div class="d-flex justify-content-start align-items-center">' +
        feather.icons[iconName].toSvg({ class: 'me-75 ' + className }) +
        '<span>' +
        arrList[i].firstChild.dataset.bsOriginalTitle +
        '</span>' +
        '</div>' +
        feather.icons['star'].toSvg({ class: 'text-warning bookmark-icon float-end' }) +
        '</a>' +
        '</li>';
    }
    $('ul.search-list').append($arrList);
  });

  // Navigation Search area Open
  navLinkSearch.on('click', function () {
    var $this = $(this);
    var searchInput = $(this).parent('.nav-search').find('.search-input');
    searchInput.addClass('open');
    searchInputInputfield.focus();
    searchList.find('li').remove();
    bookmarkInput.removeClass('show');
  });

  // Navigation Search area Close
  $('.search-input-close').on('click', function () {
    var $this = $(this),
      searchInput = $(this).closest('.search-input');
    if (searchInput.hasClass('open')) {
      searchInput.removeClass('open');
      searchInputInputfield.val('');
      searchInputInputfield.blur();
      searchList.removeClass('show');
      appContent.removeClass('show-overlay');
    }
  });

  // Filter
  if ($('.search-list-main').length) {
    var searchListMain = new PerfectScrollbar('.search-list-main', {
      wheelPropagation: false
    });
  }
  if ($('.search-list-bookmark').length) {
    var searchListBookmark = new PerfectScrollbar('.search-list-bookmark', {
      wheelPropagation: false
    });
  }
  // update Perfect Scrollbar on hover
  $('.search-list-main').mouseenter(function () {
    searchListMain.update();
  });

  searchInputInputfield.on('keyup', function (e) {
    $(this).closest('.search-list').addClass('show');
    if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
      if (e.keyCode == 27) {
        appContent.removeClass('show-overlay');
        bookmarkInput.find('input').val('');
        bookmarkInput.find('input').blur();
        searchInputInputfield.val('');
        searchInputInputfield.blur();
        searchInput.removeClass('open');
        if (searchInput.hasClass('show')) {
          $(this).removeClass('show');
          searchInput.removeClass('show');
        }
      }

      // Define variables
      var value = $(this).val().toLowerCase(), //get values of input on keyup
        activeClass = '',
        bookmark = false,
        liList = $('ul.search-list li'); // get all the list items of the search
      liList.remove();
      // To check if current is bookmark input
      if ($(this).parent().hasClass('bookmark-input')) {
        bookmark = true;
      }

      // If input value is blank
      if (value != '') {
        appContent.addClass('show-overlay');

        // condition for bookmark and search input click
        if (bookmarkInput.focus()) {
          bookmarkSearchList.addClass('show');
        } else {
          searchList.addClass('show');
          bookmarkSearchList.removeClass('show');
        }
        if (bookmark === false) {
          searchList.addClass('show');
          bookmarkSearchList.removeClass('show');
        }

        var $startList = '',
          $otherList = '',
          $htmlList = '',
          $bookmarkhtmlList = '',
          $pageList =
            '<li class="d-flex align-items-center">' +
            '<a href="#">' +
            '<h6 class="section-label mt-75 mb-0">Pages</h6>' +
            '</a>' +
            '</li>',
          $activeItemClass = '',
          $bookmarkIcon = '',
          $defaultList = '',
          a = 0;

        // getting json data from file for search results
        $.getJSON(assetPath + 'data/' + $filename + '.json', function (data) {
          for (var i = 0; i < data.listItems.length; i++) {
            // if current is bookmark then give class to star icon
            // for laravel
            if ($('body').attr('data-framework') === 'laravel') {
              data.listItems[i].url = assetPath + data.listItems[i].url;
            }

            if (bookmark === true) {
              activeClass = ''; // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = '';
              // Loop to check if current seach value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.listItems[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning';
                  break;
                } else {
                  activeClass = '';
                }
              }

              $bookmarkIcon = feather.icons['star'].toSvg({ class: 'bookmark-icon float-end' + activeClass });
            }
            // Search list item start with entered letters and create list
            if (data.listItems[i].name.toLowerCase().indexOf(value) == 0 && a < 5) {
              if (a === 0) {
                $activeItemClass = 'current_item';
              } else {
                $activeItemClass = '';
              }
              $startList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.listItems[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
                feather.icons[data.listItems[i].icon].toSvg({ class: 'me-75 ' }) +
                '<span>' +
                data.listItems[i].name +
                '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>';
              a++;
            }
          }
          for (var i = 0; i < data.listItems.length; i++) {
            if (bookmark === true) {
              activeClass = ''; // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = '';
              // Loop to check if current search value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.listItems[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning';
                } else {
                  activeClass = '';
                }
              }

              $bookmarkIcon = feather.icons['star'].toSvg({ class: 'bookmark-icon float-end' + activeClass });
            }
            // Search list item not start with letters and create list
            if (
              !(data.listItems[i].name.toLowerCase().indexOf(value) == 0) &&
              data.listItems[i].name.toLowerCase().indexOf(value) > -1 &&
              a < 5
            ) {
              if (a === 0) {
                $activeItemClass = 'current_item';
              } else {
                $activeItemClass = '';
              }
              $otherList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.listItems[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
                feather.icons[data.listItems[i].icon].toSvg({ class: 'me-75 ' }) +
                '<span>' +
                data.listItems[i].name +
                '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>';
              a++;
            }
          }

          
          $defaultList = $('.main-search-list-defaultlist').html();
          if ($startList == '' && $otherList == '') {
            $otherList = $('.main-search-list-defaultlist-other-list').html();
          }
          // concatinating startlist, otherlist, defalutlist with pagelist
          $htmlList = $pageList.concat($startList, $otherList, $defaultList);
          $('ul.search-list').html($htmlList);
          // concatinating otherlist with startlist
          $bookmarkhtmlList = $startList.concat($otherList);
          $('ul.search-list-bookmark').html($bookmarkhtmlList);
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        });
      } else {
        if (bookmark === true) {
          var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
            $arrList = '';
          for (var i = 0; i < arrList.length; i++) {
            if (i === 0) {
              $activeItemClass = 'current_item';
            } else {
              $activeItemClass = '';
            }

            var iconName = '',
              className = '';
            if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
              var classString = arrList[i].firstChild.firstChild.getAttribute('class');
              iconName = classString.split('feather-')[1].split(' ')[0];
              className = classString.split('feather-')[1].split(' ')[1];
            }
            $arrList +=
              '<li class="auto-suggestion">' +
              '<a class="d-flex align-items-center justify-content-between w-100" href=' +
              arrList[i].firstChild.href +
              '>' +
              '<div class="d-flex justify-content-start align-items-center">' +
              feather.icons[iconName].toSvg({ class: 'me-75 ' }) +
              '<span>' +
              arrList[i].firstChild.dataset.bsOriginalTitle +
              '</span>' +
              '</div>' +
              feather.icons['star'].toSvg({ class: 'text-warning bookmark-icon float-end' }) +
              '</a>' +
              '</li>';
          }
          $('ul.search-list').append($arrList);
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        } else {
          // if search input blank, hide overlay
          if (appContent.hasClass('show-overlay')) {
            appContent.removeClass('show-overlay');
          }
          // If filter box is empty
          if (searchList.hasClass('show')) {
            searchList.removeClass('show');
          }
        }
      }
    }
  });

  

  // Prevent closing bookmark dropdown on input textbox click
  $(document).on('click', '.bookmark-input input', function (e) {
    bookmarkInput.addClass('show');
    bookmarkSearchList.addClass('show');
  });

  // Favorite star click
  $(document).on('click', '.bookmark-input .search-list .bookmark-icon', function (e) {
    e.stopPropagation();
    if ($(this).hasClass('text-warning')) {
      $(this).removeClass('text-warning');
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li');
      for (var i = 0; i < arrList.length; i++) {
        if (arrList[i].firstChild.dataset.bsOriginalTitle == $(this).parent()[0].innerText) {
          arrList[i].remove();
        }
      }
      e.preventDefault();
    } else {
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li');
      $(this).addClass('text-warning');
      e.preventDefault();
      var $url = $(this).parent()[0].href,
        $name = $(this).parent()[0].innerText,
        $listItem = '',
        $listItemDropdown = '',
        iconName = $(this).parent()[0].firstChild.firstChild.dataset.icon;
      if ($($(this).parent()[0].firstChild.firstChild).hasClass('feather')) {
        var classString = $(this).parent()[0].firstChild.firstChild.getAttribute('class');
        iconName = classString.split('feather-')[1].split(' ')[0];
      }
      $listItem =
        '<li class="nav-item d-none d-lg-block">' +
        '<a class="nav-link" href="' +
        $url +
        '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
        $name +
        '">' +
        feather.icons[iconName].toSvg({ class: 'ficon' }) +
        '</a>' +
        '</li>';
      $('ul.nav.bookmark-icons').append($listItem);
      $('[data-bs-toggle="tooltip"]').tooltip();
    }
  });

  

  // Waves Effect
  Waves.init();
  Waves.attach(
    ".btn:not([class*='btn-relief-']):not([class*='btn-gradient-']):not([class*='btn-outline-']):not([class*='btn-flat-'])",
    ['waves-float', 'waves-light']
  );
  Waves.attach("[class*='btn-outline-']");
  Waves.attach("[class*='btn-flat-']");

  

  // on window scroll button show/hide
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 400) {
      $('.scroll-top').fadeIn();
    } else {
      $('.scroll-top').fadeOut();
    }

    // On Scroll navbar color on horizontal menu
    if ($body.hasClass('navbar-static')) {
      var scroll = $(window).scrollTop();

      if (scroll > 65) {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#fff',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('.horizontal-menu.dark-layout .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      } else {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#f8f8f8',
          'box-shadow': 'none'
        });
        $('.dark-layout .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': 'none'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      }
    }
  });

  // Click event to scroll to top
  $('.scroll-top').on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 75);
  });

  function getCurrentLayout() {
    var currentLayout = '';
    if ($html.hasClass('dark-layout')) {
      currentLayout = 'dark-layout';
    } else if ($html.hasClass('bordered-layout')) {
      currentLayout = 'bordered-layout';
    } else if ($html.hasClass('semi-dark-layout')) {
      currentLayout = 'semi-dark-layout';
    } else {
      currentLayout = 'light-layout';
    }
    return currentLayout;
  }

  // Get the data layout, for blank set to light layout
  var dataLayout = $html.attr('data-layout') ? $html.attr('data-layout') : 'light-layout';

  // Navbar Dark / Light Layout Toggle Switch
  $('.nav-link-style').on('click', function () {
    var currentLayout = getCurrentLayout(),
      switchToLayout = '',
      prevLayout = localStorage.getItem(dataLayout + '-prev-skin', currentLayout);

    // If currentLayout is not dark layout
    if (currentLayout !== 'dark-layout') {
      // Switch to dark
      switchToLayout = 'dark-layout';
    } else {
      // Switch to light
      // switchToLayout = prevLayout ? prevLayout : 'light-layout';
      if (currentLayout === prevLayout) {
        switchToLayout = 'light-layout';
      } else {
        switchToLayout = prevLayout ? prevLayout : 'light-layout';
      }
    }
    // Set Previous skin in local db
    localStorage.setItem(dataLayout + '-prev-skin', currentLayout);
    // Set Current skin in local db
    localStorage.setItem(dataLayout + '-current-skin', switchToLayout);

    // Call set layout
    setLayout(switchToLayout);

    // ToDo: Customizer fix
    $('.horizontal-menu .header-navbar.navbar-fixed').css({
      background: 'inherit',
      'box-shadow': 'inherit'
    });
    $('.horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', 'inherit');
  });

  // Get current local storage layout
  var currentLocalStorageLayout = localStorage.getItem(dataLayout + '-current-skin');

  // Set layout on screen load
  //? Comment it if you don't want to sync layout with local db
  // setLayout(currentLocalStorageLayout);

  function setLayout(currentLocalStorageLayout) {
    var navLinkStyle = $('.nav-link-style'),
      currentLayout = getCurrentLayout(),
      mainMenu = $('.main-menu'),
      navbar = $('.header-navbar'),
      // Witch to local storage layout if we have else current layout
      switchToLayout = currentLocalStorageLayout ? currentLocalStorageLayout : currentLayout;

    $html.removeClass('semi-dark-layout dark-layout bordered-layout');

    if (switchToLayout === 'dark-layout') {
      $html.addClass('dark-layout');
      mainMenu.removeClass('menu-light').addClass('menu-dark');
      navbar.removeClass('navbar-light').addClass('navbar-dark');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({ class: 'ficon' }));
    } else if (switchToLayout === 'bordered-layout') {
      $html.addClass('bordered-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    } else if (switchToLayout === 'semi-dark-layout') {
      $html.addClass('semi-dark-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    } else {
      $html.addClass('light-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
    }
    // Set radio in customizer if we have
    if ($('input:radio[data-layout=' + switchToLayout + ']').length > 0) {
      setTimeout(function () {
        $('input:radio[data-layout=' + switchToLayout + ']').prop('checked', true);
      });
    }
  }
})(window, document, jQuery);

// To use feather svg icons with different sizes
function featherSVG(iconSize) {
  // Feather Icons
  if (iconSize == undefined) {
    iconSize = '14';
  }
  return feather.replace({ width: iconSize, height: iconSize });
}


