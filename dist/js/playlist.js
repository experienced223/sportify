
var url = '';
var strHTML = '';
var strHTML_italy = '';
var strHTML_international = '';
var token = '';



var myid = "cbe518d94238478fa8a3f1b63a0e3b7f";
var mysecret = "e043591de5d04ee6a0e90f72aa521647";

var refresh_token = 'AQD59sXdgHCuvLkVXxnPSDkjyy8-CZee8UVWZhSMM8USGgBsd0lxjoyG3cUtVdXKIc4yZkNVqiCCB9wHzKzSurpQJIojqhS5eoJb3fQlfE68FfIjAFA0kbIgOg2tldYKvqk';
var client_data = 'Basic ' + btoa(myid + ':' + mysecret);

function get_token()
{
  $.ajax(
  {
    method: "POST",
    url: "https://accounts.spotify.com/api/token",
    headers: {'Content-Type': 'application/x-www-form-urlencoded', "Authorization": client_data},
    data: {
      "grant_type":    "refresh_token",
      "refresh_token": refresh_token
      
    },
    success: function(result) {
      access_token = result.access_token;
      display();
    },
  }
);  
}

function send_ajax_italy(index)
{
  token ='Bearer ' + access_token;
  if (array_italy_url[index]){


  url = array_italy_url[index].replace("https://open.spotify.com/playlist", "https://api.spotify.com/v1/playlists");
  $.ajax({
        url: url,
        type: 'GET',
        headers: {"Authorization": token},
        Accept: 'application/json',
        contentType: 'application/json',
        success: function (data) {
          
          var json = JSON.parse(JSON.stringify(data));
          create_table(json.name, json.external_urls.spotify, json.followers.total, index, "italy");
          
          if (parseInt(index) < array_italy_url.length - 1){
            send_ajax_italy(parseInt(index) + 1);
          }else if (parseInt(index) == array_italy_url.length - 1){
            display_international();
          }
          
        },
        error: function(){
          create_table("", url, "", index, "italy");
          if (parseInt(index) < array_italy_url.length - 1){
            send_ajax_italy(parseInt(index) + 1);
          }else if (parseInt(index) == array_italy_url.length - 1){
            check_box();
            refill_color();
            remove_playlist();
            edit_playlist();
            display_international();
          }
        }
    });

    }else{
      display_international();
    }
}

function send_ajax_international(index)
{
  if (array_international_url[index]){
  url = array_international_url[index].replace("https://open.spotify.com/playlist", "https://api.spotify.com/v1/playlists");
  $.ajax({
        url: url,
        type: 'GET',
        headers: {"Authorization": token},
        Accept: 'application/json',
        contentType: 'application/json',
        success: function (data) {
          var json = JSON.parse(JSON.stringify(data));
          create_table(json.name, json.external_urls.spotify, json.followers.total, index, "international");
          if (parseInt(index) < array_international_url.length - 1){
            send_ajax_international(parseInt(index) + 1);
          }else if (parseInt(index) == array_international_url.length - 1){
           check_box();
            refill_color();
            remove_playlist();
            edit_playlist();
          }
          
        },
        error: function(data){
          create_table("", url, "", index, "international");
          if (parseInt(index) < array_international_url.length - 1){
            send_ajax_international(parseInt(index) + 1);
          }else if (parseInt(index) == array_international_url.length - 1){
           check_box();
            refill_color();
            remove_playlist();
            edit_playlist();
          }
        }
    });
  }else{
    check_box();
    refill_color();
    remove_playlist();
    edit_playlist();
  }
}
function refill_color()
{
    $('table td').each(function() {
        if ($(this).hasClass("refill") && parseInt($(this).html()) > 0)
        {
            $(this).removeClass("refill_plus");
            $(this).addClass("refill_minus");
            $(this).parents("tr").children("td").removeClass("above_threshold");
            $(this).parents("tr").children("td").addClass("below_threshold");
        }
        else if ($(this).hasClass("refill") && parseInt($(this).html()) < 0)
        {
            $(this).removeClass("refill_minus");
            $(this).addClass("refill_plus");
            $(this).parents("tr").children("td").removeClass("below_threshold");
            $(this).parents("tr").children("td").addClass("above_threshold");
        }
    
});
}

