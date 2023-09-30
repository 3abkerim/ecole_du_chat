//? FORMULAIRE

function nextStep(currentStep, nextStep) {
  var currentElement = document.getElementById("step" + currentStep);

  // Check if required fields in current step are filled
  var requiredFields = currentElement.querySelectorAll("input[required]");
  for (var i = 0; i < requiredFields.length; i++) {
    if (requiredFields[i].value == "") {
      alert("Veuillez remplir tous les champs obligatoires marqués d'un * avant de passer à l'étape suivante.");
      return; // Do not proceed to next step
    }
  }

  // Continue with existing logic
  currentElement.style.display = "none";
  if (nextStep) {
    var nextElement = document.getElementById("step" + nextStep);
    nextElement.style.display = "block";
    scrollToTop();
  } else {
    alert("Form submitted!");
  }
}

function previousStep(currentStep, previousStep) {
  document.getElementById("step" + currentStep).style.display = "none";
  document.getElementById("step" + previousStep).style.display = "block";
  scrollToTop();
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

grecaptcha.ready(function () {
  // handle recaptcha for the first form
  grecaptcha.execute("6Lfznh0nAAAAAOk9d9CojhqCh4DEDz_w4U-kBUZP", { action: "submit" }).then(function (token) {
    var form = document.getElementById("form-fa");
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "g-recaptcha-response";
    input.value = token;
    form.appendChild(input);
  });

  // handle recaptcha for the second form
  grecaptcha.execute("6LcyEx4nAAAAACAO-__6Fo4GJl1hSOUByJFQRcWm", { action: "submit" }).then(function (token) {
    var form = document.getElementById("form-ad");
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "g-recaptcha-response";
    input.value = token;
    form.appendChild(input);
  });

  // handle recaptcha for the third form
  grecaptcha.execute("6LePuB4nAAAAANWs-QcPnblx5a1HrSL3X8MLpzFH", { action: "submit" }).then(function (token) {
    var form = document.getElementById("inscription");
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "g-recaptcha-response";
    input.value = token;
    form.appendChild(input);
  });
});

//? FIN FORMULAIRE

//? INSCRIPTION

const departementSelect = document.querySelector('[name="departement"]');
const villeSelect = document.querySelector('[name="ville"]');

$(document).ready(function () {
  $("#departement").on("change", function () {
    var id_departement = this.value;
    console.log(id_departement);
    $.ajax({
      url: "traitement_villes",
      type: "POST",
      data: {
        departement_data: id_departement,
      },
      success: function (result) {
        $("#ville").html(result).trigger("change");
        console.log(result);
      },
    });
  });

  $("#ville").on("change", function () {
    var ville_id = this.value;
    $.ajax({
      url: "traitement_cp",
      type: "POST",
      data: {
        ville_data: ville_id,
      },
      success: function (result) {
        // update value of "cp" input field
        $("#cp").val(result);
      },
    });
  });
});

//? FIN INSCRIPTION

// ? PAS DE TEXT EN INPUT
function isNumber(event) {
  var keycode = event.keyCode;
  if (keycode >= 48 && keycode <= 57) {
    // these keycodes correspond to the numbers 0-9
    return true;
  }
  return false;
}
// ? FIN PAS DE TEXT EN INPUT

//? TEXTAREAS LIMIT
let textareas = document.getElementsByTagName("textarea");

for (let i = 0; i < textareas.length; i++) {
  let textarea = textareas[i];

  if (textarea.id === "exclude") {
    // if the textarea is the one to exclude
    continue; // skip to the next iteration
  }

  textarea.addEventListener("input", function () {
    let longueur = textarea.value.length;
    let reste = 500 - longueur;

    // assuming each textarea has a corresponding label with class 'form-label'
    let label = textarea.nextElementSibling;

    // check if the limit is exceeded
    if (longueur > 500) {
      // limit the input to 500 characters
      textarea.value = textarea.value.substring(0, 500);
      reste = 0;
    }

    if (reste > 1 || reste == 0) {
      label.innerHTML = "Reste " + reste + " caractères";
    } else {
      label.innerHTML = "Reste " + reste + " caractères";
    }
  });
}
//? FIN TEXTAREAS LIMIT

// ? FILTRES CHATS
$(document).ready(function () {
  // Initial AJAX call to get all cats when the page loads
  $.ajax({
    url: "filtres_chats",
    type: "POST",
    data: {
      gender: "any",
      age: "any",
    },
    success: function (data) {
      $("#cats-section").html(data);
    },
  });

  // Existing code
  $(document).on("click", ".btn-check", function () {
    $(".btn-check").change(function () {
      var gender = $('input[name="btn-group"]:checked').val();
      var age = $('input[name="btn-group2"]:checked').val();

      // console.log("Gender: " + gender);
      // console.log("Age: " + age);

      $.ajax({
        url: "filtres_chats",
        type: "POST",
        data: {
          gender: gender,
          age: age,
        },
        success: function (data) {
          $("#cats-section").html(data);
        },
      });
    });
  });
});
// ? FIN FILTRES CHATS

//? BARNAV
// navbar

// var prevScrollpos = window.scrollY;
// $(window).scroll(function () {
//   var currentScrollPos = window.scrollY;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("navbar").style.top = "0";
//   } else {
//     document.getElementById("navbar").style.top = "-100px";
//   }
//   prevScrollpos = currentScrollPos;
// });

var prevScrollpos = window.scrollY;
window.onscroll = function () {
  var currentScrollPos = window.scrollY;
  if (prevScrollpos > currentScrollPos || window.scrollY < 100) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-100px";
  }
  prevScrollpos = currentScrollPos;
};

//? FIN BARNAV

//?  COOKIES

var toastElList = [].slice.call(document.querySelectorAll(".toast"));
var toastList = toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl, {
    autohide: false,
  });
});
toastList.forEach((toast) => toast.show());

// The following part is what I added:
document.getElementById("accept").addEventListener("click", function () {
  document.cookie = "site_visited=1;max-age=" + 60 * 60 * 24 * 30; // Set cookie 'site_visited' to expire after 30 days
  location.reload(); // Reload the page to hide the cookie notice
});

document.getElementById("dismiss").addEventListener("click", function () {
  document.cookie = "dismissed=1;max-age=" + 60 * 60; // Set cookie 'dismissed' to expire after 1 hour
  // Hide the toast
  var cookieNotice = document.getElementById("cookie_notice");
  var bsToast = new bootstrap.Toast(cookieNotice);
  bsToast.hide();
});

//? FIN COOKIES

// ? ARCHIVES

// var prevScrollpos = window.scrollY;
// $(window).on("scroll touchmove", function () {
//   var currentScrollPos = window.scrollY;
//   if (prevScrollpos > currentScrollPos || currentScrollPos <= 20) {
//     document.getElementById("navbar").style.top = "0";
//   } else {
//     document.getElementById("navbar").style.top = "-100px";
//   }
//   prevScrollpos = currentScrollPos;
// });

// function nextStep(currentStep, nextStep) {
//   document.getElementById("step" + currentStep).style.display = "none";
//   if (nextStep) {
//     document.getElementById("step" + nextStep).style.display = "block";
//     scrollToTop();
//   } else {
//     alert("Form submitted!");
//   }
// }

// function previousStep(currentStep, previousStep) {
//   document.getElementById("step" + currentStep).style.display = "none";
//   document.getElementById("step" + previousStep).style.display = "block";
//   scrollToTop();
// }

// function scrollToTop() {
//   window.scrollTo({
//     top: 0,
//     behavior: "smooth",
//   });
// }
