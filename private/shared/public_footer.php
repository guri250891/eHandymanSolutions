<!--Footer HTML Starts-->
      <footer>
            <article class="footerFirst">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Quick Links</h3>
                            <ul>
                                <li><a href="<?php echo url_for('/index.php?subject_id=2'); ?>">About</a></li>
                                <li><a href="<?php echo url_for('/index.php?subject_id=5'); ?>">Contact Us</a></li>
                                <li><a href="<?php echo url_for('/userArea/references.php'); ?>">References</a></li>
                            </ul>
                        </div>  
                        <div class="col-md-4">
                            <h3>Follow Us</h3>
                            <ul class="follow">
                                <li><a href="https://www.facebook.com/" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><span><i class="fab fa-twitter"></i></span></a></li>
                                <li><a href="https://accounts.google.com/signin/" target="_blank"><span><i class="fab fa-google"></i></span></a></li>
                            </ul>
                        </div>  
                        <div class="col-md-4 logo">
                            <a href="<?php echo url_for('/index.php?subject_id=1'); ?>">E-HandyMan<br/>Solutions</a>
                        </div>
                    </div>
                </div>
            </article>
            <article class="footerSecond">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><span><i class="far fa-copyright"></i></span>2019 E-Handyman Solutions. All Rights Reserved</h3>
                        </div> 
                    </div>
                </div>
            </article>
            </div>
      </footer>

      <!--Footer HTML Ends-->

      <script>
    
    var serviceType = document.querySelectorAll("input[type='radio']");
    var householdSubType = document.getElementById("householdSubType");
    var businessSubType = document.getElementById("businessSubType");
    
    
    serviceType[0].onchange = function(){
        householdSubType.style.display = "Block";
        businessSubType.style.display = "None";
    };
    serviceType[1].onchange = function(){
        businessSubType.style.display = "Block";
        householdSubType.style.display = "None";
    };
    
    
</script>
<script type="text/javascript">
            var sessionUserName = '<?php echo $_SESSION['username'] ?? ''; ?>';

            var liSubjects = document.getElementsByClassName("subject_main");

            //console.log(sessionUserName+"..............");

            //console.log(liSubjects[5].children[0].innerText);

            var signInText = liSubjects[5].children[0].innerText;

            var dealerJoin = document.getElementById("joinDealer");

            var rightTop = document.getElementById("right");

            var anchor = document.createElement("a");
            var textNode = document.createTextNode('Show Requested Services');

            //console.log(liSubjects[5].children[0].href);

            if(sessionUserName !== "" && !signInText.localeCompare("Sign In")){
                liSubjects[5].children[0].innerText = "Sign Out";
                liSubjects[5].children[0].href = "<?php echo url_for('/userArea/user_logout.php'); ?>";
                dealerJoin.innerText = "View Profile";
                dealerJoin.href = "<?php echo url_for('/userArea/viewUserProfile.php?id=' . $_SESSION['user_id']); ?>";
                anchor.appendChild(textNode);
                rightTop.appendChild(anchor);
                anchor.className = 'showServiceRequestes';
                anchor.setAttribute("href", "<?php echo url_for('/userArea/showUserServiceRequests.php'); ?>");
                anchor.style.color = "#fff";
            }
            else{
                liSubjects[5].children[0].innerText = "Sign In";
                liSubjects[5].children[0].href = "<?php echo url_for('/testProject/public/index.php?subject_id=6'); ?>";
                dealerJoin.href = "<?php echo url_for('/index.php?subject_id=8'); ?>";
                rightTop.removeChild(anchor);
            }

        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                var sessionUserEmail = '<?php echo $_SESSION['email'] ?? ''; ?>';
                var sessionUserPhone= '<?php echo $_SESSION['mobile'] ?? ''; ?>';
                var sessionUserAddress = '<?php echo $_SESSION['address'] ?? ''; ?>';

                $("#email").val(sessionUserEmail);
                $("#mobile").val(sessionUserPhone);
                $("#address").val(sessionUserAddress);

            });
        </script>     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="<?php echo url_for('/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo url_for('/js/extScript.js'); ?>"></script>
  </body>
</html>

<?php
    db_disconnect($db);
?>