/*    $.ajax({
        type: "POST",
        url: url,
        data: {"taskid": data},
        dataType: "text",
        async: false,
        success: function (payloads) {
            show(payloads);
        },
        error: function () {
            alert('something wrong error 002');
        }
    });*/
    function edit(){
        var formArray = $('.edit-message');
      var ajaxObj = {};
        $.each(formArray, function(index, val) {
        ajaxObj[$(val).attr('name')] = $(val).val()
      });

      var interestCheckbox = $('.interest-checkbox');
      ajaxObj['department'] = [];

      $.each(interestCheckbox, function(index, val) {
        /* iterate through array or object */
        if (val.checked) {
          ajaxObj['department'].push($(val).attr('id'));
          console.log($(val).attr('id'));
        }
      });

      var ajaxJson = JSON.stringify(ajaxObj);
      var url = "modify.php";
      $.ajax({
        type: "POST",
        url: url,
        data: {"data": ajaxJson},
        dataType: "text",
        async: false,
        success: function (payloads) {
            resModify(payloads,'user.php');
        },
        error: function () {
            alert('something wrong error 002');
            location.href="index.html";
        }
    });

    }
    function login(){
        var json = JSON.stringify(getFormJson('#login-form'));
        var url = "login.php";
        $.ajax({
        type: "POST",
        url: url,
        data: {"data": json},
        dataType: "text",
        async: false,
        success: function (payloads) {
            show(payloads,'user.php');
        },
        error: function () {
            alert('something wrong error 002');
        }
    });
    }
    function register(){
        var json = JSON.stringify(getFormJson('form'));
        var url = "reg.php";
        $.ajax({
        type: "POST",
        url: url,
        data: {"data": json},
        dataType: "text",
        async: false,
        success: function (payloads) {
            show(payloads,'index.html');
        },
        error: function () {
            alert('something wrong error 002');
        }
    });
    }

    function getFormJson(form) {
        var o = {};
        var a = $(form).serializeArray();
        $.each(a, function () {
        if (o[this.name] !== undefined) {
        if (!o[this.name].push) {
        o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
        } else {
        o[this.name] = this.value || '';
        }
        });
        return o;
    }

    //logout

    //url
    function goback(){
        history.back();
    }
    function logout(){
        url="logout.php";
        $.ajax({
        type: "GET",
        url: url,
        dataType: "text",
        async: false,
        success: function (payloads) {
            show(payloads,'index.html');
        },
        error: function () {
            alert('something wrong error 009');
        }
    });

    }

    function show(msg,url){
        msg = JSON.parse(msg);
        var message = msg['message'];
        message = unescape(message.replace(/\u/g, "%u"));
        if(msg['code']==0){
            $('#msg').css("color","green");
            setTimeout('location.href="'+url+'"',1000);
            $('#msg').html(message);
        }
        else if(msg['code']==1){
            $('#msg').css("color","red");
            $('#msg').html(message);
        }
        else if(msg['code']==2){
            $('#msg').css("color","#f0ffff");
            $('#msg').html("欢迎"+"<p style='color:gold'>"+message+"</p>");
            setTimeout("location.href='user.php'",1000);

        }

    }

function resModify(msg,url){
        msg = JSON.parse(msg);
        var message = msg['message'];
        message = unescape(message.replace(/\u/g, "%u"));
        if(msg['code']==0){
            $('#msg').css("color","green");
            alert(message);
            setTimeout('location.href="'+url+'"',1000);
            $('#msg').html(message);
        }
        else if(msg['code']==1){
            $('#msg').css("color","red");
            $('#msg').html(message);
            alert(message);
        }
}