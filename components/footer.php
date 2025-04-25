<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>

<script>
  // Get the modal
  // const modal = document.querySelector("#myModal");

  // Get the button that opens the modal
  // const btn = document.querySelectorAll(".btn-news");

  // // Get the <span> element that closes the modal
  // const closeModal = document.getElementsByClassName("close")[0];

  // for (let i = 0; i < btn.length; i++) {
  //   btn[i].addEventListener("click", function () {
  //      document.getElementById('news').innerHTML = this.value;
  //     modal.style.display = "block";
  //   });
  // }

  // // When the user clicks the button, open the modal
  // btn.onclick = function () {
  //   modal.style.display = "block";
  // };

  // // When the user clicks on <span> (x), close the modal
  // closeModal.onclick = function () {
  //   modal.style.display = "none";
  // };

  // // When the user clicks anywhere outside of the modal, close it
  // window.onclick = function (event) {
  //   if (event.target == modal) {
  //     modal.style.display = "none";
  //   }
  // };


  var firebaseConfig = {
    apiKey: "AIzaSyC0JZr8g9nOtEFhSS3-tYupuaIxN5SdWVs",
    authDomain: "web-push-notifications-f1cf1.firebaseapp.com",
    projectId: "web-push-notifications-f1cf1",
    storageBucket: "web-push-notifications-f1cf1.appspot.com",
    messagingSenderId: "381496875115",
    appId: "1:381496875115:web:db384171b17aa6ace2792e",
    measurementId: "G-0C1KZ6RRXZ"
  };
  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();

  function IntitalizeFireBaseMessaging() {
    messaging
      .requestPermission()
      .then(function() {
        console.log("Notification Permission");
        return messaging.getToken();
      })
      .then(function(token) {
        console.log("Token : " + token);
        document.getElementById("token").value = token;
      })
      .catch(function(reason) {
        console.log(reason);
      });
  }

  messaging.onMessage(function(payload) {
    console.log(payload);
    const notificationOption = {
      body: payload.notification.body,
      icon: payload.notification.icon
    };

    if (Notification.permission === "granted") {
      var notification = new Notification(payload.notification.title, notificationOption);

      notification.onclick = function(ev) {
        ev.preventDefault();
        window.open(payload.notification.click_action, '_blank');
        notification.close();
      }
    }

  });
  messaging.onTokenRefresh(function() {
    messaging.getToken()
      .then(function(newtoken) {
        console.log("New Token : " + newtoken);
      })
      .catch(function(reason) {
        console.log(reason);
        //alert(reason);
      })
  })
  IntitalizeFireBaseMessaging();
</script>
<footer class="footer" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">
  <!-- About Section -->



  <section class=" ftr_tag">
    <div class="container">
      <div class="pdsecrion">
        <div><img src="logo.jpg" alt="<?php echo site_name ?>" class="w-40 md:w-40"></div>
        <div class="dt">
          <p>
            Kay Paper Deals Pvt Ltd is working as sourcing agent for Paper Industries. We are working with various
            paper mills across India and exporting to all the major paper manufacturers across world.
          </p>
        </div>
      </div>


    </div>
  </section>
  <section class="ftr_section " id="contact">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 ">
      <div class="flex flex-col  sell  ">
        <div class="ftr_head flex flex-col gap-1">
          <h3>Contact Us</h3>
          <!-- <span class="border-b-2 w-6 border-[#86776f]"></span> -->
        </div>
        <div class="flex flex-col fof ">
          <div class="flex flex-row gap-4 py-2 iii">
            <i class="bi bi-geo-alt-fill text-[#fff]"></i>
            <p> Registered Office : Kay Paper Deals Pvt Ltd. <br>
              B-9, F/F, Housing society,<br>N.D.S.E - 1
              New Delhi -110049</p>
          </div>
          <div class="flex flex-row gap-4 py-2 num">
            <i class="bi bi-telephone-fill text-[#fff]"></i>
            <p>9837093712, 7017744883</p>
          </div>
          <div class="flex flex-row gap-4 py-2 mail">
            <i class="bi bi-envelope text-[#fff]"></i>
            <p>support@paperdeals.in</p>
          </div>




        </div>

        <style>
          .socials-link {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 10px;

          }

          .social-link {
            transition: transform 4s ease-in-out, box-shadow 4s ease-in-out;
          }

          .social-link a {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: inherit;

          }

          .social-link a:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);

          }

          .social-link i {
            font-size: 28px;
            transition: all 4s ease-in-out;
          }

          /* .social-link a:hover i {
            color: #0073b1;
            /* Change to your desired hover color */
        </style>
        <!--<ul class="socials-link">-->
        <!--  <li class="social-link">-->
        <!--    <a href="" target="_blank">-->
        <!--      <i class="fa-brands fa-facebook text-[28px] "></i>-->
        <!--    </a>-->
        <!--  </li>-->

        <!--  <li class="social-link" style="height:39px;">-->
        <!--    <a href="" target="_blank">-->
        <!--      <i class="fa-brands fa-x-twitter text-[28px] "></i>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="social-link">-->
        <!--    <a href="" target="_blank">-->
        <!--      <i class="fa-brands fa-instagram text-[28px] "></i>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="social-link">-->
        <!--    <a href="" target="_blank">-->
        <!--      <i class="fa-brands fa-linkedin text-[28px]"></i>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--</ul>-->

        <style>
          .social-link {

            padding: 6px;
            margin: 2px;

          }
        </style>


      </div>

      <div class="flex flex-col  sell">
        <div class="ftr_head flex flex-col gap-1">
          <h3>Quick Links</h3>
          <!-- <span class="border-b-2 w-6 border-[#86776f]"></span> -->
        </div>
        <div class="flex flex-col lii">
          <ul>
            <li><a href="./">About Us</a></li>
            <li><a href="disclaimer.php">Disclaimer</a></li>
            <li><a href="privacy_policy.php">Privacy Policy</a></li>
            <li><a href="payment_policy.php">Payment Policy</a></li>
            <li><a href="terms_conditions.php">Terms & Conditions</a></li>
            <!-- <li><a href="faq.php">FAQ</a></li> -->
          </ul>
        </div>
      </div>


      <div class="flex flex-col  sell" style="margin-bottom: 5%;">
        <div class="ftr_head flex flex-col gap-1">
          <h3>Our Location</h3>
          <!-- <span class="border-b-2 w-6 border-[#86776f]"></span> -->
        </div>
        <iframe title="business map location" src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3504.017071619498!2d77.21873857549846!3d28.569250075699415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDM0JzA5LjMiTiA3N8KwMTMnMTYuNyJF!5e0!3m2!1sen!2sin!4v1716003534413!5m2!1sen!2sin" width="90%" height="150" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- <h3 style="font-size:20px; text-align: center;">A Product of Kay Group</h3> -->
        <ul class="socials-link">
          <li class="social-link">
            <a href="https://www.facebook.com/profile.php?id=61554782455824" target="_blank">
              <i class="fa-brands fa-facebook text-[28px] "></i>
            </a>
          </li>

          <li class="social-link" style="height:39px;">
            <a href="" target="_blank">
              <i class="fa-brands fa-x-twitter text-[28px] "></i>
            </a>
          </li>
          <li class="social-link">
            <a href="" target="_blank">
              <i class="fa-brands fa-instagram text-[28px] "></i>
            </a>
          </li>
          <li class="social-link">
            <a href="https://www.linkedin.com/company/paper-deals/" target="_blank">
              <i class="fa-brands fa-linkedin text-[28px]"></i>
            </a>
          </li>
          <li class="social-link">
            <a href="https://www.youtube.com/channel/UCo01JZ9yzH2cXkSHLYa3I9w" target="_blank">
              <i class="fa-brands fa-youtube text-[28px]"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="flex flex-row items-center  gap-2  iii">
      <p style="margin:0 auto;font-size:20px;">A Product of Kay Group</p>
    </div>
  </section>

