<footer>

	<article class="footerSecond">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><span><i class="far fa-copyright"></i></span><?php echo date('Y'); ?> E-Handyman Solutions. All Rights Reserved</h3>
                        </div> 
                    </div>
                </div>
            </article>
		</footer>

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

	</body>

</html>
<?php
	db_disconnect($db);
?>