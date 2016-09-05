// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true,
});
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true,
    showBarsOnPageScrollEnd: false
});

//index page
$$('.isa-drops').on('click', function() {
    window.location.href = "http://drops.hduisa.org/"
})

$$('.isa-wiki').on('click', function() {
    window.location.href = "http://wiki.hduisa.org/"
})

$$('.isa-ctf').on('click', function() {
    window.location.href = "http://ctf.hduisa.org/"
})

$$('.isa-index').on('click', function() {
    window.location.href = "http://hduisa.org/"
})

// Callbacks for About page;
myApp.onPageInit('about', function (page) {
  // run createContentPage func after link was clicked
  $$('.create-page').on('click', function () {
    createContentPage();
  });

  $$('.wiki-link').on('click', function() {
    window.location.href = "http://wiki.hduisa.org/"
  })
});

// Callbacks for Form page;
myApp.onPageInit('form', function (page) {
  // get interest json
  $$.get('ajax/department.php', function(responseData) {
    // var responseData = '[{"id":"1","depart_name":"\u6e17\u900f"},{"id":"2","depart_name":"\u9006\u5411"},{"id":"3","depart_name":"windows"},{"id":"4","depart_name":"web"},{"id":"5","depart_name":"linux"},{"id":"6","depart_name":"\u65e0\u7ebf"},{"id":"7","depart_name":"\u7f51\u7edc"}]';
    var interestList = JSON.parse(responseData);
    $$.each(interestList, function(index, val) {
      /* iterate through array or object */
      var newSelection = $$('<li><label class="label-checkbox item-content"><input type="checkbox" class="interest-checkbox" id="' + val.id + '" name="ks-checkbox" /><div class="item-media"><i class="icon icon-form-checkbox"></i></div><div class="item-inner"><div class="item-title">' + val.depart_name + '</div></div></label></li>');
      $$('.interest-ul').append(newSelection)
    });
  });
  
  var buttonAvaliable = 1;
  $$('.form-submit').on('click',function(){
    if (buttonAvaliable) {
      buttonAvaliable = 0;
      var formArray = $$('.reg-message');
      var ajaxObj = {};

      $$.each(formArray, function(index, val) {
        ajaxObj[$$(val).attr('name')] = $$(val).val()
      });

      var interestCheckbox = $$('.interest-checkbox')
      ajaxObj['department'] = [];

      $$.each(interestCheckbox, function(index, val) {
        /* iterate through array or object */
        if (val.checked) {
          ajaxObj['department'].push($$(val).attr('id'))
        }
      });

      var ajaxJson = JSON.stringify(ajaxObj);

      var preLoader = $$('<div class="preloader-indicator-modal" style="position:fixed"><span class="preloader preloader-white"></span></div>');
      $$('.form-page').append(preLoader);
//http://reg.admin.hduisa.cn/ajax/reg.php
      $$.post('ajax/reg.php', {data: ajaxJson}, function(responseData, textStatus, xhr) {
      // (function jiade(){
        // var responseData = {"code":"0","message":"\u60a8\u5df2\u62a5\u540d\u6210\u529f\uff0c\u9762\u8bd5\u7801\u4e3aFFWO43\uff0c\u8bf7\u51ed\u501f\u9a8c\u8bc1\u7801\u8fdb\u884c\u9762\u8bd5\uff0c\u9762\u8bd5\u65f6\u95f4\u662f\uff0c\u5730\u70b9\uff0c\u7a0d\u540e\u9762\u8bd5\u7801\u4f1a\u53d1\u9001\u81f3\u624b\u673a\uff0c\u8bf7\u6ce8\u610f\u4fdd\u7ba1\u3002"}
        var validation = 0;
        responseData = JSON.parse(responseData);
        if(!parseInt(responseData.code)){
          validation = 1;
        }

        buttonAvaliable = 1;
        $$('.preloader-indicator-modal').remove();

        myApp.alert(responseData.message, 'HDUISA', function () {
          if(validation){
            mainView.router.back();
          }
        });
      // })()
      });
    }
  })
});

// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
    mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
    return;
}