</footer>

<div id="myModal" class="modal cstm_mdl_rc">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="center">
      <button class="close"><i class="bi bi-x-lg"></i></button>
      <h1>Request Callback</h1>
      <form name="request_callback" action="#" method="post">
        <div class="inputbox">
          <input type="text" class="form-control" id="name1" name="name" required>
          <span>Name</span>
        </div>
        <div class="inputbox">
          <input type="phone" name="phone" required="required" onKeyPress="if(this.value.length==10) return false;">
          <span>Mobile</span>
        </div>
        <button class="btn" type="submit" name="modal_req">
          Submit
        </button>
      </form>
    </div>
  </div>
</div>
<!-- Toast container -->
<style>
  /* Toast container */
  #toastContainer {
    position: fixed;
    top: 10px;
    right: 10px;
    z-reindex: 1000;
  }

  /* Toast base styles */
  .toast {
    position: fixed;
    top: 118px;
    right: 30px;
    border-radius: 12px;
    background: #24ac24;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transform: translateX(calc(100% + 30px));
    display: none;
    transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    /* Smooth entrance */
  }

  /* Toast active state */
  .toast.active {
    transform: translate(0%, 0%);
    /* Slide in */
  }

  /* Toast content */
  .toast .toast-content {
    display: flex;
    align-items: center;
  }

  /* Check icon styling */
  .toast-content .check {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    min-width: 35px;
    background-color: #fff;
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
  }

  /* Message styling */
  .toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
  }

  /* Message text */
  .message .text {
    font-size: 16px;
    font-weight: 400;
    color: #fff;
  }

  .message .text.text-1 {
    font-weight: 600;
    color: #fff;
  }

  /* Close button styling */
  .toast .close {
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
  }

  .toast .close:hover {
    opacity: 1;
  }

  /* Progress bar */
  .toast .progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
  }

  .toast .progress:before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
    background-color: #fff;
  }

  .progress.active:before {
    animation: progress 5s linear forwards;
  }

  /* Keyframes for progress bar animation */
  @keyframes progress {
    to {
      width: 0;
    }
  }

  /* Button styling */
  button {
    padding: 12px 20px;
    font-size: 20px;
    outline: none;
    border: none;
    background-color: #4070f4;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background-color: #0e4bf1;
  }

  /* Disable button interaction while toast is active */
  .toast.active~button {
    pointer-events: none;
  }
</style>
<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "flex";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<div class="toast active">

  <div class="toast-content">
    <i class="fa fa-check text-white"></i>
    <div class="message">
      <span class="text text-1">Success</span>
      <span class="text text-2">Request Call has been saved</span>
    </div>
  </div>
  <!-- Remove 'active' class, this is just to show in Codepen thumbnail -->
  <div class="progress active" style="color:#fff;"></div>
</div>
<?php

if (isset($_REQUEST['modal_req'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  $query = "insert into reqcall(name,phone) values('$name','$phone')";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) { ?>

    <script>
      // Get the elements with the class name "toast"
      var toasts = document.getElementsByClassName("toast");
      // Check if there is at least one element in the collection
      if (toasts.length > 0) {
        // Set the display style of the first element to "block"
        toasts[0].style.display = "block";
        setTimeout(() => {
          toasts[0].style.display = "none";
          location.href = "index.php";

        }, 5000);
      }
    </script>
  <?php } else { ?>
    <script>
      alert('Request Callback Data not saved. Please try again later.');
    </script>
<?php }
}
?>