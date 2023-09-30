// ? BUTTON EN LIGNE

$(document).ready(function () {
  $(document).on("change", 'input[type="checkbox"][role="switch"][data-type="chat"]', function () {
    const chatId = $(this).data("id");
    const publieValue = this.checked ? 1 : 0;

    $.ajax({
      url: "../controller/traitement_enligne.php",
      type: "POST",
      data: {
        id: chatId,
        publie: publieValue,
      },
    });
  });

  $(document).on("change", 'input[type="checkbox"][role="switch"][data-type="event"]', function () {
    const eventId = $(this).attr("data-idEvent");
    const publieValue = this.checked ? 1 : 0;

    console.log($(this).attr("data-idEvent"), publieValue);

    $.ajax({
      url: "../controller/traitement_event_enLigne.php",
      type: "POST",
      data: {
        id: eventId,
        publie: publieValue,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });

  $(document).on("change", 'input[type="checkbox"][role="switch"][data-type="article"]', function () {
    const articleId = $(this).data("idArticle");
    const publieValue = this.checked ? 1 : 0;

    $.ajax({
      url: "../controller/traitement_article_enLigne.php",
      type: "POST",
      data: {
        id: articleId,
        publie: publieValue,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });

  $(document).on("change", 'input[type="checkbox"][role="switch"][data-type="opdn"]', function () {
    const opdnId = $(this).data("idOpdn");
    const publieValue = this.checked ? 1 : 0;

    $.ajax({
      url: "../controller/traitement_opdn_enLigne.php",
      type: "POST",
      data: {
        id: opdnId,
        publie: publieValue,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });

  $(document).on("change", 'input[type="checkbox"][role="switch"][data-type="produit"]', function () {
    const produitId = $(this).data("idProduit");
    const publieValue = this.checked ? 1 : 0;

    $.ajax({
      url: "../controller/traitement_produit_enLigne.php",
      type: "POST",
      data: {
        id: produitId,
        publie: publieValue,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      },
    });
  });
});

// ? BUTTON EN LIGNE

// ? IMAGES ORDRES

let draggedItem = null;
let draggedItemOrder = null;
let droppedItemOrder = null;

document.addEventListener("DOMContentLoaded", function () {
  const imageContainer = document.getElementById("imageContainer");
  const imageItems = document.querySelectorAll(".imageItem");

  imageItems.forEach((item) => {
    item.setAttribute("draggable", "true");

    item.addEventListener("dragstart", (e) => {
      draggedItem = item;
      e.dataTransfer.setData("text/plain", "");
    });

    item.addEventListener("dragover", (e) => {
      e.preventDefault();
    });

    item.addEventListener("drop", (e) => {
      e.preventDefault();
      if (draggedItem !== item) {
        // Swap the positions of the dragged item and the target item
        const draggedItemNextSibling = draggedItem.nextElementSibling;
        const targetItemNextSibling = item.nextElementSibling;

        if (draggedItemNextSibling === item) {
          // If the dragged item is right before the target item, insert the target item before the dragged item
          imageContainer.insertBefore(item, draggedItem);
        } else if (targetItemNextSibling === draggedItem) {
          // If the target item is right before the dragged item, insert the dragged item before the target item
          imageContainer.insertBefore(draggedItem, item);
        } else {
          // Otherwise, insert the dragged item before the target item and the target item before the original next sibling of the dragged item
          imageContainer.insertBefore(draggedItem, targetItemNextSibling);
          imageContainer.insertBefore(item, draggedItemNextSibling);
        }

        // Recalculate draggedItemOrder and droppedItemOrder after the order has changed
        draggedItemOrder = Array.from(imageItems).indexOf(draggedItem) + 1;
        droppedItemOrder = Array.from(imageItems).indexOf(item) + 1;

        updateImageOrder();
      }
    });
  });
});

function updateImageOrder() {
  const imageItems = document.querySelectorAll(".imageItem");
  let imageOrderData = [];

  imageItems.forEach((item, index) => {
    const imageId = item.dataset.image;
    const imageOrder = index + 1;
    item.querySelector(".number").textContent = imageOrder;
    imageOrderData.push({ id: imageId, order: imageOrder });
  });

  let swappedImages = imageOrderData.filter((item) => item.order === draggedItemOrder || item.order === droppedItemOrder);

  // AJAX call to update the order in the database
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controller/update_image_order.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(swappedImages));

  xhr.onload = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("Response from the server: \n" + xhr.responseText);
    }
  };
}

// ? FIN IMAGES ORDRES

//? 3 TABS GESTION DEMANDES ADOPTION

/**
 * Set the current cat ID in local storage.
 *
 * @param {string} idChat - The ID of the cat.
 */
function setCurrentCatId(idChat) {
  localStorage.setItem("currentCatId", idChat);
}

// Run this code after the page has fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Get the current cat ID from local storage
  const currentCatId = localStorage.getItem("currentCatId");

  if (currentCatId) {
    // Find the 'gestion_adoption_chat' link in the navigation
    const gestionTab = document.querySelector('.nav-item .nav-link[href*="gestion_adoption_chat"]');

    // If the link is found, append the current cat ID to its href
    if (gestionTab) {
      gestionTab.href = "gestion_adoption_chat-" + currentCatId;
    } else {
      console.warn("Could not find the navigation link to modify.");
    }
  } else {
    console.warn("Could not get the current cat ID from local storage.");
  }
});

// ? FIN 3 TABS GESTION DEMANDES ADOPTION

//? Affiche btn users
$(document).ready(function () {
  var initialSelection = $("#role").val();
  $("#role").change(function () {
    if ($(this).val() === initialSelection) {
      $("#validateButton").hide();
    } else {
      $("#validateButton").show();
    }
  });
});
//? FIN Affiche btn users

// ? CHART

let chartElement = document.getElementById("adoptionChart");
if (chartElement) {
  let ctx = document.getElementById("adoptionChart").getContext("2d");

  // Make an AJAX request to fetch the data from the server
  fetch("../controller/fetch_data_graph.php")
    .then((response) => response.json())
    .then((data) => {
      // Extract the required data from the response
      let labels = data.labels;
      let adoptionData = data.adoptionData;

      let adoptionChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Adoptions par mois de l'année actuelle",
              data: adoptionData,
              // borderColor: "rgba(75, 192, 192, 1)",
              // backgroundColor: "rgba(75, 192, 192, 0.2)",
              borderColor: "rgba(136, 188, 252)",
              backgroundColor: "rgba(252, 214, 139)",
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1,
                max: 10,
              },
            },
          },
        },
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// ? FIN CHART

// ? barres de recherche

$(document).ready(function () {
  $("#chat-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_chats.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#chats-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#chat-search").keyup();
});

$(document).ready(function () {
  $("#chat-adopte-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_chats_adoptes.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#chats-adoptes-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#chat-adopte-search").keyup();
});

$(document).ready(function () {
  $("#articles-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_articles.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#articles-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#articles-search").keyup();
});

$(document).ready(function () {
  $("#event-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_events.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#events-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#event-search").keyup();
});

$(document).ready(function () {
  $("#opdn-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_opdn.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#opdns-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#opdn-search").keyup();
});

$(document).ready(function () {
  $("#produit-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_produits.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#produits-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#produit-search").keyup();
});

$(document).ready(function () {
  $("#demande-ad-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_demandes_adoption.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#demandes-ad-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#demande-ad-search").keyup();
});

$(document).ready(function () {
  $("#demande-ad-chat-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_demandes_adoption_chat.php",
      method: "POST",
      data: { req: searchText, idChat: idChat },
      success: function (response) {
        $("#demandes-ad-chat-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#demande-ad-chat-search").keyup();
});

$(document).ready(function () {
  $("#fa-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_fa.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#fa-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#fa-search").keyup();
});

$(document).ready(function () {
  $("#demandes-fa-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_demandes_fa.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#demandes-fa-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#demandes-fa-search").keyup();
});

$(document).ready(function () {
  $("#user-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_users.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#users-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#user-search").keyup();
});

$(document).ready(function () {
  $("#ad-confirme-search").keyup(function () {
    var searchText = $(this).val();

    $.ajax({
      url: "../controller/fetch_adoptions_confirme.php",
      method: "POST",
      data: { req: searchText },
      success: function (response) {
        $("#ad-confirme-table tbody").html(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
      },
    });
  });
  // Trigger the keyup event when the page loads to show all the cats initially
  $("#ad-confirme-search").keyup();
});

// ? FIN barres de recherche

// ? CHATS EN LIGNE ET CHATS ADOPTES BUTTONS

document.getElementById("option1").addEventListener("change", function (event) {
  if (event.target.checked) {
    document.getElementById("chatsDispo").style.display = "block";
    document.getElementById("chatsAdoptes").style.display = "none";
  }
});

document.getElementById("option2").addEventListener("change", function (event) {
  if (event.target.checked) {
    document.getElementById("chatsDispo").style.display = "none";
    document.getElementById("chatsAdoptes").style.display = "block";
  }
});

// ? FIN CHATS EN LIGNE ET CHATS ADOPTES BUTTONS