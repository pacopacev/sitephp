
function saveFaforiteRadio(name_radio, url_radio, stationuuid) {
    var fav_radio = {name: name_radio, url: url_radio, stationuuid: stationuuid};
    $.ajax({
        url: "radio/save_favorite_radio.php",
        datatype: 'json',
        data: fav_radio,
        cache: false,
        type: "POST",
        success: function (response) {
            $("#btn-add-fav").addClass('hidden');
            $("#btn-rem-fav").removeClass('hidden').addClass('btn-favorite');
            $("#btn-rem-fav").attr("data-text", "Added in Favorites");
            $("#btn-rem-fav").disabled = true;
            if (response.success == true) {
                showModalAddedToFavorites(response);
                return;
            }
            if (response.success == false) {
                showModalExistInFavorites();
                return;
            }
        }
    });
}
//get favorite
document.getElementById("station-favorite").addEventListener('click', function () {
    $.ajax({
        url: "radio/getFavorites.php",
        datatype: 'json',
        cache: false,
        type: "GET",
        success: function (response) {
            var formoption = "";
            var res = JSON.parse(response);
            $.each(res, function (key, value) {
                if (value.length == 1) {
                    formoption += "<option selected>Chose your favorite</option>";
                    return;
                }
                if (value) {
                    var url = value['url'].slice(1, -1);
                    var name = value['name'].slice(1, -1);
                    var id = value['id'];
                    formoption += "<option value='" + url + "' data-id='" + id + "'>" + name + "</option>";
                }

            });

            $('#station-favorite').html(formoption);
            $('#station-favorite').on('change', function () {
                var name_radio = $("#station-favorite option:selected").text();
                var url_radio = $(this).val();
//                //---del favorite
                var station_id = $("#station-favorite option:selected").data('id');
                $("#btn-rem-fav").click(function () {
                    delFavorite(station_id, name_radio);
                });

                var url = "https://radioplayer.link/iframe/index.php?autoplay=play&name=" + name_radio + "&logo=&bgcolor=212121&textcolor=FFFFFF&v=1&stream=" + url_radio;
                $("#radio_url").attr('src', url);
                var url = $(this).val();
                var name = $("#station-favorite option:selected").text();
                var sn = "<option value='" + url + "'>" + name + "</option>";
                $('#station-favorite').html(sn);
                $("#btn-rem-fav").removeClass('hidden').addClass('btn-favorite').addClass('fav-btn-color');
                $("#btn-rem-fav").attr("data-text", "Remove Favorite");
                $("#btn-rem-fav").disabled = true;
            });
        }
    });
}, false);


function delFavorite(station_id, name_radio) {
    var data = {id: station_id, name: name_radio};
    if (station_id != "undifined") {
        $.ajax({
            url: "radio/delete_favorite_radio.php",
            datatype: 'json',
            data: data,
            cache: false,
            type: "POST",
            success: function (response) {
                if (response.success == true) {
                    showModalDelfromFavorites(response);
                    return;
                }
            }
        });
    }
}

function showModalAddedToFavorites(response) {
//modal, added to favorites
// Get the modal
    var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// Open the modal   
    modal.style.display = "block";
    var radio_name = response.name_radio.slice(1, -1);
    $(".modal-content p").remove();
    $(".modal-content").append("<p>" + "Added to favorite list:" + "<br>" + radio_name + "</p>");

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function showModalExistInFavorites() {

    //modal, added to favorites
// Get the modal
    var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// Open the modal   
    modal.style.display = "block";
    $(".modal-content p").remove();
    $(".modal-content").append("<p>Already exists in favorites!</p>");

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}

function showModalDelfromFavorites(response) {
//modal, added to favorites
// Get the modal
    var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// Open the modal   
    modal.style.display = "block";
    var radio_name = response.name_radio.slice(1, -1);
    $(".modal-content p").remove();
    $(".modal-content").append("<p>" + "Removed from favorite list:" + "<br>" + radio_name + "</p>");

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}