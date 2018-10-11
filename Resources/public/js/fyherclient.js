$( document ).ready(function() {



    $(".chosen-select").chosen();
   // $('[data-toggle="tooltip"]').tooltip();
    $(document).tooltip({ selector: '[data-toggle="tooltip"]' });
    datetimepicker(); 
    $(document).on("click",".openpopupfyher",function(){

        if(!document.getElementById("modalfyheraffiche")){
            var modal=document.createElement("div");
            var contenu='' +
                '<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalfyher">\n' +
                '  <div class="modal-dialog" role="document">\n' +
                '    <div class="modal-content">\n' +
                '      <div class="modal-header">\n' +
                '        <h5 class="modal-title">Modal title</h5>\n' +
                '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
                '          <span aria-hidden="true">&times;</span>\n' +
                '        </button>\n' +
                '      </div>\n' +
                '      <div class="modal-body">\n' +
                '        <p>Chargement en cours ....</p>\n' +
                '      </div>\n' +
                '      <div class="modal-footer">\n' +
                '        <button type="button" class="btn btn-success" data-dismiss="modal">Fermer</button>\n' +
                '      </div>\n' +
                '    </div>\n' +
                '  </div>\n' +
                '</div>';
            modal.setAttribute("id","modalfyheraffiche");
            document.body.appendChild(modal);
            document.getElementById("modalfyheraffiche").innerHTML=contenu;
        }

        var url=$(this).attr("data-link");


        var nom=$(this).attr("data-nom");
        $.ajax({
            url: url,
            type: "GET",
            data: null,
            success: function (html) {

                $(".modal-body").html(html.form);
                functioncheckformfyher();
            }
        });


        $(".modal-title").html(nom);
        $("#modalfyher").modal({show : true});

    });

    $(document).on("click",".edit_form_fyher",function(){

        $(this).toggleClass("btn-dark");

        $(".edit_fyher_info").toggle();
        $(".edit_fyher_form").toggle();
        $("select").chosen({disable_search_threshold: 10});
    });

    zoneafficheinformation();

});

function afficheliste(){
    $(".chosen-select").chosen();
}

function zoneafficheinformation(){


    $(".zone_fyher_affiche_information").each(function(){
        var url=$(this).attr("data-url");
       // alert(url);
        var element=$(this);
        $.get( url, function( data ) {
            element.html( data );
        });
        //return false;
    });

    $(document).on("click",".zone_fyher_affiche_information a",function(){

        var url=$(this).attr("href");
        if(url!="#"){
            var element=$(this).parents(".zone_fyher_affiche_information");
            $.get( url, function( data ) {
                // alert(data);
                element.html( data );
                // zoneafficheinformation();
            });
        }




        return false;

    });


}

function changeselect(id,value){

    //$("#fyherbundle_client_addd_cspClient").append('<option value="999">tututututututucmoiicila</option>');
   // $("#"+id).append(value);
   //alert("ici");

}

function datetimepicker(){
    $('.datetimepicker').flatpickr({
        enableTime: true,
        locale: "fr",
        altFormat: "j F Y H:i",
        dateFormat: "Y-m-d H:i",
        weekNumbers: true,
        altInput: true,
        minDate: 'today',
        time_24hr: true,
        static: true,
        appendTo: document.getElementById('formajaxfyher')
    });
}

function functioncheckformfyher(){

    datetimepicker();

    $("#formajaxfyher").on("submit",function (){

        var formData = new FormData($("#formajaxfyher")[0]);

        var route=$(this).attr("data-url");

        $.ajax({
            type: "POST",
            url: route,
            data: formData,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(function (data) {
                if (typeof data.message !== 'undefined') {
                    //alert(data.message+"tutu");
                    //alert("lol");

                    if(data.message=="ok"){
                        $( ".modal-body" ).html("<br><br><div class='alert alert-success col-md-12'>Action bien effectuées</div>");
                       // alert(data.idmodify);
                        if(data.idmodify!='undefined'){
                            var tomidyfy=data.idmodify;
                            //$("#"+tomidyfy).append(data.html);
                            //changeselect(tomidyfy,data.html);
                            $("<option/>", {
                                "value": data.id,
                                "text": data.value
                            }).appendTo($("#"+tomidyfy));

                            //$("#"+tomidyfy+"_chosen ul").append("<li class='active-result' data-option-array-index='"+data.id+"'>"+data.value+"</li>");
                            //$("#"+tomidyfy).chosen();
                            $("#"+tomidyfy).trigger("chosen:updated");
                        }
                        zoneafficheinformation();


                    }else{
                        $( ".modal-body" ).html(data.form);
                        functioncheckformfyher();
                    }
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.responseJSON.hasOwnProperty('form')) {
                        //$('.modala').html(jqXHR.responseJSON.form);
                    }
                    // $('.modala').html(jqXHR.responseJSON.message);
                } else {
                    //alert(errorThrown);
                }
            });

        return false;
    });
}



