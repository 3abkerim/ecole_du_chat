<?php
$image = getImageUser($bdd,$idUser);
?>

<div class="testBk">
  <div class="container userBk2">
    <div class="text-center">
      <form method="post" action="traitement_modif_photo_user" enctype="multipart/form-data" class="mt-5">
        <div class="mb-3 row">
          <label for="exampleFormControlInput1" class="col-lg-2 col-form-label">Ajouter une image</label>
          <div class="col-lg-4">
            <input
              type="file"
              class="form-control"
              id="inputGroupFile04"
              aria-describedby="inputGroupFileAddon04"
              aria-label="Upload"
              name="photo"
              onchange="handleFile(this.files)"
            />
          </div>
          <input type="hidden" name="idUser" value="<?php echo $idUser;?>" />
          <!-- <div class="col-lg-2">
            <button class="btn btn-primary" type="submit">Ajouter</button>
          </div> -->
        </div>
      </form>
    </div>


    <div class="row linePhotos"></div>

    <div class="row mt-2">
        <div class="col-12 text-center">
            <?php if (isset($_SESSION['success_idUser'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_idUser'] ?>
            </div>
            <?php unset($_SESSION['success_idUser']);  ?>
            <?php endif; ?> 

            <?php if (isset($_SESSION['success_deleted'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_deleted'] ?>
            </div>
            <?php unset($_SESSION['success_deleted']);  ?>
            <?php endif; ?> 
        </div>
    </div>

    <div class="row mt-3" style="display: none;" id="crop-section" >
      <div class="col-lg-4 col-sm-12 text-center mb-3 mx-auto">
        <div id="croppie"></div>
        <button id="crop">Crop & mettre en ligne</button>
      </div>
    </div>



    <div class="row mt-3" >
      <div class="col-lg-4 col-sm-12 text-center mb-3">
          <?php if(!empty($image['fichier'])){ ?>
          <img class="img-fluid" src="<?php echo $image['fichier']; ?>" alt=""/>
          <div class="d-flex justify-content-center mt-2 col-lg-12">
            <a class="dump" href="traitement_supprimer_photo_profil-<?php echo $idUser; ?>-<?php echo $image['id_image']; ?>">
              <img src="public/assets/images/dump.png" alt="" />
            </a>
          </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>

<script>
// Declare Croppie globally
var croppie;

document.addEventListener("DOMContentLoaded", (event) => {
  let el = document.getElementById("croppie");
  croppie = new Croppie(el, {
    viewport: { width: 100, height: 100 },
    boundary: { width: 300, height: 300 },
  });
});

// Handle file selection
function handleFile(files) {
  console.log("handleFile function has been called");
  let reader = new FileReader();
  reader.onload = function (event) {
    croppie.bind({
      url: event.target.result,
    });
    // Show the crop section
    document.getElementById("crop-section").style.display = "block";
  };
  reader.readAsDataURL(files[0]);
}

document.addEventListener("DOMContentLoaded", () => {
  // Handle crop
  document.getElementById("crop").addEventListener("click", function (e) {
    e.preventDefault(); // Prevent the form from submitting

    croppie.result({
      type: 'blob',
      size: 'viewport',
      format: 'png',
      quality: 1 // highest quality
    }).then(function (blob) {
      // Create a new FormData object
      let data = new FormData();

      // Append the cropped image file to the form data
      data.append("photo", blob, "filename.png"); // use .png extension

      // Append other form data
      data.append("idUser", document.querySelector('input[name="idUser"]').value);

      // Debug: Log the blob to see if it is as expected
      console.log(blob);

      // Send the form data to the server with fetch
      fetch("traitement_modif_photo_user", {
        method: "POST",
        body: data,
      })
      .then((response) => {
        if (!response.ok) {
          throw new Error("HTTP error " + response.status);
        }
        // Parse the JSON response
        return response.json();
      })
      .then((data) => {
        // Update the src attribute of your image with the new image URL
        document.querySelector('.img-fluid').src = data.imageUrl;
        // Hide the crop section
        document.getElementById("crop-section").style.display = "none";

        window.location.reload();

      })
      .catch(function (error) {
        console.log("Fetch Error :-S", error);
      });
    })
    .catch(function (error) {
      // Debug: Log any errors from croppie.result
      console.log("Croppie Error:", error);
    });
  });
});
</script>





