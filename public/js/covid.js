const IsNumeric = (num) => /^-{0,1}\d*\.{0,1}\d+$/.test(num);
function onSubmit(){
    const $employeeId = $("#txtEmployeeId");
    const $el = $("#txtTemperature");
    //IsNumeric($el.val());

    if(IsNumeric($el.val()) && ($el.val() > 30 && $el.val() < 40)){
       // $($el).addClass("is-valid");
        $($el).removeClass("is-invalid");
        if(!$($el).hasClass("is-valid")){
            $($el).addClass("is-valid");
        }
        $.ajax({
            method: "POST",
            url: "/api/employee/checkin",
            data: { employee_id: $employeeId.val(), temperature: $el.val()}
            })
        .done(function( response ) {
            if(response.errCode == 0){
                const xHtml = '<div class="card card-body"><h6>Xin cảm ơn!</h6>'
                    +'<h3 class="text-center">'+response.data.name+'</h3>'
                    +'<h5 class="text-center h4" style="color:#FF8C00">Chúc bạn có ngày làm việc thật vui vẻ.</h5>'
                    +'</div>';
                    $('#form_covid').trigger("reset");
                    $("#txtSearch").removeClass('is-valid').focus();
                        $("#collapseExample").html(xHtml);
                        $("#collapseExample").show();
                        $($el).removeClass("is-invalid");
                        if(!$($el).hasClass("is-valid")){
                            $($el).addClass("is-valid");
                        }
                        $("html, body").animate({ scrollTop: 0 }, "slow");
            }
            else {
                const xHtml = '<div class="card card-body">'
                    +'<p class="text-danger text-center">'+response.errMsg+'</p>'
                    +'</div>';
                    $("#collapseExample").html(xHtml);
                    $("#collapseExample").show();
                    $($el).removeClass("is-valid");
                    if(!$($el).hasClass("is-invalid")){
                        $($el).addClass("is-invalid");
                    }
            }
        });
    }else{
        //console.log("a"+IsNumeric($el.val()));
        $($el).removeClass("is-valid");
        if(!$($el).hasClass("is-invalid")){
            $($el).addClass("is-invalid");
        }
    }

}

jQuery(document).ready(function($){
    $('#txtSearch').focus().keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
         {
           $('#btnSearch').click();
           return false;
         }
    });



    $( "#btnSearch" ).click(function(e) {
        e.preventDefault();
        const $el = $("#txtSearch");
        $("#collapseExample").hide();
        $.ajax({
            method: "POST",
            url: "/api/employee/find-by-code-or-name",
            data: { search: $el.val()}
            })
        .done(function( response ) {
            if(response.errCode == 0){
                const xHtml = '<div class="card card-body"><h6>Xin chào ngày mới tốt lành!</h6>'
                    +'<h3 class="text-center">'+response.data.name+'</h3>'
                    +'<p class="text-danger text-center">Xin hãy nhập nhiệt độ đã đo được và bấm nút submit.</p>'
                    +'<div class="row g-3 align-items-center input-group-lg">'
                        +'<div class="col-auto">'
                            +'<label for="txtTemperature" class="col-form-label font-weight-bold">Nhiệt độ đã đo</label>'
                            +'</div>'
                            +'<div class="col-auto">'
                                +'<input type="hidden" value="'+response.data.id+'">'
                                +'<input name="employee_id" id="txtEmployeeId" type="hidden" value="'+response.data.id+'">'
                                +'<input id="txtTemperature" type="number" class="form-control col-4" required> <div class="invalid-feedback">Bạn không phải người.</div>'
                                +'</div>'
                                +'</div>'
                                +'<br/>'
                                +'<div class="container">'
                                    +'<div class="row">'
                                        +'<div class="col text-center">'
                                            +'<button id="btnSubmit" type="submit" class="btn btn-success btn-lg col-3" onclick="onSubmit()">Submit</button>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div></div>';
                        $("#collapseExample").html(xHtml);
                        $("#collapseExample").show();
                        $("#txtTemperature").focus();
                        $($el).removeClass("is-invalid");
                        if(!$($el).hasClass("is-valid")){
                            $($el).addClass("is-valid");
                        }
                        $('#txtTemperature').on('keypress', function (e) {
                            var key = e.which;
                            if(key == 13)  // the enter key code
                             {
                                onSubmit();
                               return false;
                             }
                        });

            }
            else {
                const xHtml = '<div class="card card-body">'
                    +'<p class="text-danger text-center">'+response.errMsg+'</p>'
                    +'</div>';
                    $("#collapseExample").html(xHtml);
                    $("#collapseExample").show();
                    $($el).removeClass("is-valid");
                    if(!$($el).hasClass("is-invalid")){
                        $($el).addClass("is-invalid");
                    }
            }
        });
    });

});
