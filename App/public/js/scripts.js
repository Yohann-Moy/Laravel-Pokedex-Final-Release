$(document).ready(function(){

    $('.burger_menu').click(function(e){
        $('.burger_menu_content').slideToggle();
    });

    window.onscroll = function (e) {
        $('.burger_menu_content').slideUp(0);
        // called when the window is scrolled.
    }

    $('.release_pokemon').click(function(e) {
      e.preventDefault(); // Evite l'envoi de façon normale //
      var this_pokemon_container = $("#list_content_"+$(this).data("id"));
      var donnees = $(this).data("id");


        $.ajax({
          method: "POST",
          url: "/pokedex/release_pokemon",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            "id": $(this).data("id"), // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
          //"_method": 'delete'
          },

          dataType: "json",

          success: function(response){
            this_pokemon_container.remove();

            if($('.list_content').length==0){
                if($('#whoIsConnected').val() == 0){ // Dans le cas où ce n'est pas l'admin //
                    document.getElementById('status').innerHTML="Vous n'avez pas encore capturé de pokémons ou bien vous les avez tous relâché.";
                }
                else{
                    document.getElementById('status').innerHTML="Ce dresseur n'a pas encore capturé de pokémons ou bien ils ont tous été relâchés.";
                }
            }
          },

          error: function(xhr){
            alert('ca ne fonctionne pas :(');
          },
      })
    });

    // $('.del_pokemon').click(function(e) {
     document.querySelector('body').addEventListener('click', function(e){

        // Copyright Damien Grislain //
        if(e.target.tagName.toLowerCase() == 'a'){
            if(e.target.name=="delete_pokemon_trigger"){
            id=e.target.id;
            console.log(id);

        // End Copyright //

        e.preventDefault(); // Evite l'envoi de façon normale //
        var this_pokemon_container = $("#list_content_"+id);



          $.ajax({
            method: "POST",
            url: "/pokedex/delete_pokemon",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              "id": id, // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
            },

            dataType: "json",

            success: function(response){
              //alert('ca fonctionne mon con');
              this_pokemon_container.remove();
            },

            error: function(xhr){
              alert('ca ne fonctionne pas :(');
            },
        })
    }}
      });

      $('.del_user').click(function(e) {
        e.preventDefault(); // Evite l'envoi de façon normale //
        var this_user_container = $("#tab_content_"+$(this).data("id"));

          $.ajax({
            method: "POST",
            url: "/pokedex/delete_user",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              "id": $(this).data("id"), // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
            },

            dataType: "json",

            success: function(response){
              //alert('ca fonctionne mon con');
              this_user_container.remove();
            },

            error: function(xhr){
              alert('ca ne fonctionne pas :(');
            },
        })
      });

      // Changer surnom pokémon AJAX //

      $('.change_pkmn_surnom_validate').click(function(e) {
        e.preventDefault(); // Evite l'envoi de façon normale //

        $dataID = $(this).data("id");

        // Récupère l'ancien surnom du pokemon //
        var dataOldNOM = $('#pkmn_old_nickname_'+$dataID).val();

        // Récupère le contenu de l'input pour changer le nom //
        var dataNOM = $('#form_nom_edit_'+$dataID).val();

        if(dataNOM == ''){
            dataNOM = dataOldNOM;
        }

        // Cible l'élément qui sera remplacé par un autre surnom //
        var pokemon_surnom = $(".surnom_"+$dataID);

/*         console.log('Data ID = '+$dataID);
        console.log('Data nom = '+dataNOM); */

          $.ajax({
            method: "POST",
            url: "/my_pokemons/nickname_changed",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              "id": $dataID, // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
              "pkmn_new_surnom": dataNOM,

            },

            dataType: "json",

            success: function(response){
            //   alert('ca fonctionne mon con');
              pokemon_surnom.html("( "+dataNOM+" )");
            },

            error: function(xhr){
              alert('ca ne fonctionne pas :(');
            },
        })
      });

      $('.gotchaaaa').click(function(e) {
        e.preventDefault(); // Evite l'envoi de façon normale //

        $dataPokemonID = $(this).data("id");
        $dataUserID = $('#gotchaaaa_value_'+$dataPokemonID).val();

        var this_pokemon_container = $("#list_content_"+$dataPokemonID);


           $.ajax({
            method: "POST",
            url: "/pokedex/catch_action_pokemon="+$dataPokemonID+"-user_id="+$dataUserID,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              "pokemon_id": $dataPokemonID, // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
              "user_id": $dataUserID,
            },

            dataType: "json",

            success: function(response){
            // alert('ca fonctionne mon con');
              this_pokemon_container.append("<div class='pokemon_capture'></div>");
            },

            error: function(xhr){
              alert('ca ne fonctionne pas :(');
            },
        })
      });

      $('.bouton_add_pokemon').click(function(e){


        e.preventDefault(); // Evite l'envoi de façon normale //

        $dataPokemonID = $('#form_tache_add').val();
        $dataPokemonNom = $('#form_nom_add').val();
        $dataPokemonType1 = $('#pokemontype1_add').val();
        $dataPokemonType2 = $('#pokemontype2_add').val();
        $dataPokemonImage = $('#form_image_add').val();

        $.ajax({
            method: "POST",
            url: "/juste_les_pokemons",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "pokemon_id": $dataPokemonID, // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
                "pokemon_nom": $dataPokemonNom,
                "pokemon_type1": $dataPokemonType1,
                "pokemon_type2": $dataPokemonType2,
                "pokemon_sprite": $dataPokemonImage,
            },

            dataType: "json",

            success: function(response){
              //alert('ca fonctionne mon con');
              $('.list_items').html(response.html);

              // Remet l'ensemble des champs du formulaire à vide
              $('#form_tache_add').val('');
              $('#form_nom_add').val('');
              $('#pokemontype1_add').val('');
              $('#pokemontype2_add').val('');
              $('#form_image_add').val('');
            },

            error: function(xhr){
              alert('ca ne fonctionne pas :(');
            },
        })
      });

      document.querySelector('body').addEventListener('click', function(e){

        // Copyright Damien Grislain //
        if(e.target.tagName.toLowerCase() == 'button'){
            if(e.target.name=="edit_pokemon_trigger"){
            id=e.target.id;
            id=id.replace('bouton_envoyer_','');
            console.log(id);

        // End Copyright //

//      $('.submit_edit_pokemon').click(function(e){

          $databaseID = id;

          $dataPokemonID = $('#form_numero_edit_'+$databaseID).val();
          $dataPokemonNom = $('#form_nom_edit_'+$databaseID).val();
          $dataPokemonType1 = $('#pokemontype1_edit_'+$databaseID).val();
          $dataPokemonType2 = $('#pokemontype2_edit_'+$databaseID).val();
          $dataPokemonImage = $('#form_image_edit_'+$databaseID).val();

          /* alert($dataPokemonID+' '+$dataPokemonNom+' '+$dataPokemonType1+' '+$dataPokemonType2+' '+$dataPokemonImage); */

          $.ajax({
            method: "POST",
            url: "/pokedex/update_pkmn="+$databaseID,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "table_id": $databaseID,
                "pokemon_id": $dataPokemonID, // data qui a pour nom id a pour valeur l'attribut data-id du bouton cliqué //
                "pokemon_nom": $dataPokemonNom,
                "pokemon_type1": $dataPokemonType1,
                "pokemon_type2": $dataPokemonType2,
                "pokemon_sprite": $dataPokemonImage,
            },

            dataType: "json",

            success: function(response){
                //alert('ca fonctionne mon con');
                //Reload la vue //
                $('.list_items').html(response.html);
            },

            error: function(xhr){
                console.log(xhr);
              alert('ca ne fonctionne pas :('+$databaseID);
            },
        })
    }}
})

