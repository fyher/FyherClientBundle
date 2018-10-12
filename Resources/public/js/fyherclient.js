$( document ).ready(function() {



    //$(".chosen-select").chosen();
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

    $(document).on("keypress",".listingvillefyher",function(){
       var key=$(this).val();
       var url=Routing.generate("ville_info_ville",{"nomVille":key});
        $.ajax({
            url: url,
            type: "GET",
            data: null,
            success: function (html) {
                $(".boxville").show();
                $("#listingville_fyher").html(html);
                gestionville();
            }
        });
    });

});

function gestionville(){
    $(".liste_ville_zoneville").click(function(){
      var adresse=$(this).attr("data-addresse-numero")+" "+$(this).attr("data-adresse");
      var ville=$(this).attr("data-ville");
      var departement=$(this).attr("data-departement");
      var codepostal=$(this).attr("data-codepostale");
      var codedepartement=$(this).attr("data-codedepartement");
      var longitude=$(this).attr("data-longitude");
      var latitude=$(this).attr("data-latitude");
      var pays=$(this).attr("data-pays");

      var scodedepartement=codedepartement.split("-");

      //il faut mettre à jour les champs du formulaire
        $("#fyherbundle_client_addd_adresseClient").val(adresse);
        $("#fyherbundle_client_addd_codePostalClient").val(codepostal);
        $("#fyherbundle_client_addd_villeClient").val(ville);
        $("#fyherbundle_client_addd_departementNomClient").val(departement);
        $("#fyherbundle_client_addd_departementCodeClient").val(scodedepartement[1]);
        $("#fyherbundle_client_addd_paysClient option[value='"+pays.substr(0,2).toUpperCase()+"']").prop('selected',true);
        $("#fyherbundle_client_addd_paysClient").trigger("chosen:updated");
        $("#fyherbundle_client_addd_latitudeClient").val(latitude);
        $("#fyherbundle_client_addd_longitudeClient").val(longitude);
        $(".boxville").hide();
    });
}

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
                            $("<option/>", {
                                "value": data.id,
                                "text": data.value
                            }).appendTo($("#"+tomidyfy));

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