function remove_playlist()
{
    var category = '';
    var temp_obj;
    $(".remove").click(function(){
        category = '';
        temp_obj = '';
        category = $(this).parents("table").attr("id");
        temp_obj = $(this).parents("tr");
        
    });

    $("#delete_tr").click(function(){
        id = temp_obj.attr("id").toString();
        if (category == "italy")
          {
            category = "italy";
            id = id.substr(6, id.length);
          }else if (category == "international")
          {
            category = "international";
            id = id.substr(14, id.length);
          }
    $.post( "./php/delete.php", { category: category, id: id})
        .done(function( data ) {
          alert(data);
          location.reload(true);
        });
    });
}
function edit_playlist()
{
  var tr_value = '';
  var tr_category = '';
  var tr_id = '';
  $(".edit").click(function(){
    tr_value = $(this).parents("tr").attr("id").toString();
    if ($(this).parents("table").attr("id") == "italy")
    {
      tr_category = "italy";
      tr_id = tr_value.substr(6, tr_value.length);
    }else if ($(this).parents("table").attr("id") == "international")
    {
      tr_category = "international";
      tr_id = tr_value.substr(14, tr_value.length);
    }
    $.post( "./php/edit_initial.php", { tr_category: tr_category, tr_id: tr_id})
        .done(function( data ) {
          data = JSON.parse(data);
          $("#edit_url").attr("value", data.url.replace("https://api.spotify.com/v1/playlists", "https://open.spotify.com/playlist"));
          $("#edit_threshold").attr("value", data.threshold);      
        });
    
  });
  $("#edit_confirm").click(function(){
    url_edit = $("#edit_url").val();
    $.post( "./php/edit.php", { category: tr_category, id: tr_id, url: url_edit, threshold: $("#edit_threshold").val()})
        .done(function( data ) {
          if (data == 1){
            location.reload(true);
          }
              
        });
  });
}
function check_box()
{
    $(":checkbox").change(function(){
           if ($(this).is(':checked')) {
            $(this).parents("tr").removeClass("unselected");
            $(this).parents("tr").addClass("selected");
          }else{
            $(this).parents("tr").removeClass("selected");
            $(this).parents("tr").addClass("unselected");
          }
    });
}

function create_table(name, url, followers, index, category)
{

    if (category == "italy"){
      id = array_italy_id[index];
      threshold = array_italy_threshold[index];
      strHTML = strHTML_italy;
    }else if (category == "international"){
      id = array_international_id[index];
      threshold = array_international_threshold[index];
      strHTML = strHTML_international;

    }
    strHTML = strHTML + '<tr id="' + category + '_' + id + '" class="unselected ' + category + '_tr"><td>' + (index*1 + 1) + '</td><td class="noExport"><input type="checkbox"/></td><td class="name_css">' + name + '</td><td class=""><a href="' + url + '" target="_blank">' + url + '</a></td><td class="textali_right">' + followers + '</td><td class="textali_right">' + threshold + '</td><td class="refill textali_right">' + (threshold - followers) + '</td><td class="noExport"><button class="btn btn-block btn-info edit" data-toggle="modal" data-target="#edit_tr">EDIT</button></td><td class="noExport"><button class="btn btn-block btn-danger remove" data-toggle="modal" data-target="#remove_tr">REMOVE</button></td></tr>';

            if (category == "italy"){
              strHTML_italy = strHTML;
              document.getElementById(category + "_tb").innerHTML = strHTML_italy;
            }else if (category == "international"){
              strHTML_international = strHTML;
              document.getElementById(category + "_tb").innerHTML = strHTML_international;
            }

          $(".odd").remove();
          strHTML = '';
}

function sortTable(n, category) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(category);
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */

      if (n < 4){
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      } else {
        if (dir == "asc"){
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            shouldSwitch = true;
            break;
          }
        }
      }




    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      rows[i].childNodes[0].innerHTML = i;
      rows[i + 1].childNodes[0].innerHTML = i + 1;
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}


function display_international(){
    send_ajax_international(0);
}
function display(){
    send_ajax_italy(0);
}
function check_threshold()
{
    convert("below_threshold");
}

function convert(flag)
{
    if (flag == "all"){
        $("#italy").table2excel({
            exclude: ".noExport",
            filename: "report of italy playlists",
        });
        $("#international").table2excel({
            exclude: ".noExport",
            filename: "report of international playlists",
        });
    }else if (flag == "selected"){
        $("#italy").table2excel({
            exclude: ".unselected",
            filename: "report of italy playlists"
        });
        $("#international").table2excel({
            exclude: ".unselected",
            filename: "report of international playlists",
        });
    }else if (flag == "below_threshold"){
        $("#italy").table2excel({
            exclude: ".above_threshold",
            filename: "report of italy playlists",
        });
        $("#international").table2excel({
            exclude: ".above_threshold",
            filename: "report of international playlists",
        });
    }
    
}



$("#all_convert").click(function(){
    convert("all");
});

$("#selected_convert").click(function(){
    convert("selected");
});

$("#below_threshold_convert").click(function(){
    //check_threshold();
    convert("below_threshold");
});
$("#add_playlist_confirm").click(function(){
    var radio_category = $('input:radio:checked').val();
    //add_url = $("#url").val().replace("https://open.spotify.com/playlist", "https://api.spotify.com/v1/playlists");
    add_url = $("#url").val();
    $.post( "./php/add.php", { category : radio_category, url: add_url, threshold: $("#threshold").val() })
    .done(function( data ) {
      alert(data);
      location.reload(true);
    });
});

$(".pull-right").click(function(){
  if ($(this).hasClass("fa-angle-left")){
    $(this).removeClass("fa-angle-left");
    $(this).addClass("fa-angle-down");
  }else if ($(this).hasClass("fa-angle-down")){
    $(this).removeClass("fa-angle-down");
    $(this).addClass("fa-angle-left");
  }
});

$( document ).ready(function() {
  get_token();
    //display();
});

