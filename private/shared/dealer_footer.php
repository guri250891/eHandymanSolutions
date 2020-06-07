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

<script type="text/javascript" src="<?php echo url_for('/js/jquery-3.4.1.min.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	</body>

</html>
<?php
	db_disconnect($db);
?>