$('.recuperer_mon_pokemon').click(function(e){
    e.preventDefault(); // Evite l'envoi de façon normale //
    $dataRowID = $(this).data("id");

    var this_pokemon_container = $("#list_content_"+$dataRowID);

    $.ajax({
        method: "POST",
        url: "/recuperer_un_pokemon",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "row_id": $dataRowID,
        },

        dataType: "json",

        success: function(response){
            /* alert('ca fonctionne mon con'); */
            $('#gotchaaaa_exchange_madeup_'+$dataRowID).remove();
            this_pokemon_container.append("<button type='button' data-toggle='modal' id='gotchaaaa_exchange_"+$dataRowID+"' class='gotchaaaa_exchange' data-target='#ExchangeModal"+$dataRowID+"'>Échanger</button>");
            //Reload la vue //
        },

        error: function(xhr){
          alert('ca ne fonctionne pas :(');
        },
    })
});

$('.envoyer_mon_pokemon').click(function(e){
    e.preventDefault(); // Evite l'envoi de façon normale //
    $dataRowID = $(this).data("id");

    var this_pokemon_container = $("#list_content_"+$dataRowID);

    $.ajax({
        method: "POST",
        url: "/envoyer_un_pokemon",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "row_id": $dataRowID,
        },

        dataType: "json",

        success: function(response){
            /* alert('ca fonctionne mon con'); */
            $('#gotchaaaa_exchange_'+$dataRowID).remove();
            this_pokemon_container.append("<button type='button' data-toggle='modal' id='gotchaaaa_exchange_madeup_"+$dataRowID+"'class='gotchaaaa_exchange' data-target='#ExchangeGetBackModal"+$dataRowID+"'>Récupérer</button>");
        },

        error: function(xhr){
          alert('ca ne fonctionne pas :(');
        },
    })
});

      });
/* }); */
